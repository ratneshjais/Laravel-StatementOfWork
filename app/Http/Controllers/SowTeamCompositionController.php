<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamComposition;
use App\Models\Sow;

class SowTeamCompositionController extends Controller
{
    //
 
    public function show(Sow $sow)
    {
        return TeamComposition::all(
                [
                    'id',
                    'sow_id',
                    'role_id',
                    'skill_id',
                    'qty',
                    'start_date',
                    'end_date'
                ])->where('sow_id', '', $sow->attributesToArray()['id']);
    }

    public function store(Request $request)
    {
        $sowTeamComposition = TeamComposition::create($request->all());
        return response()->json($sowTeamComposition, 201);
 
    }

    public function update(Request $request, TeamComposition $sowTeamComposition)
    {
        $sowTeamComposition->update($request->all());

        return response()->json($sowTeamComposition, 200); 
    }

    public function delete(Request $request, TeamComposition $sowTeamComposition)
    {
        $sowTeamComposition->delete();

        return response()->json(null, 204);
    }
}
