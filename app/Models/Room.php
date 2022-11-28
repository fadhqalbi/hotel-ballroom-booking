<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BookingDetail;
use App\Models\Booking;
use App\Models\BookingSummary;

class Room extends Model
{
    use HasFactory;
    protected $table = 'ruang';
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
        'nama_ruang',
        'kapasitas_maks',
        'lokasi_lantai',
    ];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class,'booking_detail','kode_ruang','no_booking');
    }
    public function booking_summary()
    {
        return $this->hasMany(BookingSummary::class,'kode_ruang');
    }

}
