<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $primaryKey = 'no_customer';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'no_customer',
        'nama_customer',
        'alamat',
        'kota',
        'email',
        'hp'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class,'no_customer');
    }

}
