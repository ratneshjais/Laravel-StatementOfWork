<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

//use Illuminate\Database\Eloquent\SoftDeletes;
/* Revisionable */
use \Venturecraft\Revisionable\RevisionableTrait;
/* Revisionable */
class AnnexureValue extends Model
{
	
    public $table = 'annexure_values';
    protected $fillable = ['sow_id', 'attribute_id', 'value'];

    public function annexureAttribute()
    {
        return $this->hasOne('App\Models\AnnexureAttribute', 'id' , 'attribute_id' )->orderBy('list_order', 'asc');
    }
}
