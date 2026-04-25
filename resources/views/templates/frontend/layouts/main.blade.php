<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('templates.frontend.partials.head')
    </head>
    <body>
        <div class="body-inner">
            @yield('content')
            @include('templates.frontend.partials.footer') 
        </div>
    </body>
</html>
