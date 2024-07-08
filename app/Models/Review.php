<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'review';

    protected $fillable = [
        'driver_id',
        'rider_id',
        'type',
        'rating',
        'comment',
    ];
}
