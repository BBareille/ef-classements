<?php

namespace Azuriom\Plugin\EfClassements\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property boolean $isDisplayed
 * @property int $weight
 * @property int $ranking_id
 *
 * @method static Builder enabled()
 */
class Column extends Model
{
    public $timestamps = false;

    protected $attributes = [
      'isDisplayed' => false,
      'weight' => 1,
    ];

    public function ranking(): BelongsTo
    {
        return $this->belongsTo(Ranking::class, 'ranking_id', 'id');
    }


}
