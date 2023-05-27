<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sele extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function buy()
    {
        return $this->belongsTo(Buy::class);
    }

    public function getRouteKeyName()
    {
        return 'unique';
    }
}
