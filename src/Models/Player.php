<?php

namespace Azuriom\Models;

use Azuriom\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $user_id
 * @property int $faction_id
 * @property int $kills
 * @property int $deaths
 *
 * @method static Builder enabled()
 */
class Player extends Rankable
{


    public $timestamps = false;

    protected $table = 'player'; // next migration this need to go
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function faction(): BelongsTo{
        return $this->belongsTo(Faction::class);
    }
}
