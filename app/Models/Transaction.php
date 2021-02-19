<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Sow;
//use Spatie\Permission\Models\Role;

class Transaction extends Model
{
    public $table = 'transactions';

     protected $fillable = [
        'sow_id',
        'user_id',
        'from_status',
        'to_status',
        'role_id'
    ];

    public  function creator() 
	{
		return $this->belongsTo('App\User', 'user_id');
    }
    
    public  function sowdtl() 
	{
		return $this->belongsTo('App\Models\Sow', 'sow_id');
    }

    public function scopeByProjectType($query, $projectType)
    {
        return $query->whereIn('project_type_id', $projectType);
    }

    public  function role() 
    {
        return $this->belongsTo('Spatie\Permission\Models\Role', 'role_id');
    }

    public  function comment() 
    {
        return $this->hasOne('App\Models\SowComment', 'transaction_id' , 'id' );
        //return $this->belongsTo('Spatie\Permission\Models\Role', 'role_id');
    }
}
