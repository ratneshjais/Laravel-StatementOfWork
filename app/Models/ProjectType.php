<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/* Revisionable */
use \Venturecraft\Revisionable\RevisionableTrait;
/* Revisionable */
class ProjectType extends Model
{
    use SoftDeletes;
	
    public $table = 'project_types';

    public function identifiableName()
    {
        return $this->type;
    }
    protected $fillable = ['type'];

}
