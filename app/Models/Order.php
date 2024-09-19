<?php

namespace App\Models;

use App\Events\BillOfLadingReleased;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Return the user that released the Bill of Lading.
     *
     */
    public function blReleasedBy()
    {
        return $this->belongsTo(User::class);
    }
}
