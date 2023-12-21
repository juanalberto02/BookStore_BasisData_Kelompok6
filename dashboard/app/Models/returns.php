<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class returns extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    protected $fillable = [
        'book_id',
        'amount',
        'reason',
        'store_id',
        'status',
    ];

    // If you have a relationship with the Order model
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function books()
    {
        return $this->belongsTo(books::class, 'book_id');
    }
    // Define other relationships or methods if needed
}
