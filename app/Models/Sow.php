<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use App\Models\ProjectType;
use App\Models\ProcuringParty;
use App\Models\Manager;
use App\User;

/* Revisionable */
use \Venturecraft\Revisionable\RevisionableTrait;
/* Revisionable */


class Sow extends Model
{
	use SoftDeletes;
    
    public $table = 'sow';

    protected $fillable = [
        'project_name',
        'project_type_id',
        'procuring_party_id',
        'project_desc',
		'creator_id',
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
		'cancellation',
		'applicability_deliverables',
		'price',
		'overtime_working',
		'payments',
		'out_pocket_travel_exp',
		'trans_back_arr',
        'data_protection',
        'status',
        'effective_from',
        'dated',
        'amendment_for',
        'dated',
        'original_end_date',
        'revised_end_date',
        'rate',
        'rate_vat',
        'type'
    
    ];

    protected $gaurded = [
        'id'
	];
    
    /* Revisionable */
    use RevisionableTrait;
    protected $revisionEnabled = true;
    protected $revisionCreationsEnabled = true;
    // protected $keepRevisionOf = ['project_name'];
    protected $dontKeepRevisionOf = ['cust_manager_id','supp_manager_id','reviewer_id'];
    protected $revisionFormattedFields = [
        //'project_name' => "string:<strong>%s</strong>",
        //'updated_at'   => 'datetime:m/d/Y g:i A',
        'deleted_at'   => 'isEmpty:Active|Deleted'
    ];
    protected $revisionFormattedFieldNames = [
            'project_name'              => 'project name',
            'deleted_at'                => 'deleted at',
            'procuring_party_id'        => 'procuring party',
            'project_type_id'           => 'project type',
            'project_desc'              => 'project description',
            'act_scope_work'            => 'activities/scope of work',
            'skills_tech_abilities'     => 'skills and technical abilities',
            'infra_cust'                => 'infrastructure from customer',
            'infra_supp'                => 'infrastructure from supplier',
            'work_days'                 => 'work days',
            'start_date'                => 'start date',
            'end_date'                  => 'end date',
            'work_allocation'           => 'work allocation',
            'progress_reporting'        => 'progress reporting',
            'acceptance_criteria'       => 'acceptance criteria',
            'slas_agreed'               => 'slas agreed',
            'cust_manager_id'           => 'customer manager',
            'supp_manager_id'           => 'supplier manager',
            'applicability_deliverables'=> 'applicability of escrow for the deliverables',
            'out_pocket_travel_exp'     => 'out of pocket and travel expenses',
            'trans_back_arr'            => 'transition back arrangements',
            'agree_date'                => 'date of agreement',
            'change_control'            => 'change control',
            'extension'                 => 'extension',
            'cancellation'              => 'cancellation',
            'overtime_working'          => 'overtime working',
            'data_protection'           => 'data protection'
    ];
   // public $relatedModels = ['supp_manager_id' => 'Manager','cust_manager_id' => 'Manager'];

    /* Revisionable */
    

	public  function project_type() 
	{
		return $this->belongsTo(ProjectType::class);
	}

	public  function procuring_party() 
	{
		return $this->belongsTo(ProcuringParty::class);
	}

	public  function creator() 
	{
		return $this->belongsTo('App\User', 'creator_id');
	}

    public  function reviewer() 
    {
        return $this->belongsTo('App\User', 'reviewer_id');
    }

    public  function approver() 
    {
        return $this->belongsTo('App\User', 'approver_id');
    }

    public  function location() 
    {
        return $this->belongsTo('App\Models\Location');
    }

    public  function supplierManager() 
    {
        return $this->belongsTo('App\Models\Manager', 'supp_manager_id');
    }

    public  function customerManager() 
    {
        return $this->belongsTo('App\Models\Manager', 'cust_manager_id');
    }
 
	public static  function getRecords() 
	{
		return DB::table('sow')
		->leftjoin('project_types', 'sow.project_type_id', '=', 'project_types.id')
		->leftjoin('procuring_parties', 'sow.procuring_party_id', '=', 'procuring_parties.id')
		->select('sow.*', 'project_types.type', 'procuring_parties.name')
		->latest()->paginate(5);
	}

