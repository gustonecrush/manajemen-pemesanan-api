<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangPemesanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id');
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id');
    }

    public function getBarangDataAttribute()
    {
        return $this->barang;
    }
}
