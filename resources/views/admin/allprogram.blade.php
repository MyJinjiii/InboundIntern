@extends('layouts/navigation')
@extends('layouts/sidebar')
@section('title')
    All Programs
@endsection
@section('header')
    <h1 class="admissionstatus">All Programs</h1>
@endsection

@section('content')
    <style>
        table {
            width: 100%;
            margin: auto;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            margin: 0;
            vertical-align: middle;
            text-align: center;
        }

        th {
            text-align: center;
            padding: 12px;
            color: white;
            background-color: #044A9C;

            font-size: 18px;
        }

        tbody {
            margin-top: 20px;
        }

        .info-container {
            display: flex;
            align-items: center;
        }

        .custom-hr {
            width: 100%;
            margin-left: 10px;
            border-top: 1px solid #ddd;
        }

        textarea {
            width: 100%;
            resize: none;
        }

        .number-column {
            width: 20px;
        }

        @media only screen and (max-width: 768px) {
            .number-column {
                width: 30%;
            }
        }

        .no-border-bottom td {
            border-bottom: none;
        }

        .change-btn2 {
            border: 1px solid #ff0b03;
            border-color: #ff0000;
            border-radius: 10px;
            padding: 5px 15px;
            background-color: #ffffff;
            color: #9b0404;
            transition: background-color 0.3s, color 0.3s;
        }

        .change-btn2:hover {
            background-color: #c40000;
            color: #ffffff;
            border-color: #c40000;
        }

        .change-btn {
            border: 1px solid #04499b;
            border-color: #04499b;
            border-radius: 10px;
            padding: 5px 15px;
            background-color: #ffffff;
            color: #04499b;
            transition: background-color 0.3s, color 0.3s;
            position: absolute;

            right: 70px;
        }

        .change-btn:hover {
            background-color: #04499b;
            color: #ffffff;
        }

        .card {
            position: relative;
            margin-left: 200px;
            display: inline-block;
        }

        tbody tr:not(:last-child) {
            border-bottom: 1px solid #ddd;
        }

    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <br>
    @if ($research_list->count() > 0)
    <div class="card">
        <table>
            <thead>
                <tr class="no-border-bottom">
                    <th style="border-radius: 20px 0 0 0;" class="number-column">No.</th>
                    <th>Division</th>
                    <th>Program</th>
                    <th>Advisor name</th>
                    <th>Short introduction of laboratory and facilities</th>
                    <th>List of research topics</th>
                    <th>Other support</th>
                    <th style="border-radius: 0 20px 0 0;">Detail</th>
                    
                </tr>
            </thead>
            <tbody id="table-body">
                @foreach ($research_list as $research)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $research->division }}</td>
                        <td>{{ $research->program }}</td>
                        <td>{{ $research->prof_name }}</td>
                        <td style="text-align: left;">{{ $research->short }}</td>
                        <td style="text-align: left">{!! nl2br(e($research->topic)) !!}</td>
                        <td>{{ $research->support }}</td>
                        <td> {{ $research->details }} </td>
                    </tr>
                    
                @endforeach
                
            </tbody>

        </table>
        <script>
            function showAlert(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, submit it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('deleteForm').submit();
                        Swal.fire(
                            'Submitted!',
                            'Update success!',
                            'success'
                        )
                    }
                });
            }
        </script>
    </div>
    @else
    <div class="alert alert-warning" role="alert" style="text-align: center; width: 50%; margin: 0 auto;"><i
            class="fa-solid fa-triangle-exclamation"></i> ไม่มี Program
    </div>
    @endif
    <br><br>
    {!! $research_list->links() !!}
@endsection
