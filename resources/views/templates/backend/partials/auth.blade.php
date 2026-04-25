@if(session()->has('usrUuId'))

@else
    <script type="text/javascript">
        window.location="{{ url('/') }}";
    </script>
@endif

