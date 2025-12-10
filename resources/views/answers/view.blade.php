@extends('layouts.app')
@section('title', 'All Student Answers')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">📚 All Students’ Answers</h2>

        {{-- Lesson tanlash --}}
        <form action="{{ route('answers.view') }}" method="GET" class="mb-4">
            <div class="row align-items-end">

                {{-- Lesson tanlash --}}
                <div class="col-md-4">
                    <label for="lesson" class="form-label">Lesson</label>
                    <select name="lesson_id" id="lesson" class="form-select" onchange="this.form.submit()">
                        <option value="">Tanlang</option>
                        @foreach ($lessons as $lesson)
                            <option value="{{ $lesson->id }}" {{ $selectedLesson == $lesson->id ? 'selected' : '' }}>
                                {{ $lesson->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Question tanlash --}}
                @if($allQuestions->isNotEmpty())
                    <div class="col-md-4">
                        <label for="question" class="form-label">Question</label>
                        <select name="question_id" id="question" class="form-select" onchange="this.form.submit()">
                            <option value="">Tanlang</option>
                            @foreach ($allQuestions as $question)
                                <option value="{{ $question->id }}" {{ $selectedQuestion == $question->id ? 'selected' : '' }}>
                                    {{ $question->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                {{-- Student tanlash --}}@if($users->isNotEmpty())
                    <div class="col-md-4">
                        <label for="user" class="form-label">User</label>
                        <select name="user_id" id="user" class="form-select" onchange="this.form.submit()">
                            <option value="" {{ !isset($selectedUser) ? 'selected' : '' }}>Tanlang</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ (isset($selectedUser) && $selectedUser == $user->id) ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif


                {{-- Submit button --}}
                <div class="col-md-2 mt-3">
                    <button type="submit" class="btn btn-secondary w-100">Load</button>
                </div>
            </div>
        </form>


        {{-- Javoblar jadvali --}}
        @if ($selectedLesson)
            @if($answers->count() > 0)
                <table class="table table-bordered table-hover align-middle shadow-sm">
                    <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Question Item</th>
                        <th>Answer</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $row = 1; @endphp
                    @foreach($answers as $answer)
                            <tr>
                                <td>{{ $row++ }}</td>
                                <td>{{ optional($answer->user)->name ?? 'Nomaʼlum' }}</td>
                                <td>
                                    {{ $answer->questionItem->question_text }}
                                    @if(!empty($answer->questionItem->image))
                                        <br>
                                        <img src="{{ asset('storage/' . $answer->questionItem->image) }}"
                                             class="img-thumbnail mt-1"
                                             style="max-width: 120px; cursor: pointer;"
                                             data-bs-toggle="modal"
                                             data-bs-target="#imageZoomModal"
                                             onclick="showFullImage(this.src)">
                                    @endif
                                </td>
                                <td>{{ $answer->answers }}</td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-secondary">Bu dars uchun hali javoblar yo‘q.</div>
            @endif
        @else
            <div class="alert alert-info mt-4">Iltimos, yuqoridan fan tanlang.</div>
    @endif

@endsection
