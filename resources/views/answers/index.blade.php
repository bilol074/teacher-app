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
            Javoblarni saqlashda xatolik yuz berdi. Iltimos barcha maydonlarni to'ldiring.
        </div>
    @endif

    <div class="container mt-5">
        <h2 class="mb-4">✏️ Student Answers</h2>

        {{-- === 1. FAN (LESSON) TANLASH === --}}
        <form action="{{ route('set-answer') }}" method="GET" class="mb-4">
            <div class="row align-items-end">
                <div class="col-md-5">
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

                <div class="col-md-5">
                    <label for="type" class="form-label">Question Type</label>
                    <select name="type" id="type" class="form-select"  onchange="this.form.submit()">
                        <option value=""> Select Type </option>
                        <option value="daily" {{ $selectedType == 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="mock" {{ $selectedType == 'mock' ? 'selected' : '' }}>Mock</option>
                    </select>
                </div>

            @if($allQuestions)
                    <div class="col-md-5">
                        <label for="question" class="form-label">Question</label>
                        <select name="question_id" id="question" class="form-select"  onchange="this.form.submit()">
                            <option value="">Tanlang</option>
                            @foreach ($allQuestions as $question)
                                <option value="{{ $question->id }}" {{$selectedQuestion == $question->id ? 'selected' : ''}}>
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

        <div class="container">
            @if ($selectedLesson)
                {{-- Savollar mavjud bo'lsa ko'rsatish --}}
                @if ($questions->isNotEmpty())
                    <h3 class="mt-4">Tanlangan dars savollari</h3>

                    <form action="{{ route('store-answers') }}" method="POST" class="mb-5">
                        @csrf
                        <input type="hidden" name="question_id" value="{{ $selectedQuestion }}">

                        @foreach ($questions as $question)
                            @foreach ($question->items as $item)
                                <div class="mb-4 p-3 border rounded shadow-sm">
                                    <label for="answer-{{ $item->id }}" class="form-label d-block">
                                        <strong>{{ $loop->iteration }}. Savol: </strong>
                                        {{ $item->question_text }}
                                    </label>

                                    {{-- --- RASM QISMI BOSHLANDI --- --}}
                                    @if (!empty($item->image))
                                        <div class="my-3">
                                            <img src="{{ asset('storage/' . $item->image) }}"
                                                 alt="Savol rasmi"
                                                 class="img-fluid rounded border shadow-sm"
                                                 style="max-height: 200px; object-fit: contain; cursor: pointer;"
                                                 data-bs-toggle="modal"
                                                 data-bs-target="#imageZoomModal"
                                                 onclick="showFullImage(this.src)">
                                            <div class="text-muted small mt-1">
                                                <i class="fas fa-search-plus"></i> Kattalashtirish uchun rasm ustiga bosing
                                            </div>
                                        </div>
                                    @endif
                                    {{-- --- RASM QISMI TUGADI --- --}}

                                    <input type="text" name="answers[{{ $item->id }}]" id="answer-{{ $item->id }}" class="form-control" placeholder="Javobingizni yozing...">
                                </div>
                            @endforeach
                        @endforeach

                        <button type="submit" class="btn btn-primary w-100 mt-3 py-2">Javoblarni Saqlash</button>
                    </form>

                @else
                    <div class="alert alert-info mt-4">Bu dars uchun savollar topilmadi.</div>
                @endif
            @else
                <div class="alert alert-info mt-4">Iltimos, yuqoridan fan tanlang.</div>
            @endif
        </div>
        {{-- KATTALASHTIRISH UCHUN MODAL (Oyna) --}}
        <div class="modal fade" id="imageZoomModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg"> <div class="modal-content">
                    <div class="modal-body p-0 position-relative">
                        {{-- Yopish tugmasi --}}
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 bg-white p-2" data-bs-dismiss="modal" aria-label="Close" style="z-index: 10;"></button>

                        {{-- Katta rasm chiqadigan joy --}}
                        <img id="zoomedImage" src="" class="w-100 h-auto" alt="Katta rasm">
                    </div>
                </div>
            </div>
        </div>

        {{-- SCRIPT --}}
        <script>
            function showFullImage(src) {
                // Kichik rasm manzilini (src) olib, Modal ichidagi rasmga qo'yamiz
                document.getElementById('zoomedImage').src = src;
            }
        </script>
@endsection
