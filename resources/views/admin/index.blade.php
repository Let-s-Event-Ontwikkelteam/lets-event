@extends('layouts.app')

@section('content')

<body>
<table>
    <h1>Admin of tournament</h1>
    <tr>
        <th>Name</th>
        <th>E-mail</th>
        <th>Placement</th>
        <th>Settings</th>
    </tr>
    <h4>List of players in the tournament:</h4>
    <!-- hier komt een lijst met alle spelers -->
    <tr>
        <td>Mats</td>
        <td>Matsverlinden@live.nl</td>
        <td>1st</td>
        <td><i class="fas fa-cog"></i></td>

    </tr>
</table>
</body>

@endsection