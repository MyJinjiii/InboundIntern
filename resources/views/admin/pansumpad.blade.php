@extends('layouts/navigation')
@extends('layouts/sidebar')
@section('title')
    Interview Result
@endsection
@section('header')
    <h1 class="admissionstatus">Interview Result</h1>
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
    </style>
@if ($user_info->count() > 0)
    <div class="card">
        <table>
            <thead>
                <tr class="no-border-bottom">
                    <th style="border-radius: 20px 0 0 0;" class="number-column">No.</th>
                    <th>Name</th>
                    <th>Document</th>
                    <th>Status</th>
                    <th style="border-radius: 0 20px 0 0;">Comment</th>
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
                        <td id="advisorname">{{ $info->name }}&nbsp;{{ $info->surname }}
                        </td>
                        <td id="filecheck">
                            <button type="button" class="change-btn" data-bs-toggle="modal"
                                data-bs-target="#User_Profile{{ $info->id }}">
                                View Profile
                            </button>
                        </td>
                        <td id="Status">
                        </td>
                        <td id="usercomment">
                            <textarea maxlength="2000" readonly></textarea>
                        </td>
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
                                                value="{{ $info->year_of_study }}" class="border rounded px-4 py-2 w-full"
                                                readonly>
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
                @endforeach
            </tbody>

        </table>
        {!! $user_info->links() !!}

        <br><br>
    </div>
    @else
    <div class="alert alert-warning" role="alert" style="text-align: center; width: 50%; margin: 0 auto;"><i
            class="fa-solid fa-triangle-exclamation"></i> ไม่มี User ที่ผ่านสัมภาษณ์
    </div>
    @endif
@endsection
