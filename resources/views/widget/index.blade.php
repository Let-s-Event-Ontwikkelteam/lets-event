@extends ('layouts.app')

@section ('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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

            <h2 class="text-center">Verander uw widget voorkeur</h2>
            <table class="">
                

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            @php
                                $widgetName = 'Mijn toernooien';
                            @endphp
                            <form action="{{ action('Homecontroller@widgetEdit', $widgetName)}}">
                            <input type="checkbox" aria-label="Checkbox for following text input">
                            </form>
                        </div>
                    </div>
                        <label type="text" class="form-control" >Toernooien waar je aan mee doet</label>
                </div>
            </table>
</div>


@endsection