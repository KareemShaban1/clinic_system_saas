<!-- jquery -->
<script src="{{ URL::asset('backend/assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('backend/assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script>
    var plugin_path = 'js/';
</script>

<!-- chart -->
<script src="{{ URL::asset('backend/assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('backend/assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('backend/assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('backend/assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('backend/assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('backend/assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('backend/assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('backend/assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('backend/assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('backend/assets/js/custom.js') }}"></script>

{{-- Data table --}}
<script src="{{ URL::asset('backend/assets/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('/sw.js') }}"></script>
{{-- <script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script> --}}
@if (App::getLocale() == 'ar')
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable({
                
                oLanguage: {
                    sZeroRecords: 'لا يوجد سجل متتطابق',
                    sEmptyTable: 'لا يوجد بيانات في الجدول',
                    oPaginate: {
                    sFirst: "First",
                    sLast: "الأخير",
                    sNext: "التالى",
                    sPrevious: "السابق"
                },
                },
                
            });
        });
    </script>
@else
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable({
                oLanguage: {
                    sZeroRecords: 'No matching records found',
                    sEmptyTable: 'No data available in table',
                    oPaginate: {
                    sFirst: "First",
                    sLast: "الأخير",
                    sNext: "Next",
                    sPrevious: "Previous"
                },
                },
                
            });
        });
    </script>
@endif
@livewireScripts
@stack('scripts')
