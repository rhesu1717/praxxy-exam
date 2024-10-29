<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemporaryFile extends Model
{
    protected $table = 'temporary_files';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'folder',
        'filename'
    ];
}
