<?php
namespace Azuriom\Plugin\EfClassements\Models;

use Azuriom\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @property int $id
 * @property int $user_id
 * @property int $faction_id
 * @property int $kills
 * @property int $deaths
 *
 * @method static Builder enabled()
 */
class Player extends Model
{
    public $params = ['kills', 'deaths', 'points'];

    public $timestamps = false;

    public function ranking(): MorphToMany
    {
        return $this->morphToMany(Ranking::class, 'rankable');
    }
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function faction(): BelongsTo{
        return $this->belongsTo(Faction::class);
    }

    public function name(){
        return User::find($this->user_id)->name;
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
