@extends('admin.layouts.admin')

@section('title', 'Paramètres du classement des factions')

@section('content')
    @if($factionList)
        <table class="table table-bordered">
            <thead>
                <th>Pos</th>
                <th>name</th>
                <th>Id du classement</th>
                <th>totem</th>
                <th>koth</th>
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
{{--                    <td>{{dd($faction)}}</td>--}}
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
