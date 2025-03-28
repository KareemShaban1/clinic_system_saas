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

 <!-- SweetAlert2 -->
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

<script defer>
    document.addEventListener('DOMContentLoaded', function() {
        // Global DataTable defaults
        $.extend(true, $.fn.dataTable.defaults, {
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search...",
                lengthMenu: "_MENU_ records per page",
                info: "Showing _START_ to _END_ of _TOTAL_ records",
                infoEmpty: "No records available",
                infoFiltered: "(filtered from _MAX_ total records)",
                paginate: {
                    first: '<i class="mdi mdi-chevron-double-left"></i>',
                    previous: '<i class="mdi mdi-chevron-left"></i>',
                    next: '<i class="mdi mdi-chevron-right"></i>',
                    last: '<i class="mdi mdi-chevron-double-right"></i>'
                }
            },
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            order: [[0, 'desc']],
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]]
        });

        // Global delete function
        window.deleteRecord = function(id, routePrefix) {
            Swal.fire({
                title: '{{__("Are you sure?")}}',
                text: "{{__("You won't be able to revert this!")}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#727cf5',
                cancelButtonColor: '#d33',
                cancelButtonText: '{{__("Cancel")}}',
                confirmButtonText: '{{__("Yes, delete it!")}}',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${routePrefix}/delete/${id}`,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                $('.dataTable').DataTable().ajax.reload();
                                Swal.fire(
                                    'Deleted!',
                                    'Record has been deleted.',
                                    'success'
                                );
                            }
                        },
                        error: function(error) {
                            Swal.fire(
                                'Error!',
                                'Something went wrong.',
                                'error'
                            );
                        }
                    });
                }
            });
        };
    });
</script>

@livewireScripts
@stack('scripts')