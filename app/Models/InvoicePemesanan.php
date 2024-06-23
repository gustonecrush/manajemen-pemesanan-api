<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicePemesanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function invoice()
    {
        return $this->belongsTo(Pemesanan::class, 'id');
    }
}
