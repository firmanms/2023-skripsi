@extends('layouts.app')

@section('content')
<div class="row">
<div class="col-12 col-sm-6 col-xl-12 mb-12">
    <div class="card shadow border-0 text-center p-0">

            <a class="btn btn-success" href="{{ route('document.create') }}">Upload Document</a><br>

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        <table class="table table-bordered">
    <tr>
        <th>No</th>
        <!--<th>File</th>-->
        <th>Title</th>

        <th width="280px">Action</th>
    </tr>
    @foreach ($documents as $product)
    <tr>
        <td>{{ ++$i }}</td>
        {{-- <td>
            <a href="{{ url('images/' . $product->image) }}"> view </a>
            <img src="{{ url('images/' . $product->image) }}" width="100px">
        </td>--}}
        <td>{{ $product->judul }}</td>

        <td>
            <form action="{{ route('document.destroy',$product->id) }}" method="POST">

                <a class="btn btn-info" href="{{ route('document.show',$product->id) }}">Show</a>

                <a class="btn btn-primary" href="{{ route('document.edit',$product->id) }}">Edit</a>

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $documents->links() !!}
    </div>
</div>
</div>


@endsection
