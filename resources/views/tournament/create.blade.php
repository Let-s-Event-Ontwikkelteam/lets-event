@extends ('layouts.app')

@section ('content')

<h1 class="text-center">Vul het formulier in om een toernooi aan te maken</h1>

<div class="container">
    <form method="post" action="{{ action('TournamentController@store') }}">
        <input name="_token" type="hidden" value="{{ csrf_token() }}" />
        <div class="form-group">
            <label for="name">Naam</label>
            <input type="name" class="form-control" id="name" name="name" placeholder="Vul hier een naam in">
        </div>

        <div class="form-group">
            <label for="description">Beschrijving</label>
            <input type="description" class="form-control" id="description" name="description"
                placeholder="Vul hier een beschrijving in">
        </div>

        <div class="form-group">
            <label for="start-date-time">Start datum en tijd</label>
            <input class="form-control" type="datetime-local" id="start-date-time" name="start-date-time">
        </div>

        <button type="submit" class="button btn-primary">Maak toernooi</button>
</div>

@endsection