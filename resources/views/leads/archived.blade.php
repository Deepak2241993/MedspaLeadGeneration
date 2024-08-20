@extends('layouts.master')

@section('title')
    Archived Leads
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('build/libs/toastr/build/toastr.min.css') }}">
@endsection

@section('page-title')
    Archived Leads
@endsection

@section('body')

    <body data-sidebar="colored">
    @endsection

    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div id="bulk-actions" class="d-flex justify-content-start align-items-center">
                                    <button id="delete-all" class="btn btn-danger mr-6">Delete All</button>
                                    <form id="restore-all-form" action="{{ route('leads.restoreMultiple') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="ids" id="emails-input">
                                        <button type="submit" id="restore-all-btn" class="btn btn-info">Restore All</button>
                                    </form>
                                    
                                </div>
                                


                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 float-end">
                                    <a href="{{ route('leads.index') }}" class="btn btn-primary">
                                        <i class="fas fa-bars"></i></i>
                                    </a>
                                    <a href="{{ route('leadboard') }}" class="btn btn-primary">
                                        <i class="uim uim-columns"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="check-all"></th>
                                    <th>Sr No.</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Text</th>
                                    <th>Source</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $lead)
                                    <tr>
                                        <td style="width: 60px;">
                                            <div class="form-check font-size-16 text-center">
                                                <input type="checkbox" class="row-checkbox" data-ids="{{ $lead['_id'] }}"
                                                    class="tasks-activeCheck2" id="tasks-activeCheck2">
                                                <label class="form-check-label" for="tasks-activeCheck2"></label>
                                            </div>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lead['first_name'] }}</td>
                                        <td>{{ $lead['last_name'] }}</td>
                                        <td>{{ $lead['email'] }}</td>
                                        <td>{{ $lead['phone'] }}</td>
                                        <td>{{ $lead['message'] }}</td>
                                        <td>{{ $lead['source'] }}</td>
                                        <td>
                                            <a href="{{ route('leads.restore', $lead['_id']) }}"
                                                class="btn btn-primary btn-sm">Restore</a>
                                            <form action="{{ route('leads.permanentdelete', $lead['_id']) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No data found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    @endsection

    @section('scripts')
        <!-- Required datatable js -->
        <script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/jszip/jszip.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/pdfmake/build/pdfmake.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/pdfmake/build/vfs_fonts.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

        <script src="{{ URL::asset('build/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>

        <!-- Responsive examples -->
        <script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

        <!-- Datatable init js -->
        <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <!-- toastr plugin -->
        <script src="{{ URL::asset('build/libs/toastr/build/toastr.min.js') }}"></script>
        <!-- toastr init -->
        <script src="{{ URL::asset('build/js/pages/toastr.init.js') }}"></script>
        <script>
            $(document).ready(function() {
                // Toggle checkboxes
                $('#check-all').click(function() {
                    $('.row-checkbox').prop('checked', this.checked);
                    updateBulkActions();
                });

                // Monitor checkbox changes
                $('.row-checkbox').change(function() {
                    updateBulkActions();
                });

                // Update bulk actions visibility
                function updateBulkActions() {
                    var checkedCount = $('.row-checkbox:checked').length;
                    // if (checkedCount > 0) {
                    //     $('#bulk-actions').show();
                    // } else {
                    //     $('#bulk-actions').hide();
                    // }
                }

                // Handle Delete All action
                $(document).ready(function() {
                    // Toastr options
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": 300,
                        "hideDuration": 1000,
                        "timeOut": 5000,
                        "extendedTimeOut": 1000,
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    // Handle Check All action
                    $('#check-all').click(function() {
                        $('.row-checkbox').prop('checked', this.checked);
                    });

                    // Handle Delete All action
                    $('#delete-all').click(function() {
                        if (confirm('Are you sure you want to delete the selected columns?')) {
                            var ids = $('.row-checkbox:checked').map(function() {
                                return $(this).data(
                                    'ids'); // Ensure data-ids attribute is used correctly
                            }).get();

                            if (ids.length > 0) {
                                var url =
                                    "{{ route('leads.destroyMultiple') }}"; // Updated route name for multiple delete
                                $.ajax({
                                    url: url,
                                    type: 'DELETE',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        ids: ids
                                    },
                                    success: function(response) {
                                        toastr.success(
                                            'Selected columns deleted successfully');
                                        location
                                            .reload(); // Reload the page to see the changes
                                    },
                                    error: function(xhr) {
                                        toastr.error('Error deleting columns: ' + xhr
                                            .responseJSON.message);
                                    }
                                });
                            } else {
                                toastr.warning('No columns selected for deletion');
                            }
                        }
                    });
                });
            });
            $('#restore-all-btn').click(function(e) {
                e.preventDefault();

                var ids = $('.row-checkbox:checked').map(function() {
                    return $(this).data('ids');
                }).get();

                if (ids.length > 0) {
                    $('#emails-input').val(ids.join(',')); // Store the selected IDs in the hidden input
                    $('#restore-all-form').submit(); // Submit the form
                } else {
                    toastr.warning('No leads selected for restoration');
                }
            });

        </script>
    @endsection
