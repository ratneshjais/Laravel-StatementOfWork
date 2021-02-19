<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/* Revisionable */
use \Venturecraft\Revisionable\RevisionableTrait;
/* Revisionable */
class Location extends Model
{
	use SoftDeletes;

    protected $fillable = [
        'type'
    ];
    public function identifiableName()
    {
        return $this->type;
    }
}