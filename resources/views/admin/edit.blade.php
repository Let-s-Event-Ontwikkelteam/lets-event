@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-5">Deelneemer: <u><b>{{ $user->name }}</b></u></h2>
    <div class="row">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>   
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <a class="btn btn-success"  href="../../{{ $tournament_id }}/create/{{ $user->id }}">
                Maak {{$user->name}} medebeheerder
            </a>
        </div>
        <div class="col-md-5">
            <a class="btn btn-danger"  href="../../{{ $tournament_id }}/destroy/{{ $user->id }}">
                Verwijder {{$user->name}} van het toernooi
            </a>
        </div>
        <div class="col-md-1"></div>
    </div> 
    <hr>
    <a href="{{ URL::previous() }}" class="btn btn-primary">Terug naar deelnemers</a>
</div>

@endsection