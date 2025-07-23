@extends('layouts/navigation')
@section('title')
    Advisor
@endsection
@section('header')
    <h1 class="admissionstatus">Advisor </h1>
@endsection

@section('content')
    <style>
        table {
            width: 100%;
            margin: auto;
        }

        th,
        td {
            padding: 10px;

        }

        th {
            background-color: #04499b;
            color: #ffffff;
            text-align: center;
        }

        th:first-child {
            border-radius: 20px 0 0 0;
        }

        th:last-child {
            border-radius: 0 20px 0 0;
        }

        @media (max-width: 768px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            th {
                border-radius: 0;

            }

            th:first-child {
                border-radius: 20px 20px 0 0;
            }

            th:last-child {
                border-radius: 0 0 20px 20px;
            }

            tr {
                margin-bottom: 10px;
            }

            th,
            td {

                padding-left: 50%;
                position: relative;
            }

            th::before,
            td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 10px;
                font-weight: bold;

            }
        }

        tbody {
            margin-top: 20px
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

        .pagination {
            display: flex;
            /* Enable flexbox for the container */
            justify-content: space-between;
            /* Distribute buttons evenly */
            margin: 2.5%;
            margin-bottom: 0%;
        }

        .advisor-btn {
            border: 1px solid #04499b;
            border-color: #04499b;
            border-radius: 10px;
            padding: 5px;
            background-color: #ffffff;
            color: #04499b;
            transition: background-color 0.3s, color 0.3s;
            margin-right: 20px;
            width: 100%;
        }

        .advisor-btn:hover {
            background-color: #04499b;
            color: #ffffff;
        }

        .custom-alert {
            width: 900px;

            position: absolute;
            left: 50%;
            top: 18%;
            transform: translate(-50%, -50%);
            z-index: 1050;

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

        .custom-alert2 {
            width: 900px;
            position: absolute;
            left: 50%;
            top: 18%;
            transform: translate(-50%, -50%);
            z-index: 1050;
            text-align: center;
        }

        .modal {
            background: rgba(0, 0, 0, 0.5) !important;
        }

        .modal-backdrop {
            display: none !important;
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

        .textcolor {
            color: #04499b;
            font-size: 17px;
        }
    </style>
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

    @if (count($research_list) > 0)
        <div class="card" style="margin-bottom: 60px;">
            <table>
                <thead>
                    <tr>
                        <th style="border-radius: 20px 0 0 0;" class="number-column">No.</th>
                        <th>Division</th>
                        <th>Program</th>
                        <th>Advisor name</th>
                        <th>Short introduction of laboratory and facilities</th>
                        <th>List of research topics</th>
                        <th>Other support</th>
                        <th>Detail</th>
                        <th style="border-radius: 0 20px 0 0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($research_list as $research)
                        <tr>
                            <td>{{ ($research_list->currentPage() - 1) * $research_list->perPage() + $loop->iteration }}
                            </td>
                            <td>{{ $research->division }}</td>
                            <td>{{ $research->program }}</td>
                            <td>{{ $research->prof_name }}</td>
                            <td style="text-align: left">{{ $research->short }}</td>
                            <td style="text-align: left">{!! nl2br(e($research->topic)) !!}</td>
                            <td style="text-align: center">{{ $research->support }}</td>
                            <td><button class="advisor-btn"><a href="{{ $research->details }}" target="blank">More
                                        detail</a></button></td>
                            <td>
                                @if ($research->approve == 1)
                                    <button class="advisor-btn"><a href="{{ route('Advisor.show') }}">Student apply
                                        </a></button>
                                @elseif($research->approve == 2)
                                    <button data-bs-toggle="modal" href="#option{{ $research->id }}"
                                        class="change-btn">Option</button>
                                    <div class="modal fade" id="option{{ $research->id }}" tabindex="-1"
                                        aria-labelledby="optionModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 600px;">
                                            <div class="modal-content">
                                                <button type="button" class="btn-close position-absolute top-0 end-0 m-3"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                <h5 class="modal-title h1form" id="optionModalLabel"
                                                    style="text-align: center">
                                                    <br>Program Option
                                                </h5>
                                                <hr class="custom-hr">
                                                @foreach ($research_list as $research)
                                                    @if (isset($comments[$research->id]) && $comments[$research->id])
                                                        <div class="modal-body">
                                                            Comment : <a>{{ $comments[$research->id]->comment }}</a>
                                                        </div>
                                                    @else
                                                        <div class="modal-body">
                                                            Comment : <a>No comments</a>
                                                        </div>
                                                    @endif
                                                @endforeach

                                                <div class="modal-footer">
                                                    <button data-bs-target="#edit{{ $research->id }}"
                                                        data-bs-toggle="modal" data-bs-dismiss="modal"
                                                        class="change-btn">Edit Program</button><br>
                                                    <button data-bs-target="#delete{{ $research->id }}"
                                                        data-bs-toggle="modal" class="change-btn2"
                                                        data-bs-dismiss="modal">Delete
                                                        Program</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Modal -->
                                    <form action="{{ route('Program.update', $research->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="modal fade" id="edit{{ $research->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <h5 class="modal-title h1form" id="editModalLabel"
                                                        style="text-align: center"><br>Edit Program</h5>
                                                    <hr class="custom-hr">
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <!-- Division -->
                                                            <div class="form-group row align-items-center mb-3">
                                                                <label for="division"
                                                                    class="col-sm-3 col-form-label textcolor">Division:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="division"
                                                                        class="form-control"
                                                                        value="{{ $research->division }}" required>
                                                                </div>
                                                            </div>

                                                            <!-- Program -->
                                                            <div class="form-group row align-items-center mb-3">
                                                                <label for="program"
                                                                    class="col-sm-3 col-form-label textcolor">Program:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="program"
                                                                        class="form-control"
                                                                        value="{{ $research->program }}" required>
                                                                </div>
                                                            </div>

                                                            <!-- Advisor name -->
                                                            <div class="form-group row align-items-center mb-3">
                                                                <label for="prof_name"
                                                                    class="col-sm-3 col-form-label textcolor">Advisor
                                                                    name:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="prof_name"
                                                                        class="form-control"
                                                                        value="{{ $research->prof_name }}" required>
                                                                </div>
                                                            </div>

                                                            <!-- Short introduction -->
                                                            <div class="form-group row align-items-center mb-3">
                                                                <label for="short"
                                                                    class="col-sm-3 col-form-label textcolor">Short
                                                                    introduction:</label>
                                                                <div class="col-sm-9">
                                                                    <textarea name="short" class="form-control" rows="3" required>{{ $research->short }}</textarea>
                                                                </div>
                                                            </div>

                                                            <!-- List of research topics -->
                                                            <div class="form-group row align-items-center mb-3">
                                                                <label for="topic"
                                                                    class="col-sm-3 col-form-label textcolor">List of
                                                                    research topics:</label>
                                                                <div class="col-sm-9">
                                                                    <textarea name="topic" class="form-control" rows="3" required>{{ $research->topic }}</textarea>
                                                                </div>
                                                            </div>

                                                            <!-- Other support -->
                                                            <div class="form-group row align-items-center mb-3">
                                                                <label for="support"
                                                                    class="col-sm-3 col-form-label textcolor">Other
                                                                    support:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="support"
                                                                        class="form-control"
                                                                        value="{{ $research->support }}" >
                                                                </div>
                                                            </div>

                                                            <!-- Detail -->
                                                            <div class="form-group row align-items-center mb-3">
                                                                <label for="details"
                                                                    class="col-sm-3 col-form-label textcolor">Detail:</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="details"
                                                                        class="form-control"
                                                                        value="{{ $research->details }}" >
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <div class="text-center">
                                                                <button type="submit" class="change-btn"
                                                                    style="margin-right: 10px;">Save changes</button>
                                                                <button type="button" class="change-btn2"
                                                                    data-bs-dismiss="modal"
                                                                    style="margin-left: 10px;">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <a style="color: orange; "><i class="fa-solid fa-hourglass-start"></i> &nbsp;Wait for
                                        Approve</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <br><br>
            <!-- แสดงลิงก์เปลี่ยนหน้า -->
            {!! $research_list->links() !!}
        </div>
    @else
        <div class="alert alert-warning" role="alert" style="text-align: center; width: 50%; margin: 0 auto;"><i
                class="fa-solid fa-triangle-exclamation"></i> คุณยังไม่มีโปรแกรมขณะนี้กรุณาสมัคร
        </div>
        <a href="{{ route('Advisor.create') }}" class="change-btn" style="margin-left: 80%;">
            Program Create </a>
    @endif
    {!! $research_list->links() !!}
    @foreach ($research_list as $research)
        @if ($research->approve == 2)
            <div class="alert alert-danger alert-dismissible fade show custom-alert2" role="alert">
                โปรแกรมไม่ผ่านโปรดกดปุ่ม Option เพื่อแก้ไขหรือลบโปรแกรม
            </div>
        @endif
    @endforeach

@endsection
