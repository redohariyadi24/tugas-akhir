<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    use HasFactory;

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function artis(): BelongsTo
    {
        return $this->belongsTo(Artis::class);
    }

    public function penjualan(): HasMany
    {
        return $this->hasMany(Penjualan::class);
    }

    protected $fillable = [
        'nama',       
        'artis_id',      
        'kategori_id',  
        'stok',       
        'harga',      
        'deskripsi', 
        'gambar'
    ];
}
