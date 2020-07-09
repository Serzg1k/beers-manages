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
    <form>
        <div class="form-row">
            <div class="form-group col-md-4">
                <select name="filter[type]" id="inputState" class="form-control">
                    <option value="">Choose...</option>
                    @foreach ($types as $type)
                        <option
                            @if(Request::get('filter'))
                                @if(Request::get('filter')['type'] == $type->id)
                                    selected
                                @endif
                            @endif
                            value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

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
