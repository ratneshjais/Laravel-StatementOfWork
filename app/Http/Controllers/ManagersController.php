<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;

class ManagersController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:manager-list', ['only' => ['index','show','mdatatables']]);
         $this->middleware('permission:manager-create', ['only' => ['create','store','edit','update']]);
         $this->middleware('permission:manager-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $managers = Manager::latest()->paginate(5);

        return view('managers.index');//,compact('managers')
                // ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $managers = array('customer'=>'Customer','supplier'=>'Supplier');
        
        return view('managers.create',compact('managers'));
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
            'type' => 'required'
        ]);

        $manager = Manager::create($request->all());

        return redirect()->route('managers.index')
                         ->with('success','Manager created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function show(Manager $manager)
    {
        return view('managers.show',compact("manager"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit(Manager $manager)
    {
        $manager_type = array('customer'=>'Customer','supplier'=>'Supplier');
        
        return view('managers.edit',compact("manager","manager_type"));
    }

    /**
     * Update the specified resource in storage.s
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manager $manager)
    {
        request()->validate([
            'name' => 'required',
            'type' => 'required'

        ]);

        $manager->update($request->all());

        return redirect()->route('managers.index')
                         ->with('success','Managers Profile updated successfully');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manager $manager)
    {

        $manager->delete();

        return redirect()->route('managers.index')
                         ->with('success','Project Roles Deactivated successfully');
    }
   
    public function manager_revoke($manager_id)
    {

        Manager::withTrashed()->find($manager_id)->restore();

        return redirect()->route('managers.index')
                         ->with('success','Project Roles Activated successfully');
    }
    
    public function mdatatables(Request $request)
    {
        $s_b_name = $_POST['name'];
        $s_b_type = $_POST['mtype'];

        $data = array();

        $columns = array( 
                            1=>'name', 
                            2=>'type'
                        );
                    
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
                    
        $posts = Manager::latest()->withTrashed();
                    
        $totalData = $posts->count();
                    
        if(!empty($s_b_name))
        {
            $posts =  $posts->where('name','LIKE',"%{$s_b_name}%");
        }
        if(!empty($s_b_type))
        {
            $posts =  $posts->where('type','LIKE',"%{$s_b_type}%");
        }
    
        $totalFiltered = $posts->count();
    
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
                // $show =  route('managers.show',$post->id);
                $edit =  route('managers.edit',$post->id);
                $delete =  route('managers.destroy',$post->id);
                $revoke = route('manager_revoke', $post->id); 
                
                if($post->deleted_at == null)
                {
                    $act_deact = "
                    <a href='{$edit}' title='Edit' class='fa fa-edit edit_button' title='Edit' ></a>
                    <form action=".$delete." style='display:inline' method='POST'>
                             ".method_field('DELETE')."
                             ".csrf_field()."
                             <button type='submit' class ='fa fa-trash deact_button' title='Deactivate'></button>
                          </form>";
                }
                else
                {
                    $act_deact = " <a href='{$revoke}' title='Activate' class='fa fa-check-circle act_button' title='Activate' ></a>";
                }
                

                $nestedData['id'] = $i;
                $nestedData['name'] = $post->name;
                $nestedData['type'] = ucfirst($post->type);
                $nestedData['options'] = "$act_deact";
                $data[] = $nestedData;
            }
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
        return json_encode($json_data); 
    }   

}
