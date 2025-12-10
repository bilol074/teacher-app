<h1>Edit Student</h1>

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

<form action="{{ route('students.update', $student->id) }}" method="POST">
    @csrf
    @method('PUT') {{-- PUT metodini ishlatish uchun --}}

    <label for="name">Student Name:</label>
    <input type="text" id="name" name="name" value="{{ old('name', $student->name) }}" required>

    <button type="submit">Update</button>
</form>

<a href="{{ route('students.index') }}">⬅ Back to list</a>
