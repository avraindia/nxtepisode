<!DOCTYPE html>
<html lang="en">
    <head>
        @include('includes.admin.head')
    </head>
    <body>
        @include('includes.admin.left-menu')
        <div class="main">
            @include('includes.admin.top-menu')

            @yield('content')
        </div>
        @include('includes.admin.foot')
        @stack('scripts')
    </body>
</html>