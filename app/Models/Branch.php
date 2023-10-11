<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Branch extends Model
{
    use HasFactory;
    protected $table = 'store_branches';

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
