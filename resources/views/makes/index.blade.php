@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>CRUD Maker</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('makes.create') }}"> Create New Maker</a>
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
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($makes as $make)
            <tr>
                <td>{{ $make->name }}</td>
                <td>
                    <form action="{{ route('makes.destroy',$make->id) }}" method="POST">

                        <a class="btn btn-primary" href="{{ route('makes.edit',$make->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


@endsection
