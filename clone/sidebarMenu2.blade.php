@php

  $currentUrl = Request::url();

  $zed = new \App\Helpers\RoleHelper;

@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">


    <a href="{{ url('/') }}" class="app-brand-link">
      <img src="{{ asset('theme/img/brand/logo.png') }}" alt class="w-100" />
      <!--<span class="app-brand-logo demo">
         <svg xmlns="http://www.w3.org/2000/svg" width="25" viewBox="0 0 24 24" style="fill: rgba(105, 108, 255, 1);transform: ;msFilter:;"><path d="M2 7v1l11 4 9-4V7L11 4z"></path><path d="M4 11v4.267c0 1.621 4.001 3.893 9 3.734 4-.126 6.586-1.972 7-3.467.024-.089.037-.178.037-.268V11L13 14l-5-1.667v3.213l-1-.364V12l-3-1z"></path></svg>
      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2">Itm</span>-->
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">

    <!-- Dashboard -->
    <li class="menu-item {{ $currentUrl == url('/') ? 'active' : '' }}">
      <a href="{{ url('/') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Home</div>
      </a>
    </li>

    <!-- Layouts -->
    <li class="menu-item {{ str_contains($currentUrl, 'students') || str_contains($currentUrl, 'teachers') || str_contains($currentUrl, 'classrooms') || str_contains($currentUrl, 'subjects') || str_contains($currentUrl, 'enrollments') || str_contains($currentUrl, 'grades') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-layout"></i>
        <div data-i18n="Layouts">Entidades</div>
      </a>

      <ul class="menu-sub">
        
        @if($zed::isAuthorized('Estudiantes.showStudents'))
          <li class="menu-item {{ str_contains($currentUrl, 'students') ? 'active' : '' }}">
            <a href="{{ route('students.index' )}}" class="menu-link">
              <div data-i18n="Without menu">Estudiantes</div>
            </a>
          </li>
        @endif

        @if($zed::isAuthorized('Profesores.showTeachers'))
          <li class="menu-item {{ str_contains($currentUrl, 'teachers') ? 'active' : '' }}">
            <a href="{{ route('teachers.index' )}}" class="menu-link">
              <div data-i18n="Without navbar">Profesores</div>
            </a>
          </li>
        @endif

        @if($zed::isAuthorized('Aulas.showClassrooms'))
          <li class="menu-item {{ str_contains($currentUrl, 'classrooms') ? 'active' : '' }}">
            <a href="{{ route('classrooms.index') }}" class="menu-link">
              <div data-i18n="Without navbar">Aulas</div>
            </a>
          </li>
        @endif

        @if($zed::isAuthorized('Asignaturas.showSubjects'))
          <li class="menu-item {{ str_contains($currentUrl, 'subjects') ? 'active' : '' }}">
            <a href="{{ route('subjects.index' )}}" class="menu-link">
              <div data-i18n="Without menu">Asignaturas</div>
            </a>
          </li>
        @endif

        @if($zed::isAuthorized('Matriculas.showEnrollments'))
          <li class="menu-item {{ str_contains($currentUrl, 'enrollments') ? 'active' : '' }}">   
            <a href="{{ route('enrollments.index' )}}" class="menu-link">
              <div data-i18n="Without menu">Matriculas</div>
            </a>
          </li>
        @endif

        @if($zed::isAuthorized('Notas.showGrades'))
        <li class="menu-item {{ str_contains($currentUrl, 'grades') ? 'active' : '' }}">
          <a href="{{ route('grades.index' ) }}" class="menu-link">
            <div data-i18n="Without menu">Notas</div>
          </a>
        </li>
        @endif

      </ul>
    </li>

    @if($zed::isAuthorized('Roles.showRoles'))
      <li class="menu-item {{ str_contains($currentUrl, 'roles') ? 'active' : '' }}">
        <a href="{{ route('roles.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-lock-alt"></i>
          <div data-i18n="Analytics">Roles</div>
        </a>
      </li>
    @endif

    @if($zed::isAuthorized('Usuarios.showUsers'))
      <li class="menu-item {{ str_contains($currentUrl, 'users') ? 'active' : '' }}">
        <a href="{{ route('users.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-user"></i>
          <div data-i18n="Analytics">Usuarios</div>
        </a>
      </li>
    @endif
    
  </ul>
</aside>
