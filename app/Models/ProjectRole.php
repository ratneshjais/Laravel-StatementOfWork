<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/* Revisionable */
use \Venturecraft\Revisionable\RevisionableTrait;
/* Revisionable */
class ProjectRole extends Model
{
	use SoftDeletes;

    public $table = 'project_roles';

    protected $fillable = ['name'];

    /**
     * Get all of the skills that are assigned this project role.
     */
    public function skills()
    {
        return $this->morphedByMany('App\Models\ProjectSkills', 'role_has_skills');
    }
    public function identifiableName()
    {
        return $this->name;
    }
}
