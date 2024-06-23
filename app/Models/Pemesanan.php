<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function invoice()
    {
        return $this->hasOne(InvoicePemesanan::class, 'id_pemesanan');
    }

    public function notaJalan()
    {
        return $this->hasOne(NotaJalan::class, 'id_pemesanan');
    }

    public function barangs()
    {
        return $this->hasMany(BarangPemesanan::class, 'id_pemesanan');
    }
}
