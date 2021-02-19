<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Spatie\Permission\Models\Role;

class Workflow extends Model
{
	protected $fillable = [
        'project_type_id',
        'user_id',
        'role_id' 
    ];
	public  function project_type() 
	{
		return $this->belongsTo(ProjectType::class);
	}

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id' ,'id'  );
    }

	public  function role() 
	{
		return $this->belongsTo(Role::class);
	}

    public function scopeOfRole($query, $role)
    {
        return $query->whereIn('role_id', $role);
    }

    public function scopeByProjectType($query, $projectType)
    {
        return $query->where('project_type_id', $projectType);
    }

    public function scopeByProjectTypeRole($query, $projectType, $role)
    {
        return $query->where(['project_type_id' => $projectType, 'role_id' => $role]);
    }

    public function scopeByUser($query, $user)
    {
        return $query->where('user_id', $user);
    }

    public function sow()
    {
        return $this->belongsTo('App\Models\Sow', 'project_type_id' ,'project_type_id'  );
    }
    
    
}
