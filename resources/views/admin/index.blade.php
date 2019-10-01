@extends('layouts.app')

@section('content')
@if(session()->has('message'))
    <div class=" container alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
<div class="container">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css"
        integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous">

        <table class="table ">
            <h1 class="text-center">Beheerder van het Tournament</h1>
            <tr>
                <th class="col">Naam</th>
                <th class="col">E-mail</th>
                <th class="col">Nummer</th>
                <th class="col">Instellingen</th>
            </tr>
            <h4>Lijst van spelers in het toernooi:</h4>
            <!-- hier komt een lijst met alle spelers -->
            {{-- gebruik de tournament_user_roles tabel om te kijken of de gebruiker in dit toernooi zit --}}
            @foreach ($users as $user)
                @foreach ($tournamentParticipant as $tournamentP)
                    @if ($user->id == $tournamentP->user_id)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td><a href="{{ $tournament_id }}/show/{{ $user->id }}"><i class="fas fa-cog"></i></a></td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        </table>
</div>

@endsection
