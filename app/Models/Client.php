<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name','email','status'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}