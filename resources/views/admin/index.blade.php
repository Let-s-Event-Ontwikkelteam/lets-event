@extends('layouts.app')

@section('content')
@if(session()->has('message'))
    <div class=" container alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
    <div class="container">
        <table class="table ">
            <h1 class="text-center">Lijst van spelers die deelnemen aan het toernooi:</h1>
            <tr>
                <th class="col">Naam</th>
                <th class="col">E-mail</th>
                <th class="col">Telefoonummer</th>
                <th class="col">Instellingen</th>
            </tr>
            <!--
             hier komt een lijst met alle spelers 
            gebruik de tournament_user_roles tabel om te kijken of de gebruiker in dit toernooi zit 
            -->
            @foreach ($users as $user)
                @foreach ($tournamentParticipant as $tournamentP)
                    @if ($user->id == $tournamentP->user_id)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td class="text-center"><a href="{{ $tournament_id }}/show/{{ $user->id }}"><i class="fas fa-cog"></i></a></td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        </table>
    <a href="{{ url('tournament') }}" class="btn btn-primary">Terug naar toernooien</a>
    </div>

@endsection
