@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center font-weight-bold">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">
                            <h2 class="text-center"><u>Uw toernooien waaraan u deelneemt</u>:</h2>
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <table class="table">
                                        <thead class="thead-light">
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
                                                <td class="text-danger"><a href="" class="btn btn-danger">Verlaten</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                        </div
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
