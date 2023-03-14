<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - SiteName</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>
<body>
<div class="container-fluid bg-danger">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('site.index')}}">DCrypto</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav navbar-link">
                    @if(auth()->check())
                    <li class="nav-item">
                    <a class="nav-link" href="{{route('symbol.add')}}">Token</a>
                    </li>
                    @endif
                    <li class="nav-item">
                    <a class="nav-link" href="#">Premium</a>
                    </li>
                </ul>
                <div class="w-100">
                    <ul class="navbar-nav navbar-link float-lg-end">
                        @if(!auth()->check())
                        <li class="nav-item">
                        <a class="nav-link" href="{{route('login.create')}}">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('login')}}">Login</a>
                        </li>
                        @endif
                        @if(auth()->check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('login.logout')}}">Logout</a>
                        </li>
                        @endif
                    </ul>
                </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<div class="container-fluid">
@yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

@yield('script')

</body>
</html>
