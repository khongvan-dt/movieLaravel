<?php

namespace App\Models;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    use HasFactory;
    protected $table = 'customer'; 

    protected $primaryKey = 'customer_id'; // Khai báo khóa chính của bảng

    protected $fillable = ['name', 'email', 'password']; // Các trường cho phép gán dữ liệu

}
