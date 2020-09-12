<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BookMyGames') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet">
    @yield('styles')

</head>
<body class="h-100">

<div class="container-fluid">
    <div class="row">
        <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
            @include('admin.shared.sidebar')
        </aside>

        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">

            <div class="main-navbar sticky-top bg-white">
                @include('admin.shared.topnav')
            </div>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="fa fa-check mx-2"></i>
                        {{ $error }}
                    </div>
                @endforeach
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="fa fa-check mx-2"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="fa fa-check mx-2"></i>
                    {{ session('error') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="fa fa-check mx-2"></i>
                    {{ session('warning') }}
                </div>
            @endif
            @if (session('message'))
                <div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="fa fa-check mx-2"></i>
                    {{ session('message') }}
                </div>
            @endif



            <div class="main-content-container container-fluid px-4">

                @yield('content')

            </div>


            <footer class="main-footer d-flex p-2 px-3 bg-white border-top">
                @include('admin.shared.footer')
            </footer>

        </main>

    </div>
</div>


<!-- Scripts -->
<script src="{{ asset('js/admin/app.js') }}" ></script>

@yield('scripts')


</body>
</html>
