<!-- Main Footer -->
<footer class="main-footer">
<?php
        use App\Setting;
            $app = Setting::first();
        ?>	<p>&copy; 2020
            @if(session('lang') == 'en')
                {{ $app->sitename_en }}
            @elseif(session('lang') == 'ar')
                {{ $app->sitename_ar }}
            @endif.  | {{ __('design_by') }}
            <strong><a href="https://www.linkedin.com/in/kairo-wageh-591811b5/" target="_blank">Kairo Wageh</a>.</strong>
            {{ __('all_rights_reserved') }}
        </p>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="{{ asset('public/design/admin/js/jquery-3.6.0.min.js') }}"></script>
{{--<script src="{{ asset('public/design/admin/plugins/jquery/jquery.min.js') }}"></script>--}}

<!-- Bootstrap -->
<script src="{{asset('public/design/admin/js/bootstrap.js')}}"> </script>
<script src="{{ asset('public/design/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('public/design/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/design/admin/dist/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('public/design/admin/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('public/design/admin/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('public/design/admin/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('public/design/admin/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('public/design/admin/plugins/chart.js/Chart.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/design/admin/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('public/design/admin/dist/js/pages/dashboard2.js') }}"></script>
<!--dataTables-->

<script src="{{asset('public/design/admin/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/design/admin/js/dataTables.bootstrap.min.js')}}"></script>
<!--//dataTables-->

<script src="{{asset('public/design/admin/js/dataTables.buttons.min.js')}}"> </script>
<script src="{{asset('public/vendor/datatables/buttons.server-side.js')}}"> </script>
<!-- Toastr -->
<script src="{{ asset('public/design/admin/js/toastr.min.js') }}"></script>
@stack('js')
@stack('css')
</body>
</html>
