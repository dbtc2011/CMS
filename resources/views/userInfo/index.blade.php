@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 5.5 CRUD Example from scratch</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('userInfo.create') }}"> Create New Profile</a>
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
            <th>NO</th>
            <th>MEM_CODE</th>
            <th>ACC_CODE</th>
            <th>CREDIT</th>
            <th>DEBIT</th>
            <th>CHK_NO</th>
            <th>DOC_DATE</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($userInfo as $article)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $article->mem_code}}</td>
        <td>{{ $article->acc_code}}</td>
        <td>{{ $article->credit}}</td>
        <td>{{ $article->debit}}</td>
        <td>{{ $article->chk_no}}</td>
        <td>{{ $article->doc_date}}</td>
        <td>
            <a class="btn btn-info" href="{{ route('userInfo.show',$article->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('userInfo.edit',$article->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['userInfo.destroy', $article->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>

    {!! $userInfo->links() !!}
@endsection