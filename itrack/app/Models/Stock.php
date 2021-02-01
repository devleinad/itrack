<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'quantity',
        'from',
        'report',
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'item_id');
    }

    public function stocker()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
