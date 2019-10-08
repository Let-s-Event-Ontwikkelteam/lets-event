@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                @if(session()->has('message'))
                    <div class="container alert alert-success">
                        <b>{{ session()->get('message') }}</b>
                    </div>
                @endif

                @if($errors->any())
                    <div class=" container alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <b>{{ $error }}</b>
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