	/**
     * Scope a query to only include sow of a given type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfStatus($query, $status)
    {
        return $query->whereIn('status', $status);
    }  

    /**
     * Scope a query to only include sow created by given user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByCreator($query, $userid)
    {
        return $query->where('creator_id', $userid);
    }

    /**
     * Scope a query to only include sow of project type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByProjectType($query, $projectType)
    {
        return $query->whereIn('project_type_id', $projectType);
    }

    /**
     * Scope a query to only include sow of project type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByReviewerProfile($query, User $user)
    {
        return $query->where('project_type_id', $projectType);
    }

    /**
     * Get all of the sows's comments.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\SowComment', 'sow_id' , 'id' );
    }

    public function attributeComments()
    {
        return $this->hasMany('App\Models\AttributeComment', 'sow_id' , 'id' );
    }

    public function headerDesc()
    {
        return $this->hasMany('App\Models\SowMaster', 'project_type_id' , 'project_type_id' );
    }

    public function workflows()
    {
        return $this->hasMany('App\Models\Workflow', 'project_type_id' , 'project_type_id' );
    }

    /*
    public function annexures()
    {
        return $this->hasMany('App\Models\AnnexureValue', 'sow_id' , 'id' );
    }
    */
    public function annexureAttributes()
    {
        return $this->hasMany('App\Models\AnnexureAttribute', 'project_type_id' , 'project_type_id' );
    }

    public function teamCompositions()
    {
        return $this->hasMany('App\Models\TeamComposition', 'sow_id' , 'id' );
    }

    public static function generateUniqueSowNumber(){
        $sowResult = Sow::selectRaw("concat('SOW', '-', '".date("y")."', '-', LPAD (SUBSTRING(`sow_code`, -6, 6)+1, 6 , 0) ) as 'new_sow_code'")
                          ->where('sow_code','!=','')
                          ->where('type','=','sow')
                          ->whereRaw('SUBSTRING(`sow_code`, 5, 2) = ' . date("y"))
                          ->orderByRaw('(SUBSTRING(sow_code, -6, 6)) desc')
                          ->first();
        if(isset($sowResult->new_sow_code)){
            $newSOW = $sowResult->new_sow_code; 
            return $newSOW;
        }         
        else {
            return "SOW-".date("y")."-010001";
        }
    }

    public static function generateUniqueAmendmentNumber($sow_code='', $sow_id){
        $sowResult = Sow::selectRaw("concat('$sow_code', '-', LPAD ( SUBSTRING(`sow_code` , -3) +1, 3 , 0) ) as 'new_sow_code'")
                          ->where('sow_code','!=','')
                          ->where('type','=','amendment')
                          ->whereRaw("id in (select amendment_id from sow_amendments where sow_id = '$sow_id')")
                          ->orderByRaw('(SUBSTRING(sow_code, -3)) desc')
                          ->first();
        if(isset($sowResult->new_sow_code)){
            $newSOW = $sowResult->new_sow_code; 
            return $newSOW;
        }         
        else {
            return $sow_code."-001";
        }
    }

    /*update Sow On Project Type Changes*/
    public static function getSowmasterOnProjectType($project_type_id){
        $masterArray = [
            'skills_tech_abilities',
            'infra_cust',
            'infra_supp',
            'work_days',
            'start_date',
            'end_date' ,
            'work_allocation',
            'progress_reporting',
            'risk_mitigation_plans',
            'slas_agreed',
            'change_control', 
            'extension',
            'cancellation',   
            'applicability_deliverables',
            'overtime_working',
            'payments',
            'out_pocket_travel_exp',
            'trans_back_arr',
            'data_protection'
        ];     //
        $masters = SowMaster::where('project_type_id',$project_type_id)
        ->whereIn('name',$masterArray)->pluck('content','name');
        return $masters;
    }
    
    public static function getStatusMaster($roles): array {      
        $type = DB::select( DB::raw('SHOW COLUMNS FROM SOW WHERE Field = "status"') )[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach(explode(',', $matches[1]) as $value){
            $v = trim( $value, "'" );
            $enum[$v] =  $v;
        }
        if(is_array($roles))
                if(!in_array('creator',$roles))   unset($enum['draft']);
                if(in_array('reviewer',$roles))  $enum['rejected_by_reviewer'] = 'rejected';
                if(in_array('approver',$roles)){
                    unset($enum['draft']);
                    unset($enum['sent_to_reviewer']);
                    unset($enum['rejected_by_reviewer']);
                    $enum['rejected_by_approver'] = 'rejected'; 
                }    
        return $enum;
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction', 'sow_id' , 'id' );
    }
}
