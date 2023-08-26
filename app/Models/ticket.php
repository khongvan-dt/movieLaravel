<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    use HasFactory;
    protected $table = 've'; 

    protected $primaryKey = 've_id '; // Khai báo khóa chính của bảng

    protected $fillable = ['Id_users','ID_ghe2','movie_id3','Id_lich_chieu2','gia','Ngay_dat_ve','thanh_toan']; 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
 