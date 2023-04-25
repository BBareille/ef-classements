<?php

namespace Azuriom\Plugin\EfClassements\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $formula
 * @property Collection $rankingList
 *
 * @method static Builder enabled()
 */
class Calculation extends Model
{
    public $timestamps = false;
    public function rankingList():HasMany{
        return $this->hasMany(Ranking::class);
    }
}
