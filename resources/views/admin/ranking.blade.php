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
                    @foreach($entity as $params)
                        <option selected="false" value={{$params}}>{{$params}}</option>
                    @endforeach
                </select>
            @endforeach
        </div>

        <fieldset id="columnList">
            <legend><h2>Colonnes de votre classement</h2></legend>

            @foreach($entities as $name=>$entity)
                <div class="columns" id="column{{$name}}" style="display: none">
                    @foreach($entity as $params)
                    <div class="form-check form-switch {{$params}}">
                        <label class="form-check-label" for="{{$params}}">{{$params}}</label>
                        <input class="form-check-input" type="checkbox" value="{{$params}}" name="columns[]" id="{{$params}}">
                    </div>
                @endforeach
                </div>
            @endforeach

        </fieldset>

            <label>Choisissez l'impact des paramètres sur les points:</label><br>
            @foreach($entities as $entity)
                @foreach($entity as $params)
                    @if($params != 'points')
                        <div class="form-group">
                            <label for="totem{{$params}}">{{$params}}</label>
                            <input  class="form-control w-25" id="totem{{$params}}" name="weight[{{$params}}]" type="number" value="{{$params}}">
                        </div>
                            @endif
                        @endforeach
            @endforeach


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
                resetAllColumnsSelected();
                select.style = 'display : block'
                select.labels[0].style = 'display : block'
                let columns = document.getElementById('column'+targetEntity.value)
                columns.style = 'display : block'
                for (let option of select){
                    option.disabled= false;
                }
            } else{
                select.style = 'display: none'
                select.labels[0].style = 'display : none'
                for (let option of select){
                    option.disabled= true;
                }
            }
        }
    })

    for(let select of selectSortBy){
        select.addEventListener("change", ()=> {
            let targetEntity = document.getElementById("targetEntity").value
            let columns = document.getElementById("column"+targetEntity)
            for(let children of columns.children){
                for(let column of children.classList){
                    children.children[1].checked = false;
                    children.children[1].disabled = false;
                    if(column == select.value){
                        children.children[1].checked = true;
                        children.children[1].disabled = true;
                        break;
                    }

                }
            }
        })
    }


    function resetAllColumnsSelected(){
        let fieldset = document.getElementById("columnList")
        let columnList = [];
        for (let children of fieldset.children){
            if(children.className.includes('columns')){
                columnList.push(children)
            }
        }

        for (let column of columnList){
            for(let form of column.children){
                form.children[1].checked = false
            }
        }

    }
</script>
@endsection
