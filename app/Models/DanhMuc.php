<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhMuc extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $table = 'danh_mucs'; khi mà chạy câu lệnh php artisan make:model -m thì không cần dòng này
    protected $fillable = [
        'hinh_anh',
        'ten_danh_muc',
        'trang_thai',
    ];
    protected $cats = [
        'trang_thai' => 'boolean'
    ];
    public function sanPham(){
        return $this->hasMany(SanPham::class);
    }

}
