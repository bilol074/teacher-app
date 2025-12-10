<h1>Edit Teacher</h1>

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

<form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
    @csrf
    @method('PUT') {{-- PUT metodini ishlatish uchun --}}
    
    <label for="name">Teacher Name:</label>
    <input type="text" id="name" name="name" value="{{ old('name', $teacher->name) }}" required>

    <button type="submit">Update</button>
</form>

<a href="{{ route('teachers.index') }}">⬅ Back to list</a>
