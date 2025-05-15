<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['client_id','package_id','date','total','status'];

    protected $casts = [
        'date'  => 'date',
        'total' => 'decimal:2',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}