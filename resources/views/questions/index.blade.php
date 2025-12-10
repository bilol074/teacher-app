@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Questions</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('questions.create') }}" class="btn btn-primary mb-3">+ Add question</a>

    <div class="row">
        @foreach($questions as $question)
            <div class="col-md-3">
                <div class="card text-center mb-4 shadow-sm">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($question->name) }}&background=random&size=200"
                         class="card-img-top rounded-circle mx-auto mt-3"
                         style="width:120px; height:120px; object-fit:cover;"
                         alt="{{ $question->name }}">

                    <div class="card-body">
                        <h5 class="card-title">{{ $question->question }}</h5>

                        <a href="{{ route('questions.show', $question->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('questions.destroy', $question->id) }}" method="POST" style="display:inline;">
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
