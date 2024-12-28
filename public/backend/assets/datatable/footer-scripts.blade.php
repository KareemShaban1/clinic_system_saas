 <!-- bundle -->
<script src="{{asset('backend/assets/js/vendor.min.js')}}"></script>
<script src="{{asset('backend/assets/js/app.min.js')}}"></script>

<!-- third party js -->
<!-- <script src="{{asset('backend/assets/js/vendor/apexcharts.min.js')}}"></script> -->
<script src="{{asset('backend/assets/js/vendor/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('backend/assets/js/vendor/jquery-jvectormap-world-mill-en.js')}}"></script>

<!-- Datatables js -->
<script src="{{asset('backend/assets/js/vendor/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/assets/js/vendor/dataTables.bootstrap5.js')}}"></script>
<script src="{{asset('backend/assets/js/vendor/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/assets/js/vendor/responsive.bootstrap5.min.js')}}"></script>

<!-- Datatable Init js -->
<script src="{{asset('backend/assets/js/pages/demo.datatable-init.js')}}"></script>

<!-- third party js ends -->

<!-- demo app -->
<script src="{{asset('backend/assets/js/pages/demo.dashboard.js')}}"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
     const languages = {
            @if(App::getLocale() == 'en')
            en: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'></i> Previous",
                    next: "Next <i class='mdi mdi-chevron-right'></i>"
                },
                info: "Showing records _START_ to _END_ of _TOTAL_",
                lengthMenu: "Display _MENU_ records",
                search: "_INPUT_",
                searchPlaceholder: "Search...",
                zeroRecords: "No matching records found",
                infoEmpty: "No records to display",
                infoFiltered: "(filtered from _MAX_ total records)"
            },
            @else
            ar: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-right'></i> السابق",
                    next: "التالي <i class='mdi mdi-chevron-left'></i>"
                },
                info: "عرض السجلات من _START_ إلى _END_ من إجمالي _TOTAL_ سجلات",
                lengthMenu: "عرض _MENU_ سجلات",
                search: "_INPUT_",
                searchPlaceholder: "بحث...",
                zeroRecords: "لا توجد سجلات مطابقة",
                infoEmpty: "لا توجد سجلات للعرض",
                infoFiltered: "(تمت التصفية من إجمالي _MAX_ سجلات)"
            }
            @endif
        };

        const language = '{{ App::getLocale() }}';
</script>

@stack('scripts')