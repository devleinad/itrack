<?php

namespace App\Models;

use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Issuing extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'item_id',
        'quantity',
        'receiver',
        'report',
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }

    public function issuer()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
