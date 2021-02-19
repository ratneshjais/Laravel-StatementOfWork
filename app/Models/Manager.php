<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/* Revisionable */
use \Venturecraft\Revisionable\RevisionableTrait;
/* Revisionable */

class Manager extends Model
{   
	use SoftDeletes;

    public $table = 'managers';

    public function identifiableName()
    { 
        return $this->name;
    }
    
    protected $fillable = [
        'name', 'type'
    ];

}
