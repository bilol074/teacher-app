@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lessons</h1>

    {{-- Success xabari --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Lesson qo‘shish tugmasi --}}
    <a href="{{ route('lessons.create') }}" class="btn btn-primary mb-3">+ Add Lesson</a>

    {{-- Lessons grid --}}
    <div class="row">
        @foreach($lessons as $lesson)
            <div class="col-md-3">
                <div class="card text-center mb-4 shadow-sm">
                    {{-- Avatar rasmi --}}
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($lesson->name) }}&background=random&size=200"
                         class="card-img-top rounded-circle mx-auto mt-3"
                         style="width:120px; height:120px; object-fit:cover;"
                         alt="{{ $lesson->name }}">

                    <div class="card-body">
                        {{-- Lesson nomi --}}
                        <h5 class="card-title">{{ $lesson->name }}</h5>

                        {{-- Tugmalar --}}
                        <a href="{{ route('lessons.show', $lesson->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('lessons.edit', $lesson->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" style="display:inline;">
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

