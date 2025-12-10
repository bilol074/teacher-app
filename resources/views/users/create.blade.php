@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4">Add New user</h3>

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">user Name</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter usser name"
                                value="{{ old('name') }}"
                            >
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="email" class="form-label">user email</label>
                            <input
                                type="text"
                                id="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Enter user email"
                                value="{{ old('email') }}"
                            >
                            <label for="password" class="form-label">user password</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Enter user password"
                                value="{{ old('password') }}"
                            >
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-save me-1"></i> Save user
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
