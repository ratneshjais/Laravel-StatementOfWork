<?php

namespace App\Http\Controllers;
use App\Models\ProjectType;
use App\Models\SowMaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Lang;

class SowMasterController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:sow_master-list', ['only' => ['sow_header','sow_header_view']]);
         $this->middleware('permission:sow_master-create', ['only' => ['sow_header_edit','sow_header_update']]);
    }

    public function sow_header()
    {
      return view('sow_header.index');
    }

    public function sow_header_view($id)
    {
        $sow = SowMaster::find($id);
        $ptype = ProjectType::where('id',$sow->project_type_id)->first();

        return view('sow_header.show',compact('sow','ptype'));
    }
    public function sow_header_edit($id)
    {

        $sow = SowMaster::find($id);
        $ptype = ProjectType::where('id',$sow->project_type_id)->first();

        return view('sow_header.edit',compact('sow','ptype'));
    }
    
    public function sow_header_update(Request $request)
    {
  
        $sow = SowMaster::find($request->get('sow_header_id'));
        $sow->content = $request->get('header_value');
        $sow->save();
      
        return redirect()->route('sow_header')
                        ->with('success','Comment Added successfully.');
    }

   

    public function sow_header_datatables(Request $request)
    {
        $h_name = $_POST['h_name'];
        $p_type = $_POST['ptype'];


        $header = array(
                0=>'id',
                1=>'type');


        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $header[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $records = DB::table('sow_master')
                        ->join('project_types','project_types.id','sow_master.project_type_id')
                        ->select('sow_master.id as sow_header_id','sow_master.*','project_types.*');
        
        
        $tcounts = $records->count();


        if(!empty($h_name))
        {
            $records =  $records->where('name','LIKE',"%{$h_name}%");
        }
        if(!empty($p_type))
        {
            $records =  $records->where('project_type_id','LIKE',"%{$p_type}%");
        }
          
          $fcounts = $records->count();

          $records = $records->offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();


          if(!empty($records))
          {
              $i=0;
              $data = array();
          
              foreach($records as $key => $ptype)
                {
                  $i++;

                  $show = route('sow_header_show',$ptype->sow_header_id);
                  $edit = route('sow_header_edit',$ptype->sow_header_id);                  
                    
                  $data_value['id'] = $i;
                  $data_value['type'] = $ptype->type;
                  $data_value['header_name'] = ucfirst(Lang::get('validation.attributes.'.$ptype->name));
                  $data_value['action'] ="<a class='fa fa-eye show_button' href='{$show}' title='View'></a>
                                          <a class='fa fa-edit edit_button' href='{$edit}' title='Edit'></a>";
                    
                  $data[] = $data_value; 
                }
            }

            $json_data = array(
                'draw' => $request->input('draw'),
                'recordsTotal' => $tcounts,
                'recordsFiltered' => $fcounts,
                'data' => $data
            );
            return json_encode($json_data);
    }

    public function sowHeaderlist($type)
    { 
       $sow = SowMaster::where('project_type_id',$type)->where('name','header_desc')->pluck('content'); 
       return $sow[0];
    }
    
}
