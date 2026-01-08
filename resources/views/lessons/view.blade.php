@extends('layouts.app')

@section('title', 'Lessons Information')

@section('content')
    <div class="container">
        <h1 class="mb-4">Lessons</h1>

        @if($lessons->count())
            <ul class="list-group">
                @foreach($lessons as $lesson)
                    <li class="list-group-item">
                        {{ $lesson->name }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>No lessons found.</p>
        @endif
    </div>
@endsection
