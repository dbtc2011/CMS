@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>User Credentials</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('userCredentials.create') }}">Import</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Member Code</th>
            <th>Name</th>
            <th>Password</th>
            <th width="280px">Action</th>
        </tr>
    @foreach($userCreds as $userCredentials)
    <tr>
        <td>{{$userCredentials->code}}</td>
        <td>{{$userCredentials->name}}</td>
        <td>{{$userCredentials->password}}</td>
        <td>
            <a class="btn btn-primary" href="{{ route('userCredentials.edit',$userCredentials->code) }}">Edit</a>
        </td>
    </tr>
    @endforeach
    </table>

    {!! $userCreds->links() !!}
@endsection