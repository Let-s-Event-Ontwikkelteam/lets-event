@extends ('layouts.app')

@section ('content')

<div class="container">
    <h1 class="text-center"> dit is de show page </h1>

    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Naam</th>
                <th scope="col">Beschrijving</th>
                <th scope="col">Startdatum</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $tournament->id }}</td>
                <td>{{ $tournament->name }}</td>
                <td>{{ $tournament->description }}</td>
                <td>{{ $tournament->start_date_time}}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
