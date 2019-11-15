@extends ('layouts.app')

@section ('content')

    @if(session()->has('message'))
        <div class="container alert alert-success">
            <b class="text-white">{{ session()->get('message') }}</b>
        </div>
    @endif

    @if($errors->any())
        <div class=" container alert alert-danger">
            @foreach ($errors->all() as $error)
                <b class="text-white">{{ $error }}</b>
            @endforeach
        </div>
    @endif

    <div class="container">
        <h1 class="text-left">Overzicht van scheidsrechters</h1>