@extends('layouts.app')

@section('title', 'Classement FactionCollection')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.css">

    @foreach($rankingList as $ranking)
        <button onclick="show({{$ranking->id}})" class="btn btn-primary m-2" >{{$ranking->name}}</button>
    @endforeach


    @foreach($rankingList as $ranking)
        @php($mainColumn = \Azuriom\Plugin\EfClassements\Models\Column::find($ranking->orderBy)->name)

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
                    @foreach($ranking->columns as $column)
                        @if($column->name != $mainColumn)
                            @if($column->isDisplayed == 1)
                                <th>{{$column->name}}</th>
                            @endif

                        @endif

                    @endforeach
                </tr>
            </thead>
            <tbody>

            @if(count($ranking->faction)>0)
                @foreach($ranking->getSortedEntityBy('Faction', $mainColumn) as $faction)
                    <tr>
                        <td>{{$loop->index +1}}</td>
                        <td>{{$faction->name}}</td>
                        @foreach($ranking->columns as $column)
                            @if($column->isDisplayed == 1)
                            @php($name = $column->name)
                                @if($name == 'points')
                                    <td>{{$ranking->getEntityPoints($faction->id, 'Faction')}}</td>
                                @else
                                <td>{{$faction->$name}}</td>
                                @endif
                            @endif
                        @endforeach
                    </tr>
                @endforeach

            @else
                @if(count($ranking->player)>0)
                    @foreach($ranking->getSortedEntityBy('Player', $mainColumn) as $player)
                        <tr>
                            <td>{{$loop->index +1}}</td>
                            <td>{{$player->name()}}</td>
                            @foreach($ranking->columns as $column)
                                @if($column->isDisplayed == 1)
                                    @php($name = $column->name)
                                    @if($name == 'points')
                                        <td>{{$ranking->getEntityPoints($player->id, 'Player')}}</td>
                                    @else
                                        <td>{{$player->$name}}</td>
                                    @endif
                                @endif
                            @endforeach
                        </tr>
                    @endforeach

                @endif
            @endif

            </tbody>
            </table>


{{--        Boucle sur les différents classement --}}
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
