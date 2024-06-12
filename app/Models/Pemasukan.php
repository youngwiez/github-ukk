<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;
    protected $table = 'pemasukan';
    protected $fillable = [
        'tgl_masuk', 
        'qty_masuk', 
        'barang_id'
    ];
    
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
