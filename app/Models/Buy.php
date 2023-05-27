<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function consumer()
    {
        return $this->belongsTo(Consumer::class);
    }

    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }

    public function getRouteKeyName()
    {
        return 'unique';
    }
}
