@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 lead">
                            <h2>Verander {{$user->name}}</h2>
                            <hr>
                        </div>
                    </div>
                    <form action="{{ route('admin.edit', ['id'=>$user->id]) }}">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <b><label for="user_last_name">Naam:</label></b>
                                <input type="text" class="form-control" value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <b><label for="user_last_name">E-mail:</label></b>
                                <input type="text" class="form-control" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <b><label for="user_last_name">Telefoonnummer:</label></b>
                                <input type="tel" class="form-control" value="{{ $user->phone_number }}">
                            </div>
                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                data-target="#delete-user-modal">
                                Maak mede-beheerder
                            </button>

                        <a href="{{ route('admin.destroy', ['id'=>$user->id]) }}"><button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#delete-user-modal">
                                Verwijder van toernooi
                            </button></a>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                           <button type="submit" class="btn btn-primary pull-right">Akkoord</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
