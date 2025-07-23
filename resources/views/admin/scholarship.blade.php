@extends('layouts/navigation')
@extends('layouts/sidebar')
@section('title')
    All Scholarship Applicants
@endsection
@section('header')
    <h1 class="admissionstatus">All Scholarship Applicants</h1>
@endsection
@section('content')
    <style>
        .h11 {
            color: #04499b;
            font-size: 35px;
            text-align: center;
        }

        .h12 {
            font-size: 20px;
            text-align: center;
            color: #04499b;
        }

        .flex-container {
            text-align: left;
            color: #04499b;
        }

        .BTNR {
            display: flex;
            justify-content: flex-end;
            /* Align items to the right */
        }

        .flex-container1 {
            text-align: right;
            color: #04499b;
            margin-right: 10px; 
        }

        .text-color {
            color: #04499b;
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

        .change-btn3 {
            border: 1px solid #04499b;
            border-color: #04499b;
            border-radius: 10px;
            padding: 5px 15px;
            background-color: #ffffff;
            color: #04499b;
            transition: background-color 0.3s, color 0.3s;
        }

        .change-btn3:hover {
            background-color: #122241;
            color: #ffffff;
            border-color: #122241;
        }

        table {
            width: 100%;
            margin: auto;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            margin: 0;
            border-bottom: 1px solid #ddd;
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
            justify-content: space-between;
            margin: 2.5%;
            margin-bottom: 0%;
        }

        .card {
            width: 65%;
            height: auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-color: #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06);
            margin: 5% auto;
        }

        .no-border-bottom td {
            border-bottom: none;
        }

        td {
            padding: 12px;
            color: #044A9C;
            vertical-align: top;
        }

        .h1form {
            font-size: 25px;
            color: #04499b;
        }

        .custom-hr {
            border: 1px;
            height: 2px;
            background-color: #007bff;
            margin: 20px 0;
            width: 100%;
        }

        .h1form {
            font-size: 25px;
            color: #04499b;
        }

        .bg-white {
            border: 2px solid #e2e8f0;
        }

        .rounded-lg {
            border-radius: 8px;
        }

        .fileviewer {
            border: 2px solid #04499b;
            border-radius: 8px;
            margin: 5px;
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

        input.rounded {
            border-radius: 50px !important;
        }

        .border {
            border: var(--bs-border-width) var(--bs-border-style) #007cf9 !important;
        }

        .rounded {
            border-radius: var(--bs-border-radius-xl) !important;
        }

        .modal {
            background: rgba(0, 0, 0, 0.5);
        }

        .modal-backdrop {
            display: none;
        }

        .parent {
            display: flex;
            justify-content: center;
            align-items: center;
            /* Adjust as needed */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show custom-alert" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($user_info->count() > 0)
        <div class="card">
            <table>
                <thead>
                    <tr class="no-border-bottom">
                        <th style="border-radius: 20px 0 0 0;" class="number-column">No.</th>
                        <th>Name</th>
                        <th>Profile</th>
                        <th>file</th>
                        <th>Status</th>
                        <th style="border-radius: 0 20px 0 0;"></th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php
                    $fromScholarship = isset($_GET['fromScholarship']) && $_GET['fromScholarship'] === 'true';
                    ?>

                    @foreach ($user_info as $info)
                        <tr class="no-border-bottom">
                            <td class="info-container" style="text-align: left;">
                                {{ ($user_info->currentPage() - 1) * $user_info->perPage() + $loop->iteration }}
                            </td>
                            <td style="text-align: left;">{{ $info->name }}&nbsp;{{ $info->surname }}
                            </td>
                            <td id="filecheck">
                                <button type="button" class="change-btn3" data-bs-toggle="modal"
                                    data-bs-target="#User_Profile{{ $info->info_id }}">
                                    View Profile
                                </button>
                            </td>
                            <td id>
                                <button type="button" class="change-btn3" data-bs-toggle="modal"
                                    data-bs-target="#User_file{{ $info->info_id }}">
                                    View file
                                </button>
                            </td>
                            <td style="text-align: center;">
                                @if ($info->confirm_right == 1)
                                    &nbsp;&nbsp;&nbsp;<a style="color: greenyellow;"><i
                                            class="fas fa-check-circle"></i></i>&nbsp;Confirmed</a>
                                @elseif($info->confirm_right == 2)
                                    &nbsp;&nbsp;&nbsp;<a style="color: rgb(168, 5, 5);"><i
                                            class="fa-solid fa-circle-xmark"></i>&nbsp;Declined</a>
                                @elseif($info->interview_result == 1)
                                    &nbsp;&nbsp;&nbsp;<a style="color: orange;"><i
                                            class="fa-solid fa-hourglass-start"></i>&nbsp;Wait
                                        for confirmation</a>
                                @elseif($info->interview_result == 2)
                                    &nbsp;&nbsp;&nbsp;<a style="color: rgb(168, 5, 5);"><i
                                            class="fa-solid fa-circle-xmark"></i>&nbsp;Not pass</a>
                                @elseif(
                                    $info->cv_status == 1 &&
                                        $info->motivation_status == 1 &&
                                        $info->passport_status == 1 &&
                                        $info->transcript_status == 1)
                                    &nbsp;&nbsp;&nbsp;<a style="color: orange;"><i
                                            class="fa-solid fa-circle-exclamation"></i>&nbsp;Waiting for interview</a>
                            </td>
                            <td>
                                <div class="flex-container">
                                    <button data-bs-toggle="modal" data-bs-target="#interview_result{{ $info->info_id }}"
                                        class="change-btn">Interview Result</button>
                                </div>
                            </td>
                        @elseif($info->comment)
                            <a style="color: orange;">&nbsp;&nbsp;&nbsp;<i
                                    class="fa-solid fa-circle-exclamation"></i>&nbsp;ไม่เรียบร้อย
                            </a>
                        @elseif(
                            $info->cv_status == 1 ||
                                $info->motivation_status == 1 ||
                                $info->passport_status == 1 ||
                                $info->transcript_status == 1)
                            <a style="color: orange;">&nbsp;&nbsp;&nbsp;<i
                                    class="fa-solid fa-circle-exclamation"></i>&nbsp;Some
                                file still not check
                            </a>
                        @elseif(
                            ($info->comment && $info->cv_status == 1) ||
                                $info->motivation_status == 1 ||
                                $info->passport_status == 1 ||
                                $info->transcript_status == 1)
                            <a style="color: orange;">&nbsp;&nbsp;&nbsp;<i
                                    class="fa-solid fa-circle-exclamation"></i>&nbsp;Wait
                                for edit file
                            </a>
                        @elseif($info->comment == null)
                            <a style="color: orange;">&nbsp;&nbsp;&nbsp;<i
                                    class="fa-solid fa-circle-exclamation"></i>&nbsp;Haven't checked
                            </a>
                    @endif
                    @if (isset($info->LAO_file))
                        <td><a href="{{ asset('storage/' . $info->LAO_file) }}" target="blank" class="change-btn3">View
                                LOA</a></td>
                    @elseif ($info->confirm_right == 1)
                        <td>
                            <button data-bs-toggle="modal" data-bs-target="#modal_LOA{{ $info->info_id }}"
                                class="change-btn3">Upload LOA</button>
                        </td>
                    @endif
                    </tr>

                    <div class="modal fade" id="User_Profile{{ $info->info_id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-body">
                                <div class="modal-content" style="padding: 20px;"><br>
                                    <div style="display: flex; justify-content: flex-end; margin-right: 15px;">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    @csrf
                                    <h1 class="h1form">Personal information</h1>
                                    <hr class="custom-hr"><br>
                                    <div class="form-container">
                                        <div class="mb-4 w-1 pr-2">
                                            <label for="email" class="block font-medium mb-2 it">Email</label>
                                            <input type="email" id="email" name="email"
                                                class="border rounded px-4 py-2 w-full" value="{{ $info->email }}"
                                                readonly>
                                        </div>
                                        <div class="flex mb-4 w-full pr-2">
                                            <div class="mb-4 w-1 pr-2">
                                                <label for="title" class="block font-medium mb-2 it">Title.</label>
                                                <input type="text" id="title" name="title"
                                                    class="border rounded px-4 py-2 w-full" value="{{ $info->title }}"
                                                    readonly>
                                            </div>
                                            <div class="mb-4 w-2 pr-2">
                                                <label for="name" class="block font-medium mb-2 it">Name</label>
                                                <input type="text" id="name" name="name"
                                                    class="border rounded px-4 py-2 w-full" value="{{ $info->name }}"
                                                    readonly>
                                            </div>
                                            <div class="mb-4 w-2 pr-2">
                                                <label for="surname" class="block font-medium mb-2 it">Surname</label>
                                                <input type="text" id="surname" name="surname"
                                                    class="border rounded px-4 py-2 w-full" value="{{ $info->surname }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex mb-4 w-full pr-2">
                                        <div class="mb-4 w-2 pr-2">
                                            <label for="tel" class="block font-medium mb-2 it">Phone Number
                                                with
                                                country code</label>
                                            <input type="tel" id="tel" name="tel"
                                                class="border rounded px-4 py-2 w-full" value="{{ $info->tel }}"
                                                pattern="^\+\d{1,3}\s?\d{3,}$" readonly>
                                        </div>
                                    </div><br>
                                    <h1 class="h1form">Education information</h1>
                                    <hr class="custom-hr"><br>
                                    <div class="flex mb-4 w-full pr-2">
                                        <div class="mb-4 w-1 pr-2">
                                            <label for="level_of_studies" class="block font-small mb-2 it">Level
                                                of
                                                Studies</label>
                                            <input type="text" id="level_of_studies" name="level_of_studies"
                                                value="{{ $info->level_of_studies }}"
                                                class="border rounded px-4 py-2 w-full" readonly>
                                        </div>
                                        <div class="mb-4 w-1 pr-2">
                                            <label for="year_of_study" class="block font-medium mb-2 it">Year
                                                of
                                                Study</label>
                                            <input type="text" id="year_of_study" name="year_of_study"
                                                value="{{ $info->year_of_study }}"
                                                class="border rounded px-4 py-2 w-full" readonly>
                                        </div>
                                        <div class="mb-4 w-2 pr-2">
                                            <label for="study_program" class="block font-medium mb-2 it">Study
                                                Program /
                                                Major</label>
                                            <input type="text" id="study_program" name="study_program"
                                                value="{{ $info->study_program }}"
                                                class="border rounded px-4 py-2 w-full" readonly>
                                        </div>
                                    </div>
                                    <div class="flex mb-4 w-full pr-2">
                                        <div class="mb-4 w-4 pr-2">
                                            <label for="faculty" class="block font-medium mb-2 it">Faculty</label>
                                            <input type="text" id="faculty" name="faculty"
                                                class="border rounded px-4 py-2 w-full"
                                                value="{{ $info->study_program }}" readonly>
                                        </div>
                                        <div class="mb-4 w-4 pr-2">
                                            <label for="university" class="block font-medium mb-2 it">University</label>
                                            <input type="text" id="university" name="university"
                                                class="border rounded px-4 py-2 w-full" value="{{ $info->university }}"
                                                readonly>
                                        </div>
                                        <div class="mb-4 w-4 pr-2">
                                            <label for="country" class="block font-medium mb-2 it">Country of
                                                university</label>
                                            <input type="text" id="country" name="country"
                                                class="border rounded px-4 py-2 w-full" value="{{ $info->university }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <br><br>
                                    <h1 class="h1form">Internship information</h1>
                                    <hr class="custom-hr"><br>
                                    @if ($fromScholarship)
                                        <div class="flex mb-4 w-full pr-2">
                                            <div class="mb-4 w-2 pr-2">
                                                <label for="Program_Focus" class="block font-medium mb-2 it">Research
                                                    topics of
                                                    interest</label>
                                                <input type="text" id="Program_Focus" name="Program_Focus"
                                                    class="border rounded px-4 py-2 w-full"
                                                    value="{{ $info->Program_Focus }}" readonly>
                                            </div>
                                            <div class="mb-4 w-2 pr-2">
                                                <label for="Program_Focus" class="block font-medium mb-2 it">Program
                                                    Focus</label>
                                                <input type="text" id="Program_Focus" name="Program_Focus"
                                                    class="border rounded px-4 py-2 w-full"
                                                    value="{{ $info->Program_Focus }}" readonly>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex mb-4 w-full pr-2">
                                            <div class="mb-4 w-2 pr-2">
                                                <label for="advisor" class="block font-medium mb-2 it">Name
                                                    of
                                                    PSU
                                                    Advisor (if
                                                    applicable)</label>
                                                <input type="text" id="advisor" name="advisor"
                                                    value="{{ $info->advisor }}" class="border rounded px-4 py-2 w-full"
                                                    readonly>
                                            </div>
                                            <div class="mb-4 w-2 pr-2">
                                                <label for="topic" class="block font-medium mb-2 it">Topic
                                                    of
                                                    Research
                                                    Focus</label>
                                                <input type="text" id="topic" name="topic"
                                                    value="{{ $info->topic }}" class="border rounded px-4 py-2 w-full"
                                                    readonly>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="flex mb-4 w-full pr-2">
                                        <div class="mb-4 w-2 pr-2">
                                            <label for="internship_duration" class="block font-medium mb-2 it">Internship
                                                Duration</label>
                                            <input type="text" id="internship_duration" name="internship_duration"
                                                value="{{ $info->internship_duration }}"
                                                class="border rounded px-4 py-2 w-full" readonly>
                                        </div>
                                        <div class="mb-4 w-2 pr-2">
                                            <label for="starting_date" class="block font-medium mb-2 it">Starting
                                                Date</label>
                                            <input type="date" id="starting_date" name="starting_date"
                                                class="border rounded px-4 py-2 w-full" value="{{ $info->start_date }}"
                                                readonly pattern="\d{1,2}/\d{1,2}/\d{4}">
                                        </div>
                                        <div class="mb-4 w-2 pr-2">
                                            <label for="ending_date" class="block font-medium mb-2 it">Ending
                                                Date</label>
                                            <input type="date" id="ending_date" name="ending_date"
                                                value="{{ $info->ending_date }}" class="border rounded px-4 py-2 w-full"
                                                readonly pattern="\d{1,2}/\d{1,2}/\d{4}">
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="User_file{{ $info->info_id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-body">
                                <div class="modal-content">
                                    <div
                                        style="display: flex; justify-content: flex-end; margin-right: 15px; padding-top: 20px;">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div><br>
                                    <h1 class="modal-title h1form " id="exampleModalLabel" style="text-align: center">
                                        Applicants required
                                        file
                                    </h1>
                                    <hr class="custom-hr">
                                    @if (
                                        $info->cv_status == 1 &&
                                            $info->motivation_status == 1 &&
                                            $info->passport_status == 1 &&
                                            $info->transcript_status == 1)
                                    @else
                                        <div class="flex-container1">
                                            <button type="button" class="change-btn" data-bs-toggle="modal"
                                                data-bs-target="#comment{{ $info->info_id }}">
                                                Comment
                                            </button>
                                        </div>
                                    @endif
                                    <form action="{{ route('post.scholarship', $info->info_id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="container overflow-hidden text-center">
                                            <div class="row gy-5">
                                                @if ($info->cv_status == 1)
                                                    <div class="col-6 ">
                                                        <div class="fileviewer">
                                                            <div class="p-4">
                                                                <label for="cv"
                                                                    class="block font-medium mb-2 it">Curriculum
                                                                    Vitae
                                                                    (CV)
                                                                </label>
                                                                <a href="{{ asset('storage/uploads/cv/' . $info->cv_file) }}"
                                                                    target="_blank" style="display: block; width: 100%;"
                                                                    class="border rounded px-4 py-2">
                                                                    <i class="fa-solid fa-file-pdf"></i>
                                                                    View
                                                                </a>
                                                                <input type="checkbox" id="cv_checkbox" name="cv_status"
                                                                    value="1" checked disabled class="ml-2 form-check-input">
                                                                <label for="cv_status" class="it">Approved</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-6">
                                                        <div class="fileviewer">
                                                            <div class="p-4">
                                                                <label for="cv"
                                                                    class="block font-medium mb-2 it">Curriculum
                                                                    Vitae
                                                                    (CV)
                                                                </label>
                                                                <a href="{{ asset('storage/uploads/cv/' . $info->cv_file) }}"
                                                                    target="_blank" style="display: block; width: 100%;"
                                                                    class="border rounded px-4 py-2"><i
                                                                        class="fa-solid fa-file-pdf"></i>
                                                                View
                                                                </a>
                                                                </button>
                                                                <input type="checkbox" id="cv_checkbox" name="cv_status"
                                                                    value="1" class="ml-2 form-check-input">
                                                                <label for="cv_status" class="it">Approve</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($info->transcript_status == 1)
                                                    <div class="col-6 ">
                                                        <div class="fileviewer">
                                                            <div class="p-4">
                                                                <label for="study_record"
                                                                    class="block font-medium mb-2 it">Study
                                                                    Record
                                                                    (Transcript)</label>
                                                                <a href="{{ asset('storage/uploads/transcript/' . $info->transcript_file) }}"
                                                                    target="_blank" style="display: block; width: 100%;"
                                                                    class="border rounded px-4 py-2"><i
                                                                        class="fa-solid fa-file-pdf"></i>
                                                                 View
                                                                </a>
                                                                <input type="checkbox" id="study_record_checkbox"
                                                                    name="study_record_status" value="1"
                                                                    class="ml-2 form-check-input" checked disabled>
                                                                <label for="study_record_checkbox"
                                                                    class="it">Approved</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-6">
                                                        <div class="fileviewer">
                                                            <div class="p-4">
                                                                <label for="study_record"
                                                                    class="block font-medium mb-2 it">Study
                                                                    Record
                                                                    (Transcript)</label>
                                                                <a href="{{ asset('storage/uploads/transcript/' . $info->transcript_file) }}"
                                                                    target="_blank" style="display: block; width: 100%;"
                                                                    class="border rounded px-4 py-2"><i
                                                                        class="fa-solid fa-file-pdf"></i>
                                                                View
                                                                </a>
                                                                <input type="checkbox" id="study_record_checkbox"
                                                                    name="study_record_status" value="1"
                                                                    class="ml-2 form-check-input">
                                                                <label for="study_record_checkbox"
                                                                    class="it">Approve</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($info->passport_status == 1)
                                                    <div class="col-6">
                                                        <div class="fileviewer">
                                                            <div class="p-4">
                                                                <label for="main_passport_page"
                                                                    class="block font-medium mb-2 it">Main
                                                                    Passport Page</label>
                                                                <a href="{{ asset('storage/uploads/passport/' . $info->passport_file) }}"
                                                                    target="_blank" style="display: block; width: 100%;"
                                                                    class="border rounded px-4 py-2"><i
                                                                        class="fa-solid fa-file-pdf"></i>
                                                                    View
                                                                </a>
                                                                </button>
                                                                <input type="checkbox" id="main_passport_page_checkbox"
                                                                    name="main_passport_page_status" value="1"
                                                                    class="ml-2 form-check-input" checked disabled>
                                                                <label for="main_passport_page_checkbox"
                                                                    class="it">Approved</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-6">
                                                        <div class="fileviewer">
                                                            <div class="p-4">
                                                                <label for="main_passport_page"
                                                                    class="block font-medium mb-2 it">Main
                                                                    Passport Page</label>
                                                                <a href="{{ asset('storage/uploads/passport/' . $info->passport_file) }}"
                                                                    target="_blank" style="display: block; width: 100%;"
                                                                    class="border rounded px-4 py-2"> <i
                                                                        class="fa-solid fa-file-pdf"></i>
                                                                    View
                                                                </a>
                                                                </button>
                                                                <input type="checkbox" id="main_passport_page_checkbox"
                                                                    name="main_passport_page_status" value="1"
                                                                    class="ml-2 form-check-input">
                                                                <label for="main_passport_page_checkbox"
                                                                    class="it">Approve</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($info->motivation_status == 1)
                                                    <div class="col-6">
                                                        <div class="fileviewer">
                                                            <div class="p-4">
                                                                <label for="motivation_letter"
                                                                    class="block font-medium mb-2 it">Motivation
                                                                    Letter</label>
                                                                <a href="{{ asset('storage/uploads/motivation/' . $info->motivation_file) }}"
                                                                    target="_blank" style="display: block; width: 100%;"
                                                                    class="border rounded px-4 py-2"><i
                                                                        class="fa-solid fa-file-pdf"></i>
                                                                    View
                                                                </a>
                                                                </button>
                                                                <input type="checkbox" id="motivation_letter_checkbox"
                                                                    name="motivation_letter_status" value="1"
                                                                    class="ml-2 form-check-input" checked disabled>
                                                                <label for="motivation_letter_checkbox"
                                                                    class="it">Approved</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-6">
                                                        <div class="fileviewer">
                                                            <div class="p-4">
                                                                <label for="motivation_letter"
                                                                    class="block font-medium mb-2 it">Motivation
                                                                    Letter</label>
                                                                <a href="{{ asset('storage/uploads/motivation/' . $info->motivation_file) }}"
                                                                    target="_blank" style="display: block; width: 100%;"
                                                                    class="border rounded px-4 py-2"> <i
                                                                        class="fa-solid fa-file-pdf"></i>
                                                                    View
                                                                </a>
                                                                </button>
                                                                <input type="checkbox" id="motivation_letter_checkbox"
                                                                    name="motivation_letter_status" value="1"
                                                                    class="ml-2 form-check-input">
                                                                <label for="motivation_letter_checkbox"
                                                                    class="it">Approve</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div><br>
                                            @if (
                                                $info->cv_status == 1 &&
                                                    $info->motivation_status == 1 &&
                                                    $info->passport_status == 1 &&
                                                    $info->transcript_status == 1)
                                            @else
                                                <div style="display: flex;justify-content: flex-end;">
                                                    <button type="submit" class="change-btn" style="width: 20%;"
                                                        onclick="showAlert(event)">
                                                        Submit
                                                    </button>
                                                </div>
                                                <br>
                                            @endif
                                            <br>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal_LOA{{ $info->info_id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-body">
                                <div class="modal-content" style="width: 70%;">
                                    <div
                                        style="display: flex; justify-content: flex-end; margin-right: 15px; padding-top: 20px;">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div><br>
                                    <h1 class="modal-title h1form " id="exampleModalLabel" style="text-align: center">
                                        Applicants required
                                        file
                                    </h1>
                                    <hr class="custom-hr">
                                    <form action="{{ route('LOA', ['info_id' => $info->info_id]) }}" method="POST"
                                        enctype="multipart/form-data" id="loaForm">
                                        @csrf
                                        <div class="parent">
                                            <div class="mb-6">
                                                <label for="fileInput{{ $info->info_id }}" class="change-btn3">Upload
                                                    LOA</label>
                                                <input name="loa" type="file" class="form-control"
                                                    id="fileInput{{ $info->info_id }}" style="display: none;"
                                                    onchange="updateLabel(this)">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="change-btn2"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="change-btn3">Upload</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="interview_result{{ $info->info_id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content" style="width: 500px">
                                <h5 class="modal-title h1form" id="exampleModalLabel" style="text-align: center">
                                    <br>
                                    Applicants required
                                    file
                                </h5>
                                <hr class="custom-hr">
                                <div class="modal-body">
                                    <div style="text-align: center;">
                                        <form action="{{ route('interview_result_scholarship', $info->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <button name="interview_result" type="submit" value="1"
                                                class="change-btn1" style="margin-right: 10%;">Accepted</button>
                                            <button name="interview_result" type="submit" value="2"
                                                class="change-btn2" style="margin-left: 10%;">Declined</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="comment{{ $info->info_id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-body">
                                <div class="modal-content">
                                    <div style="display: flex; justify-content: flex-end; margin-right: 15px;">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <h1 class="modal-title h1form " id="exampleModalLabel" style="text-align: center">
                                        Comment
                                    </h1>
                                    <hr class="custom-hr">
                                    <form action="{{ route('comment', ['info_id' => $info->info_id]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <textarea class="form-control" id="commentText" rows="3" placeholder="Enter your comment" name="comment"
                                                value="">  {{ $info->comment }}</textarea>
                                        </div>
                                        <div style="display: flex;justify-content: flex-end;">
                                            <button type="submit" class="change-btn" style="width: 20%;">
                                                Submit
                                            </button>
                                        </div>
                                        <br>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
    @endforeach
    </tbody>
    </table>
    {!! $user_info->links() !!}
    <br><br>

    </div>
    <script>
        function updateLabel(input) {
            const label = document.querySelector(`label[for="${input.id}"]`);
            const fileName = input.files.length > 0 ? input.files[0].name : 'Upload';
            label.textContent = fileName;
        }
    </script>
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
                    event.target.form.submit();
                    Swal.fire(
                        'Submitted!',
                        'Update success!',
                        'success'
                    )
                }
            })
        }
    </script>
@else
    <div class="alert alert-warning" role="alert" style="text-align: center; width: 50%; margin: 0 auto;"><i
            class="fa-solid fa-triangle-exclamation"></i> ไม่มี User
    </div>
    @endif
@endsection
