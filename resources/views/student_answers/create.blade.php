@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-success text-white text-center rounded-top-4">
            <h4 class="mb-0">Add New Answer</h4>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('students.store') }}" method="POST">
                @csrf

                {{-- Answer Name --}}
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Answer Name</label>
                    <input type="text" name="name" id="name"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Enter answer name" value="{{ old('name') }}">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-check2-circle me-1"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

