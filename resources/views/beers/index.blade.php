@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>CRUD Beer</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('beers.create') }}"> Create New Beer</a>
            </div>
        </div>
    </div>
    <form>
        <div class="form-row">
            <div class="form-group col-md-4">
                <select name="filter[make_id]" id="inputState" class="form-control">
                    <option value="">Choose...</option>
                    @foreach ($makes as $make)
                        <option value="{{ $make->id }}">{{ $make->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <select name="filter[type_id]" id="inputState" class="form-control">
                    <option value="">Choose...</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
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
            <th>Type</th>
            <th>Maker</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($beers as $beer)
            <tr>
                <td>{{ $beer->name }}</td>
                <td>{{ $beer->type->name }}</td>
                <td>{{ $beer->make->name }}</td>
                <td>{{ $beer->description }}</td>
                <td>
                    <form action="{{ route('beers.destroy',$beer->id) }}" method="POST">

                        <a class="btn btn-primary" href="{{ route('beers.edit',$beer->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>


@endsection
