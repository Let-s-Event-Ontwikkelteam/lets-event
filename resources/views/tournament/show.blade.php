@extends ('layouts.app')

@section ('content')

<div class="container">
    <h1 class="text-left">Toernooi</h1>
    <h2 class="text-left font-italic">{{ $tournament->name }}</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Naam</th>
                <th scope="col">Beschrijving</th>
                <th scope="col">Startdatum</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $tournament->name }}</td>
                <td>{{ $tournament->description }}</td>
                <td>{{ $tournament->start_date_time}}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
