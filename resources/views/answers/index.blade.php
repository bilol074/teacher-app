@extends('layouts.app')
@section('title', 'Student Answers')

@section('content')
    {{-- Muvaqqiyat xabari --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Validatsiya xatolari --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container mt-5">
        <h2 class="mb-4">✏️ Student Answers</h2>

        {{-- === 1. FAN VA TUR TANLASH === --}}
        <form action="{{ route('set-answer') }}" method="GET" class="mb-4">
            <div class="row align-items-end">
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

                <div class="col-md-3">
                    <label for="type" class="form-label">Question Type</label>
                    <select name="type" id="type" class="form-select" onchange="this.form.submit()">
                        <option value=""> Select Type </option>
                        <option value="daily" {{ $selectedType == 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="mock" {{ $selectedType == 'mock' ? 'selected' : '' }}>Mock</option>
                    </select>
                </div>

                @if($allQuestions->isNotEmpty())
                    <div class="col-md-3">
                        <label for="question" class="form-label">Question Set</label>
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

                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100">Load</button>
                </div>
            </div>
        </form>

        {{-- === 2. TAYMER (FAQAT MOCK UCHUN) === --}}
        @if($selectedType === 'mock' && !$alreadySubmitted && $questions->isNotEmpty() && $durationSeconds > 0)
            <div class="alert alert-danger text-center sticky-top shadow-sm py-3 mb-4" style="z-index: 1020; top: 10px; border-radius: 15px;">
                <h4 class="mb-0">⏳ Qolgan vaqt: <span id="timer" class="fw-bold">--:--</span></h4>
            </div>
        @endif

        <div class="container">
            @if ($questions->isNotEmpty())
                <h3 class="mt-4 mb-3">📝 Test savollari</h3>

                @if($selectedType === 'mock' && $alreadySubmitted)
                    {{-- Mock test topshirilgan bo'lsa --}}
                    <div class="alert alert-warning shadow-sm border-warning">
                        <h4 class="alert-heading">⚠️ Test topshirilgan!</h4>
                        <p>Siz ushbu Mock testni allaqachon topshirgansiz. Mock testlarni faqat bir marta ishlash mumkin.</p>
                    </div>
                @else
                    {{-- Test shakli --}}
                    <form action="{{ route('store-answers') }}" method="POST" id="quiz-form" class="mb-5">
                        @csrf
                        <input type="hidden" name="question_id" value="{{ $selectedQuestion }}">
                        <input type="hidden" name="type" value="{{ $selectedType }}">
                        <input type="hidden" name="lesson_id" value="{{ $selectedLesson }}">

                        @foreach ($questions as $question)
                            @foreach ($question->items as $item)
                                <div class="mb-4 p-4 border rounded shadow-sm bg-white">
                                    <label class="form-label d-block fs-5">
                                        <strong>{{ $loop->iteration }}. </strong>
                                        {{ $item->question_text }}
                                    </label>

                                    @if (!empty($item->image))
                                        <div class="my-3">
                                            <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid rounded border" style="max-height: 250px;">
                                        </div>
                                    @endif

                                    <textarea name="answers[{{ $item->id }}]" id="answer-{{ $item->id }}"
                                              class="form-control" rows="2"
                                              placeholder="Javobingizni yozing..." required></textarea>
                                </div>
                            @endforeach
                        @endforeach

                        <button type="submit" id="submit-btn" class="btn btn-primary btn-lg w-100 mt-3 py-3">
                            <i class="fas fa-save me-2"></i> Javoblarni Saqlash
                        </button>
                    </form>
                @endif
            @elseif($selectedLesson)
                <div class="alert alert-info mt-4">Bu dars uchun savollar topilmadi.</div>
            @endif
        </div>
    </div>
@endsection

@dd($question->duration);

