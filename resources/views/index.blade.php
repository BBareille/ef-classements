@extends('layouts.app')

@section('title', 'Plugin home')

@section('content')

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
@endsection
