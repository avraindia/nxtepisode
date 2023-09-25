<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.frontend.head')
    </head>
    <body>
        <div class="main-wrapper">
        @include('includes.frontend.header')
        @yield('content')
            <section class="footer">
                @include('includes.frontend.foot')
            </section>
        </div>
        @include('includes.frontend.footer')
        @stack('scripts')
        
    </body>
</html>