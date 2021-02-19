<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:location-list', ['only' => ['index','show']]);
         $this->middleware('permission:location-create', ['only' => ['create','store','edit','update']]);
         $this->middleware('permission:location-delete', ['only' => ['destroy','location_revoke']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data = Location::orderBy('id','DESC')->withTrashed()->paginate(5);
        return view('locations.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'type'=>'required'
        ]);

        $location = new Location([
            'type' => $request->get('type')
        ]);
        $location->save();
        return redirect('/locations')->with('success', 'Location saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        return view('locations.show',compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //

        return view('locations.edit',compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
         request()->validate([
            'type' => 'required',

        ]);

        $location->update($request->all());

        return redirect()->route('locations.index')
                        ->with('success','Location updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //
        $location->delete();

        return redirect()->route('locations.index')
                        ->with('success','Location Deactivated successfully');
    }

    public function location_revoke($location_id)
    {
        Location::withTrashed()->find($location_id)->restore();

        return redirect()->route('locations.index')
                        ->with('success','Location Activated successfully');
    }

    public function loc_datatables(Request $request)
    {
        $header = array(
            0=>'id', 
            1=>'type', 
        );

        $limit =  $request->input('length');
        $start =  $request->input('start');
        $order = $header[ $request->input('order.0.column')];
        $dir =  $request->input('order.0.dir');
        $search =  $request->input('search.value');

        $records = Location::latest()->withTrashed();

        if(!empty($search))
        {
            $records = $records->where('type','LIKE',"%{$search}%");
        }

        $records = $records
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
        
        $counts = $records->count();

        $data = array();

        if(!empty($records))
        {
            $i = 0;

            foreach($records as $location)
            {
                $i++;

                $revoke = route('location_revoke',$location->id);
                $edit = route('locations.edit',$location->id);
                $delete = route('locations.destroy',$location->id);
                
                if($location->deleted_at != null)
                {
                    $act_deact = "<a class='fa fa-check-circle act_button' title='Activate' href='{$revoke}'></a>";
                }
                else
                {
                    $act_deact ="
                                <a href='{$edit}' title='Edit' class='fa fa-edit edit_button'></a>
                                <form action=".$delete." style='display:inline' method='POST'>
                                    ".method_field('DELETE')."
                                    ".csrf_field()."
                                    <button type='submit' class ='fa fa-trash deact_button' title='Deactivate' ></button>
                                </form>";
                }

                $data_array['id']=$i;
                $data_array['type']=$location->type;
                $data_array['action']=$act_deact;
    
                $data[] = $data_array;
            }
        }
        
          
       $json_data = array(
        "draw"            => intval($request->input('draw')),  
        "recordsTotal"    => intval($counts),  
        "recordsFiltered" => intval($counts), 
        "data"            => $data   
        );
        return json_encode($json_data); 
    }

    
}
