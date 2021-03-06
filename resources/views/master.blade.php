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
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <style>
        main {
            margin-top: 30px;
        }
        .col-5.title-button {
          display: flex;
          justify-content: flex-end;
          align-items: center;
        }
        .btn {
          border-radius: 5px;
        }
        .btn.reg {
          color: red;
        }
        .navbar.navbar-expand-lg {
          background-color: #20c997 !important;
          box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }
        .nav-link,
        .navbar-brand {
          color: white;
          font-size:1.15vw;
        }
        .nav-link:hover,
        .navbar-brand:hover {
          color: rgb(241, 241, 241);
        }
        .nav-btn {
          font-size: 1vw;
          padding: 8px 10px;
        }
        .nav-btn.sign-in {
          margin-left: 10px;
        }
    </style>
    @stack("css")

</head>
<body>
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a href="/" class="navbar-brand" style="font-size:1.75vw">CSKU GRADER</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"><i class="fas fa-bars text-white"></i></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor03">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="/problems">Problems</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/scoreboard">Scoreboard</a>
            </li>
            @if (Auth::check())
            <li class="nav-item">
              <a class="nav-link" href="/submissions">Submissions</a>
            </li>
            @endif
            @if (Auth::check() and Auth::user()->type == "admin")
            <li class="nav-item">
              <a class="nav-link" href="/users">Users</a>
            </li>
            @endif
          </ul>
          @if(Auth::check())
          <a class="btn btn-primary nav-btn" href="/profile" style="margin-right: 10px">Profile</a>
          <form action="/logout" method="POST" style="margin: 0px">
            @csrf
            <button class="btn btn-danger nav-btn" value="submit">SIGN OUT</button>
          </form>
          @else
          <a href="/login" class="btn btn-primary nav-btn sign-in">Sign In</a>
          @endif
        </div>
      </div>
    </nav>
    <main class="container-fluid">
      <div class="container">
        <div class="row">
          <div class="col-7">
            <h3 class="display-4">@yield("title")</h3>
          </div>
          <div class="col-5 title-button">
            @yield("title-button")
          </div>
        </div>
        <hr>
        <div class="container">
        @yield("content")
        </div>
      </div>
    </main>
    <div  id="app"></div>

    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack("js")

</body>


</html>
