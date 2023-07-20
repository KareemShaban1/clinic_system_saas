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

<!-- toastr -->
@yield('js')

<script src="{{ asset('backend/assets/js/toastr.js') }}"></script>

<script src="{{ asset('backend/assets/js/custom.js') }}"></script>

{{-- Data table --}}
<script src="{{ asset('backend/assets/datatables/datatables.min.js') }}"></script>

@if (App::getLocale() == 'ar')
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable({
                responsive: true,
                // initComplete: function() {
                //     this.api()
                //         .columns()
                //         .every(function() {
                //             var column = this;
                //             var title = column.footer().textContent;

                //             // Create input element and add event listener
                //             $('<input type="text" placeholder="Search ' + title + '" />')
                //                 .appendTo($(column.footer()).empty())
                //                 .on('keyup change clear', function() {
                //                     if (column.search() !== this.value) {
                //                         column.search(this.value).draw();
                //                     }
                //                 });
                //         });
                // },
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
