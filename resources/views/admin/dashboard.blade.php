@extends('layouts.navigation')
@extends('layouts.sidebar')

@section('title')
    Admin Dashboard
@endsection

@section('header')
    <h1 class="admissionstatus">Admin Dashboard</h1>
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.6.2/css/select.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.2.2/jszip.min.js"></script>

    <style>
        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }
        .table thead th {
            background-color: #04499b;
            color: #ffffff;
            border: 1px solid #dee2e6;
            text-align: center;
            padding: 12px 8px;
            position: relative;
        }
        .table tbody td {
            border: 1px solid #dee2e6;
            text-align: center;
            padding: 12px 8px;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.3em 1em;
            margin: 0.2em;
            border-radius: 4px;
            border: 1px solid #ddd;
            background-color: #f8f9fa;
            color: #333;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #e9ecef;
            border: 1px solid #ddd;
            color: #333;
        }
        .sorting:after,
        .sorting_asc:after,
        .sorting_desc:after {
            font-family: PSU Stidti;
            padding-left: 10px;
        }
        .sorting:after {
            content: "\f0f6";
        }
        .sorting_asc:after {
            content: "\f062";
        }
        .sorting_desc:after {
            content: "\f064";
        }
    </style>

    <div class="container my-4">
        {{-- <div class="form-group">
            <label for="budgetyear">Select Budget Year:</label>
            <select id="budgetyear" class="form-control">
                <option value="">Select Budget Year</option>
                @foreach ($budgetyears as $year)
                    <option value="{{ $year->id }}">{{ $year->year }}</option>
                @endforeach
            </select>
        </div> --}}

        {{-- <div class="form-group mt-3">
            <label for="program">Select Program:</label>
            <select id="program" class="form-control" disabled>
                <option value="">Select Program</option>
            </select>
        </div> --}}

        <div class="table-container mt-3">
            <table id="myTable" class="table table-striped table-bordered table-hover">
                <thead class="thead-dark" id="table-header">
                    <!-- Table header will be dynamically inserted here if there is data -->
                </thead>
                <tbody id="user-info-body">
                    <!-- User info will be dynamically inserted here -->
                </tbody>
            </table>
        </div>

        <div class="btn-actions mt-3">
            <a href="/export-all-students" class="btn btn-primary">Export All Students</a>
           
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table;

            $('#budgetyear').change(function() {
                var yearId = $(this).val();
                if (yearId) {
                    $.ajax({
                        url: '/get-programs/' + yearId,
                        type: 'GET',
                        success: function(data) {
                            $('#program').removeAttr('disabled');
                            $('#program').html(data);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching programs:', error);
                        }
                    });
                } else {
                    $('#program').attr('disabled', 'disabled');
                    $('#program').html('<option value="">Select Program</option>');
                }
            });

            $('#program').change(function() {
                var programId = $(this).val();
                var yearId = $('#budgetyear').val();

                if (yearId) {
                    $.ajax({
                        url: '/get-users/' + (programId === 'all' ? 'all' : programId),
                        type: 'GET',
                        data: { year_id: yearId },
                        success: function(data) {
                            console.log('Data received from server:', data); // Check what data is received
                            const userInfoBody = $('#user-info-body');
                            userInfoBody.empty();

                            if (data.length > 0) {
                                const tableHeader = $('#table-header');
                                if (!tableHeader.hasClass('table-header-inserted')) {
                                    tableHeader.html(`
                                        <tr>
                                            <th>No</th>
                                            <th>Name-Surname</th>
                                            <th>E-mail</th>
                                            <th>Institution</th>
                                            <th>Country</th>
                                            <th>Program</th>
                                            <th>Advisor</th>
                                            <th>Time Period</th>
                                            <th>Status</th>
                                        </tr>
                                    `);
                                    tableHeader.addClass('table-header-inserted');
                                }

                                data.forEach((user, index) => {
                                    const timePeriod = user.start_date && user.ending_date
                                        ? user.start_date + ' - ' + user.ending_date
                                        : 'N/A';

                                    const programName = user.study_program || 'N/A';

                                    userInfoBody.append(`
                                        <tr>
                                            <td>${index + 1}</td>
                                            <td>${user.name} ${user.surname}</td>
                                            <td>${user.email}</td>
                                            <td>${user.university}, ${user.faculty}</td>
                                            <td>${user.country}</td>
                                            <td>${programName}</td>
                                            <td>${user.advisor}</td>
                                            <td>${timePeriod}</td>
                                            <td>${user.status}</td>
                                        </tr>
                                    `);
                                });

                                if ($.fn.dataTable.isDataTable('#myTable')) {
                                    table.destroy();
                                }

                                table = $('#myTable').DataTable({
                                    paging: true,
                                    searching: true,
                                    ordering: true,
                                    info: true,
                                    order: [[0, 'asc']],
                                    pageLength: 10,
                                    pagingType: 'simple',
                                    language: {
                                        paginate: {
                                            next: '<i class="fas fa-chevron-right"></i>',
                                            previous: '<i class="fas fa-chevron-left"></i>'
                                        }
                                    }
                                });
                            } else {
                                $('#table-header').empty();
                                $('#user-info-body').empty().append(`
                                    <tr>
                                        <td colspan="9" class="text-center">No data available for the selected filters.</td>
                                    </tr>
                                `);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching users:', error);
                        }
                    });
                } else {
                    $('#user-info-body').empty();
                    $('#table-header').empty();
                }
            });
        });
    </script>
@endsection
