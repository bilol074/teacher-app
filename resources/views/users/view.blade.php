@extends('layouts.app')

@section('title', 'Users Information')

@section('content')
    <div class="container d-flex justify-content-center mt-5">
        <div class="card shadow" style="width: 26rem;">
            <div class="card-body">

                <h4 class="card-title text-center mb-4">
                    User Information
                </h4>

                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Created at:</strong> {{ $user->created_at }}</p>
                <p><strong>Updated at:</strong> {{ $user->updated_at }}</p>

                {{-- Back button --}}
                <div class="mt-4 text-center">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        ⬅ Back
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection
