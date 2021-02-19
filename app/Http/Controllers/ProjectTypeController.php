<?php

namespace App\Http\Controllers;
use App\Models\ProjectType;

use Illuminate\Http\Request;

class ProjectTypeController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:project_type-list', ['only' => ['index','show']]);
         $this->middleware('permission:project_type-create', ['only' => ['create','store','edit','update']]);
         $this->middleware('permission:project_type-delete', ['only' => ['destroy','project_type_revoke']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('project_type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('project_type.create');
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
            'type' => 'required',
        ]);

        ProjectType::create($request->all());

        return redirect()->route('project_type.index')
                         ->with('success','Procuring Party created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ptype = ProjectType::find($id);
        return view('project_type.show',compact("ptype"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ptype = ProjectType::find($id);
        return view('project_type.edit',compact("ptype"));
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
        request()->validate([
            'type' => 'required',
        ]);

        $project_type = ProjectType::find($id);
        $project_type->update($request->all());

        return redirect()->route('project_type.index')
                         ->with('success','Procuring Party updated successfully');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProjectType::find($id)->delete();
    
        return redirect()->route('project_type.index')
                         ->with('success','Project Type Deactivated successfully');
    }
    
    public function project_type_revoke($id)
    {
        ProjectType::withTrashed()->find($id)->restore();
    
        return redirect()->route('project_type.index')
                         ->with('success','Project Type Activated successfully');
    }
    
    public static function getAllActiveRecords(): \Illuminate\Database\Eloquent\Collection {
        return ProjectType::all($columns = ['id', 'type']);
    }

    public function project_type_datatables(Request $request)
    {
        $header = array(
                0=>'id',
                1=>'type'
        );


        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $header[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $records = ProjectType::latest()->withTrashed();

        if(!empty($search))
        {
            $records = $records->where('type','LIKE',"%{$search}%");
        }

        $records = $records->offset($start)->limit($limit)->orderBy($order,$dir)->get();

        $counts = $records->count();

        if(!empty($records))
        {
            $i=0;
            $data = array();

            foreach($records as $key => $ptype)
            {
                $i++;
                $edit = route('project_type.edit',$ptype->id);
                $revoke = route('project_type_revoke',$ptype->id);
                $delete = route('project_type.destroy',$ptype->id);

                if($ptype->deleted_at == null){
                        $act_deact = "<a class='fa fa-edit edit_button' href='{$edit}' title='Edit'></a>
                                        <form action=".$delete." style='display:inline' method='POST'>
                                            ".method_field('DELETE')."
                                            ".csrf_field()."
                                            <button type='submit' class ='fa fa-trash deact_button' title='Deactivate' ></button>
                                        </form>";
                    } 
                    else{
                        $act_deact = "<a class='fa fa-check-circle act_button' href='{$revoke}' title='Activate'></a>";
                    }
                

                $data_value['id'] = $i;
                $data_value['type'] = $ptype->type;
                $data_value['action'] = $act_deact;

                $data[] = $data_value; 
            }
        }

        $json_data = array(
            'draw' => $request->input('draw'),
            'recordsTotal' => $counts,
            'recordsFiltered' => $counts,
            'data' => $data
        );

        
        return json_encode($json_data);
    }
}
