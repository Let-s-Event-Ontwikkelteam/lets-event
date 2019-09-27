@extends('layouts.app')

@section('content')
<div class="container">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css"
        integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous">

    <body>
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
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number }}</td>
                <td><a href="{{ route('admin.show', ['id'=>$user->id]) }}"><i class="fas fa-cog"></i></a></td>
            </tr>
            @endforeach
        </table>
</div>
</body>

@endsection
