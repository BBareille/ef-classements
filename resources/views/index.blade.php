@extends('layouts.app')

@section('title', 'Plugin home')

@section('content')

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
                </tr>
            @endforeach
            </tbody>
        </table>

    @endif
@endsection
