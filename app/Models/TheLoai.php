<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    use HasFactory;
    protected $table = 'the_loai'; 
    protected $primaryKey = 'the_loai_id'; 
    protected $fillable = ['tenTheLoai'];
}
