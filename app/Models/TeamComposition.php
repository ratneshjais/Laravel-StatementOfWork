<?php

namespace App\Models;
use App\User;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/* Revisionable */
use \Venturecraft\Revisionable\RevisionableTrait;
/* Revisionable */
class TeamComposition extends Model
{
    use SoftDeletes;

    public $table = 'sow_team_compositions';
    
    protected $fillable = [
        'sow_id',
        'role_id',
        'skill_id',
        'qty',
        'start_date',
        'end_date'
    ];

       /* Revisionable */
       use RevisionableTrait;
       protected $revisionEnabled = true;
       protected $revisionCreationsEnabled = true;
       protected $keepRevisionOf = ['qty'];
       protected $revisionFormattedFieldNames = [
               'qty'              => 'quantity',
               'deleted_at'       => 'deleted at',
               'start_date'       => 'start date',
               'end_date'         => 'end date'
       ];
       /* Revisionable */

}
