@extends('admin.layouts.admin')

@section('title', 'Paramètres du classement des factions')

@section('content')
    <form class="form" method="POST" action="{{action('Azuriom\Plugin\EfClassements\Controllers\Admin\AdminController@storeRanking')}}">
        @csrf
        <div class="form-group">
            <label>Nom du classement</label>
            <input class="form-control w-50" name="name"/>
        </div>
        <div class="form-group">
        <label>Cible du classement</label>
        <select class="form-select w-50" name="target" id="targetEntity">
            <option selected> Sélectionnez la cible de votre classement</option>
            @foreach($entities as $name=>$entity)
                <option value="{{$name}}">{{$name}}</option>
            @endforeach
        </select>
        </div>

        <div class="form-group">

        <label for="sortByFaction" style="display: none">Classement par :</label>
        <label for="sortByPlayer" style="display: none">Classement par :</label>

            @foreach($entities as $name=>$entity)
                <select aria-labelledby="sortBy" style="display: none" class="form-select mb-3 w-50 sortBy" name="calculation" id={{'sortBy'.$name}}>
                    <option selected>Sélectionnez le paramètres qui va trier votre classement</option>
                    @foreach($entity as $params)
                        <option value={{$params}}>{{$params}}</option>
                    @endforeach
                </select>
            @endforeach
        </div>

        <fieldset>
            <legend><h2>Colonnes de votre classement</h2></legend>

            @foreach($entities as $name=>$entity)
                <div class="columns" id="column{{$name}}" style="display: none">
                    @foreach($entity as $params)
                    <div class="form-check form-switch">
                        <label class="form-check-label" for="{{$params}}">{{$params}}</label>
                        <input class="form-check-input" type="checkbox" value="{{$params}}" name="columns[]" id="{{$params}}">
                    </div>
                @endforeach
                </div>
            @endforeach

        </fieldset>
        <button type="submit" class="btn btn-primary mt-3 ">Valider</button>
    </form>

<script>
    let selectSortBy = document.getElementsByClassName('sortBy')
    let targetEntity = document.getElementById("targetEntity")
    let columnsList = document.getElementsByClassName("columns")


    targetEntity.addEventListener("change", ()=> {
        for(let column of columnsList){
            column.style = 'display:none'
        }
        for(let select of selectSortBy){



            if(select.id == 'sortBy'+targetEntity.value){
                select.style = 'display : block'
                select.labels[0].style = 'display : block'
                let columns = document.getElementById('column'+targetEntity.value)
                columns.style = 'display : block'
            } else{
                select.style = 'display: none'
                select.labels[0].style = 'display : none'
            }
        }
    })

    for(let select of selectSortBy){
        select.addEventListener("change", ()=> {

        })
    }
</script>
@endsection
