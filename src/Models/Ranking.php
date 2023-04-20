<?php

namespace Azuriom\Plugin\RankFaction\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property string $name
 * @property Calculation $rankCalculation
 * @property \Illuminate\Support\Collection|Azuriom\Plugin\RankFaction\Models\Rankable $targetEntities
 *
 * @method static \Illuminate\Database\Eloquent\Builder enabled()
 */
class Ranking extends Model
{
    public function targetEntities(){
        return $this->hasMany(Rankable::class);
    }

    public function rankCalculation(): BelongsTo
    {
        return $this->belongsTo(Calculation::class);
    }
}
