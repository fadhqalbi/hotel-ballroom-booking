<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
use App\Models\Booking;

class BookingDetail extends Model
{
    use HasFactory;

    protected $table = 'booking_detail';
    // protected $foreignKey = ['no_booking','kode_ruang'];
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
        'kode_ruang',
        'tgl_penggunaan_ruang',
        'lama_booking',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

}
