@extends ('layouts.app')

@section ('content')

<div class="container">
    <h1 class="text-center"> dit is de edit page </h1>
        <form method="POST" action="{{ action(TournamentController::class . '@update', $tournament) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="form-group">
            <label for="name">Naam</label>
            <input type="name" class="form-control" id="name" name="name" value="{{ $tournament->name }}">
        </div>

        <div class="form-group">
            <label for="description">Beschrijving</label>
            <input type="description" class="form-control" id="description" name="description" value=" {{ $tournament->description }}">
        </div>

        <div class="form-group">
            <label for="start-date-time">Start datum en tijd</label>
            <input class="form-control" type="datetime-local" id="start-date-time" name="start-date-time" value=" {{ $tournament->start_date_time }}"> 
        </div>

        <button type="submit" class="button btn-primary">Edit toernooi</button>
</div>
@endsection
