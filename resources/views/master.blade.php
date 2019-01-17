<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield("title")
    </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/filter.js')}}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <style>
        main {
            margin-top: 80px;
        }
    </style>
    @stack("css")

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container">
        <a href="/" class="navbar-brand" href="#">CSKU GRADER</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="/scoreboard">Scoreboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/problems">Problems</a>
            </li>
          </ul>
          @if(Auth::check())
          <form action="/logout" method="POST" style="margin: 0px">
            @csrf
            <button class="btn btn-danger" value="submit">SIGN OUT</button>
          </form>
          @else
          <a href="/login" class="btn btn-success">SIGN IN</a>
          @endif
        </div>
      </div>
    </nav>
    <main class="container-fluid">
      <div class="container">
        <h3 class="display-4">@yield("title")</h3>
        <hr>
        <div class="container">
        @yield("content")
        </div>
      </div>
    </main>

    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack("js")

</body>


</html>
