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
<!-- <script src="{{ asset('backend/assets/js/sweetalert2.js') }}"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="{{ asset('backend/assets/js/popper.min.js') }}"></script>

<script src="{{ asset('backend/assets/js/toastr.js') }}"></script>

<script>
    @if(session('toast_success'))
    toastr.success("{{ session('toast_success') }}", "", {
        "timeOut": 1000
    }); // Set timeOut to 1000 milliseconds (1 second)
    @endif
    @if(session('toast_error'))
    toastr.error("{{ session('toast_error') }}", "", {
        "timeOut": 1000
    }); // Set timeOut to 1000 milliseconds (1 second)
    @endif
</script>

<script src="{{ asset('backend/assets/js/custom.min.js') }}"></script>


<script src="{{ asset('backend/assets/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{asset('backend/assets/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/assets/datatable/dataTables.bootstrap5.js')}}"></script>
<script src="{{asset('backend/assets/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/assets/datatable/responsive.bootstrap5.min.js')}}"></script>

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

@livewireScripts
@stack('scripts')