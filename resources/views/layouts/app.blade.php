<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher App</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Custom Styles --}}
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Butun oynani egallaydi */
            background-color: #f8f9fa;
            font-family: "Segoe UI", sans-serif;
            margin: 0;
        }

        main.container {
            flex: 1; /* Bo‘sh joyni egallaydi */
            background: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-top: 30px;
        }

        /* Navbar styling */
        .navbar {
            background: linear-gradient(90deg, #343a40, #212529);
            box-shadow: 0 3px 8px rgba(0,0,0,0.3);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.25rem;
            letter-spacing: 0.5px;
        }

        .nav-link {
            color: #dcdcdc !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #ffffff !important;
            text-decoration: underline;
        }

        .nav-link.active {
            color: #0d6efd !important;
            font-weight: 600;
        }

        /* Footer styling */
        footer {
            padding: 15px 0;
            background-color: #212529;
            color: #ccc;
            text-align: center;
            font-size: 0.9rem;
            margin-top: 50px;
        }

        .btn-logout {
            margin-left: 10px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>


{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">TeacherApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                @role('admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}"
                       href="{{ route('users.index') }}">Users</a>
                </li>
                @endrole
                @hasanyrole('admin|teacher')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('teachers.index') ? 'active' : '' }}"
                       href="{{ route('teachers.index') }}">Teachers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('lessons.index') ? 'active' : '' }}"
                       href="{{ route('lessons.index') }}">Lessons</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('questions.index') ? 'active' : '' }}"
                       href="{{ route('questions.index') }}">Questions</a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link {{ request()->routeIs('students.index') ? 'active' : '' }}"--}}
{{--                       href="{{ route('students.index') }}">Students</a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('answers.view') ? 'active' : '' }}"
                       href="{{ route('answers.view') }}">AnswersView</a>
                </li>
                @endhasanyrole

                @hasanyrole('admin|student')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('set-answer') ? 'active' : '' }}"
                       href="{{ route('set-answer') }}">Answer</a>
                </li>
                @endhasanyrole

                @guest
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm me-2 {{ request()->routeIs('login') ? 'active' : '' }}"
                       href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary btn-sm me-2 {{ request()->routeIs('register.show') ? 'active' : '' }}"
                       href="{{ route('register.show') }}">Register</a>
                </li>
                @endguest

               @auth
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm btn-logout">Logout</button>
                    </form>
                </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

{{-- Main Content --}}
<main class="container">
    @yield('content')
</main>

{{-- Footer --}}
<footer>
    <div class="container">
        &copy; {{ date('Y') }} Teacher App | Made  by Bilol
    </div>
</footer>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleMockFields() {
        const typeSelect = document.getElementById('type');
        const mockFields = document.getElementById('mock_fields');

        if (typeSelect.value === 'mock') {
            mockFields.style.display = 'block';
        } else {
            mockFields.style.display = 'none';
        }
    }
</script>

</body>
</html>
