@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if (session('status'))
                <div class="alert alert-success">
                <a href="{{ route('user.settings')}}" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header"><h3>Account instellingen</h3></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.post_settings') }}">
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
                        <button type="submit" class="btn btn-primary float-right">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
