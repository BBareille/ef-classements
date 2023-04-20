@extends('admin.layouts.admin')

@section('title', 'Paramètres du classement des factions')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('rank-faction.admin.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <label>Nom de faction</label>
                <input type="text" name="name" value=""/>
                <label>Nombre de points</label>
                <input type="number" name="points" value=""/>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>

    @if($factionList)
        <table class="table table-bordered">
            <thead>
                <th>Pos</th>
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
                    <td><form action="{{route('rank-faction.admin.destroy', ['id'=> $faction->id ])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Supprimer</button>
                        </form></td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endif
@endsection
