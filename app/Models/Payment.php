<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [ 'id' ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function kosan()
    {
        return $this->belongsTo(Kosan::class);
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
