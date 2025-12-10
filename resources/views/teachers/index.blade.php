@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Teachers</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('teachers.create') }}" class="btn btn-primary mb-3">+ Add Teacher</a>

    <div class="row">
        @foreach($teachers as $teacher)
            <div class="col-md-3">
                <div class="card text-center mb-4 shadow-sm">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($teacher->name) }}&background=random&size=200"
                         class="card-img-top rounded-circle mx-auto mt-3"
                         style="width:120px; height:120px; object-fit:cover;"
                         alt="{{ $teacher->name }}">

                    <div class="card-body">
                        <h5 class="card-title">{{ $teacher->name }}</h5>

                        <a href="{{ route('teachers.show', $teacher->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
