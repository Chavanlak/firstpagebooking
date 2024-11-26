<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    protected $table = 'booking';
    public $timestamps = false;
    protected $primaryKey = 'bookingId';


    public function memberBooking(): HasMany{
        return $this->hasMany(Memberbooking::class,'bookingId');
    }

    use HasFactory;
}
