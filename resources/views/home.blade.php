@extends('layouts.app')

@section('content')
    
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">
                        <h1 class="text-center font-weight-bolder">Dashboard</h1>
                            <h3 class="text-center"><u>Uw toernooien waaraan u deelneemt</u>:</h3>
                            <div class="row">
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
                                                <td class="text-danger float-right"><a href="" class="btn btn-danger">Verlaten</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
@endsection
