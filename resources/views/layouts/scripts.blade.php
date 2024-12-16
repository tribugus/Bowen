

<script src="{{ asset('theme/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('theme/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('theme/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('theme/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('theme/vendor/js/menu.js') }}"></script>
<script src="{{ asset('theme/vendor/libs/apex-charts/apexcharts.js') }}"></script>


<script async defer src="https://buttons.github.io/buttons.js"></script>

<script src="{{ asset('theme/js/main.js') }}"></script>



<script src="https://kit.fontawesome.com/c82bfcd167.js" crossorigin="anonymous"></script>
<script src="{{asset('theme/vendor/libs/sweetalert2/sweetalert2.all.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('theme/vendor/libs/sweetalert2/sweetalert2.css?').rand(9999,999999) }}" />

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>'
        });
    </script>
@endif

<!-- Código de SweetAlert2 para mostrar mensajes de sesión flash -->
@if (session()->has('message'))
    <script>
        const message = @json(session('message'));
        Swal.fire({
            icon: message.type,
            title: message.content
        });
    </script>
@endif