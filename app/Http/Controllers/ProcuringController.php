<?php

namespace App\Http\Controllers;
use App\Models\ProcuringParty;

use Illuminate\Http\Request;

class ProcuringController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:procuringparties-list', ['only' => ['index','show']]);
         $this->middleware('permission:procuringparties-create', ['only' => ['create','store','edit','update']]);
         $this->middleware('permission:procuringparties-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procuringparties = ProcuringParty::latest()->withTrashed()->paginate(5);
        return view('procuring.index',compact('procuringparties'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('procuring.create');
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
        ]);

        ProcuringParty::create($request->all());

        return redirect()->route('procuring.index')
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
        $procuringparties = ProcuringParty::find($id);
        return view('procuring.show',compact("procuringparties"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $procuringparty = ProcuringParty::find($id);
        return view('procuring.edit',compact("procuringparty"));
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
            'name' => 'required',
        ]);

        $procuringparties = ProcuringParty::find($id);
        $procuringparties->update($request->all());

        return redirect()->route('procuring.index')
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
        ProcuringParty::find($id)->delete();

        return redirect()->route('procuring.index')
                         ->with('success','Procuring Party Deactivated successfully');
    }
    
    public function procuring_revoke($id)
    {
        ProcuringParty::withTrashed()->find($id)->restore();

        return redirect()->route('procuring.index')
                         ->with('success','Procuring Party Activated successfully');
    }
    
    public static function getAllActiveRecords(): \Illuminate\Database\Eloquent\Collection {
        return ProcuringParty::all($columns = ['id', 'name']);
    }

    public function procuring_datatables(Request $request)
    {
        $header = array(
            0=>'id',
            1=>'name'
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $header[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $records = ProcuringParty::latest()->withTrashed();

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
            foreach($records as $key => $party)
            {
                    $i++;
                    $edit =  route('procuring.edit',$party->id);
                    $delete =  route('procuring.destroy',$party->id);
                    $revoke = route('procuring_revoke',$party->id);

                if($party->deleted_at == null){
                   $act_deact = "<a class='fa  fa-edit edit_button' title='Edit' href='{$edit}'></a>
                                  <form action=".$delete." style='display:inline' method='POST'>
                                  ".method_field('DELETE')."
                                  ".csrf_field()."
                                  <button type='submit' class ='fa fa-trash deact_button' title='Deactivate' ></button>
                                </form>";
                }
               else{
                   $act_deact = "<a class='fa fa-check-circle act_button' title='Activate' href='{$revoke}'></a>";
                }
                $data_array['id'] = $i;    
                $data_array['name'] = $party->name;
                $data_array['action'] = $act_deact;

                $data[] = $data_array;
            }
        }

        $json_data = array(
            'draw' => $request->input('draw'),
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $data
        );

        return json_encode($json_data);
    }
}
