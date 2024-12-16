

<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>
  
  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    
    <!-- Search 
    <div class="navbar-nav align-items-center">
      <div class="nav-item d-flex align-items-center">
        <i class="bx bx-search fs-4 lh-0"></i>
        <input
          type="text"
          class="form-control border-0 shadow-none"
          placeholder="Search..."
          aria-label="Search..."
        />
      </div>
    </div>
     /Search -->
  
    <ul class="navbar-nav flex-row align-items-center ms-auto">



      <li>
        <button class="flex items-center p-2 rounded-full" onclick="ChangeTheme(this)">




          @if(THEME()==null)
          <i class='bx bx-sun fs-4'></i>
          @else
            @if(THEME()=='light')
            <i class='bx bx-sun fs-4'></i>
            @else
            <i class='bx bx-moon fs-4'></i>
            @endif
          @endif
        </button>
      </li>

 
      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img src="{{ asset('theme/img/avatars/2.webp') }}" alt class="rounded-circle" />
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">

          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-shrink-0 me-2">
                  <div class="avatar avatar-online">
                    <img src="{{ asset('theme/img/avatars/2.webp') }}" alt class="rounded-circle" />
                  </div>
                </div>
                <div class="flex-grow-1">
                  <span class="fw-semibold d-block">
                      {{ ucwords(User('nombre').' '.User('ap_pat').' '.User('ap_mat')) }}
                  </span>
                  <small class="text-muted"> {{ ucwords(User('roll')->roll) }}</small>
                </div>
              </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <form method="POST" action="{{ url('logout') }}" style="display: contents;">
                @csrf
                <button type="submit" class="dropdown-item d-flex align-items-center" >
                  <i class="bx bx-power-off me-2"></i>
                  <span>Cerrar Sesión</span>
                </button>
              </form>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>
</nav>



<script type="text/javascript">
function ChangeTheme($this) {

    var t = Cookies.get('theme');
    var icon = $($this).children('i');


    if (t==undefined) {
      Cookies.set('theme', 'dark', { path: '/', expires: 7 }); 
      icon.replaceWith("<i class='bx bx-moon fs-4'></i>");

    }else {
        if (t == 'dark') {
            Cookies.set('theme', 'light', { path: '/', expires: 7 }); 
            icon.replaceWith("<i class='bx bx-sun fs-4'></i>");
            $('#style').replaceWith(
            '<link rel="stylesheet" href="{{ asset("theme/vendor/css/")."/light.css?".rand(9999,999999) }}"'
            +'class="template-customizer-core-css" id="style" />');
        } else {
            Cookies.set('theme', 'dark', { path: '/', expires: 7 }); 
            icon.replaceWith("<i class='bx bx-moon fs-4'></i>");
            $('#style').replaceWith(
            '<link rel="stylesheet" href="{{ asset("theme/vendor/css/")."/dark.css?".rand(9999,999999) }}"'
            +'class="template-customizer-core-css" id="style" />');
        }
    }
}
</script>