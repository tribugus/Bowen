<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

    <title>{{ env('APP_NAME', 'laravel') }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('theme/img/favicon/school-solid-24.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('theme/vendor/fonts/boxicons.css?').rand(9999,999999) }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('theme/vendor/css/light.css?').rand(9999,999999) }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('theme/vendor/css/'.THEME().'.css?').rand(9999,999999) }}" class="template-customizer-core-css" id="style" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('theme/vendor/libs/perfect-scrollbar/perfect-scrollbar.css?').rand(9999,999999) }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('theme/vendor/css/pages/page-auth.css?').rand(9999,999999) }}" />
    <!-- Helpers -->
    <script src="{{ asset('theme/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('theme/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="justify-content-center">
                <a href="{{ url('/') }}" class="gap-2 d-block">
                
                  <img src="{{ asset('theme/img/brand/logo.png') }}" class="w-px-300 mx-auto d-block" />

                  <!--<span class="app-brand-logo demo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" viewBox="0 0 24 24" style="fill: rgba(105, 108, 255, 1);transform: ;msFilter:;"><path d="M2 7v1l11 4 9-4V7L11 4z"></path><path d="M4 11v4.267c0 1.621 4.001 3.893 9 3.734 4-.126 6.586-1.972 7-3.467.024-.089.037-.178.037-.268V11L13 14l-5-1.667v3.213l-1-.364V12l-3-1z"></path></svg>
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder">Itm</span>-->
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">¡Bienvenido! 👋</h4>
              <p class="mb-4">Por favor ingresa tu cuenta</p>

              <form class="mb-3" action="{{ url('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="correo" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    name="correo"
                    placeholder="Ingresa tu email"
                    autofocus  value="{{ old('correo') }}"/>

                    @error('correo')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>
                <div class="mb-4 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="contrasena">Contraseña</label>
                    <!--<a href="#">
                      <small>¿Olvidaste tu contraseña?</small>
                    </a>-->
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="contrasena"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />

                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                  @error('contrasena')
                      <div class="error">{{ $message }}</div>
                  @enderror

                </div>
                <!--<div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Recuérdame </label>
                  </div>
                </div>-->
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Iniciar Sesión</button>
                </div>
              </form>

              <!--<p class="text-center">
                <span>¿Nuevo en nuestra plataforma?</span>
                <a href="#">
                  <span>Crear una cuenta</span>
                </a>
              </p>-->
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!--<div class="buy-now">
      <a
        href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div>-->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('theme/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('theme/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('theme/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('theme/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{asset('theme/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{asset('theme/js/main.js')}}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    
    <script src="{{asset('theme/vendor/libs/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('theme/vendor/libs/sweetalert2/sweetalert2.css?').rand(9999,999999) }}" />





    @if($errors->any())
      <script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>'
      });
      </script>
    @endif

    @if(session()->has('message'))
      <script>
      const message = @json(session('message'));
      Swal.fire({
        icon: message.type,
        title: message.content
      });
      </script>
    @endif

  </body>
</html>