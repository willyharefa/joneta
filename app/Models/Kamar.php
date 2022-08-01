<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;
    protected $guarded = [ 'id' ];

    public function gambarKamar()
    {
        return $this->hasMany(GambarKamar::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
