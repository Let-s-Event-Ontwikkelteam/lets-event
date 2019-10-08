@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center font-weight-bolder mb-4">Dashboard</h1>
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <h5 class="card-header"><b>Opkomende toernooien</b></h5>
                <div class="card-body">
                    <p class="card-text"><b>Hier komen de opkomende toernooien waaraan je deelneemt</b></p>
                    <a href="{{ url('tournament')}}" class="btn btn-primary">Ga naar toernooien</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <h5 class="card-header"><b>Gespeelde toernooien</b></h5>
                <div class="card-body">
                    <p class="card-text"><b>Hier komen de toernooien waaraan je deelgenomen hebt</b></p>
                    <a href="{{ url('tournament')}}" class="btn btn-primary">Ga naar toernooien</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <h5 class="card-header"><b>Account-instellingen</b></h5>
                <div class="card-body">
                    <p class="card-text"><b>Hier komen de opkomende toernooien waaraan je deelneemt</b></p>
                    <a href="{{ route('user.index', ['id' => auth()->user()->id]) }}" class="btn btn-primary">Ga naar account-instellingen</a>
                </div>
            </div>
        <div class="col-sm-12">
            <table class="table">
                <thead class="thead">
                <tr>
                    <th scope="col">Naam</th>
                    <th scope="col">Beschrijving</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($tournaments as $tournament)
                    <tr>
                        <th>{{ $tournament->name }}</th>
                        <td>{{ $tournament->description }}</td>
                        <td class="text-danger float-right"><a href="dashboard/{{ $tournament->id }}/leave" class="btn btn-danger">Verlaten</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
