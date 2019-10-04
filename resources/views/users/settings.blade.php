@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success">
                <a href="{{ route('user.index')}}" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('status') }}
                </div>
            @endif
 
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <a href="{{ route('user.index')}}" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ $error }}
                    @endforeach
                </div>
            @endif
                <h3>Account instellingen</h3>
                    <form method="POST" action="{{ route('user.update') }}">
                        {{ csrf_field() }}
                           <div class="form-group">
                                <label><strong>Naam</strong></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                            </div>

                            <div class="form-group">
                                <label><strong>E-mail</strong></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                            </div>

                            <div class="form-group">
                                <label><strong>Telefoonnummer</strong></label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number"value="{{ $user->phone_number }}">
                            </div>
                        <button type="submit" class="btn btn-primary float-right">Opslaan</button>
                    </form>
                </div>
            </div>
@endsection
