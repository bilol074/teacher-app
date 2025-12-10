@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Student Answers</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('student_answers.create') }}" class="btn btn-primary mb-3">+ Add Answer</a>

    <div class="row">
        @foreach($student_answers as $answer)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">
                            Student: {{ $answer->student->name ?? 'Unknown' }}
                        </h5>
                        <p class="card-text">
                            <strong>Answer:</strong> {{ $answer->answer }}
                        </p>
                        <p class="text-muted" style="font-size: 0.9em;">
                            Lesson ID: {{ $answer->lesson_id }}
                        </p>

                        <a href="{{ route('student_answers.show', $answer->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('student_answers.edit', $answer->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('student_answers.destroy', $answer->id) }}" method="POST" style="display:inline;">
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
