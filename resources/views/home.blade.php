@extends('layouts.app')

@section('content')
@if(session()->has('message'))
    <div class="container alert alert-danger">
        <b class="text-white">{{ session()->get('message') }}</b>
    </div>
@endif
<div class="container">
    <h1 class="text-center font-weight-bolder mb-4">Dashboard</h1>
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <h4 class="card-header"><b>Toernooien</b></h4>
                <div class="card-body">
                    <table class="table table-borderless table-striped">
                        <tbody>
                        @foreach($tournaments as $tournament)
                            <tr>
                                <th>{{ $tournament->name }}</th>
                                <td class="text-danger float-right">
                                    <a href="{{ route('tournament.leave', [
                                        'tournamentId' => $tournament->id,
                                        'tournamentStartDateTime' => $tournament->start_date_time
                                    ]) }}" class="btn-link text-danger">Verlaat toernooi</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a href="{{ url('tournament')}}" class="btn btn-primary">Ga naar toernooien</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <h5 class="card-header"><b>Account-instellingen</b></h5>
                <div class="card-body">
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet iusto enim est sa</p>
                    <a href="{{ route('user.index', ['id' => auth()->user()->id]) }}" class="btn btn-primary">Ga naar account-instellingen</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
