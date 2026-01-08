@extends('layouts.app')

@section('title', 'Teacher Information')

@section('content')
    <div class="container d-flex justify-content-center mt-5">

        <div class="card shadow" style="width: 28rem;">

            <div class="card-header bg-success text-white text-center">
                <h4 class="mb-0">Teacher Profile</h4>
            </div>

            <div class="card-body">

                <p class="mb-3">
                    <strong>Name:</strong><br>
                    {{ $teacher->name }}
                </p>

                <p class="mb-4">
                    <strong>Created at:</strong><br>
                    {{ $teacher->created_at }}
                </p>

                <p class="mb-4">
                    <strong>Updated at:</strong><br>
                    {{ $teacher->updated_at }}
                </p>

                {{-- Action buttons --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        ⬅ Back
                    </a>

                    <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-primary">
                        ✏ Edit
                    </a>
                </div>

            </div>
        </div>

    </div>
@endsection
