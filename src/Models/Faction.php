<?php

namespace Azuriom\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property string $name
 * @property int $totem
 * @property int $koth
 * @property Collection|Player[] $players
 *
 * @method static Builder enabled()
 */

class Faction extends Model
{

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Get all of the tags for the post.
     */
    public function ranking(): MorphToMany
    {
        return $this->morphToMany(Ranking::class, 'rankable');
    }

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
                ->orderBy('koth', 'desc')
                ->get();
    }

    function getId()
    {
        return $this->id;
    }

    function getClass()
    {
        return get_class($this);
    }
}
