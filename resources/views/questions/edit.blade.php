@extends('layouts.app')

@section('title', 'Edit Question')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Edit Question</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('questions.update', $question->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- 🟢 Question Name, Teacher, Lesson bir qatorda --}}
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="questionName" class="form-label">Question Name</label>
                            <input
                                type="text"
                                name="name"
                                id="questionName"
                                class="form-control"
                                value="{{ old('name', $question->name) }}"
                                required>
                        </div>

                        <div class="col-md-4">
                            <label for="teacher" class="form-label">Select Teacher</label>
                            <select name="teacher_id" id="teacher" class="form-select" required>
                                <option value="">Tanlang</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ $teacher->id == $question->teacher_id ? 'selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="lesson" class="form-label">Select Lesson</label>
                            <select name="lesson_id" id="lesson" class="form-select" required>
                                <option value="">Tanlang</option>
                                @foreach ($lessons as $lesson)
                                    <option value="{{ $lesson->id }}" {{ $lesson->id == $question->lesson_id ? 'selected' : '' }}>
                                        {{ $lesson->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- 🔵 Question Items (Repeater) --}}
                    <div class="mb-4">
                        <label class="form-label">Question Items</label>
                        <div id="question-items">
                            @foreach ($question->items as $item)
                                <div class="input-group mb-2">
                                    <input type="text" name="items[]" value="{{ $item->question_text }}" class="form-control" placeholder="Enter question item" required>
                                    <button type="button" class="btn btn-danger remove-item">X</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-item" class="btn btn-secondary mt-2">+ Add More</button>
                    </div>

                    {{-- 🟢 Submit Button --}}
                    <button type="submit" class="btn btn-warning w-100 py-2">
                        <i class="bi bi-save"></i> Update Question
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- 🔧 Simple Repeater Script --}}
    <script>
        document.getElementById('add-item').addEventListener('click', function() {
            const container = document.getElementById('question-items');
            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');
            div.innerHTML = `
            <input type="text" name="items[]" class="form-control" placeholder="Enter question item" required>
            <button type="button" class="btn btn-danger remove-item">X</button>
        `;
            container.appendChild(div);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-item')) {
                e.target.parentElement.remove();
            }
        });
    </script>
@endsection
