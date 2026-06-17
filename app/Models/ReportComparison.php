<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportComparison extends Model
{
    use HasFactory;

    protected $table = 'report_comparisons';

    protected $fillable = [
        'name',
        'start_month',
        'end_month',
        'category_filter',
        'status_filter',
        'comparison_type',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'start_month' => 'date',
        'end_month' => 'date',
    ];

    /**
     * Relasi ke User (pembuat perbandingan)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
