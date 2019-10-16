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
                <th scope="col">Naam</th>
                <th scope="col">Beschrijving</th>
                <th scope="col">Startdatum</th>
                <th colspan="4"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($tournaments as $tournament)
                <tr>
                    <td>
                        <a href="{{ route('tournament.show', $tournament->id) }}">{{ $tournament->name }}</a>
                    </td>
                    <td>{{ $tournament->description }}</td>
                    <td>{{ $tournament->start_date_time }}</td>
                    <td>
                        <form action="{{ action('TournamentController@destroy', $tournament->id) }}" method="POST">
                            @method('DELETE')
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="far fa-trash-alt btn-link btn"></button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('tournament.edit', $tournament->id) }}"><i class="far fa-edit"></i></a>
                    </td>
                    <td>
                        <a href="{{ route('tournament.admin.show', $tournament->id) }}"><i class="fas fa-cogs"></i></a>
                    </td>
                    <td>
                        <a href="{{ route('tournament.join', $tournament->id) }}">Meedoen</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <a href="/tournament/create" class="btn btn-primary">Nieuw toernooi</a>

    </div>
@endsection
