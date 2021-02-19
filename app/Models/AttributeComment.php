<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeComment extends Model
{
    use SoftDeletes;
	
    public $table = 'sow_attribute_comments';

    protected $fillable = [
        'sow_id',
        'user_id',
        'comments',
        'attribute'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function sow()
    {
        return $this->belongsTo('App\Models\Sow', 'id' ,'sow_id'  );
    }

    public  function user() 
    {
        //return $this->belongsTo('App\User', 'user_id');
        return $this->hasOne('App\User', 'id' , 'user_id' );
    }
 
    
}
