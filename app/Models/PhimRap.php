<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhimRap extends Model
{
    use HasFactory;
    protected $table = 'phimRap'; // Tên bảng tương ứng trong cơ sở dữ liệu
    protected $primaryKey = 'phimRapId'; // Khóa chính của bảng

    // Các cột trong bảng
    protected $fillable = [
        'Id_Rap',
        'ID_Phim',
    ];
    // Định nghĩa các mối quan hệ nếu cần
    public function rap()
    {
        return $this->belongsTo(Rap::class, 'Id_Rap', 'rap_chieu_id');
    }
    public function phim()
    {
        return $this->belongsTo(Movie::class, 'ID_Phim', 'movie_id');
    }
}
