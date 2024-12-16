@php

  $cUrl = Request::url();

@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">


    <a href="{{ url('/') }}" class="app-brand-link">
      <img src="{{ asset('theme/img/brand/logo.png') }}" alt class="w-100" />
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">

    <!-- Dashboard -->
    <li class="menu-item {{ $cUrl == url('/') ? 'active' : '' }}">
      <a href="{{ url('/') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div>Home</div>
      </a>
    </li>



    @if(PUR(R1.R2))
    <li class="menu-item {{ str_contains($cUrl, 'usuarios') ? 'active' : '' }}">
      <a href="{{ url('/usuarios') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div>Usuarios</div>
      </a>
    </li>
    @endif



    @if(PUR(R1.R2))
    <li class="menu-item {{ str_contains($cUrl, 'profesores') ? 'active' : '' }}">
      <a href="{{ url('/profesores') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-glasses"></i>
        <div>Profesores</div>
      </a>
    </li>
    @endif


    @if(PUR(R1.R2))
    <li class="menu-item {{ str_contains($cUrl, 'alumnos') ? 'active' : '' }}">
      <a href="{{ url('/alumnos') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-graduation"></i>
        <div>Alumnos</div>
      </a>
    </li>
    @endif




    @if(PUR(R1.R2))
    <!--<li class="menu-item {{ str_contains($cUrl, 'grupos') ? 'active' : '' }}">
      <a href="{{ url('/grupos') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-group"></i>
        <div>Grupos</div>
      </a>
    </li>-->
    @endif


    @if(PUR(R1.R2))

      @php $ARR1=["roles","ciclo-escolar","serie-matricula","nivel-educativo"]; @endphp

      <li class="menu-item {{ CURL($ARR1,$cUrl) ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bxs-wrench"></i>
          <div class="text-truncate">Configuración</div>
        </a>
      
        <ul class="menu-sub">
      
          @if(PUR(R1))
          <li class="menu-item {{ str_contains($cUrl, 'roles') ? 'active' : '' }}">
            <a href="{{ url('/roles') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-lock-alt"></i>
              <div>Roles</div>
            </a>
          </li>
          @endif
          

          @if(PUR(R1.R2))
          <li class="menu-item {{ str_contains($cUrl, 'ciclo-escolar') ? 'active' : '' }}">
            <a href="{{ url('/ciclo-escolar') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-calendar"></i>
              <div>Ciclo escolar</div>
            </a>
          </li>
          @endif


          @if(PUR(R1.R2))
          <li class="menu-item {{ str_contains($cUrl, 'serie-matricula') ? 'active' : '' }}">
            <a href="{{ url('/serie-matricula') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-book"></i>
              <div>Serie matrícula</div>
            </a>
          </li>
          @endif




          @if(PUR(R1.R2))
          <li class="menu-item {{ str_contains($cUrl, 'nivel-educativo') ? 'active' : '' }}">
            <a href="{{ url('/nivel-educativo') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-bar-chart-alt-2"></i>
              <div>Nivel educativo</div>
            </a>
          </li>
          @endif


          
        </ul>
      </li>
    @endif


      











  </ul>
</aside>
