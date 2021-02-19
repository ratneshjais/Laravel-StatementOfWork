<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:role-list', ['only' => ['index','show','role_datatables']]);
         $this->middleware('permission:role-create', ['only' => ['create','store','edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $roles = Role::orderBy('id','DESC')->paginate(5);
        // return view('roles.index',compact('roles'))
            // ->with('i', ($request->input('page', 1) - 1) * 5);
            return view('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        $matrix = array();
        $accesslist = array();
        $accessquestion = array();
        $tab_accesslist = array("list", "create", "delete");
        foreach($permissions as $permission)
        {
            list($key , $value) = explode("-",$permission->name); 
            if(in_array($value,$tab_accesslist )){

                $matrix["$key"]["$value"] =  $permission ;
                $accesslist["$value"] = $value;
            }
            else
                $accessquestion["$key"]["$value"] =  $permission ;
        }

        $matrix_sorter = array(
                          "user" => "",
                          "role" => "",
                          "location" => "",
                          "projectrole" => "",
                          "skill" => "",
                          "manager" => "",
                          "workflow" => "",
                          "procuringparties" => "",
                          "project_type" => "",
                          "sow_master" => "",
                          "permission" => "",
                          "sow" => "",
                        );
        $accesslist_sorter = array(
                              "list" => "",
                              "create" => "",
                              "edit" => "",
                              "delete" => "",
                              "review" => "",
                              "approve" => "",
                              "download" => "",
                              "upload" => "",
                              "revision" => ""
                            );

        $accesslist_sorter = array(
                              "list" => "",
                              "create" => "",
                              "delete" => "",
                            );
        $accesslist = array_merge($accesslist_sorter, $accesslist);
        $matrix = array_merge($matrix_sorter, $matrix);
        return view('roles.create',compact('permissions', 'accesslist' , 'matrix', 'accessquestion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        $matrix = array();
        $accesslist = array();
        $accessquestion = array();
        $tab_accesslist = array("list", "create", "delete");
        foreach($permissions as $permission)
        {
            list($key , $value) = explode("-",$permission->name); 
            if(in_array($value,$tab_accesslist )){

                $matrix["$key"]["$value"] =  $permission ;
                $accesslist["$value"] = $value;
            }
            else
                $accessquestion["$key"]["$value"] =  $permission ;
        }

        $matrix_sorter = array(
                          "user" => "",
                          "role" => "",
                          "location" => "",
                          "projectrole" => "",
                          "skill" => "",
                          "manager" => "",
                          "workflow" => "",
                          "procuringparties" => "",
                          "project_type" => "",
                          "sow_master" => "",
                          "permission" => "",
                          "sow" => "",
                        );
        $accesslist_sorter = array(
                              "list" => "",
                              "create" => "",
                              "edit" => "",
                              "delete" => "",
                              "review" => "",
                              "approve" => "",
                              "download" => "",
                              "upload" => "",
                              "revision" => ""
                            );

        $accesslist_sorter = array(
                              "list" => "",
                              "create" => "",
                              "delete" => "",
                            );
        $accesslist = array_merge($accesslist_sorter, $accesslist);
        $matrix = array_merge($matrix_sorter, $matrix);    
        return view('roles.show',compact('role','rolePermissions','permissions', 'accesslist' , 'matrix', 'accessquestion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        $matrix = array();
        $accesslist = array();
        $accessquestion = array();
        $tab_accesslist = array("list", "create", "delete");
        foreach($permissions as $permission)
        {
            list($key , $value) = explode("-",$permission->name); 
            if(in_array($value,$tab_accesslist )){

                $matrix["$key"]["$value"] =  $permission ;
                $accesslist["$value"] = $value;
            }
            else
                $accessquestion["$key"]["$value"] =  $permission ;
        }

        $matrix_sorter = array(
                          "user" => "",
                          "role" => "",
                          "location" => "",
                          "projectrole" => "",
                          "skill" => "",
                          "manager" => "",
                          "workflow" => "",
                          "procuringparties" => "",
                          "project_type" => "",
                          "sow_master" => "",
                          "permission" => "",
                          "sow" => "",
                        );
        $accesslist_sorter = array(
                              "list" => "",
                              "create" => "",
                              "edit" => "",
                              "delete" => "",
                              "review" => "",
                              "approve" => "",
                              "download" => "",
                              "upload" => "",
                              "revision" => ""
                            );

        $accesslist_sorter = array(
                              "list" => "",
                              "create" => "",
                              "delete" => "",
                            );
        $accesslist = array_merge($accesslist_sorter, $accesslist);
        $matrix = array_merge($matrix_sorter, $matrix);
        return view('roles.edit',compact('role','permissions','rolePermissions', 'accesslist' , 'matrix', 'accessquestion' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }

    public function role_datatables(Request $request)
    {
        $header= array(
            0=>'id',
            1=>'name'
        );

        $limit= $request->input('length');
        $start= $request->input('start');
        $dir= $request->input('order.0.dir'); 
        $order=  $header[$request->input('order.0.column')];
        $search= $request->input('search.value');

        $records = Role::latest();

        if(!empty($search))
        {
            $records = $records->where('name','LIKE',"%{$search}%");
        }

        $records = $records->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

        $count = $records->count();
        
        if(!empty($records))
        {
            $data = array();
            $i=0;
            foreach ($records as $key => $role) {
                $i++;    
                                $show = route('roles.show',$role->id);
                                $edit = route('roles.edit',$role->id);

                $action = "<a class='fa fa-eye show_button' title='Show' href='{$show}'></a>";
                // can('role-edit')
                // {
                    $action .= "<a class='fa fa-edit edit_button' title='Edit' href='{$edit}'></a>";

                // }
 

                $data_array['id'] = $i;
                $data_array['name'] = ucfirst($role->name);
                $data_array['action'] = $action;
                
                $data[] = $data_array;
            }
        }

        $json_data = array(
            "draw"              => $request->input('draw'),
            "recordsTotal"      => $count,
            "recordsFiltered"   => $count,
            "data"              => $data
        );
        return json_encode($json_data);    
    }
}
