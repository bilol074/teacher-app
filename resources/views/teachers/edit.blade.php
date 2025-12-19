@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 flex items-center justify-center">

        <div class="w-full max-w-md bg-white border border-gray-200 rounded-lg shadow-sm p-6">

            {{-- Title --}}
            <h1 class="text-xl font-semibold text-gray-800 mb-5">
                Edit Teacher
            </h1>

            {{-- Errors --}}
            @if ($errors->any())
                <div class="mb-4 text-sm text-red-600">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="mb-4">
                    <label class="block text-sm text-gray-600 mb-1">
                        Teacher name
                    </label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $teacher->name) }}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm
                           focus:outline-none focus:border-indigo-500"
                        required
                    >
                </div>

                {{-- Buttons --}}
                <div class="flex justify-between items-center">
                    <a href="{{ route('teachers.index') }}"
                       class="text-sm text-gray-500 hover:text-gray-700">
                        Back
                    </a>

                    <button
                        type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white
                           text-sm px-4 py-2 rounded-md transition">
                        Update
                    </button>
                </div>

            </form>

        </div>

    </div>
@endsection
