<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

{{-- HEADER --}}
@include('components.header')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        {{-- NAVBAR --}}
        @include('components.navbar')
        {{-- SIDEBAR --}}
        @include('components.sidebar')
        <main class="app-main"> <!--begin::App Content Header-->
            {{-- BREADCRUMB --}}
            {{-- @include('components.breadcrumb') --}}
            <div class="app-content"> <!--begin::Container-->
                <div id="app" class="container-fluid"> <!--begin::Row-->
                    @yield('content')
                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main--> <!--begin::Footer-->
        {{-- FOOTER --}}
        @include('components.footer')
    </div> <!--end::App Wrapper-->
</body><!--end::Body-->

</html>
