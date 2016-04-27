<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <title>GeekieID Connect Example - Laravel</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.1.8/semantic.min.css">

  <style type="text/css">
    body {
      background-color: #FFFFFF;
    }
    .ui.menu .item img.logo {
      margin-right: 1.5em;
    }
    .main.container {
      margin-top: 7em;
    }
    .wireframe {
      margin-top: 2em;
    }
    .ui.footer.segment {
      margin: 5em 0em 0em;
      padding: 5em 0em;
    }
  </style>

</head>
<body>

  <div class="ui fixed inverted menu">
    <div class="ui container">
      <a href="#" class="header item">
        GeekieID Connect Example - Laravel
      </a>
    </div>
  </div>

  <div class="ui main text container">

    @yield('content')

    <h1 class="ui header">Source</h1>

    <p>You can find the source for this example at:</p>

    <p>
      <a href="https://github.com/projetoeureka/geekieid-connect-example-laravel">https://github.com/projetoeureka/geekieid-connect-example-laravel</a>
    </p>
  </div>

  <script src="https://cdn.jsdelivr.net/g/jquery@2.2.3,semantic-ui@2.1.8"></script>
</body>
</html>
