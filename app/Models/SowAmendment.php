<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SowAmendment extends Model
{
    use SoftDeletes;

    public $table = 'sow_amendments';
    protected $fillable = [
        'sow_id',
        'amendment_id'
    ];

    public function sow()
    {
        return $this->belongsTo('App\Models\Sow', 'id' ,'sow_id');
    }
}
