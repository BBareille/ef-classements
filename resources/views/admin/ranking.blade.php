@extends('admin.layouts.admin')

@section('title', 'Paramètres du classement des factions')

@section('content')
    <form class="form" method="POST" action="{{action('Azuriom\Plugin\RankFaction\Controllers\Admin\AdminController@storeRanking')}}">
        @csrf
        <div class="form-group">
            <label>Nom du classement</label>
            <input class="form-control w-25" name="name"/>
        </div>
        <div class="form-group">
        <label>Cible du classement</label>
        <select class="form-select w-25" name="target" id="targetEntity">
            @foreach(Azuriom\Plugin\RankFaction\Controllers\RankingController::getListOfTargetEntities() as $target)
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
            {{--            @foreach(Azuriom\Plugin\RankFaction\Controllers\RankingController::getListOfCalculation() as $calculation)--}}
{{--                <option value="{{$calculation->id}}">{{$calculation->name}}</option>--}}
{{--            @endforeach--}}
        </select>
        </div>
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
