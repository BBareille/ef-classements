@extends('layouts.app')

@section('title', 'Classement Faction')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.css">

    <div  class="col-sm-2 mb-2">
        <input type="text" id="customSearch" placeholder="Rechercher une faction .." class="form-control">
    </div>


    @if($factionList)
        <table id="table"
               data-toggle="table"
               data-search="true"
               data-pagination="true"
               data-page-size="4"
               data-pagination-pre-text="Précédent"
               data-pagination-next-text="Suivant"
               data-pagination-detail="false"
               data-pagination-parts="pageList"
               data-search-selector="#customSearch"
        >
            <thead>
            <th data-field="position" data-sortable="true" data-width="20">Pos</th>
            <th>Nom de faction</th>
            <th>Nombres de points</th>
            </thead>
            <tbody>
            @foreach($factionList as $faction)
                <tr>
                    <td>{{$loop->index +1}}</td>
                    @foreach(array_keys(get_object_vars($faction)) as $param)
                        @if($param != 'id')
                            @if($param != 'created_at')
                                @if($param != 'updated_at')
                                    <td>{{ $faction->$param }}</td>
                                @endif
                            @endif
                        @endif


                    @endforeach
                </tr>
            @endforeach
            <tr class="no-data">
                <td colspan="3" >in table</td>
            </tr>
            </tbody>
        </table>

        <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.js"></script>

    @endif
@endsection
