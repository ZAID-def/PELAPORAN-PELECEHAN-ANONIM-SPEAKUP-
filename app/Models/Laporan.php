<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporans';
    protected $primaryKey = 'id_laporan';

    protected $fillable = [
        'id_user',
        'jenis_kejadian',
        'lokasi',
        'tanggal_kejadian',
        'deskripsi',
        'phone',
        'status',
        'tanggal_lapor',
        'kode_tracking',
        'notes',
    ];

    protected $casts = [
        'tanggal_kejadian' => 'datetime',
        'tanggal_lapor' => 'datetime',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Relasi ke Bukti
     */
    public function buktis()
    {
        return $this->hasMany(Bukti::class, 'id_laporan');
    }

    /**
     * Relasi ke StatusUpdate
     */
    public function statusUpdates()
    {
        return $this->hasMany(StatusUpdate::class, 'id_laporan');
    }
}