<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SowAuthorization extends Model
{
    public $table = 'sow_authorizations';

    protected $fillable = [
        'sow_id',
        'transaction_id',
        'role_id',
        'user_id',
		'status'
    ];

    protected $gaurded = [
        'id'
    ];
    
    public function authorizationUser()
    {
        //return $this->belongsTo(User::class, 'user_id' ,'id'  );
        return $this->belongsTo('App\User', 'user_id');

    }
}
