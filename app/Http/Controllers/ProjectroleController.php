<?php

namespace App\Http\Controllers;

use App\Models\Projectrole;
use Illuminate\Http\Request;
 
class ProjectroleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:projectrole-list', ['only' => ['index','show','prdatatables']]);
         $this->middleware('permission:projectrole-create', ['only' => ['create','store','edit','update']]);
         $this->middleware('permission:projectrole-delete', ['only' => ['destroy','projectroles_revoke']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $projectroles = Projectrole::latest()->paginate(5);
        return view('projectroles.index');//,compact('projectroles')
    }

    /**
     * for API to get all records of table.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllData()
    {
        return ProjectRole::all(['id', 'name']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('projectroles.create');
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

        Projectrole::create($request->all());

        return redirect()->route('projectroles.index')
                        ->with('success','projectroles created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Projectrole $projectrole)
    {
        return view('projectroles.show',compact('projectrole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Projectrole $projectrole)
    {
        return view('projectroles.edit',compact('projectrole'));    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Projectrole $projectrole)
    {
         request()->validate([
            'name' => 'required',

        ]);

        $projectrole->update($request->all());

        return redirect()->route('projectroles.index')
                        ->with('success','Project Roles updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projectrole $projectrole)
    {
        $projectrole->delete();

        return redirect()->route('projectroles.index')
                        ->with('success','Project Roles Deactivated successfully');
    }
    
    public function projectroles_revoke($projectrole_id)
    {
        Projectrole::withTrashed()->find($projectrole_id)->restore();

        return redirect()->route('projectroles.index')
                        ->with('success','Project Roles Activated successfully');
    }

    public function prdatatables(Request $request)
    {
        $columns = array( 
                            1=>'name', 
                        );
                    
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
                    
        $posts = Projectrole::latest()->withTrashed();
                    
        $totalData = $posts->count();
                    
        if(!empty($search))
        {
            $posts =  $posts->where('name','LIKE',"%{$search}%");
        }
        
        $posts = $posts->offset($start)
                       ->limit($limit)
                       ->orderBy($order,$dir)
                       ->get();
    
    
        if(!empty($posts))
        {
            $i=0;
            foreach ($posts as $post)
            {
                $i++;
                $show = route('projectroles.show',$post->id);
                $edit = route('projectroles.edit',$post->id);
                $delete = route('projectroles.destroy',$post->id);
                $revoke = route('projectroles_revoke', $post->id);
                
                if($post->deleted_at == null)
                {
                    $act_deact = "
                                <a href='{$edit}' title='Edit' class='fa fa-edit edit_button'></a>
                                          
                                <form action=".$delete." style='display:inline' method='POST'>
                                    ".method_field('DELETE')."
                                    ".csrf_field()."
                                    <button type='submit' class ='fa fa-trash deact_button' title='Deactivate'></button>
                                </form>";
                }
                else
                {
                    $act_deact = "<a href='{$revoke}' title='Activate' class='fa fa-check-circle act_button'></a>";
                }
                

                $nestedData['id'] = $i;
                $nestedData['name'] = $post->name;
                $nestedData['options'] = "$act_deact";

                $data[] = $nestedData;
            }
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalData), 
                    "data"            => $data   
                    );
        return json_encode($json_data); 
    }   
}
