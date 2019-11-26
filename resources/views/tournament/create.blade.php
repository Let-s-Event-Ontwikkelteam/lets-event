@extends ('layouts.app')

@section ('content')

@if($errors->any())
    <div class=" container alert alert-danger">
        @foreach ($errors->all() as $error)
            <b class="text-white">{{ $error }}</b>
        @endforeach
    </div>
@endif

<h1 class="text-center">Vul het formulier in om een toernooi aan te maken</h1>

<div class="container">
    <form method="post" action="{{ action('TournamentController@store') }}">
        <input name="_token" type="hidden" value="{{ csrf_token() }}" />
        <div class="form-group">
            <label for="name">Naam *</label>
            <input type="name" class="form-control" id="name" name="name" placeholder="Vul hier een naam in" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Beschrijving *</label>
            <input type="description" class="form-control" id="description" name="description"
                placeholder="Vul hier een beschrijving in" value="{{ old('description') }}" required>
        </div>

        <div class="form-group">
            <label for="start-date-time">Start datum en tijd *</label>
            <input class="form-control" type="datetime-local" id="start-date-time" max="2100-12-31T00:00" name="start-date-time" {{ old('start-date-time') }} required>
        </div>

        <button type="submit" class="button btn btn-primary">Maak toernooi</button>
</div>

@endsection
