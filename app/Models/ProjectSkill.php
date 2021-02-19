<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/* Revisionable */
use \Venturecraft\Revisionable\RevisionableTrait;
/* Revisionable */
class ProjectSkill extends Model
{
	use SoftDeletes;
	
    public $table = 'project_skills';

    public $fillable = ['name'];

    /**
     * Get all of the roles for the project skill.
     */
    public function roles()
    {
        Schema::table('project_skills', function (Blueprint $table) {
            $table->softDeletes();
        });
    	return $this->morphToMany('App\Models\ProjectRoles', 'role_has_skills');
    }
    public function identifiableName()
    {
        return $this->name;
    }
}
