<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kid extends Model
{
    protected $fillable = [
        'process',
        'name',
        'cpf',
        'state'
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
