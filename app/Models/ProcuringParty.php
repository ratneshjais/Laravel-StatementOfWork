<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/* Revisionable */
use \Venturecraft\Revisionable\RevisionableTrait;
/* Revisionable */

class ProcuringParty extends Model
{ 
	use SoftDeletes;
	
    public $table = 'procuring_parties';

    public function identifiableName()
    {
        return $this->name;
    }
    protected $fillable = ['name'];

}
