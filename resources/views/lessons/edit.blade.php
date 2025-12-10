<h1>Edit Lessons</h1>

{{-- Xatoliklarni chiqarish --}}
@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('lessons.update', $lesson->id) }}" method="POST">
    @csrf
    @method('PUT') {{-- PUT metodini ishlatish uchun --}}

    <label for="name">Lessons Name:</label>
    <input type="text" id="name" name="name" value="{{ old('name', $lesson->name) }}" required>

    <button type="submit">Update</button>
</form>

<a href="{{ route('lessons.index') }}">⬅ Back to list</a>
