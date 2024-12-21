<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ItemHistory;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['thumbnail', 'category', 'code', 'name', 'description', 'price', 'price_sell', 'stock', 'stock_alert', 'pcs'];

    public function histories()
    {
        return $this->hasMany(ItemHistory::class);
    }
}
