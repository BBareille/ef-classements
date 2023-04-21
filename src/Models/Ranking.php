<?php

namespace Azuriom\Models;

use Azuriom\Models\Calculation;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $name
 * @property int $calculation_id
 * @property Collection|Rankable $targetEntities
 *
 * @method static Builder enabled()
 */
class Ranking extends Model
{
    public $timestamps = false;
    /**
     * Get all of the tags for the post.
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Faction::class, 'taggable');
    }

    public function rankCalculation(): BelongsTo
    {
        return $this->belongsTo(Calculation::class);
    }
}
