@extends('admin.layouts.admin')

@section('title', 'Paramètres du classement des factions')

@section('content')
    <div>Liste des classements</div>
    <a href="ef-classements/newRanking" class="btn btn-primary">Ajouter un nouveau classement</a>
    <table>
        @foreach($rankingList as $ranking)
            <tr>
                <td>{{$ranking->name}}</td>
                <td><button class="btn btn-secondary">Modifier</button></td>
                <td>
                    <form method="POST" action="{{action('Azuriom\Plugin\EfClassements\Controllers\Admin\AdminController@destroyRanking')}}">
                        @csrf
                        @method("DELETE")
                        <input type="hidden" name="id" value="{{$ranking->id}}"/>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


@endsection
