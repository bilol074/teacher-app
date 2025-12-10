<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<form action="{{ route('lessons.store') }}" method="POST" class="w-50 mx-auto mt-5 p-4 border rounded shadow-sm bg-light">
    @csrf
    <div class="mb-3">
        <label for="lessonName" class="form-label">Lesson Name</label>
        <input type="text" name="name" id="lessonName" class="form-control" placeholder="Enter lesson name" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Save</button>
</form>
