@extends ('layouts.app')

@section ('content')
<div class="container">
    <h1 class="text-center">Toernooi Homepagina</h1>

    @if ($errors->any())
      <div class="errors text-danger text-center">
          @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
          @endforeach
      </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Naam</th>
                <th scope="col">Beschrijving</th>
                <th scope="col">Startdatum</th>
                <th colspan="3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($tournaments as $tournament)
            <tr>
                <th scope="row">{{ $tournament->id }}</th>
                <td><a href="tournament/{{ $tournament->id }}">{{ $tournament->name }}</td> </a>
                <td>{{ $tournament->description }}</td>
                <td>{{ $tournament->start_date_time }}</td>
                <td>
                    <form method="POST" action="{{ action('TournamentController@destroy', $tournament->id) }}">
                        <input type="hidden" name="_method" value="delete"  />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" value="delete" class="blueTransparentButton">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
                <td><a href="tournament/{{ $tournament->id }}/edit"><i class="far fa-edit"></i></a></td>
                <td>
                    <form method="GET" action="{{ action('TournamentUserRoleController@joinParticipant', $tournament->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        {{-- TODO: Check inbouwen om te zien of de gebruiker al deelneemt aan het toernooi. --}}
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
