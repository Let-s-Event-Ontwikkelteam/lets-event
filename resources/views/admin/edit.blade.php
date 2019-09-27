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
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br /> 
                    @endif
                    <div class="row">
                        <div class="col-md-8">
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
                        <a href="{{ route('admin.index')}}" class="btn btn-primary">Terug</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
