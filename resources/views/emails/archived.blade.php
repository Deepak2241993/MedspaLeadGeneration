@extends('admin.layouts.app')

@php
    $pageTitle = 'Archived Leads';
@endphp

@section('content')
    <div class="content-wrapper">
        <form method="POST" action="{{ route('admin.emails.index') }}" id="myForm">
            @csrf
            <input type="hidden" name="selectedIds[]" id="selectedIds">
            <div class="d-grid d-lg-flex d-md-flex action-bar">
                <div id="table-actions" class="flex-grow-1 align-items-center">
                    <button class="btn btn-danger btn-permanent-delete-selected" style="display:none;">Permanent Delete</button>
                </div>
                <div class="btn-group mt-2 mt-lg-0 mt-md-0 ml-0 ml-lg-3 ml-md-3" role="group">
                    <a href="{{ route('admin.leads.index') }}" class="btn btn-secondary f-14 btn-active"
                        data-toggle="tooltip" data-original-title="Table View"><i class="side-icon bi bi-list-ul"></i></a>
                    <a href="{{ route('admin.leadboard') }}" class="btn btn-secondary f-14" data-toggle="tooltip"
                        data-original-title="Lead Status"><i class="side-icon bi bi-kanban"></i></a>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Add this div where you want to display the success message -->
            <div id="success-message" style="display: none;" class="alert alert-success">
                <!-- Success message will be displayed here -->
            </div>

            <div class="d-flex flex-column w-tables rounded mt-3 bg-white table-responsive">
                <div id="leads-table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"></div>

                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover data-table border-0 w-100 dataTable no-footer" id="leads-table"
                            role="grid" aria-describedby="leads-table_info" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="check-all"></th>
                                    <th>Sr No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone No.</th>
                                    <th>Text</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        @include('admin.sections.datatable_js')
        <script>
            $(document).ready(function() {
                var table = $(".data-table").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.leads.archived') }}",
                    columns: [{
                            data: 'checkbox',
                            name: 'checkbox',
                            orderable: false,
                            searchable: false,
                            width: '5%',
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                return '<input type="checkbox" class="row-checkbox" data-id="' + full
                                    .id + '" data-email="' + full.email + '">';
                            }
                        },
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            width: '5%'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email',
                            className: 'email-column'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'message',
                            name: 'message'
                        },
                        {
                            "data": "status",
                            "name": "status",
                            "title": "Status",
                            "orderable": true,
                            "searchable": true
                        },
                        // { data: 'mobile', name: 'mobile' },
                        {
                            data: 'action',
                            name: 'action',
                            width: '15%'
                        },
                    ],
                    Searching: true,
                    lengthChange: false,
                });

                // Check all functionality
                $('#check-all').click(function() {
                    $('.row-checkbox').prop('checked', this.checked);
                    toggleButtonVisibility();
                });

                // Individual checkbox selection
                $('.data-table').on('click', '.row-checkbox', function() {
                    toggleButtonVisibility();
                });

                // Delete Selected functionality
                $('.btn-permanent-delete-selected').click(function() {
                    var selectedIds = getSelectedIds();

                    // Check if any item is selected
                    if (selectedIds.length > 0) {
                        // Ask for confirmation before deleting
                        if (confirm('Are you sure you want to delete selected records?')) {
                            deleteSelectedRecords(selectedIds);
                        }
                    } else {
                        alert('Please select at least one record to delete.');
                    }
                });

               
                // Event listener for delete button click
                $(document).ready(function() {
                    $('.data-table').on('click', '.harddelete', function() {
                        var id = $(this).data('id');
                        var url = '/admin/lead/delete/' +
                            id; // Adjust this URL based on your route setup

                        // Ask for confirmation before deleting
                        if (confirm('Are you sure you want to delete permanently?')) {
                            var harddeleteBtn = $(this); // Reference to the delete button

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
                                    table.row(harddeleteBtn.closest('tr')).remove().draw(false);
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                    });
                });

                // Function to toggle button visibility based on selected checkboxes
                function toggleButtonVisibility() {
                    var selectedCheckboxCount = $('.row-checkbox:checked').length;
                    if (selectedCheckboxCount >= 0) {
                        $('.btn-permanent-delete-selected, .btn-send-emails').show();
                    } else {
                        $('.btn-permanent-delete-selected, .btn-send-emails').hide();
                    }
                }

                // Function to get the IDs of selected checkboxes
                function getSelectedIds() {
                    var selectedIds = [];
                    $('.row-checkbox:checked').each(function() {
                        selectedIds.push($(this).closest('tr').find('.delete').data('id'));
                    });
                    return selectedIds;
                }

                // Function to delete selected records
                function deleteSelectedRecords(ids) {
                    $.ajax({
                        url: '{{ route('admin.leads.permanentdeleteAll') }}',
                        type: 'POST',
                        data: {
                            ids: ids,
                            _token: '{{ csrf_token() }}'
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



            });
        </script>
        <script>
            $("form").submit(function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Collect selected checkbox IDs
                var selectedIds = [];
                $("input[type='checkbox']:checked").each(function() {
                    selectedIds.push($(this).closest('tr').find('.row-checkbox').data('id'));
                });
                var filteredArray = selectedIds.filter(function(element) {
                    return element !== undefined;
                });

                // console.log(filteredArray);
                // Set the value of the hidden input field
                $("#selectedIds").val(filteredArray.join(','));

                // Submit the form directly using the form's submit method
                document.getElementById("myForm").submit();
            });
        </script>
    @endpush
@endsection
