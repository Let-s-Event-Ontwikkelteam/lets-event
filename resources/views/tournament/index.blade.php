@extends ('layouts.app')

@section ('content')

@if(session()->has('message'))
<div class="container alert alert-success">
    <b class="text-white">{{ session()->get('message') }}</b>
</div>
@endif

@if($errors->any())
<div class=" container alert alert-danger">
    @foreach ($errors->all() as $error)
    <b class="text-white">{{ $error }}</b>
    @endforeach
</div>
@endif

<div class="container">
    <h1 class="text-center">Toernooien</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Naam</th>
                <th scope="col">Beschrijving</th>
                <th scope="col">Startdatum</th>
                <th colspan="4"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($tournaments as $tournament)
            <tr>
                <th scope="row">{{ $tournament->id }}</th>
                <td><a href="tournament/{{ $tournament->id }}">{{ $tournament->name }}</td> </a>
                <td>{{ $tournament->description }}</td>
                <td>{{ $tournament->start_date_time }}</td>

                <td><a href="tournament/{{ $tournament->id }}/destroy"> <i class="far fa-trash-alt"></i></a></td>
                <td><a href="tournament/{{ $tournament->id }}/edit"><i class="far fa-edit"></i></a></td>
                <td><a href="admin/{{ $tournament->id }}"><i class="fas fa-cogs"></i></a></td>
                <td>
                    <form method="GET" action="{{ action('TournamentUserRoleController@joinParticipant', $tournament->id) }}">
                        <button type="submit" class="btn btn-success">Meedoen</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="/tournament/create" class="btn btn-primary">Nieuw toernooi</a>

</div>
@endsection