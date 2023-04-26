@extends('admin.layouts.admin')

@section('title', 'Paramètres du classement des factions')

@section('content')
    <form class="form" method="POST" action="{{action('Azuriom\Plugin\EfClassements\Controllers\Admin\AdminController@storeRanking')}}">
        @csrf
        <div class="form-group">
            <label>Nom du classement</label>
            <input class="form-control w-25" name="name"/>
        </div>
        <div class="form-group">
        <label>Cible du classement</label>
        <select class="form-select w-25" name="target" id="targetEntity">
            @foreach(Azuriom\Plugin\EfClassements\Controllers\RankingController::getListOfTargetEntities() as $target)
                @if($target == "Island")
                    <option disabled value="{{$target}}">{{$target}}</option>
                @else
                <option value="{{$target}}">{{$target}}</option>
                @endif
            @endforeach
        </select>
        </div>
        <div class="form-group">
        <label for="calculation">Classement par :</label>
        <select class="form-select w-25" name="calculation" id="calculation">
            <option value='koth'>Koth</option>
            <option value='totem'>Totem</option>
            <option value='players'>Players</option>
        </select>
        </div>

        <fieldset>
            <legend><h2>Colonnes dans le classement</h2></legend>
        <div class="form-check form-switch">
            <label class="form-check-label" for="koth">koth</label>
            <input class="form-check-input" type="checkbox" value="koth" name="columns[]" id="koth">
        </div>
        <div class="form-check form-switch">
            <label class="form-check-label" for="totem">totem</label>
            <input class="form-check-input" type="checkbox" value="totem" name="columns[]" id="totem">
        </div>
        <div class="form-check form-switch">
            <label class="form-check-label" for="players">players</label>
            <input class="form-check-input" type="checkbox" value="players" name="columns[]" id="players">
        </div>
        <div class="form-check form-switch">
            <label class="form-check-label" for="points">points</label>
            <input class="form-check-input" type="checkbox" value="points" name="columns[]" id="points">
        </div>
        </fieldset>
        <button type="submit" class="btn btn-primary mt-3 ">Valider</button>
    </form>

<script>
    let selectCalculation = document.getElementById("calculation")
    let targetEntity = document.getElementById("targetEntity")
    targetEntity.addEventListener("change", ()=> {
        if(targetEntity.value == "Player"){
            selectCalculation.innerHTML = "<option value='kills'>Kill</option><option value='deaths'>Deaths</option>"
        } else if(targetEntity.value == "Faction"){
            selectCalculation.innerHTML = "<option value='koth'>Koth</option><option value='totem'>Totem</option><option value='players'>Players</option>"
        }
    })
</script>
@endsection
