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
                        <option
                            @if(Request::get('filter'))
                                @if(Request::get('filter')['make_id'] == $make->id)
                                    selected
                                @endif
                            @endif
                            value="{{ $make->id }}">{{ $make->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <select name="filter[type_id]" id="inputState" class="form-control">
                    <option value="">Choose...</option>
                    @foreach ($types as $type)
                        <option
                            @if(Request::get('filter'))
                                @if(Request::get('filter')['type_id'] == $type->id)
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
            <th>Type</th>
            <th>Maker</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($beers as $beer)
            <tr>
                <td>{{ $beer->name }}</td>
                @if($beer->type !== null)
                    <td>{{ $beer->type->name }}
                @else
                    <td>empty</td>
                @endif
                @if($beer->make !== null)
                    <td>{{ $beer->make->name }}</td>
                @else
                    <td>empty</td>
                @endif
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
