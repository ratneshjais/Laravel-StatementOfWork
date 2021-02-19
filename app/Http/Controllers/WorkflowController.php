<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workflow;
use App\Models\ProjectType;
use App\User;
use Spatie\Permission\Models\Role;

class WorkflowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:workflow-list|user-list', ['only' => ['index']]);
         $this->middleware('permission:workflow-create|user-create', ['only' => ['create','store','createWithUser','storeWithUser','edit','update','editWithUser']]);
         $this->middleware('permission:workflow-delete|user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workflows = Workflow::with('project_type')
        				->with('user')
        				->with('role')
        				->latest()
        				->paginate(5);
        return view('workflows.index',compact('workflows'))
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
        $roles = Role::pluck('name','id')->all();
        $users = User::pluck('name','id')->all();
        return view('workflows.create', compact('projectTypes', 'roles', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createWithUser($user_id)
    {
        $projectTypes = ProjectType::pluck('type','id')->all();
        $roles = Role::pluck('name','id')->all();
        $user = User::find($user_id);
        return view('workflows.createwithuser', compact('projectTypes', 'roles', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeWithUser(Request $request)
    {
        request()->validate([
            'project_type_id' => 'required',
            'user_id' => 'required',
            'role_id' => 'required', 
        ]);
 
        $sow =Workflow::create($request->all());

        $this->syncUserRoles($request->user_id);

        return redirect()->route('users.edit', $request->user_id)
                         ->with('success','Workflow created successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'project_type_id' => 'required',
            'user_id' => 'required',
            'role_id' => 'required', 
        ]);
 
        $Workflow =Workflow::create($request->all());

        $this->syncUserRoles($request->user_id);

        return redirect()->route('workflows.index')
                         ->with('success','Workflow created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit(Workflow $workflow)
    {
        $projectTypes = ProjectType::pluck('type','id')->all();
        $roles = Role::pluck('name','id')->all();
        $users = User::pluck('name','id')->all();
        
        return view('workflows.edit', compact('projectTypes', 'roles', 'users'));
    }

    /**
     * Update the specified resource in storage.s
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workflow $workflow)
    {
        request()->validate([
            'project_type_id' => 'required',
            'user_id' => 'required',
            'role_id' => 'required'

        ]);

        $workflow->update($request->all());

        $this->syncUserRoles($workflow->user_id);

        if(app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName()=='wfEditWithUser')
            return redirect()->route('users.edit', $workflow->user_id)
                         ->with('success','Workflow updated successfully');    
        else 
            return redirect()->route('workflows.index')
                         ->with('success','Workflow updated successfully');    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function editWithUser($workflow)
    {
        $workflow = Workflow::find($workflow);
        $projectTypes = ProjectType::pluck('type','id')->all();
        $roles = Role::pluck('name','id')->all();
        $users = User::pluck('name','id')->all();
        $user = User::find($workflow->user_id);
        return view('workflows.edit', compact('workflow', 'projectTypes', 'roles', 'users', 'user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workflow $workflow)
    {
        $workflow->delete();

        $this->syncUserRoles($workflow->user_id);
        
        if(app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName()=='users.edit')
            return redirect()->back()->withInput();    
        else 
            return redirect()->route('workflows.index')
                         ->with('success','worflow Roles deleted successfully');   
        
    }

    public function syncUserRoles($user_id)
    {
         $roles = Workflow::with('role')
                        ->ByUser($user_id)
                        ->get() 
                        ->unique('role.name')
                        ->pluck('role.name')
                        ->toArray(); 

        $users = User::find($user_id);
        $users->syncRoles($roles);   
        
    }

   
}
