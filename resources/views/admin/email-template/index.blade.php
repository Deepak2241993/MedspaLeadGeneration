@extends('admin.layouts.app')

@php
    $pageTitle = 'Email Template';
@endphp
@include('admin.sections.leadboad_css')
@section('content')
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog d-flex justify-content-center align-items-center modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    {{ __('app.loading') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel rounded mr-3" data-dismiss="modal">Close</button>
                    <button type="button" class="btn-primary rounded">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENT WRAPPER START -->
    <div class="content-wrapper">
        <!-- Add Task Export Buttons Start -->
        <div class="d-grid d-lg-flex d-md-flex action-bar">
            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                <a href="{{ route('admin.email.create') }}" class="btn btn-primary btn-back">Create Email Template</a>
                <button class="btn btn-danger btn-delete-all">Delete Selected</button>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                <button class="btn btn-danger btn-delete-all">Delete Selected</button>
            </div>
        </div>

        <div class="d-flex flex-column w-tables rounded mt-3 bg-white table-responsive">
            <div class="col-xs-4 col-sm-3 col-md-2">
                <label for="custom-search">Search:</label>
                <input type="text" id="custom-search" class="form-control" placeholder="Enter search term">
            </div>

            <div id="leads-table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover data-table border-0 w-100 dataTable no-footer" id="leads-table"
                            role="grid" aria-describedby="leads-table_info" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="check-all"></th>
                                    <th>Sr No.</th>
                                    <th>Title</th>
                                    {{-- <input type="checkbox" checked data-toggle="toggle" data-size="mini">                                     --}}
                                    {{-- <th>Status</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
        @include('admin.sections.datatable_js')
        <script>
            $(document).ready(function() {
                var table = $(".data-table").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.email.index') }}",
                    columns: [
                        {
                            data: 'checkbox',
                            name: 'checkbox',
                            orderable: false,
                            searchable: false,
                            width: '5%',
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                return '<input type="checkbox" class="row-checkbox" data-id="' + full.id + '">';
                            }
                        },
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            width: '5%'
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            width: '15%'
                        },
                    ],
                    searching: true,
		    lengthChange: false,
                });

                // Check all functionality
                $('#check-all').click(function() {
                    $('.row-checkbox').prop('checked', this.checked);
                });

                // Individual checkbox selection
                $('.data-table').on('click', '.row-checkbox', function() {
                    if ($('.row-checkbox:checked').length === $('.row-checkbox').length) {
                        $('#check-all').prop('checked', true);
                    } else {
                        $('#check-all').prop('checked', false);
                    }
                });

                // Custom search input handling
                $('#custom-search').on('keyup', function() {
                    table.search($(this).val()).draw();
                });
            });
        </script>


        <script>
            const MODAL_LG = '#myModal';
            const MODAL_XL = '#myModalXl';
            const MODAL_HEADING = '#modelHeading';
            $('#add-column').click(function() {
                const url = "#";
                $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
                $.ajaxModal(MODAL_LG, url);
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#add-column').click(function() {
                    $('#addEmailTemplateModal').modal('show');
                });

                $('#addEmailTemplateForm').submit(function(e) {
                    e.preventDefault();

                    // Perform Ajax request to submit the form data
                    $.ajax({
                        url: '{{ route('admin.email.store') }}', // Replace with your actual route
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            // Handle success (e.g., close the modal, update the table)
                            $('#addEmailTemplateModal').modal('hide');
                            // Additional logic as needed
                        },
                        error: function(xhr, status, error) {
                            // Handle errors (e.g., display validation errors)
                            console.error(xhr.responseText);
                        }
                    });
                });

                $(document).ready(function() {
                    $('.data-table').on('click', '.delete', function() {
                        var id = $(this).data('id');
                        var url = '/admin/email-templates/' +
                            id; // Adjust this URL based on your route setup

                        // Ask for confirmation before deleting
                        if (confirm('Are you sure you want to delete this Email Template?')) {
                            var deleteBtn = $(this); // Reference to the delete button

                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    console.log(response.message);
                                    // Assuming you want to remove the row from the DataTable
                                    var table = $('.data-table').DataTable();
                                    table.row(deleteBtn.closest('tr')).remove().draw(false);
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                    });
                });

                // Update the Delete All button visibility
                function updateDeleteButtonVisibility() {
                    var selectedCount = $('.row-checkbox:checked').length;
                    $('.btn-delete-all').toggle(selectedCount >= 2);
                }

                // Check all functionality
                $('#check-all').click(function() {
                    $('.row-checkbox').prop('checked', this.checked);
                    updateDeleteButtonVisibility(); // Update visibility when checkboxes change
                });

                // Individual checkbox selection
                $('.data-table').on('click', '.row-checkbox', function() {
                    updateDeleteButtonVisibility(); // Update visibility when checkboxes change
                });

                // Delete All functionality
                $('.btn-delete-all').click(function() {
                    var selectedIds = [];

                    // Collect the IDs of selected items
                    $('.row-checkbox:checked').each(function() {
                        selectedIds.push($(this).data('id'));
                    });

                    // Check if any item is selected
                    if (selectedIds.length > 0) {
                        // Ask for confirmation before deleting
                        if (confirm('Are you sure you want to delete selected Email Templates?')) {
                            $.ajax({
                                url: "{{ route('admin.email.deleteAll') }}", // Replace with your actual route
                                type: 'POST',
                                data: {
                                    ids: selectedIds
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    console.log(response.message);
                                    // Assuming you want to reload the page or update the table
                                    location.reload();
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                    } else {
                        alert('Please select at least two items to delete.'); // Updated message
                    }
                });

                // Initially hide the Delete All button
                updateDeleteButtonVisibility();

            });
        </script>
    @endpush
@endsection
