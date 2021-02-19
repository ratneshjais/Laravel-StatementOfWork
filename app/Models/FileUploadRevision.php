<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileUploadRevision extends Model
{
    //
    use SoftDeletes;

    public $table = 'file_upload_revision';
    
    protected $fillable = [
        'sow_id',
        'file_name'
    ];
}
