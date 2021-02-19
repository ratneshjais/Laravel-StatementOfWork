<?php

namespace App\Http\Controllers;

use App\Models\Projectskill;
use Illuminate\Http\Request;
 
class ProjectskillController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:skill-list', ['only' => ['index','show']]);
         $this->middleware('permission:skill-create', ['only' => ['create','store','edit','update']]);
         $this->middleware('permission:skill-delete', ['only' => ['destroy','skill_revoke']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectskills = Projectskill::latest()->withTrashed()->orderBy('id', 'asc')->paginate(5);
        return view('projectskills.index',compact('projectskills'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * for API to get all records of table.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllData()
    {
        return Projectskill::all(['id', 'name']);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('projectskills.create');
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
            'name' => 'required',
             
        ]);

        Projectskill::create($request->all());

        return redirect()->route('projectskills.index')
                        ->with('success','projectskills created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Projectskill $projectskill)
    {
        return view('projectskills.show',compact('projectskill'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Projectskill $projectskill)
    {
        return view('projectskills.edit',compact('projectskill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Projectskill $projectskill)
    {
         request()->validate([
            'name' => 'required',

        ]);

        $projectskill->update($request->all());

        return redirect()->route('projectskills.index')
                        ->with('success','Project skills updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projectskill $projectskill)
    {
        $projectskill->delete();

        return redirect()->route('projectskills.index')
                        ->with('success','Project skills Deactivated successfully');
    }

    public function skill_revoke($skill_id)
    {
        ProjectSkill::withTrashed()->find($skill_id)->restore();

        return redirect()->route('projectskills.index')
                        ->with('success','Project skills Activated successfully');
    }

    public function skill_datatables(Request $request)
    {
        $header = array(
            0=>'id',
            1=>'name'
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $header[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');


        $records = Projectskill::latest()->withTrashed();

        if(!empty($search))
        {
            $records = $records->where('name','LIKE',"%{$search}%");
        }

        $records = $records
                        ->Offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();

        $count = $records->count();

        if(!empty($records))
        {
            $data = array();
            $i=0;
            foreach($records as $key => $skill)
            {

                $i++;
                // $show = route('projectskills.show',$skill->id);
                $edit = route('projectskills.edit',$skill->id);
                $delete = route('projectskills.destroy',$skill->id);
                $revoke = route('skill_revoke', $skill->id);
                
                if($skill->deleted_at == null)
                {
                    $act_deact = "
                                <a href='{$edit}' title='EDIT' class='fa fa-edit edit_button'></a>
                                          
                                <form action=".$delete." style='display:inline' method='post'>
                                    ".method_field('DELETE')."
                                    ".csrf_field()."
                                    <button type='submit' class ='fa fa-trash deact_button'></button>
                                </form>";
                }
                else
                {
                    $act_deact = "<a href='{$revoke}' title='Activate' title='Delete' class='fa fa-check-circle act_button'></a>";
                }
                

                $data_arr['id'] = $i;
                $data_arr['name'] = $skill->name;
                $data_arr['action'] = $act_deact;

                $data[] = $data_arr; 

            }
        }

        $json_data = array(
            'draw'              => $request->input('draw'),
            'recordsTotal'      => $count,
            'recordsFiltered'   => $count,
            'data'              => $data
        );

        return json_encode($json_data);

    }
}
