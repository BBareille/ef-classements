<?php

namespace Azuriom\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property string $name
 * @property int $totem
 * @property int $koth
 * @property Collection|Player[] $players
 *
 * @method static \Illuminate\Database\Eloquent\Builder enabled()
 */

class Faction extends Rankable
{

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faction';

    public $timestamps = false;


    public function players(): HasMany{
        return $this->hasMany(Player::class);
    }
    public static function getRankBy(): Collection
    {
            return DB::table('faction')
                ->orderBy('points', 'desc')
                ->get();
    }

}
