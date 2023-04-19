@extends('admin.layouts.admin')

@section('title', 'Paramètres du classement des factions')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('rank-faction.admin.testpost')}}" method="POST" enctype="multipart/form-data">
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
        <table>
            <thead>
            <th>Pos</th>
            <th>Nom de faction</th>
            <th>Nombres de points</th>
            </thead>
            <tbody>
            @foreach($factionList as $faction)
                <tr>
                    <td>{{$loop->index +1}}</td>
                    <td>{{ $faction->name }}</td>
                    <td>{{ $faction->points }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endif
@endsection
