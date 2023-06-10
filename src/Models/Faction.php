<?php

namespace Azuriom\Plugin\EfClassements\Models;

use Azuriom\Plugin\EfClassements\Events\FactionSaved;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Notifications\Notifiable;
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
    public $params = ['totem', 'koth', 'points'];

    public $keyType = 'string';
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

    function getClass()
    {
        return get_class($this);
    }

    function valueFor($columnId){
        $column = Column::find($columnId);
        foreach ($this->attributes as $attribute => $value) {
            if($column->name == $attribute){
                return $value;
            }
        }
    }

    function points($rankingId){
        $ranking = Ranking::find($rankingId);
        $columns = $ranking->columns;
        foreach ($columns as $column) {
            $valueList[]= $this->valueFor($column->id);
        }
        return array_reduce($valueList, function ($carry, $item){
            $carry += $item;
            return $carry;
        });
    }
}
