<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use \App\Http\Controllers\ProcuringController;
use \App\Http\Controllers\ProjectTypeController;
use \App\Models\Sow;
use App\Models\Workflow;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        if(Auth::user()->hasRole('super-admin')  ) {
            return redirect()->route('users.index');
        }
        elseif(Auth::user()->hasRole('creator') ) {
            $all_sow = array();

            $all_sow['draft'] = Sow::ByCreator(Auth::user()->id)
                            ->with('project_type')
                            ->with('procuring_party')
                            ->OfStatus(['draft'])
                            ->latest()
                            ->paginate(2);

            $all_sow['inprogress'] = Sow::ByCreator(Auth::user()->id)
                            ->with('project_type')
                            ->with('procuring_party')
                            ->OfStatus(['sent_to_reviewer','sent_to_approver'])
                            ->latest()
                            ->paginate(2);

            

            $all_sow['approved'] = Sow::ByCreator(Auth::user()->id)
                            ->with('project_type')
                            ->with('procuring_party')
                            ->OfStatus(['approved_by_approver'])
                            ->latest()
                            ->paginate(2);

            $all_sow['rejected'] = Sow::ByCreator(Auth::user()->id)
                            ->with('project_type')
                            ->with('procuring_party')
                            ->OfStatus(['rejected_by_reviewer','rejected_by_approver'])
                            ->latest()
                            ->paginate(2);
        }
        else {
             //for Reviewer and Approver
             if(Auth::user()->hasRole('reviewer'))
             {
                 $status = array('sent_to_reviewer');
                 $roles = Role::findByName('reviewer');
                 $data = 'review';
             }
             if(Auth::user()->hasRole('approver'))
             {
                 $status = array('sent_to_approver');
                 $roles = Role::findByName('approver');
                 $data = 'approve';
             }


             $projectTypes = Workflow::with('project_type')
                                 ->ByUser(Auth::user()->id)
                                 ->OfRole($roles)
                                 ->pluck('project_type_id');

             $all_sow[$data] = Sow::ByProjectType($projectTypes)
                                    ->OfStatus($status)
                                    ->latest()
                                    ->paginate(2);
        }
        $procuringParties = ProcuringController::getAllActiveRecords();
        $projectTypes = ProjectTypeController::getAllActiveRecords();
        $projectStatuses = Sow::getStatusMaster(array_column(Auth::user()->roles->toArray(), 'name'));
       
        return view('home',compact('all_sow', 'procuringParties', 'projectTypes' , 'projectStatuses'));
    }
    
    public function getFilteredSows() : \Illuminate\View\View {
        
        //$filteredRecords = Sow::WhereIn('project_type_id', $projectTypes)
                               // ->orWhere('creator_id' , Auth::user()->id);

        $projectTypes = Workflow::ByUser(Auth::user()->id)->get()->pluck('project_type_id');                  
        $filteredRecords = Sow::where(function ($query) use ($projectTypes) {
                                $query->WhereIn('project_type_id', $projectTypes)
                                ->orWhere('creator_id' , Auth::user()->id);
                            });

        foreach (request()->request as $key => $value) {
            if(empty($value)) //skip the empty value of request
                continue;
            
            switch ($key) {
                case 'search_field':
                    $filteredRecords->where(function ($query) use ($value) {
                        $query->where('project_name', 'like', '%'. $value .'%');
                        $query->orWhere('sow_code', 'like', '%'. $value .'%');
                    });
                    break;
                
                case 'project_type_id':
                case 'procuring_party_id':        
                case 'status':
                    $filteredRecords->whereIn($key, $value);
                    break;
                
                default:                    
                    break;
            }
        }
        $data = $filteredRecords->get()->all();
        $procuringParties = ProcuringController::getAllActiveRecords();
        $projectTypes = ProjectTypeController::getAllActiveRecords();
        $projectStatuses = Sow::getStatusMaster(array_column(Auth::user()->roles->toArray(), 'name'));
        return view('search_result',compact('data', 'procuringParties', 'projectTypes' , 'projectStatuses'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
