<!-- jquery -->
<script src="{{ asset('backend/assets/js/jquery-3.3.1.min.js') }}"></script>

<script src="{{ asset('backend/assets/js/bootstrap.min.js') }}"></script>

<!-- plugins-jquery -->
<script src="{{ asset('backend/assets/js/plugins-jquery.js') }}"></script>

<!-- plugin_path -->
<script>
    var plugin_path = '{{ asset('backend/assets/js/') }}';
</script>

<!-- datepicker -->
<script src="{{ asset('backend/assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ asset('backend/assets/js/sweetalert2.js') }}"></script>

<script src="{{ asset('backend/assets/js/popper.min.js') }}"></script>

<script src="{{ asset('backend/assets/js/toastr.js') }}"></script>

<script>
    @if (session('toast_success'))
        toastr.success("{{ session('toast_success') }}", "", {
            "timeOut": 1000
        }); // Set timeOut to 1000 milliseconds (1 second)
    @endif
    @if (session('toast_error'))
        toastr.error("{{ session('toast_error') }}", "", {
            "timeOut": 1000
        }); // Set timeOut to 1000 milliseconds (1 second)
    @endif
</script>

<script src="{{ asset('backend/assets/js/custom.js') }}"></script>


<script src="{{ asset('backend/assets/datatables/dataTables.responsive.min.js') }}"></script>


<script src="{{ asset('backend/assets/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('backend/assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/assets/jquery-ui/jquery-ui.min.js') }}"></script>

<script src="{{ asset('backend/assets/datatables/export-tables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/assets/datatables/export-tables/buttons.flash.min.js') }}"></script>
<script src="{{ asset('backend/assets/datatables/export-tables/jszip.min.js') }}"></script>
<script src="{{ asset('backend/assets/datatables/export-tables/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/assets/datatables/export-tables/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/assets/datatables/export-tables/buttons.print.min.js') }}"></script>

{{-- @if (App::getLocale() == 'ar')
    <script>
        $(document).ready(function() {
            
            var datatable = $('#table_id').DataTable({
                responsive: true,
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
                responsive: true,
                oLanguage: {
                    sZeroRecords: 'No matching records found',
                    sEmptyTable: 'No data available in table',
                    oPaginate: {
                        sFirst: "First",
                        sLast: "Last",
                        sNext: "Next",
                        sPrevious: "Previous"
                    },
                },

            });
        });
    </script>
@endif --}}

@livewireScripts
@stack('scripts')
