<?php

namespace App\Http\Controllers;
use Lang;
use App\Models\Sow;
use App\Models\ProjectType;
use App\Models\ProcuringParty;
use App\Models\SowMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Location;
use App\Models\Manager;
use App\Models\SowComment;
use App\Models\AnnexureAttribute;
use App\Models\AnnexureValue;
use App\Models\Workflow;
use Spatie\Permission\Models\Role;
use PDF;
use App\Models\Transaction;
use App\Models\AttributeComment;
use App\Models\SowAuthorization;
use App\Models\SowAmendment;

use Illuminate\Support\Facades\Input;

class SowController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:sow-list', ['only' => ['sowList', 'sowView','revision']]);
        $this->middleware('permission:sow-create', ['only' => ['create','store','stepEdit','update','annexupdate']]);
        $this->middleware('permission:sow-review|sow-approve', ['only' => ['sowActionForm','sowTransition']]);
        $this->middleware('permission:sow-download', ['only' => ['generatePdf']]);
        $this->middleware('permission:sow-revision', ['only' => ['revision']]);
        $this->middleware('permission:sow-delete', ['only' => ['destroy']]);
    }

    /**
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Sow::with('project_type')
                    ->with('procuring_party')
                    ->latest()
                    ->paginate(5);
        return view('sows.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projectTypes = ProjectType::pluck('type','id')->all();
        $procuringParties = ProcuringParty::pluck('name','id')->all();
        $headerDesc = SowMaster::where('name','header_desc')->pluck('content');
        return view('sows.create', compact('projectTypes', 'procuringParties', 'headerDesc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if($request->input('project_desc')!=''){
        $request->merge(array('project_desc' => preg_replace('/^<p><br><\/p>/', '', $request->input('project_desc'))));
        $request->merge(array('project_desc' => preg_replace('/^<p>&nbsp;<\/p>/', '', $request->input('project_desc'))));
        $request->merge(array('project_desc' => preg_replace('/^<p><\/p>/', '', $request->input('project_desc'))));
      }
       request()->validate([
            'project_name' => 'required',
            'project_desc' => 'required',
            'project_type_id' => 'required',
            'procuring_party_id' => 'required',
        ]);

        $request->merge(["creator_id"=>Auth::user()->id,'status'=>'draft','type'=>'sow']); 
        //$sow =Sow::create($request->all());
        $masters = SowMaster::where('project_type_id',$request->input('project_type_id'))
                            ->pluck('content','name');
        
        $fillables = array();
        foreach($masters as $key=>$master)
            $fillables["$key"] = $master;
        $request->merge($fillables);  
        $sow =Sow::create($request->all());
        
        $annexMasters = AnnexureAttribute::where('project_type_id', $request->input('project_type_id'))
                                        ->where('control_type','checkbox')
                                        ->select('id','default_value')
                                        ->get()
                                        ->toArray();
        $annexfillables = array();
        foreach($annexMasters as $key=>$master)
            // $annexfillables[] = array( 
            //                             'sow_id' => $sow->id, 
            //                             'attribute_id' => $master['id'], 
            //                             'value' => $master['default_value'],
            //                             'created_at' => \Carbon\Carbon::now()
            //                         );
            //  AnnexureValue::insert($annexfillables);
          AnnexureValue::create(
              [ 
                'sow_id' => $sow->id, 
                'attribute_id' => $master['id'], 
                'value' => $master['default_value']
              ]
            ); 

          Transaction::create(
              [    
                  'user_id'     => Auth::user()->id,
                  'sow_id'      => $sow->id,
                  'from_status' => '',
                  'to_status'   => 'draft',
                  'role_id'     => Role::findByName('creator')->id
              ]
          ); 
        
          return redirect()->route('sowEdit',['filter'=>"draft" , 'id'=>$sow->id , 'step'=>2 ]) 
                         ->with('success','SOW created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sow  $Sow
     * @return \Illuminate\Http\Response
     */
    public function show($sow_id)
    { 
        $sow = Sow::where('id', $sow_id)
                    ->with('project_type')
                    ->with('procuring_party')
                    ->with('location')
                    ->with('creator')
                    ->with('reviewer')
                    ->with('supplierManager')
                     ->with('customerManager')
                    ->with(['comments' => function($query) {
                      $query->orderBy('updated_at', 'desc')->paginate(10);
                    }])
                    ->with([
                        'annexureAttributes',
                        'annexureAttributes.annexureValues' => function($query) use ($sow_id) {
                          $query->where('sow_id', $sow_id);
                        }])
                    ->with(['attributeComments' => function($query) {
                          $query->orderBy('created_at', 'desc');
                        }])
                    ->with(['headerDesc' => function($query) {
                      $query->where('name', 'header_desc')->first();
                    }])
                    ->first();

        $annexureAttributes = $sow->annexureAttributes->groupBy('type');
 
        $masters = SowMaster::where('project_type_id',$sow->project_type_id)->pluck('content','name');
        $attributeComments = $sow->attributeComments->groupBy('attribute');
       
        $active = false; //used to indicate if commenting should be activated. will be false for readonly views  
        return view('sows.show',compact('sow','masters','annexureAttributes','active'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sow  $Sow
     * @return \Illuminate\Http\Response
     */
    public function sowView($filter, $sow_id)
    {   
        $sow = Sow::where('id', $sow_id)
                    ->with([
                            'annexureAttributes',
                            'annexureAttributes.annexureValues' => function($query) use ($sow_id) {
                            $query->where('sow_id', $sow_id);
                        }])
                    ->with(['attributeComments' => function($query) {
                      $query->orderBy('created_at', 'desc');
                    }])
                    ->with(['headerDesc' => function($query) {
                            $query->where('name', 'header_desc')->first();
                    }])
                    ->first(); 

        $data = Transaction::where('sow_id',$sow_id)
                    ->latest()
                    ->paginate(25); 
                  
        $annexureAttributes = $sow->annexureAttributes->groupBy('type');

        $attributeComments = $sow->attributeComments->groupBy('attribute');
        $sow_authorizationsUserList = [];

        if($sow['status'] != 'approved_by_approver')
        {
            $transaction = Transaction::where([
              'sow_id'=> $sow_id,
              'to_status'=> 'sent_to_reviewer',
              ['from_status', "!=", 'sent_to_reviewer']
            ])
            ->orderBy('created_at', 'desc') 
            ->first();
              if($transaction){
                $sow_authorizationsUserList = SowAuthorization::where('sow_id', $sow_id)
                                            ->where('role_id', Role::findByName('reviewer')->id)
                                            ->where('transaction_id', $transaction->id)
                                            ->with(['authorizationUser' => function($query) {
                                              $query->orderBy('created_at', 'desc');
                }]) 
                ->distinct('user_id')->get()->toArray();
              }
        }    
        $active = false; //used to indicate if commenting should be activated. will be false for readonly views
        $masters = SowMaster::where('project_type_id',$sow->project_type_id)->pluck('content','name');

        // if($sow->type =="amendment")
        //   return view('sows.show',compact('sow','masters','annexureAttributes', 'filter','data', 'attributeComments', 'active','sow_authorizationsUserList'));
        // else
          return view('sows.show',compact('sow','masters','annexureAttributes', 'filter','data', 'attributeComments', 'active','sow_authorizationsUserList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sow  $Sow
     * @return \Illuminate\Http\Response
     */
    public function edit(Sow $sow)
    {   
        $projectTypes = ProjectType::pluck('type','id')->all();
        $procuringParties = ProcuringParty::pluck('name','id')->all();
        $locations = Location::pluck('type','id')->all();
        $customerManagers = Manager::where('type','customer')->pluck('name','id')->all();
        $supplierManagers = Manager::where('type','supplier')->pluck('name','id')->all();
        $headerDesc = SowMaster::where('name','header_desc')->pluck('content');
       
        return view('sows.edit',compact('sow'), compact('projectTypes', 'procuringParties', 
        'locations','customerManagers','supplierManagers','headerDesc'));
    }

    /**
     * Show the form for editing the specified resource. 
     *
     * @param  \App\Models\Sow  $Sow
     * @return \Illuminate\Http\Response
     */
    public function stepEdit($filter, $sowId, $step)
    { 
        if($step==5) {
            $sowResult = Sow::where( 'id', $sowId )
                          ->with([
                                  'annexureAttributes',
                                  'annexureAttributes.annexureValues' => function($query) use ($sowId) {
                                    $query->where('sow_id', $sowId);
                                  }])
                          ->with(['attributeComments' => function($query) {
                            $query->orderBy('created_at', 'desc');
                          }]) 
                          ->first();
            $annexureAttributes = $sowResult->annexureAttributes->groupBy('type');
            $attributeComments = $sowResult->attributeComments->groupBy('attribute');
            $masters = SowMaster::where('project_type_id',$sowResult->project_type_id)->pluck('content','name');
            return view('sows.annex',compact('filter','sowResult','masters','annexureAttributes','attributeComments'));
        }
        elseif($step==6) {
          $sow = Sow::where('id', $sowId)->first();

          $roles = Role::findByName('reviewer');
          $reviewerList = Workflow::with('user')
                          ->ByProjectTypeRole($sow->project_type_id, $roles->id)
                          ->get()
                          ->toArray();

          $transaction = Transaction::where([
                            'sow_id'=> $sowId,
                            'to_status'=> 'sent_to_reviewer',
                            ['from_status', "!=", 'sent_to_reviewer']
          ])
          ->orderBy('created_at', 'desc') 
          ->first();

          $sow_authorizationsList = [];
          if($transaction) {
            $sow_authorizationsList = SowAuthorization::where('sow_id', $sowId)
            ->where('role_id', $roles->id)
            ->where('transaction_id', $transaction->id)
            ->distinct('user_id')
                            ->pluck('user_id')
                            ->toArray();
          }
          return view('sows.authorization' ,compact('filter', 'sow','reviewerList','sow_authorizationsList'));
        }
        else {
            $sow = Sow::where('id', $sowId)
                        ->with(['attributeComments' => function($query) {
                          $query->orderBy('created_at', 'desc');
                        }]) 
                        ->first(); 
                        
            $projectTypes = ProjectType::pluck('type','id')->all();
            $procuringParties = ProcuringParty::pluck('name','id')->all();
            $locations = Location::pluck('type','id')->all();
            $customerManagers = Manager::where('type','customer')->pluck('name','id')->all();
            $supplierManagers = Manager::where('type','supplier')->pluck('name','id')->all();
            $headerDesc = SowMaster::where('name','header_desc')->where('project_type_id',$sow->project_type_id)->pluck('content');
            $attributeComments = $sow->attributeComments->groupBy('attribute');
           
            return view('sows.step'.$step ,compact('sow','projectTypes', 'procuringParties', 
            'locations','customerManagers','supplierManagers','headerDesc','filter','attributeComments'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sow  $Sow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sow $sow)
    {
      $step   = $request->input('step');
      $filter = $request->input('filter');
        switch($step){
          case 2 :
            if($request->input('project_desc')!=''){
              $request->merge(array('project_desc' => preg_replace('/^<p><br><\/p>/', '', $request->input('project_desc'))));
              $request->merge(array('project_desc' => preg_replace('/^<p>&nbsp;<\/p>/', '', $request->input('project_desc'))));
              $request->merge(array('project_desc' => preg_replace('/^<p><\/p>/', '', $request->input('project_desc'))));
            }
            request()->validate([
                'project_name' => 'required',
                'project_desc' => 'required',
                'project_type_id' => 'required',
                'procuring_party_id' => 'required',  
            ]);
          break;
          case 3:
            $requestToBeValidated = [
                'act_scope_work' => 'required',
                'skills_tech_abilities' => 'required',
                'infra_cust' => 'required',
                'infra_supp' => 'required',
                'location_id' => 'required',
                'work_days' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'work_allocation' => 'required'
            ];
            
            if(request()->team_composition_rows != null)
                $requestToBeValidated['team_composition_rows'] = 'required|integer|min:1';
            
            request()->validate($requestToBeValidated);
          break;
          case 4:
                $requestToBeValidated = [
                  'progress_reporting' => 'required',
                  'acceptance_criteria' => 'required',
                  'slas_agreed' => 'required',
                  'cust_manager_id' => 'required',
                  'supp_manager_id' => 'required',
                  'extension' => 'required', 
                ];
           if( $request->input('project_type_id') == 3){
                  $requestToBeValidated ['change_control'] = 'required';
                  $requestToBeValidated ['risk_mitigation_plans'] = 'required';
           }
           request()->validate($requestToBeValidated);
          break;
          case 5:
            request()->validate([
                'applicability_deliverables' => 'required',
                'price' => 'required',
                'overtime_working' => 'required',
                'payments' => 'required',
                'out_pocket_travel_exp' => 'required',
                'trans_back_arr' => 'required',
                'data_protection' => 'required' 
            ]);
          break;
          default:
          break;
        }      
        if($step == 2){
                  $result = Sow::where('id', $sow->id)->select('project_type_id')
                        ->first(); 
                  if ( $result && $result['project_type_id'] != $request->input('project_type_id') ) {
                        $masters = Sow::getSowmasterOnProjectType($request->input('project_type_id'));
                        
                        $fillables = array();
                        foreach($masters as $key=>$master)
                            $fillables["$key"] = $master;                
                        $request->merge($fillables);
                        $sow->update($request->all());

                        $annexMasters = AnnexureAttribute::where('project_type_id', $request->input('project_type_id'))
                        ->where('control_type','checkbox')
                        ->select('id','default_value')
                        ->get()
                        ->toArray();
                        $annexfillables = array();
                        foreach($annexMasters as $key=>$master)
                        $annexfillables[] = array( 
                                                'sow_id' => $sow->id, 
                                                'attribute_id' => $master['id'], 
                                                'value' => $master['default_value'],
                                                'created_at' => \Carbon\Carbon::now()
                                            );
                        AnnexureValue::where('sow_id', $sow->id)->delete();                    
                        AnnexureValue::insert($annexfillables);                        
                  }
                  else 
                  $sow->update($request->all());
        } 
        else 
              $sow->update($request->all());
        return redirect()->route('sowEdit',['filter'=>$filter , 'id'=>$sow->id , 'step'=>$step ])
                         ->with('success','SOW updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sow  $Sow
     * @return \Illuminate\Http\Response
     */
    public function annex($sowID)
    {
        $authId = Auth::id();
        $sowResult = Sow::where( 'id', $sowID )
                        ->where('creator_id', $authId)
                        ->with([
                                'annexureAttributes',
                                'annexureAttributes.annexureValues' => function($query) use ($sowID) {
                                  $query->where('sow_id', $sowID);
                                }])
                        ->first();
        $annexureAttributes = $sowResult->annexureAttributes->groupBy('type');
        $masters = SowMaster::where('project_type_id',$sowResult->project_type_id)->pluck('content','name');
        return view('sows.annex',compact('sowResult','masters','annexureAttributes'));
    }

    public function annexupdate(Request $request)
    {
        $error_string = '';
        $step   = $request->input('step');
        $filter = $request->input('filter');
        
        $sowdata = array(
          'agree_date'            =>  $request->input('agree_date'),
          'annex_personal_other'  =>  $request->input('annex_personal_other'),
          'authorised_processors' =>  $request->input('authorised_processors')
        );
        if($request->has('submitreview')) {
            request()->validate([
              'agree_date' => 'required',
              'annexsubcat'=>'required',
              'annexPersonal'=>'required'
            ]); 

            $emptyKeys =  $this->validateSow($request->input('id')); 
            if(!empty($emptyKeys)){
                foreach($emptyKeys as $key => $val) 
                   $error_string .= Lang::get('validation.attributes.'.$val).", ";
            }
            $error_string = rtrim($error_string,", ");
        }  
        $annex = array();
        if( $request->has('annexsubcat') && !$request->has('annexPersonal') )
            $annex = $request->input('annexsubcat');
        if( !$request->has('annexsubcat') && $request->has('annexPersonal') )
            $annex = $request->input('annexPersonal');
        if( $request->has('annexsubcat') && $request->has('annexPersonal'))         
            $annex = array_merge($request->input('annexsubcat'), $request->input('annexPersonal'));
        
        if( ($request->has('annexsubcat') || $request->has('annexPersonal')) && sizeof( $annex ) > 0 ) { 
                AnnexureValue::where( 'sow_id', $request->input('id') )
                ->whereIn( 'attribute_id', $annex )
                ->update(['value'=>'1']);
                
                AnnexureValue::where( 'sow_id', $request->input('id') )
                ->whereNotIn( 'attribute_id', $annex )
                ->update(['value'=>'0']);
        }
        if( $error_string == '')Sow::where( 'id', $request->input('id') )->update($sowdata);
      
        if($request->has('submitreview') && $error_string == ''){
            return redirect()->route('sowEdit',['filter'=>$filter , 'id'=>$request->input('id') , 'step'=>$step ]);
        }
        elseif($request->has('submitreview') && $error_string != ''){
            return redirect()->back()->withErrors(['general' => 'These fields are required '.$error_string.' from previous steps.']);
        }
        else{
            return redirect()->route('sowslist' , 'draft')
                ->with('success','SOW created successfully');
        }
    }

    public function authorizationUpdate(Request $request)
    {
        $status = 'draft'; 
        $error_string = '';
        $step   = $request->input('step');
        $filter = $request->input('filter');
        $sow = Sow::where( 'id', $request->input('id') )->first();
        
        $emptyKeys =  $sow->type == 'sow'?$this->validateSow($request->input('id')):$this->validateAmendment($request->input('id')); 
        if(!empty($emptyKeys)){
            foreach($emptyKeys as $key => $val) 
               $error_string .= Lang::get('validation.attributes.'.$val).", ";
        }
        $error_string = rtrim($error_string,", ");
        if($error_string!=""){
            return redirect()->back()->withErrors(['general' => 'These fields are required '.$error_string.' from previous steps.']);
        }
        elseif(!$request->has('reviewer')) {
            return redirect()->back()->withErrors(['general' => 'Kindly select at least one reviewer before submission.']);
        }
        elseif($request->has('submitreview') && $request->has('reviewer')) {
            //start wf
            $reviewers = $request->input('reviewer');
            $sowdata = array(
              "status"   => "sent_to_reviewer",

            );
            $sow = Sow::where( 'id', $request->input('id') )
                          ->first();

            if($sow->type == "sow"){              
              if($sow->sow_code==null || $sow->sow_code==""){
                  $sowdata += ['sow_code'=> Sow::generateUniqueSowNumber()];
              }
            }
              
            if($sow->type == "amendment"){
                $sowAmenMap = SowAmendment::where('amendment_id',$sow->id)->first();
                $sowAmenMap = Sow::where( 'id', $sowAmenMap->sow_id)->first();
                $sowdata += ['sow_code'=>$sowAmenMap->sow_code,'amendment_code'=> Sow::generateUniqueAmendmentNumber($sowAmenMap->sow_code, $sowAmenMap->id)];
            }

            $sow = Sow::where( 'id', $request->input('id') )->update($sowdata);

            $transaction_id = Transaction::create([
                          'user_id'     => Auth::user()->id,
                          'sow_id'      => $request->input('id'),
                          'from_status' => 'draft',
                          'to_status'   => 'sent_to_reviewer',
                          'role_id'     => Role::findByName('creator')->id
            ])->id;

            foreach($reviewers as $reviewer){
                SowAuthorization::create([
                          'user_id'       => $reviewer,
                          'sow_id'        => $request->get('id'),
                          'transaction_id'=> $transaction_id,
                          'role_id'       => Role::findByName('reviewer')->id,
                          'status'        => "Pending",
                ]);
            }
            return redirect()->route('sowslist' , 'inprogress')
                     ->with('success','Created successfully');
        }
        else{
            return redirect()->route('sowslist' , 'draft')
                ->with('success','Saved as Draft successfully');
        }
    }

    public function validateSow($sowID)
    {
        $authId = Auth::id();
        $rules = array(
                        'mandatory' => array(
                                      'project_name',
                                      'project_desc',
                                      'project_type_id',
                                      'procuring_party_id',
                                      'act_scope_work',
                                      'skills_tech_abilities',
                                      'infra_cust',
                                      'infra_supp',
                                      'location_id',
                                      'work_days',
                                      'start_date',
                                      'end_date',
                                      'work_allocation',
                                      'progress_reporting',
                                      'acceptance_criteria',
                                      'slas_agreed',
                                      'cust_manager_id',
                                      'supp_manager_id',
                                      'change_control',
                                      'risk_mitigation_plans',
                                      'extension',
                                      'applicability_deliverables',
                                      'price',
                                      'overtime_working',
                                      'payments',
                                      'out_pocket_travel_exp',
                                      'trans_back_arr',
                                      'data_protection',
                      ),
                );
        $sowResult = Sow::where( 'id', $sowID )
                        ->where('creator_id', $authId)
                        ->with('teamCompositions')
                        ->first();
        $emptyKeys = []; 
        
        if($sowResult)
        {
            foreach($rules['mandatory'] as $rule){
                if(isset($sowResult[$rule]) && ($sowResult[$rule] == null || $sowResult[$rule] == '' || $sowResult[$rule] == "0"  )){
                    $emptyKeys []= $rule;
                }
                elseif(!isset($sowResult[$rule])){
                    $emptyKeys []= $rule;
                }
            }
            if($sowResult['project_type_id']!=3 && count($sowResult['teamCompositions']) == 0){
                $emptyKeys []= $rule;
            }
        }
        else{
          $emptyKeys = $rules['mandatory'];
        }
        return $emptyKeys; 
    }
    
    public function validateAmendment($sowID)
    {
        $authId = Auth::id();
        $rules = array(
                        'mandatory' => array(
                          // 'sow_id',
                          'effective_from',
                          'dated',
                          'amendment_for',
                          'dated',
                          'original_end_date',
                          'revised_end_date',
                          'rate',
                          'rate_vat',
                          'data_protection'                      ),
                );
        $sowResult = Sow::where( 'id', $sowID )
                        ->where('creator_id', $authId)
                        ->where('type', 'amendment')
                        ->first();
        $emptyKeys = []; 
        
        if($sowResult)
        {
            foreach($rules['mandatory'] as $rule){
                if(isset($sowResult[$rule]) && ($sowResult[$rule] == null || $sowResult[$rule] == '' || $sowResult[$rule] == "0"  )){
                    $emptyKeys []= $rule;
                }
                elseif(!isset($sowResult[$rule])){
                    $emptyKeys []= $rule;
                }
            }
        }
        else{
          $emptyKeys = $rules['mandatory'];
        }
        return $emptyKeys; 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sow  $Sow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sow $sow)
    {
        $sow->delete();

        return redirect()->route('sows.index')
                        ->with('success','SOW deleted successfully');
    }

    /**
     * Display a listing of the draft.
     *
     * @return \Illuminate\Http\Response
     */
    public function sowList($filter)
    {
        $status = array();
        $filterHeading = '' ;
        //$userRoleName = Auth::user()->roles->first()->name;

        $filtermap = array(
                            "inprogress" => array(
                                                    'status' =>  array('sent_to_reviewer', 'sent_to_approver'),
                                                    'filterHeading' => "Pending for Approval"
                                            ) ,
                            "draft" => array(
                                                    'status' =>  array($filter),
                                                    'filterHeading' => "Draft"
                                            ) ,
                            "rejected" => array(
                                                    'status' =>  array('rejected_by_reviewer','rejected_by_approver'),
                                                    'filterHeading' => "Rejected"
                                            ) ,
                            "approved" => array(
                                                    'status' =>  array('approved_by_approver'),
                                                    'filterHeading' => "Approved"
                                            ) ,
                            "review" => array(
                                                    'status' =>  array('sent_to_reviewer'),
                                                    'filterHeading' => "To Be Reviewed"
                                            ) ,
                            "approve" => array(
                                                    'status' =>  array('sent_to_approver'),
                                                    'filterHeading' => "To Be Approved"
                                            ) ,
                            "approve" => array(
                                                    'status' =>  array('sent_to_approver'),
                                                    'filterHeading' => "To Be Approved"
                                            ) ,
                            "processed" => array(
                                                    'status' =>  array(),
                                                    'filterHeading' => "Processed"
                                            ) ,
                    );

        $status = $filtermap[$filter]['status'];
        $filterHeading =  $filtermap[$filter]['filterHeading'];

        if($filter=="review"){ 
            $roles = Role::findByName('reviewer');
            
            $projectTypes = Workflow::with('project_type')
                                ->ByUser(Auth::user()->id)
                                ->OfRole($roles)
                                ->pluck('project_type_id')
                                ->toArray(); 
                           
            $data = Sow::with(['workflows' => function($query)  {
                                  $query->where('user_id', Auth::user()->id);
                                }, 'workflows.role'])
                        ->ByProjectType($projectTypes)
                        ->OfStatus($status)
                        ->whereRaw(' id in (select sow_id from sow_authorizations where user_id = ? and role_id = ? and status = ?)', array(Auth::user()->id,$roles->id,'Pending'))
                        ->latest()
                        ->paginate(5);
        }
        elseif($filter=="approve"){
            $roles = Role::findByName('approver');
            $projectTypes = Workflow::with('project_type')
                                ->ByUser(Auth::user()->id)
                                ->OfRole($roles)
                                ->pluck('project_type_id')
                                ->toArray(); 
        
            $data = Sow::with(['workflows' => function($query)  {
                                  $query->where('user_id', Auth::user()->id);
                                }, 'workflows.role'])
                        ->ByProjectType($projectTypes)
                        ->OfStatus($status)
                        ->latest()
                        ->paginate(5);
        }
        elseif($filter=="processed"){
            $data = Sow::with(['workflows' => function($query)  {
                                  $query->where('user_id', Auth::user()->id);
                                }, 'workflows.role'])
                          ->whereRaw("id in (SELECT distinct s.id  
                                FROM `transactions` t 
                                inner join sow s on t.sow_id = s.id
                                inner join workflows w on s.project_type_id = w.project_type_id  
                                inner join roles r on w.role_id = r.id and r.name = case when t.from_status = 'sent_to_reviewer' then 'reviewer'
                                                             when t.from_status = 'sent_to_approver' then 'approver' end 
                                where w.user_id = ? )", array(Auth::user()->id))
                        ->latest()
                        ->paginate(5);
        }
        else{
            $data = Sow::ByCreator(Auth::user()->id)
                      ->with(['workflows' => function($query)  {
                                      $query->where('user_id', Auth::user()->id);
                                    }, 'workflows.role'])
                      ->OfStatus($status)
                      ->latest()
                      ->paginate(5);  
        }
        return view('sows.sowlist',compact('data', 'filterHeading', 'filter'))
                ->with('i', (request()->input('page', 1) - 1) * 5);  
    }

    public function sowTransition(Request $request)
    {
        if($request->has('comments')) {
                request()->validate([
                    'user_id' => 'required',
                    'sow_id' => 'required',
                ]);
        }
        
        $sow = Sow::find($request->get('sow_id'));

        $transition = array(
            'sent_to_reviewer' => array(
                                        'approve' =>'sent_to_approver',
                                        'reject' =>'rejected_by_reviewer',    
                                      ),
            'sent_to_approver' => array(
                                        'approve' =>'approved_by_approver',
                                        'reject' =>'rejected_by_approver',    
                                      ),
            'rejected_by_reviewer' => array(
                                        'submit' =>'sent_to_reviewer',   
                                      ),
            'rejected_by_approver' => array(
                                        'submit' =>'sent_to_reviewer',   
                                      ),
        );

        $status_map = array(
                                'sent_to_reviewer'=>'reviewer',
                                'sent_to_approver'=>'approver',
                                'rejected_by_reviewer'=>'creator',
                                'rejected_by_approver'=>'creator',
                                'approved_by_approver'=>'creator',
                            );

        $currentStatus = $sow->status;
        $action = $request->get('status');
        $newStatus = isset($transition["$currentStatus"]["$action"]) ? $transition["$currentStatus"]["$action"] : "";
        $guardRole = isset($status_map["$currentStatus"])? $status_map["$currentStatus"] : "";
        $workflows = Workflow::with(['role' => function($query) use ($guardRole) {
                                  $query->where('name', $guardRole)->first();
                                }])
                                ->ByProjectType($sow->project_type_id)
                                ->ByUser(Auth::user()->id)
                                ->first();
         
        if($workflows->role == null) {
            return Redirect::back()->withErrors([ 'You do not have right to update this record.']);
        }
        /*                        
        if($workflows->role->name == 'reviewer') {
            $sow->reviewer_id = $request->get('user_id');
        }
        elseif($workflows->role->name == 'approver') {
            $sow->approver_id = $request->get('user_id');
        }
        */

        $transaction_id = Transaction::create(
                          [    
                              'user_id'     => Auth::user()->id,
                              'sow_id'      => $request->get('sow_id'),
                              'from_status' => $currentStatus,
                              'to_status'   => $newStatus,
                              'role_id'     => $workflows->role->id
                          ]
                      )->id;

        if( $request->has('comments') && $request->get('comments') ) {
             $request->merge(["transaction_id"=> $transaction_id]); 
             SowComment::create($request->all());
        }

        if($currentStatus== "sent_to_reviewer"){
            $transaction = Transaction::where([
                                              'sow_id'=> $request->get('sow_id'),
                                              'to_status'=> 'sent_to_reviewer',
                                              ['from_status', "!=", 'sent_to_reviewer']
                          ])
                          ->orderBy('created_at', 'desc') 
                          ->first();
            SowAuthorization::where([
                                    'sow_id'=> $request->get('sow_id'),
                                    'transaction_id'=> $transaction->id,
                                    'role_id'=> Role::findByName('reviewer')->id,
                                    'user_id'=> Auth::user()->id
                              ])
                              ->update(["status"=> $action=="approve"? "Approved" : "Rejected"]);
            if($newStatus== "sent_to_approver") {
                $is_review_auth_pending = SowAuthorization::where([
                                        'sow_id'=> $request->get('sow_id'),
                                        'transaction_id'=> $transaction->id,
                                        'role_id'=> Role::findByName('reviewer')->id,
                                        ['status', '!=', 'Approved']
                                  ])
                                ->select('id')
                                ->exists();
                if($is_review_auth_pending)
                    $newStatus = $currentStatus;
            }
            elseif($newStatus== "rejected_by_reviewer") {
                //update status of all the remaining approvals to 'Defaulted'
                SowAuthorization::where([
                                        'sow_id'=> $request->get('sow_id'),
                                        'transaction_id'=> $transaction->id,
                                        'role_id'=> Role::findByName('reviewer')->id,
                                        'status'=> 'Pending'
                                  ])
                                ->update(["status"=> "Defaulted"]);
            }
        }



        $sow->status = $newStatus;
        $sow->save();

        return redirect()->route('sowView', ['filter'=>$request->input('filter'), 'id' => $request->get('sow_id')]); 
    }

    public function sowActionForm($filter, $sow_id)
    {
        $sow = Sow::where('id', $sow_id)
                    ->with('project_type')
                    ->with('procuring_party')
                    ->with('location')
                    ->with('creator')
                    ->with('reviewer')
                    ->with('supplierManager')
                    ->with('customerManager')
                    ->with(['attributeComments' => function($query) {
                      $query->orderBy('created_at', 'desc');
                    }]) 
                    ->with(['comments' => function($query) {
                      $query->orderBy('updated_at', 'desc');
                    }])
                    ->with(['headerDesc' => function($query) {
                      $query->where('name', 'header_desc')->first();
                    }])
                    ->with([
                        'annexureAttributes',
                        'annexureAttributes.annexureValues' => function($query) use ($sow_id) {
                          $query->where('sow_id', $sow_id);
                        }])
                    ->first();
        $data = Transaction::where('sow_id',$sow_id)
                    ->latest()
                    ->paginate(25);
        $annexureAttributes = $sow->annexureAttributes->groupBy('type');

        $attributeComments = $sow->attributeComments->groupBy('attribute');
 
        $masters = SowMaster::where('project_type_id',$sow->project_type_id)->pluck('content','name');

        $active = true; //used to indicate if commenting should be activated. will be false for readonly views
        return view('sows.sows_action',compact('sow','masters','annexureAttributes','filter','data' , 'attributeComments' , 'active'))
                                        ->with('success','Comment Added successfully.');    
    }

    public function generatePdf($sow_id)
    { 
        $SowOrAmendment = Sow::where('id', $sow_id)->first();

        if($SowOrAmendment->type == 'sow')
        {
          $sow = Sow::where('id', $sow_id)
          ->with('project_type')
          ->with('procuring_party')
          ->with('location')
          ->with('creator')
          ->with('reviewer')
          ->with('supplierManager')
          ->with('customerManager')
          ->with(['comments' => function($query) {
            $query->orderBy('updated_at', 'desc')->paginate(10);
          }])
          ->with(['headerDesc' => function($query) {
            $query->where('name', 'header_desc')->first();
          }])
          ->with([
              'annexureAttributes',
              'annexureAttributes.annexureValues' => function($query) use ($sow_id) {
                $query->where('sow_id', $sow_id);
              }])
          ->first();

          $annexureAttributes = $sow->annexureAttributes->groupBy('type');
          $masters = SowMaster::where('project_type_id',$sow->project_type_id)->pluck('content','name');

          $pdf = PDF::loadView('sows.sow_pdf',compact('sow','masters','annexureAttributes'));
          return $pdf->stream('Sow_and_annexure.pdf');
        }

        if($SowOrAmendment->type == 'amendment')
        {
         
          $sowMapAmend = SowAmendment::where('amendment_id',$SowOrAmendment->id)->first();
          $sow = Sow::where('id', $sowMapAmend->sow_id)->first();
          $amendment = Sow::where('id', $sowMapAmend->amendment_id)->first();

          $pdf = PDF::loadView('sows.amendment_pdf',compact('sow','amendment'));
          
          return $pdf->stream('Amendment.pdf');
        }
    }

    public function revision($filter,$sow_id)
    {
        $sow = Sow::find($sow_id);
        $revisionHistory = $sow->revisionHistory()->orderBy('id','desc')->paginate(10);
        return view('sows.revision',compact('revisionHistory','filter','sow'))->with('i', (request()->input('page', 1) - 1) * 5);
    } 

    public function createAmendment(Request  $request){
        //$queryInput = Auth::user()->id; 
        $all_sow = Sow::ByCreator(Auth::user()->id)
                    ->where('Status', 'approved_by_approver')
                    ->select('id','project_name','sow_code')
                    ->get();
                    $sow = '';
        $data_protection = SowMaster::where('name','data_protection')->pluck('content');

        return view('sows.amendment',compact('all_sow','sow','data_protection'))->with('success','Comment Added successfully.');    
    }

    public function amendmentStore(Request $request)
    {
        request()->validate([
          'sow_id' => 'required',
          'effective_from'=>'required',
          'dated'=>'required',
          'amendment_for'=>'required',
          'dated'=>'required',
          'original_end_date'=>'required',
          'revised_end_date'=>'required',
          'rate'=>'required|numeric|gt:0',
          'rate_vat'=>'required|numeric|gt:0',
          'data_protection'=>'required'
        ]);

        $sow = Sow::find($request->input('sow_id'));
       
        $request->merge([ 'creator_id'=>Auth::user()->id,
                          'project_name'=>$sow->project_name,
                          'project_type_id'=>$sow->project_type_id,
                          'procuring_party_id'=>$sow->procuring_party_id,
                          'type'=>'amendment']); 

        // if($request->has('submitreview'))  
        //     $request->merge([ 'status'=>'sent_to_reviewer', 'sow_code'=> Sow::generateUniqueAmendmentNumber($sow->sow_code, $sow->id)]); 
        // else
            $request->merge(['status'=>'draft']); 

        $amendment = Sow::create($request->all());

        SowAmendment::create(
          [ 
            'sow_id' => $request->input('sow_id'), 
            'amendment_id' => $amendment->id
          ]
        ); 
        if($request->has('submitreview')){
          return redirect()->route('sowEdit',['filter'=>'inprogress' , 'id'=>$sow->id , 'step'=>'6' ])
                         ->with('success','SOW updated successfully.');
        }
        else{
            return redirect()->route('sowslist' , 'draft')
                ->with('success','Amendment draft created successfully');
        }
    }
    public function amendmentEdit($amendmentID)
    { 
        $amendment = Sow::where('id', $amendmentID)->first();
        $all_sow = Sow::where('type','sow')->get();
        $sow = SowAmendment::where('amendment_id',$amendment->id)->first();
        $data_protection = Sow::where('id', $amendmentID)->select('data_protection')->first();

        return view('sows.amendment_edit' ,compact('amendment', 'all_sow','sow','data_protection'));
    }

    public function amendmentUpdate(Request $request){
        request()->validate([
          'sow_id' => 'required',
          'effective_from'=>'required',
          'dated'=>'required',
          'amendment_for'=>'required',
          'dated'=>'required',
          'original_end_date'=>'required',
          'revised_end_date'=>'required',
          'rate'=>'required|numeric|gt:0',
          'rate_vat'=>'required|numeric|gt:0',
          'data_protection'=>'required'
        ]);
        $sow = Sow::find($request->input('id'));
       
        $request->merge([ 'creator_id'=>Auth::user()->id,
                          'project_name'=>$sow->project_name,
                          'project_type_id'=>$sow->project_type_id,
                          'procuring_party_id'=>$sow->procuring_party_id,
                          'type'=>'amendment']); 

        $request->merge(['status'=>'draft']); 

        $sow = Sow::find($request->input('id'))->update($request->all());

        if($request->has('submitreview')){
          return redirect()->route('sowEdit',['filter'=>'inprogress' , 'id'=>$request->input('id'), 'step'=>'6' ])
          ->with('success','SOW updated successfully.');
        }
        else{
            return redirect()->route('sowslist' , 'draft')
                ->with('success','Amendment draft created successfully');
        }
      }

    public function getAllSow(Request  $request,$userid){ 
      //if(Auth::user()->hasRole('creator') ) {
        $filter = $request->input('query');
          $all_sow= Sow::ByCreator($userid)
                          ->where('Status', 'approved_by_approver')
                          ->where(function ($query) use ($filter) {
                                  $query->where('project_name','LIKE',"%{$filter}%")
                                  ->orWhere('sow_code', 'LIKE',"%{$filter}%");
                            })
                          ->select('sow.id','project_name','sow_code')
                          ->get();
                          $arr = array();
          if($all_sow){
             foreach($all_sow as $key => $val)
                {
                  $arr[] = array('label' => $val['sow_code'].' : '.$val['project_name'],'value'=>$val['id']);
                } 
                return json_encode($arr); 
          } 
          else
                return '';
      //}
    }
}
