<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
use App\Models\BookingDetail;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';
    protected $primaryKey = 'no_booking';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'no_booking',
        'nama_user',
        'no_customer',
        'tgl_booking',
    ];

    public function rooms()
    {
        return $this->belongsToMany(Room::class,'booking_detail','no_booking','kode_ruang');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class,'no_customer');
    }
    public function booking_details()
    {
        return $this->hasMany(BookingDetail::class,'no_booking','no_booking');
    }
}
