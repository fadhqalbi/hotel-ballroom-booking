<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSummary extends Model
{
    use HasFactory;

    protected $table = 'summary_booking';
    // protected $foreignKey = ['no_booking','kode_ruang'];
    protected $primaryKey = 'kode_ruang';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_ruang',
        'jumlah_booking_ruang',
        'bulan_tahun',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
