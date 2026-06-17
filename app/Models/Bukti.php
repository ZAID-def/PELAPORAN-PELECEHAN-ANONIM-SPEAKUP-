<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bukti extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'buktis';
    protected $primaryKey = 'id_bukti';

    protected $fillable = [
        'id_laporan',
        'nama_barang',
        'file_bukti',
        'tipe_file',
        'status_bukti',
        'lokasi_simpan',
        'catatan',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan');
    }
}