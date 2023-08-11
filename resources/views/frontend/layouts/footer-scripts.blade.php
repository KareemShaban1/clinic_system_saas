<!-- jquery -->
<script src="{{ asset('backend/assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ asset('backend/assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script>
    var plugin_path = '{{ asset('backend/assets/js/') }}';
</script>


<!-- calendar -->
<script src="{{ asset('backend/assets/js/calendar.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('backend/assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ asset('backend/assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ asset('backend/assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ asset('backend/assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ asset('backend/assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ asset('backend/assets/js/custom.js') }}"></script>


{{-- Data table --}}
<script src="{{ asset('backend/assets/datatables/datatables.min.js') }}"></script>

<script src="{{ asset('backend/assets/datatables/dataTables.responsive.min.js') }}"></script>

<script src="{{ asset('/sw.js') }}"></script>

@livewireScripts
@stack('scripts')
