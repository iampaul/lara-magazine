<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magazine_model extends Model
{
    
    protected $table = 'magazines';

    protected $primaryKey = 'magazine_id';

    protected $fillable = [ 'name', 'price', 'frequency', 'image', 'status' ];
}
