@extends('layouts/navigation')
@extends('layouts/sidebar')
@section('title')
    Approve Programs
@endsection
@section('header')
    <h1 class="admissionstatus">Approve Programs</h1>
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
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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

        .change-btndelete {
            border: 1px solid #f80000;
            border-color: #ff0000;
            border-radius: 10px;
            padding: 5px 15px;
            background-color: #ffffff;
            color: #ff0000;
            transition: background-color 0.3s, color 0.3s;
        }

        .change-btndelete:hover {
            background-color: #ff0000;
            color: #ffffff;
        }

        .card {
            position: relative;
            margin-left: 280px;
            display: inline-block;
        }

        .truncate-text {
            max-width: 150px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            cursor: pointer;
            color: blue;
        }

        .truncate-text:hover {
            color: red;
        }

        .change-btn {
            border: 1px solid #04499b;
            border-color: #04499b;
            border-radius: 10px;
            padding: 5px 15px;
            background-color: #ffffff;
            color: #04499b;
            transition: background-color 0.3s, color 0.3s;
        }

        .change-btn:hover {
            background-color: #04499b;
            color: #ffffff;
        }

        .change-btn1 {
            border: 1px solid #61cc09;
            border-color: #61cc09;
            border-radius: 10px;
            padding: 5px 15px;
            background-color: #ffffff;
            color: #61cc09;
            transition: background-color 0.3s, color 0.3s;
        }

        .change-btn1:hover {
            background-color: #228305;
            color: #ffffff;
            border-color: #228305;
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

        .custom-alert {
            width: 900px;
            /* ปรับตามความต้องการ */
            position: absolute;
            left: 50%;
            top: 20%;
            transform: translate(-50%, -50%);
            z-index: 1050;
            /* ให้มันอยู่ทับบนสุด */
            text-align: center;
            animation: hideAlert 12s forwards;
            /* ใช้ animation ให้หายไปภายใน 3 วินาที */
        }

        @keyframes hideAlert {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                display: none;
            }
        }

        .modal {
            background: rgba(0, 0, 0, 0.5) !important;
        }

        .modal-backdrop {
            display: none !important;
        }
    </style>
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show custom-alert" role="alert">
                {{ session('error') }}
            </div>
        @endif
    </div>
    @if ($research_list->count() > 0)
        <div class="card">
            <table>
                <thead>
                    <tr class="no-border-bottom">
                        <th style="border-radius: 20px 0 0 0;" class="number-column">No.</th>
                        <th>Division</th>
                        <th>Program</th>
                        <th>Advisor name</th>
                        <th>Short introduction of<br> laboratory and facilities</th>
                        <th>List of research topics</th>
                        <th>Other support</th>
                        <th>Detail</th>
                        <th style="border-radius: 0 20px 0 0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    </tr>
                </thead>
                <tbody id="table-body">

                    @foreach ($research_list as $research)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $research->division }}</td>
                            <td>{{ $research->program }}</td>
                            <td>{{ $research->prof_name }}</td>
                            <td>{{ $research->short }}</td>
                            <td style="text-align: left">{!! nl2br(e($research->topic)) !!}</td>
                            <td>{{ $research->support }}</td>
                            <td class="truncate-text"><a href="{{ $research->details }}" target="_blank">
                                    {{ $research->details }} </a></td>
                            <td>

                                <button data-bs-toggle="modal" href="#option{{ $research->id }}"
                                    class="change-btn">Option</button>
                            </td>
                        </tr>
                        <div class="modal fade" id="option{{ $research->id }}" tabindex="-1"
                            aria-labelledby="optionModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 600px;">
                                <div class="modal-content">
                                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3"
                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                    <h5 class="modal-title h1form" id="optionModalLabel" style="text-align: center">
                                        <br>Program Option
                                    </h5>
                                    <hr class="custom-hr">
                                    <div class="modal-body">
                                        Choose your option
                                    </div>
                                    <div class="modal-footer">
                                        <button data-bs-target="#approve{{ $research->id }}" data-bs-toggle="modal"
                                            data-bs-dismiss="modal" class="change-btn1">Approve Program</button><br>
                                        <button data-bs-target="#comment{{ $research->id }}" data-bs-toggle="modal"
                                            class="change-btn" data-bs-dismiss="modal">Not Approve
                                            Program</button>
                                        <button data-bs-target="#delete{{ $research->id }}" data-bs-toggle="modal"
                                            class="change-btn2" data-bs-dismiss="modal">Delete
                                            Program</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('allprogram.update', $research->id) }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="modal fade" id="approve{{ $research->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 450px;">
                                    <div class="modal-content">
                                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3"
                                            data-bs-dismiss="modal" aria-label="Close"></button>

                                        <h5 class="modal-title h1form" id="exampleModalLabel" style="text-align: center">
                                            <br>
                                            Approve Porgram
                                        </h5>
                                        <hr class="custom-hr">
                                        <div class="modal-body">
                                            <p>Are you sure you want to Approve this program?</p>
                                            @csrf
                                            @method('put')
                                            <div class="modal-footer">
                                                <div class="text-center">
                                                    <button type="submit" name="approve" class="change-btn1" value="1"
                                                        style="margin-right: 10px;">Approve</button>
                                                    <!-- Button to close the modal -->
                                                    <button type="button" class="change-btn2" data-bs-dismiss="modal"
                                                        aria-label="Close" style="margin-left: 10px;">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                        <form action="{{ route('Program.destroy', $research->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <div class="modal fade" id="delete{{ $research->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 450px;">
                                    <div class="modal-content">
                                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3"
                                            data-bs-dismiss="modal" aria-label="Close"></button>

                                        <h5 class="modal-title h1form" id="deleteModalLabel" style="text-align: center">
                                            <br>Confirm Deletion
                                        </h5>
                                        <hr class="custom-hr">
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this program?</p>
                                            <div class="modal-footer">
                                                <div class="text-center">
                                                    <button type="submit" class="change-btndelete"
                                                        style="margin-right: 10px;">Delete</button>
                                                    <button type="button" class="change-btn" data-bs-dismiss="modal"
                                                        style="margin-left: 10px;">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form action="{{ route('allprogram.researchnotapprove', $research->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal fade" id="comment{{ $research->id }}" tabindex="-1"
                                aria-labelledby="commentModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 450px;">
                                    <div class="modal-content">
                                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3"
                                            data-bs-dismiss="modal" aria-label="Close"></button>

                                        <h5 class="modal-title h1form" id="commentModalLabel" style="text-align: center">
                                            <br>Comment for advisor
                                        </h5>

                                        <hr class="custom-hr">
                                        <div class="modal-body">
                                            <textarea name="comment" class="form-control" required></textarea>
                                            <div class="modal-footer">
                                                <div class="text-center">
                                                    <button type="submit" name="approve" class="change-btn2"
                                                        value="2" style="margin-left: 10px;">Not Approve</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </tbody>
            </table>

            <br><br>
            {!! $research_list->links() !!}
        </div>
    @else
        <div class="alert alert-warning" role="alert" style="text-align: center; width: 50%; margin: 0 auto;"><i
                class="fa-solid fa-triangle-exclamation"></i> ไม่มีโปรแกรมให้ Approve ในตอนนี้
        </div>
    @endif


@endsection
