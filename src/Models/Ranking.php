<?php

namespace Azuriom\Plugin\EfClassements\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @property int $id
 * @property string $name
 * @property int $calculation_id
 * @property string $order
 *
 * @method static Builder enabled()
 */
class Ranking extends Model
{

    public $timestamps = false;
    /**
     * Get all of the entities for this ranking.
     */
    public function players(): MorphToMany
    {
        return $this->morphedByMany(Player::class, 'rankable');
    }

    public function faction(): MorphToMany
    {
        return $this->morphedByMany(Faction::class, 'rankable')->orderBy('koth', 'desc');
    }

    public function calculation(): BelongsTo
    {
        return $this->belongsTo(Calculation::class);
    }
}
