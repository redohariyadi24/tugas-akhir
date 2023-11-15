<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'user_id',
        'produk_id',
        'jumlah',
        'total',
        'status'
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
