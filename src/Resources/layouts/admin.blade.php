<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/backend/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script src="/js/backend/ckeditor/ckeditor.js"></script>
</head>
<body>
  <aside class="menu">
    <ul class="nav" id="navigation">
      <li class="head">
        <img src="/img/administrace.png" alt="Administrace">
      </li>
      @include('backend/components/menu_tree', ['childs' => App\Models\Admin\AdminSection::where('active', 1)->whereNull('system_path')->get()])
    </ul>
  </aside>
  <div class="wrapper">
    <div class="header">
      <div class="container">
        <button class="menu-button" type="button" name="button"><span class="arrow"><span></span></span></button>
        <div class="right-side">
          <button class="bell" type="button" name="button"><img src="/img/bell.svg" alt="Notifikace"><span>2</span></button>
          <div class="login-button">
            <img src="/img/user.svg" alt="Uživatel">
            @if ( !Auth::guard('admin')->check() )
                <li><a href="{{ url('admin/login') }}">Admin Login</a></li>
            @else
              <div class="prihlasen">
                {{ Auth::guard('admin')->user()->name }}
                <a href="{{ url('user/logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    <span>ODHLÁSIT</span>
                </a>
                <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
HELLO IM CUSTOM ADMIN VIEW !
    <div id="app">

      @yield('content')

    </div>



  </div>

<!-- Scripts -->
<script src="{{ asset('js/backend/app.js') }}"></script>
<link href="//cdn.jsdelivr.net/npm/jquery.fancytree@2.27/dist/skin-win8/ui.fancytree.min.css" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/jquery.fancytree@2.27/dist/jquery.fancytree-all-deps.min.js"></script>
<script type="text/javascript">
  $(function(){
    $(".select_parent_tree").fancytree();
  });
</script>
@foreach (App\Models\General\Lang::all() as $element)
  <script>
      CKEDITOR.replace('editor{{ $element->id }}',
      {
        extraPlugins: 'easyimage',
        cloudServices_tokenUrl: 'https://example.com/cs-token-endpoint',
        cloudServices_uploadUrl: 'https://your-organization-id.cke-cs.com/easyimage/upload/'
      }
    );
  </script>
  <script>
      CKEDITOR.replace('editor_1_{{ $element->id }}',
      {
        extraPlugins: 'easyimage',
        cloudServices_tokenUrl: 'https://example.com/cs-token-endpoint',
        cloudServices_uploadUrl: 'https://your-organization-id.cke-cs.com/easyimage/upload/'
      }
    );
  </script>
@endforeach

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>



</body>
</html>
