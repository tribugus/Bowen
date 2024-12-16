<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('layouts.head')

    <body>

        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                @include('layouts.sidebarMenu')

                <div class="layout-page">
                    @include('layouts.header')

                    <div class="content-wrapper">
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <main id="main" class="main">
                                @yield('content')
                            </main>
                        </div>
                        @include('layouts.footer')
                    </div>
                
                </div>

                

                <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
            </div>
        </div>
        @include('layouts.scripts')

    </body>
</html>