<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
    use HasFactory;

    /**
     * リレーション - partiesテーブル
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parties(): HasMany
    {
        return $this->hasMany(Party::class);
    }
}
