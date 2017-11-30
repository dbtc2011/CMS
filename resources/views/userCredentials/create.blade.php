@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Upload CSV file</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('userCredentials.index') }}">Back</a>
            </div>
        </div>
    </div>
    

    {!! Form::open(array('route' => 'userCredentials.store','method'=>'POST', 'files'=>true)) !!}
         @include('userCredentials.form')
    {!! Form::close() !!}

@endsection