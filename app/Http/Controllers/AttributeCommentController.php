<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sow;
use App\Models\AttributeComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AttributeCommentController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
          
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function atribCommentlist($sow, $attribute)
    {
        $data = AttributeComment::with('user')
        			->where(['sow_id'=>$sow , 'attribute'=>$attribute])
                    ->latest()->get();
        return $data;
    }

    public function sowCommentlist($sow)
    {
        $data = AttributeComment::with('user')
        			->where(['sow_id'=>$sow ])
                    ->latest()->get();
        return $data;
    }

    public function sowCommentlistByComment($commentID)
    {
        $data = AttributeComment::with('user')
                    ->whereRaw(" sow_id = (select sow_id from sow_attribute_comments where id= $commentID )")
                    ->whereRaw(" attribute = (select attribute from sow_attribute_comments where id= $commentID )")
        			//->where(['id'=>$commentID ])
                    ->latest()->get();
        return $data;
    }

    public function store(Request $request)
    {
        $sowTeamComposition = AttributeComment::create($request->all());
        $data = AttributeComment::with('user')
                    ->where([
                                'sow_id'=>$sowTeamComposition["sow_id"] , 
                                'attribute'=>$sowTeamComposition["attribute"]
                            ])
                    ->latest()->get();
        return $data;

        //return response()->json($sowTeamComposition, 201);
 
    }
}
