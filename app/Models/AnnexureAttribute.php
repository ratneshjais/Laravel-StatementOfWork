<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnnexureAttribute extends Model
{
	use SoftDeletes;
	
    public $table = 'annexure_attributes';

    public function annexureValues()
    {
        return $this->hasOne('App\Models\AnnexureValue', 'attribute_id' , 'id' );
    }
}
