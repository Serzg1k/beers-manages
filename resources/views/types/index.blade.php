@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>CRUD Type</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('types.create') }}"> Create New Type</a>
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
        @foreach ($types as $type)
            <tr>
                <td>{{ $type->name }}</td>
                <td>
                    <form action="{{ route('beers.destroy',$type->id) }}" method="POST">

                        <a class="btn btn-primary" href="{{ route('types.edit',$type->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


@endsection
