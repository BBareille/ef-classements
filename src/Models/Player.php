<?php

namespace Azuriom\Plugin\RankFaction\Models;
use Azuriom\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property int $user_id
 * @property int $faction_id
 * @property int $kills
 * @property int $deaths
 *
 * @method static \Illuminate\Database\Eloquent\Builder enabled()
 */
class Player extends Rankable
{
    public function user(): HasOne{
        return $this->hasOne(User::class);
    }

    public function faction(): BelongsTo{
        return $this->belongsTo(Faction::class);
    }
}
