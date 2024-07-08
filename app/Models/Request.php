<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'rider_id',
        'driver_id',
        'cost',
        'start_location',
        'stop_location',
        'end_location',
        'route_distance',
        'request_date',
        'arrived_date',
        'start_date',
        'end_date',
        'status'
    ];
}
