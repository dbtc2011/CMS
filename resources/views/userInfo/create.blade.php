@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Upload DBF file</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('userInfo.index') }}"> Back</a>
            </div>
        </div>
    </div>
    

    {!! Form::open(array('route' => 'userInfo.store','method'=>'POST', 'files'=>true)) !!}
         @include('userInfo.form')
    {!! Form::close() !!}

@endsection