<?php

namespace Azuriom\Plugin\EfClassements\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @property int $id
 * @property string $name
 * @property string $type
 * @property Column $orderBy
 * @property Collection|Player[] $players
 * @property Collection|Faction[] $faction
 * @property Collection|Column[] $columns
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
        return $this->morphedByMany(Faction::class, 'rankable');
    }

    public function orderBy(): HasOne
    {
        return $this->hasOne(Column::class, 'orderBy', 'id');
    }

    public function columns(): hasMany
    {
        return $this->hasMany(Column::class);
    }

}
