<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <button class="dark-mode-toggle">Dark Mode</button>
    <section id="card">
        <div id="card-content">
            <header id="card-title">
                <h2>Register</h2>
                <div class="underline-title"></div>
            </header>
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
            <form method="post" class="form" action="{{ route('store') }}">
                @csrf
                <label for="user-email">Email</label>
                <input id="user-email" class="form-content" type="email" name="email" value="{{ old('email') }}" autocomplete="on" required />
                <label for="user-name">Name</label>
                <input id="user-name" class="form-content" type="text" name="name" value="{{ old('name') }}" required />

                <label for="user-password">Password</label>
                <input id="user-password" class="form-content" type="password" name="password" required />


                <input id="submit-btn" type="submit" value="Register" />

                <a href="{{ route('login') }}" id="signup">Already have an account?</a>
            </form>

        </div>
    </section>
    <script src="/js/dark-mode.js"></script>
</body>

</html>