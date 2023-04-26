<?php

namespace Azuriom\Plugin\EfClassements\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property string $name
 * @property int $value
 * @property boolean $isDisplayed
 * @property int $weight
 * @property int $ranking_id
 *
 * @method static Builder enabled()
 */
class Column extends Model
{
    public $timestamps = false;

    public function getPoint(): int
    {
        return $this->value * $this->weight;
    }

    public function ranking(): BelongsTo
    {
        return $this->belongsTo(Ranking::class);
    }


}
