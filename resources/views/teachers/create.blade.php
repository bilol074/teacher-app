@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4">Add New Teacher</h3>

                    <form action="{{ route('teachers.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Teacher Name</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter teacher name"
                                value="{{ old('name') }}"
                            >
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-save me-1"></i> Save Teacher
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
