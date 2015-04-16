<html>
  <head>
    <meta name="viewport" content="width=device-width, user-scalable=no" />
    {{HTML::style('css/bootstrap.min.css')}}
    {{HTML::style('css/styles.css')}}
    {{HTML::style('css/jquery.dynatable.css')}}
    {{HTML::style('plugins/select2/select2.css')}}
    <title>User Panel</title>
  </head>
  <body>
    <header class="navbar navbar-inverse" role="banner">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <nav class="collapse navbar-collapse" role="navigation">
          <ul class="nav navbar-nav" id = 'nav-left'>
          <li class="headerLi home"><a id = 'home'  href = "{{route('dashboard')}}"><img src  = '{{asset("img/logo.jpg")}}'></a></li>
           <li class="headerLi others">
                <a class="dropdown-toggle togMe" data-toggle="dropdown"><span class = 'glyphicon glyphicon-book'></span> News<span id = 'caret' class = 'caret'></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{route('news')}}"><span class = 'glyphicon glyphicon-tasks'></span> News Home</a></li>
                  <li><a href="{{route('group')}}"><span class = 'glyphicon glyphicon-tasks'></span> Group</a></li>
                  <li><a href="{{route('game')}}"><span class = 'glyphicon glyphicon-tasks'></span> Video Game</a></li>
                  <li><a href="{{route('anime')}}"><span class = 'glyphicon glyphicon-tasks'></span> Anime</a></li>
                  <li><a href="{{route('news.create')}}"><span class = 'glyphicon glyphicon-tasks'></span> Add News</a></li>
                </ul>
            </li>
          <li class="headerLi others">
               <a class="dropdown-toggle togMe" data-toggle="dropdown"><span class = 'glyphicon glyphicon-book'></span> How To<span id = 'caret' class = 'caret'></span></a>
               <ul class="dropdown-menu" role="menu">
                 <li><a href="{{route('howto')}}"><span class = 'glyphicon glyphicon-tasks'></span> Learn</a></li>
                 <li><a href="{{route('howto.create')}}"><span class = 'glyphicon glyphicon-tasks'></span> Teach</a></li>
               </ul>
           </li>
           <li class="headerLi others">
                <a class="dropdown-toggle togMe" data-toggle="dropdown"><span class = 'glyphicon glyphicon-book'></span> Files<span id = 'caret' class = 'caret'></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{route('resources')}}"><span class = 'glyphicon glyphicon-tasks'></span> Files</a></li>
                  <li><a href="{{route('resources.new')}}"><span class = 'glyphicon glyphicon-tasks'></span> Upload</a></li>
                </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right" id = 'nav-right'>
            <li class = 'headerLi' id = 'account_dropdown'>
                <a id = 'test' class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->first_name}}<span id = 'caret' class = 'caret'></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{route('account')}}"><span class = 'glyphicon glyphicon-cog'></span> My Account</a></li>
                  <li><a href = "{{route('message.inbox')}}"><span class = 'glyphicon glyphicon-envelope'></span> Messages</a></li>
                  <li><a href="{{action('UserController@logout')}}"><span class = 'glyphicon glyphicon-off'></span> Logout</a></li>
                </ul>
            </li>
          </ul>
        </nav>
    </header>
    <div class="modal"></div>
  {{HTML::script('js/jquery-2.1.1.min.js')}}
  {{HTML::script('js/jquery.dynatable.js')}}
  {{HTML::script('js/bootstrap.min.js')}}
  {{HTML::script('plugins/select2/select2.min.js')}}
  {{HTML::script('js/common.js')}}
    <div class = "settings-wrapper" id = "pad-wrapper">
      @yield('content')
    </div>
  </body>
</html>
