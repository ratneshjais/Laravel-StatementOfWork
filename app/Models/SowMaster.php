<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SowMaster extends Model
{
	use SoftDeletes;
	
    public $table = 'sow_master';

    public function sow()
    {
        return $this->belongsTo('App\Models\Sow', 'project_type_id' ,'project_type_id'  );
    }    
}
