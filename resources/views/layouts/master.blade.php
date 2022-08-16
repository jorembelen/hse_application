<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('title')</title>

    <link rel="canonical" href="pages-blank.html" />
    <link rel="shortcut icon" href="{{ asset('assets/img/rcl.ico') }}">

    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet"> --}}

    <link href="{{ asset('assets/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/lightbox/photoswipe.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/lightbox/default-skin/default-skin.css') }}" rel="stylesheet" type="text/css" />
    <!-- BEGIN SETTINGS -->
    <!-- Remove this after purchasing -->
    <link class="js-stylesheet" href="{{ asset('assets/css/loader.css') }}" rel="stylesheet">
    <link class="js-stylesheet" href="{{ asset('assets/css/comment.css') }}" rel="stylesheet">
    <link class="js-stylesheet" href="{{ asset('assets/css/light.css') }}" rel="stylesheet">

    @livewireStyles
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div class="wrapper">

        @include('layouts.includes.sidebar.index')

        <div class="main">

            @livewire('navbar-component')

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">@yield('title')</h1>

                    @yield('content')
                    @include('scripts.sweet-alert')
                    @include('scripts.avatar')


                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-left">
                        </div>
                        <div class="col-6 text-right">
                            <p class="mb-0">
                                &copy; {{ now()->format('Y') }} - Designed and developed by:<a href="https://joreb.net" class="text-muted" target="_blank" rel="noopener noreferrer"> JOREB</a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>


        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Datatables Responsive
            $("#datatables-reponsive").DataTable({
                responsive: true
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Select2
            $(".select2").each(function() {
                $(this)
                .wrap("<div class=\"position-relative\"></div>")
                .select2({
                    placeholder: "Select value",
                    dropdownParent: $(this).parent()
                });
            })

        });
    </script>

    <script>
        var ss = $(".basic").select2({
            tags: true,
        });
    </script>

    <script src="{{ asset('assets/lightbox/photoswipe.min.js') }}"></script>
    <script src="{{ asset('assets/lightbox/photoswipe-ui-default.min.js') }}"></script>
    <script src="{{ asset('assets/lightbox/custom-photswipe.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @include('scripts.sweet-alert')

    @stack('incident-chart-js')
    @stack('wps-js')
    @stack('incident-js')
    @stack('create-notifications-js')
    @stack('edit-notifications-js')
    @stack('recommendation-js')
    @stack('comments-js')
    @stack('monthly-incidents-js')
    @stack('inc-type-js')

    @livewireScripts
</body>


</html>
