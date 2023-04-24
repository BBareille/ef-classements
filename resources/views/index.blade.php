@extends('layouts.app')

@section('title', 'Classement Faction')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.css">

    @foreach($rankingList as $ranking)
        <button onclick="show({{$ranking->id}})" class="btn btn-primary m-2" >{{$ranking->name}}</button>
    @endforeach


    @foreach($rankingList as $ranking)
{{--        @if(count($ranking->targetEntities)>0)--}}
            @php($mainColumn = $ranking->calculation->name)
            <table id="table{{$ranking->id}}"
                   data-toggle="table"
                   data-search="true"
                   data-pagination="true"
                   data-page-size="10"
                   data-pagination-pre-text="Précédent"
                   data-pagination-next-text="Suivant"
                   data-pagination-detail="false"
                   data-pagination-parts="pageList"
                   data-search-selector="#customSearch"
                   style="display: none"
            >

            <thead>
                <tr>
                    <th>Pos</th>
                    <th>Nom</th>
                    <th>{{$mainColumn}}</th>
                </tr>
            </thead>
            <tbody>
            @if(count($ranking->faction)>0)
                @foreach($ranking->faction()->orderBy($mainColumn, 'desc')->get() as $faction)
                    <tr>

                        <td>{{$loop->index +1}}</td>
                        <td>{{$faction->name}}</td>
                        <td>{{$faction->$mainColumn}}</td>
                    </tr>
                @endforeach
            @else
                @if(count($ranking->players)>0)
                    @foreach($ranking->players()->orderBy($mainColumn, 'desc')->get() as $players)
                        <tr>
                            <td>{{$loop->index +1}}</td>
                            <td>{{$players->name()}}</td>
                            <td>{{$players->$mainColumn}}</td>
                        </tr>
                    @endforeach
                @endif
            @endif

            </tbody>

            </table>


{{--        Boucle sur les différents classement --}}
{{--        @endif--}}
    @endforeach
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function(e) {
                setTimeout(()=> {
                    let totalRanking = document.getElementsByClassName('bootstrap-table')
                    console.log(totalRanking)
                    for(let element of totalRanking){
                        element.style.display = 'none'
                    }
                },0)

            });


            function show(id){
                let ranking = document.getElementById('table'+id)
                let totalRanking = ranking.parentNode.parentNode.parentNode
                // if(ranking.parentNode)
                console.log()
                if(totalRanking.style.display == "none") {
                    css(totalRanking, {
                        'display': 'block'
                    })
                    css(ranking, {
                        'display' : 'table'
                    })
                } else{
                    css(totalRanking, {
                        'display': 'none'
                    })
                    css(ranking, {
                        'display': 'none'
                    })
                }
            }

            function css(element, style) {
                for (const property in style)
                    element.style[property] = style[property];
            }
        </script>


{{--    @endif--}}
@endsection
