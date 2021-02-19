<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SowComment extends Model
{
    use SoftDeletes;

    public $table = 'sow_comment';

    public $fillable = ['comments','user_id','sow_id','transaction_id'];

    /**
     * Get all of the owning SOW models.
     */
    public function sow()
    {
        return $this->belongsTo('App\Models\Sow', 'id' ,'sow_id'  );
    }

    public  function user() 
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public  function SowComment() 
    {
        return $this->belongsTo('App\Models\SowComment', 'transaction_id');
    }
 
    public  function transaction() 
    {
        return $this->hasOne('App\Models\Transaction', 'id', 'transaction_id'  );
    }
}
