<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:permission-list');
         $this->middleware('permission:permission-create', ['only' => ['create','store','edit','update']]);
         $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('permission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permission.create');
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
            'name' => 'required',
            'guard_name' => 'required'
        ]);
        
        Permission::create($request->all());
        

        return redirect()->route('permission.index')
                         ->with('success','permission created successfully');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(permission $permission)
    {       
        return view('permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, permission $permission)
    {
        request()->validate([
            'name' => 'required',
        ]);

        $permission->update($request->all());

        return redirect()->route('permission.index')
                         ->with('success','Permission updated successfully');        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(permission $permission)
    {
        //
    }

    public function permission_datatables(Request $request)
    {
        $header = array(
            0=>'id',
            1=>'name'
        );

        $limit  =   $request->input('length');
        $start  =   $request->input('start');
        $order  =   $header[$request->input('order.0.column')];
        $dir    =   $request->input('order.0.dir');
        $search =   $request->input('search.value');

        $records = Permission::latest();

        if(!empty($search))
        {
            $records = $records->where('name','LIKE',"%{$search}%");
        }

        $records = $records->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

        $counts = $records->count();
        
        if(!empty($records))
        {
            $data = array();
            $i = 0;
            foreach ($records as $key => $permission) {
                $i++;
                $edit = route('permission.edit',$permission->id);

                $data_array['id'] = $i;
                $data_array['name'] = $permission->name;
                $data_array['action'] = "<a href='{$edit}' class='fa fa-edit edit_button'></a>";

                $data[] = $data_array;
            }
        }

        $json_data = array(
            'draw' => $request->input('draw'),
            'recordsTotal' => $counts,
            'recordsFiltered' =>$counts,
            'data' => $data
        );

        return json_encode($json_data);

        
    }
}
