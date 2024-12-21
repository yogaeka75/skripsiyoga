<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Item;

class ItemHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['item_id', 'type', 'quantity_before', 'quantity', 'quantity_after', 'description'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
