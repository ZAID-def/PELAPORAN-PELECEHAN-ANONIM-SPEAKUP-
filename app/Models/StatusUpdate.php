<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusUpdate extends Model
{
    use HasFactory;

    protected $table = 'status_updates';
    protected $primaryKey = 'id_status';

    protected $fillable = [
        'id_laporan',
        'id_admin',
        'status',
        'tanggal_update',
    ];

    protected $casts = [
        'tanggal_update' => 'datetime',
    ];

    /**
     * Relasi ke Laporan
     */
    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan');
    }

    /**
     * Relasi ke User sebagai admin
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }
}