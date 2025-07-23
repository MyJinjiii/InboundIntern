@extends('layouts/navigation')
@section('title')
    Application Status
@endsection

@section('log')
    Logout
@endsection

@section('header')
    <h1 class="admissionstatus">Application Status</h1>
@endsection
<?php $fromScholarship = false; // or false, depending on your logic ?>
@section('content')
    <style>
        table {
            width: 100%;
            margin: auto;
        }

        th {
            text-align: center;
            padding: 12px;
            color: white;
            background-color: #044A9C;
        }

        td {
            text-align: center;
            padding: 12px;
            color: #044A9C;
            vertical-align: top;
        }

        tbody {
            margin-top: 20px
        }

        .info-container {
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

        .buttonstatus-container {
            text-align: center;
            margin: 20px 0;
            color: #044A9C;
        }

        .status-button {
            padding: 10px 20px;
            margin: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .h12 {
            font-size: 20px;
            text-align: center;
            color: #04499b;
        }

        .h13 {
            font-size: 16px;
            text-align: center;
            color: #04499b;
        }

        .info1 {
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
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

        .custom-alert {
            width: 900px;
            /* ปรับตามความต้องการ */
            position: absolute;
            left: 50%;

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

        .btn-close {
            position: absolute;
            top: 5px;
            right: 5px;
            border: none;
            background: transparent;
            color: #fff;
            /* Change to match alert background */
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
    </style><br>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @foreach ($userInfoAndStatus as $item)
        <div id="info1">
            <div class="card">
                <table>
                    <tr>
                        <th style="border-radius: 20px 0 0 0;">Information</th>
                        <th>Status</th>
                        <th>Comment</th>
                        <th style="border-radius: 0 20px 0 0;">Action</th>
                    </tr>
                    <tr>
                        <td class="info-container" style="text-align: center;">Personal Information</td>

                        <td style="color: greenyellow;">
                            &nbsp;&nbsp;&nbsp;<i class="fas fa-check-circle"></i>&nbsp;Completed
                        </td>
                        <td></td>
                        <td id="personaledit">
                            <button data-bs-toggle="modal" data-bs-target="#modal_person{{ $item->info_id }}"
                                class="change-btn">Edit</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <br><br>
                            <hr class="custom-hr">
                        </td>
                    </tr>
                    @if (session()->has('success'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: '{{ session()->get('success') }}'
                                });
                            });
                        </script>
                    @endif
                    <tr>
                        <td class="info-container" style="text-align: center;">Education Information</td>

                        <td style="color: greenyellow;">
                            &nbsp;&nbsp;&nbsp;<i class="fas fa-check-circle"></i>&nbsp;Completed
                        </td>
                        <td>
                            <br><br><br>

                        </td>
                        <td id="educationedit">
                            <button data-bs-toggle="modal" data-bs-target="#modal_edu{{ $item->info_id }}"
                                class="change-btn">Edit</button>
                            {{-- <button class="fileedit change-btn">
                                    <i class="fas fa-pen-to-square"></i> Edit
                                </button> --}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <hr class="custom-hr">
                        </td>
                    </tr>
                    <tr>
                        <td class="info-container" style="text-align: center;">Required document</td>
                        @if (
                            $item->cv_status == 1 &&
                                $item->motivation_status == 1 &&
                                $item->passport_status == 1 &&
                                $item->transcript_status == 1)
                            <td style="color: greenyellow;"> &nbsp;&nbsp;&nbsp;<i
                                    class="fas fa-check-circle"></i></i>&nbsp;Completed</td>
                        @elseif(
                            $item->cv_status == 1 ||
                                $item->motivation_status == 1 ||
                                $item->passport_status == 1 ||
                                $item->transcript_status == 1 ||
                                $item->comment)
                            <td style="color: orange;"> &nbsp;&nbsp;<i
                                    class="fa-solid fa-circle-exclamation"></i>&nbsp;บางไฟล์ยังไม่ผ่าน</td>
                        @else
                            <td style="color: orange;"> &nbsp;&nbsp;<i class="fa-solid fa-hourglass-start"></i>&nbsp;To be
                                reviewed</td>
                        @endif

                        <td>
                            @if ($item->interview_right == 0)
                                @if (isset($item->comment) && !empty($item->comment))
                                    <textarea readonly style="color: red;">  {{ $item->comment }} </textarea>
                                @elseif($item->interview_right == 1)
                                    <sub>ผู้ตรวจ : {{ $item->admin_accept_name }}</sub>
                                @else
                                @endif
                            @endif
                            <br><br>
                        </td>
                        <td id="fileedit">
                            <button data-bs-toggle="modal" data-bs-target="#modal_file{{ $item->info_id }}"
                                class="change-btn">Edit</button><br><br><br>
                        </td>
                    </tr>
                    @if ($fromScholarship)
                        <tr>
                            <td colspan="4">
                                <hr class="custom-hr">
                            </td>
                        </tr>
                        <tr>
                            <td class="info-container" style="text-align: center;">Acceptance from Prof.</td>
                            <td></td>
                            <td>
                                <div style="color: orange;">
                                    &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-hourglass-start"></i>&nbsp;Pending
                                </div>
                            </td>
                            <td>
                                <br><br><br>
                            </td>
                        </tr>
                    @endif
                    @if (
                        $item->cv_status == 1 &&
                            $item->motivation_status == 1 &&
                            $item->passport_status == 1 &&
                            $item->transcript_status == 1)
                        <tr>
                            <td colspan="4">
                                <hr class="custom-hr">
                            </td>
                        </tr>
                        <tr>
                            <td class="info-container" style="text-align: center;">Contect</td>
                            <td>

                            </td>
                            <td>
                                <p style="font-size: 20px">โปรดติดต่ออาจารย์เพื่อนัดวันสัมภาษณ์ผ่านทางอีเมลล์</p>
                                <p style="font-size: 15px">*หากอาจารย์ไม่ได้ติดต่อกลับภายใน 5-7 วันให้ทำการติดต่อผ่านเมลล์
                                    วิเทศ*</p>
                            </td>
                            <td>
                                International Relations Email: sci.inter@psu.ac.th <br>
                                Advisor Email : {{ $item->advisor_email }}
                            </td>
                        @else
                    @endif
                    </tr>
                    @if (
                        $item->cv_status == 1 &&
                            $item->motivation_status == 1 &&
                            $item->passport_status == 1 &&
                            $item->transcript_status == 1)
                        <tr>
                            <td colspan="4">
                                <hr class="custom-hr">
                            </td>
                        </tr>
                        <tr>

                            <td class="info-container" style="text-align: center;">Interview result</td>
                            <td>

                            </td>

                            @if ($item->interview_result == 2)
                                <td style="color: red;">
                                    &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-circle-xmark"></i>&nbsp;Not Pass
                                </td>
                            @elseif ($item->interview_result == 1)
                                <td style="color: greenyellow;">
                                    &nbsp;&nbsp;&nbsp;<i class="fas fa-check-circle"></i>&nbsp;Completed
                                </td>
                            @else
                                <td style="color: greenyellow;">
                                    &nbsp;&nbsp;&nbsp;&nbsp;<a style="color: orange;"><i
                                            class="fa-solid fa-hourglass-start"></i> &nbsp;Pending</a>
                                </td>
                            @endif
                            </td>


                            <td>
                                <br><br><br>
                            </td>
                        @else
                    @endif
                    </tr>
                    @if ($item->interview_result == 2)
                    @elseif ($item->interview_result == 1)
                        <tr>
                            <td colspan="4">
                                <hr class="custom-hr">
                            </td>
                        </tr>
                        <tr>
                            <td class="info-container">Internship confirmation</td>
                            <td></td>
                            @if ($item->confirm_right == 1)
                                <td style="color: greenyellow;"> &nbsp;&nbsp;&nbsp;<i
                                        class="fas fa-check-circle"></i></i>&nbsp;Completed<br><br></td>
                            @elseif($item->confirm_right == 2)
                                <td style="color: rgb(255, 0, 0);">
                                    &nbsp;&nbsp;&nbsp;<i class="fa-regular fa-circle-xmark"></i>&nbsp;Declined
                                    <br><br>
                                </td>
                            @else
                                <td style="color: orange;">
                                    &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-hourglass-start"></i>&nbsp;To be reviewed
                                    <br><br>
                                </td>
                            @endif
                            <td>
                                @if ($item->confirm_right == 1)
                                @elseif($item->confirm_right == 2)
                                @else
                                    <div class="flex-container">

                                        <button type="button" class="change-btn" data-bs-toggle="modal"
                                            data-bs-target="#confirm_right{{ $item->id }}"
                                            onclick="openConfirmationModal()">
                                            Confirmation
                                        </button>
                                    </div>
                                @endif
                                <br><br>
                            </td>

                        </tr>
                        @if ($item->confirm_right == 1)
                            <tr>
                                <td colspan="4">
                                    <hr class="custom-hr">
                                </td>
                            </tr>
                            <tr>
                                <td class="info-container">Letter of Acceptance</td>
                                <td>

                                </td>
                                <td>
                                    @foreach ($loa as $loa)
                                        @if (isset($loa))
                                            <a href="{{ asset('storage/' . $loa->LAO_file) }}" class="confirmBtn change-btn"
                                                download>Download LOA</a>
                                        @else
                                            <a style="color: orange;">
                                                &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-hourglass-start"></i>&nbsp;LOA
                                                (Waiting)
                                            </a>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <br><br><br>
                                </td>
                            </tr>
                        @endif
                    @endif
                </table>

            </div>
        </div>

        <div class="modal fade" id="modal_person{{ $item->info_id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-body">
                    <div class="modal-content" style="padding: 16px">
                        <div style="display: flex; justify-content: flex-end; margin-right: 15px;">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <h1 class="modal-title h1form " id="exampleModalLabel" style="text-align: center">
                            Personal Information
                        </h1>
                        @if ($edit->edit_status == 1)
                            <form action="{{ route('person_update', $item->info_id) }}" method="POST"
                                enctype="multipart/form-data" class="flex flex-wrap">
                                @csrf
                                <hr class="custom-hr"><br>
                                <div class="mb-4 w-1 pr-2">
                                    <label for="email" class="block font-medium mb-2 it">Email</label>
                                    <input type="email" id="email" name="email" value="{{ $item->email }}"
                                        class="border rounded px-4 py-2 w-full">
                                </div>
                                <div class="mb-4 w-1 pr-2">
                                    <label for="title" class="block font-medium mb-2 it">Title.</label>
                                    <input type="text" id="title" name="title" value="{{ $item->title }}"
                                        class="border rounded px-4 py-2 w-full">
                                </div>
                                <div class="mb-4 w-2 pr-2">
                                    <label for="name" class="block font-medium mb-2 it">Name</label>
                                    <input type="text" id="name" name="name" value="{{ $item->name }}"
                                        class="border rounded px-4 py-2 w-full">
                                </div>
                                <div class="mb-4 w-2 pr-2">
                                    <label for="surname" class="block font-medium mb-2 it">Surname</label>
                                    <input type="text" id="surname" name="surname"
                                        value="{{ $item->surname }}"class="border rounded px-4 py-2 w-full">
                                </div>
                                <div class="mb-4 w-2 pr-2">
                                    <label for="tel" class="block font-medium mb-2 it">Phone Number with country
                                        code</label>
                                    <input type="tel" id="tel" name="tel"
                                        value="{{ $item->tel }}"class="border rounded px-4 py-2 w-full"
                                        pattern="^\+\d{1,3}\s?\d{3,}$">
                                </div>
                                <div class="flex-container1 flex justify-end w-full">
                                    <button type="submit" class="change-btn">Save</button>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('person_update', $item->info_id) }}" method="POST"
                                enctype="multipart/form-data" class="flex flex-wrap">
                                @csrf
                                <hr class="custom-hr"><br>
                                <div class="mb-4 w-1 pr-2">
                                    <label for="email" class="block font-medium mb-2 it">Email</label>
                                    <input type="email" id="email" name="email" value="{{ $item->email }}"
                                        class="border rounded px-4 py-2 w-full" readonly>
                                </div>
                                <div class="mb-4 w-1 pr-2">
                                    <label for="title" class="block font-medium mb-2 it">Title.</label>
                                    <input type="text" id="title" name="title" value="{{ $item->title }}"
                                        class="border rounded px-4 py-2 w-full" readonly>
                                </div>
                                <div class="mb-4 w-2 pr-2">
                                    <label for="name" class="block font-medium mb-2 it">Name</label>
                                    <input type="text" id="name" name="name" value="{{ $item->name }}"
                                        class="border rounded px-4 py-2 w-full" readonly>
                                </div>
                                <div class="mb-4 w-2 pr-2">
                                    <label for="surname" class="block font-medium mb-2 it">Surname</label>
                                    <input type="text" id="surname" name="surname"
                                        value="{{ $item->surname }}"class="border rounded px-4 py-2 w-full" readonly>
                                </div>
                                <div class="mb-4 w-2 pr-2">
                                    <label for="tel" class="block font-medium mb-2 it">Phone Number with country
                                        code</label>
                                    <input type="tel" id="tel" name="tel"
                                        value="{{ $item->tel }}"class="border rounded px-4 py-2 w-full"
                                        pattern="^\+\d{1,3}\s?\d{3,}$" readonly>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <div class="alert alert-danger alert-dismissible fade show custom-alert1" role="alert">
                                    <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i> ปิดการแก้ไขแล้ว!
                                </div>
                            </div>
                        @endif
                        <br>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        {{-- - MODAL EDIT EDU - --}}
        <div class="modal fade" id="modal_edu{{ $item->info_id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-body">
                    <div class="modal-content" style="padding: 16px;">
                        <div style="display: flex; justify-content: flex-end; margin-right: 15px;">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <h1 class="modal-title h1form " id="exampleModalLabel" style="text-align: center">
                            Education Information
                        </h1>
                        @if ($edit->edit_status == 1)
                            <form action="{{ route('edu_update', $item->info_id) }}" method="POST"
                                enctype="multipart/form-data" class="flex flex-wrap">
                                @csrf
                                <hr class="custom-hr"><br>
                                <div class="mb-4 w-1 pr-2">
                                    <label for="level_of_studies" class="block font-small mb-2 it">Level of
                                        Studies</label>
                                    <input type="text" id="level_of_studies" name="level_of_studies"
                                        value="{{ $item->level_of_studies }}" class="border rounded px-4 py-2 w-full">
                                </div>
                                <div class="mb-4 w-1 pr-2">
                                    <label for="year_of_study" class="block font-medium mb-2 it">Year of Study</label>
                                    <input type="text" id="year_of_study" name="year_of_study"
                                        value="{{ $item->year_of_study }}" class="border rounded px-4 py-2 w-full">
                                </div>
                                <div class="mb-4 w-2 pr-2">
                                    <label for="study_program" class="block font-medium mb-2 it">Study Program /
                                        Major</label>
                                    <input type="text" id="study_program" name="study_program"
                                        value="{{ $item->study_program }}" class="border rounded px-4 py-2 w-full">
                                </div>
                                <div class="mb-4 w-4 pr-2">
                                    <label for="faculty" class="block font-medium mb-2 it">Faculty</label>
                                    <input type="text" id="faculty" name="faculty" value="{{ $item->faculty }}"
                                        class="border rounded px-4 py-2 w-full">
                                </div>
                                <div class="mb-4 w-4 pr-2">
                                    <label for="university" class="block font-medium mb-2 it">University</label>
                                    <input type="text" id="university" name="university"
                                        value="{{ $item->university }}"class="border rounded px-4 py-2 w-full">
                                </div>
                                <div class="mb-4 w-4 pr-2">
                                    <label for="country" class="block font-medium mb-2 it">Country of university</label>
                                    <input type="text" id="country" name="country" value="{{ $item->country }}"
                                        class="border rounded px-4 py-2 w-full">
                                </div>
                                <br>
                                <hr class="custom-hr"><br>
                                @if ($fromScholarship == false)
                                    <div class="mb-4 w-2 pr-2">
                                        <label for="topic" class="block font-medium mb-2 it">Research topics of
                                            interest</label>
                                        <input type="text" id="topic" name="topic" value="{{ $item->topic }}"
                                            class="border rounded px-4 py-2 w-full" readonly>
                                    </div>
                                    <div class="mb-4 w-2 pr-2">
                                        <label for="advisor" class="block font-medium mb-2 it">Name of PSU Advisor (if
                                            applicable)</label>
                                        <input type="text" id="advisor" name="advisor"
                                            value="{{ $item->advisor }}" class="border rounded px-4 py-2 w-full"
                                            readonly>
                                    </div>
                                @else
                                    <div class="mb-4 w-2 pr-2">
                                        <label for="program_focus" class="block font-medium mb-2 it">Program Focus</label>
                                        <input type="text" id="program_focus" name="program_focus"
                                            class="border rounded px-4 py-2 w-full" value="{{ $item->program_focus }}"
                                            readonly>
                                        <label for="topic" class="block font-medium mb-2 it">Topic of Research
                                            Focus</label>
                                        <input type="text" id="topic" name="topic" value="{{ $item->topic }}"
                                            class="border rounded px-4 py-2 w-full" readonly>
                                    </div>
                                @endif
                                <div class="mb-4 w-1 pr-2">
                                    <label for="internship_duration" class="block font-medium mb-2 it">Internship
                                        Duration</label>
                                    <input type="text" id="internship_duration" name="internship_duration"
                                        value="{{ $item->internship_duration }}" class="border rounded px-4 py-2 w-full">
                                </div>
                                <div class="mb-4 w-1 pr-2">
                                    <label for="start_date" class="block font-medium mb-2 it">Starting Date</label>
                                    <input type="date" id="start_date" name="start_date"
                                        value="{{ $item->start_date }}" class="border rounded px-4 py-2 w-full"
                                        pattern="\d{1,2}/\d{1,2}/\d{4}">
                                </div>
                                <div class="mb-4 w-1 pr-2">
                                    <label for="ending_date" class="block font-medium mb-2 it">Ending Date</label>
                                    <input type="date" id="ending_date" name="ending_date"
                                        value="{{ $item->ending_date }}" class="border rounded px-4 py-2 w-full"
                                        pattern="\d{1,2}/\d{1,2}/\d{4}">
                                </div>
                                <div class="flex-container1 flex justify-end w-full">
                                    <button type="submit" class="change-btn">Save</button>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('edu_update', $item->info_id) }}" method="POST"
                                enctype="multipart/form-data" class="flex flex-wrap">
                                @csrf
                                <hr class="custom-hr"><br>
                                <div class="mb-4 w-1 pr-2">
                                    <label for="level_of_studies" class="block font-small mb-2 it">Level of
                                        Studies</label>
                                    <input type="text" id="level_of_studies" name="level_of_studies"
                                        value="{{ $item->level_of_studies }}" class="border rounded px-4 py-2 w-full"
                                        readonly>
                                </div>
                                <div class="mb-4 w-1 pr-2">
                                    <label for="year_of_study" class="block font-medium mb-2 it">Year of Study</label>
                                    <input type="text" id="year_of_study" name="year_of_study"
                                        value="{{ $item->year_of_study }}" class="border rounded px-4 py-2 w-full"
                                        readonly>
                                </div>
                                <div class="mb-4 w-2 pr-2">
                                    <label for="study_program" class="block font-medium mb-2 it">Study Program /
                                        Major</label>
                                    <input type="text" id="study_program" name="study_program"
                                        value="{{ $item->study_program }}" class="border rounded px-4 py-2 w-full"
                                        readonly>
                                </div>
                                <div class="mb-4 w-4 pr-2">
                                    <label for="faculty" class="block font-medium mb-2 it">Faculty</label>
                                    <input type="text" id="faculty" name="faculty" value="{{ $item->faculty }}"
                                        class="border rounded px-4 py-2 w-full" readonly>
                                </div>
                                <div class="mb-4 w-4 pr-2">
                                    <label for="university" class="block font-medium mb-2 it">University</label>
                                    <input type="text" id="university" name="university"
                                        value="{{ $item->university }}"class="border rounded px-4 py-2 w-full" readonly>
                                </div>
                                <div class="mb-4 w-4 pr-2">
                                    <label for="country" class="block font-medium mb-2 it">Country of university</label>
                                    <input type="text" id="country" name="country" value="{{ $item->country }}"
                                        class="border rounded px-4 py-2 w-full" readonly>
                                </div>
                                <br>
                                <hr class="custom-hr"><br>

                                @if ($fromScholarship == false)
                                    <div class="mb-4 w-2 pr-2">
                                        <label for="topic" class="block font-medium mb-2 it">Research topics of
                                            interest</label>
                                        <input type="text" id="topic" name="topic" value="{{ $item->topic }}"
                                            class="border rounded px-4 py-2 w-full" readonly>
                                    </div>
                                    <div class="mb-4 w-2 pr-2">
                                        <label for="advisor" class="block font-medium mb-2 it">Name of PSU Advisor (if
                                            applicable)</label>
                                        <input type="text" id="advisor" name="advisor"
                                            value="{{ $item->advisor }}" class="border rounded px-4 py-2 w-full"
                                            readonly>
                                    </div>
                                @else
                                    <div class="mb-4 w-2 pr-2">
                                        <label for="program_focus" class="block font-medium mb-2 it">Program Focus</label>
                                        <input type="text" id="program_focus" name="program_focus"
                                            class="border rounded px-4 py-2 w-full" value="{{ $item->program_focus }}"
                                            readonly>
                                        <label for="topic" class="block font-medium mb-2 it">Topic of Research
                                            Focus</label>
                                        <input type="text" id="topic" name="topic" value="{{ $item->topic }}"
                                            class="border rounded px-4 py-2 w-full" readonly>
                                    </div>
                                @endif

                                <div class="mb-4 w-1 pr-2">
                                    <label for="internship_duration" class="block font-medium mb-2 it">Internship
                                        Duration</label>
                                    <input type="text" id="internship_duration" name="internship_duration"
                                        value="{{ $item->internship_duration }}" class="border rounded px-4 py-2 w-full"
                                        readonly>
                                </div>
                                <div class="mb-4 w-1 pr-2">
                                    <label for="start_date" class="block font-medium mb-2 it">Starting Date</label>
                                    <input type="date" id="start_date" name="start_date"
                                        value="{{ $item->start_date }}" class="border rounded px-4 py-2 w-full"
                                        pattern="\d{1,2}/\d{1,2}/\d{4}" readonly>
                                </div>
                                <div class="mb-4 w-1 pr-2">
                                    <label for="ending_date" class="block font-medium mb-2 it">Ending Date</label>
                                    <input type="date" id="ending_date" name="ending_date"
                                        value="{{ $item->ending_date }}" class="border rounded px-4 py-2 w-full"
                                        pattern="\d{1,2}/\d{1,2}/\d{4}"readonly>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <div class="alert alert-danger alert-dismissible fade show custom-alert1" role="alert">
                                    <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i> ปิดการแก้ไขแล้ว!
                                </div>
                            </div>
                        @endif


                        <br>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_file{{ $item->info_id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-body">
                    <div class="modal-content" style="padding: 16px;">
                        <div style="display: flex; justify-content: flex-end; margin-right: 15px;">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <h1 class="modal-title h1form " id="exampleModalLabel" style="text-align: center">
                            Required Document
                        </h1>
                        @if ($edit->edit_status == 1)
                            <form action="{{ route('file_update', $item->info_id) }}" method="POST"
                                enctype="multipart/form-data" class="flex flex-wrap">
                                @csrf
                                <hr class="custom-hr">
                                <br>
                                <div class="container overflow-hidden text-center">
                                    <div class="row gy-5">
                                        <!-- CV Section -->
                                        <div class="col-6">
                                            <div class="fileviewer">
                                                <div class="p-4">
                                                    @if ($item->cv_status == 1)
                                                        <div
                                                            style="border-radius: 20px; border: 1px solid #04499b; padding: 10px;">
                                                            <label for="cv"
                                                                class="block font-medium mb-2 it">Curriculum Vitae
                                                                (CV)</label>
                                                            <div class="d-flex mb-4 w-100 pr-2">
                                                                <h1 class="h13" style="padding: 10px;">current file :
                                                                </h1>
                                                                <a href="{{ asset('storage/uploads/cv/' . $item->cv_file) }}"
                                                                    target="_blank" class="border rounded px-4 py-2"><i
                                                                        class="fa-solid fa-file-pdf"></i> View file</a>
                                                            </div>
                                                            <div class="alert alert-success alert-dismissible fade show custom-alert1"
                                                                role="alert">
                                                                <i class="fa-solid fa-circle-check"
                                                                    style="color: #008f64;"></i> Pass!
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div
                                                            style="border-radius: 20px; border: 1px solid #04499b; padding: 10px;">
                                                            <label for="cv"
                                                                class="block font-medium mb-2 it">Curriculum Vitae
                                                                (CV)</label>
                                                            <div class="d-flex mb-4 w-100 pr-2">
                                                                <h1 class="h13" style="padding: 10px;">current file :
                                                                </h1>
                                                                <a href="{{ asset('storage/uploads/cv/' . $item->cv_file) }}"
                                                                    target="_blank" class="border rounded px-4 py-2"><i
                                                                        class="fa-solid fa-file-pdf"></i> View file</a>
                                                            </div>
                                                            <input type="file" name="cv_file" id="cv_file"
                                                                class="border rounded px-4 py-2 w-full">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Transcript Section -->
                                        <div class="col-6">
                                            <div class="fileviewer">
                                                <div class="p-4">
                                                    @if ($item->transcript_status == 1)
                                                        <div
                                                            style="border-radius: 20px; border: 1px solid #04499b; padding: 10px;">
                                                            <label for="study_record"
                                                                class="block font-medium mb-2 it">Study Record
                                                                (Transcript)</label>
                                                            <div class="d-flex mb-4 w-100 pr-2">
                                                                <h1 class="h13" style="padding: 10px;">current file :
                                                                </h1>
                                                                <a href="{{ asset('storage/uploads/transcript/' . $item->transcript_file) }}"
                                                                    target="_blank"
                                                                    class="border rounded px-4 py-2 flex-grow-1"><i
                                                                        class="fa-solid fa-file-pdf"></i> View file</a>
                                                            </div>
                                                            <div class="alert alert-success alert-dismissible fade show custom-alert1"
                                                                role="alert">
                                                                <i class="fa-solid fa-circle-check"
                                                                    style="color: #008f64;"></i> Pass!
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div
                                                            style="border-radius: 20px; border: 1px solid #04499b; padding: 10px;">
                                                            <label for="study_record"
                                                                class="block font-medium mb-2 it">Study Record
                                                                (Transcript)</label>
                                                            <div class="d-flex mb-4 w-100 pr-2">
                                                                <h1 class="h13" style="padding: 10px;">current file :
                                                                </h1>
                                                                <a href="{{ asset('storage/uploads/transcript/' . $item->transcript_file) }}"
                                                                    target="_blank"
                                                                    class="border rounded px-4 py-2 flex-grow-1"><i
                                                                        class="fa-solid fa-file-pdf"></i> View file</a>
                                                            </div>
                                                            <input type="file" name="transcript_file"
                                                                id="transcript_file" class="px-4 py-2 w-full">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Passport Section -->
                                        <div class="col-6">
                                            <div class="fileviewer">
                                                <div class="p-4">
                                                    @if ($item->passport_status == 1)
                                                        <div
                                                            style="border-radius: 20px; border: 1px solid #04499b; padding: 10px;">
                                                            <label for="main_passport_page"
                                                                class="block font-medium mb-2 it">Main Passport
                                                                Page</label>
                                                            <div class="d-flex mb-4 w-100 pr-2">
                                                                <h1 class="h13" style="padding: 10px;">current file :
                                                                </h1>
                                                                <a href="{{ asset('storage/uploads/passport/' . $item->passport_file) }}"
                                                                    target="_blank"
                                                                    class="border rounded px-4 py-2 flex-grow-1"><i
                                                                        class="fa-solid fa-file-pdf"></i> View file</a>
                                                            </div>
                                                            <div class="alert alert-success alert-dismissible fade show custom-alert1"
                                                                role="alert">
                                                                <i class="fa-solid fa-circle-check"
                                                                    style="color: #008f64;"></i> Pass!
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div
                                                            style="border-radius: 20px; border: 1px solid #04499b; padding: 10px;">
                                                            <label for="main_passport_page"
                                                                class="block font-medium mb-2 it">Main Passport
                                                                Page</label>
                                                            <div class="d-flex mb-4 w-100 pr-2">
                                                                <h1 class="h13" style="padding: 10px;">current file :
                                                                </h1>
                                                                <a href="{{ asset('storage/uploads/passport/' . $item->passport_file) }}"
                                                                    target="_blank"
                                                                    class="border rounded px-4 py-2 flex-grow-1"><i
                                                                        class="fa-solid fa-file-pdf"></i> View file</a>
                                                            </div>
                                                            <input type="file" name="passport_file" id="passport_file"
                                                                class="px-4 py-2 w-full">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Motivation Letter Section -->
                                        <div class="col-6">
                                            <div class="fileviewer">
                                                <div class="p-4">
                                                    @if ($item->motivation_status == 1)
                                                        <div
                                                            style="border-radius: 20px; border: 1px solid #04499b; padding: 10px;">
                                                            <label for="motivation_letter"
                                                                class="block font-medium mb-2 it">Motivation Letter</label>
                                                            <div class="d-flex mb-4 w-100 pr-2">
                                                                <h1 class="h13" style="padding: 10px;">current file :
                                                                </h1>
                                                                <a href="{{ asset('storage/uploads/motivation/' . $item->motivation_file) }}"
                                                                    target="_blank"
                                                                    class="border rounded px-4 py-2 flex-grow-1"><i
                                                                        class="fa-solid fa-file-pdf"></i> View file</a>
                                                            </div>
                                                            <div class="alert alert-success alert-dismissible fade show custom-alert1"
                                                                role="alert">
                                                                <i class="fa-solid fa-circle-check"
                                                                    style="color: #008f64;"></i> Pass!
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div
                                                            style="border-radius: 20px; border: 1px solid #04499b; padding: 10px;">
                                                            <label for="motivation_letter"
                                                                class="block font-medium mb-2 it">Motivation Letter</label>
                                                            <div class="d-flex mb-4 w-100 pr-2">
                                                                <h1 class="h13" style="padding: 10px;">current file :
                                                                </h1>
                                                                <a href="{{ asset('storage/uploads/motivation/' . $item->motivation_file) }}"
                                                                    target="_blank"
                                                                    class="border rounded px-4 py-2 flex-grow-1"><i
                                                                        class="fa-solid fa-file-pdf"></i> View file</a>
                                                            </div>
                                                            <input type="file" name="motivation_file"
                                                                id="motivation_file" class="rounded px-4 py-2 w-full">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @if (
                                    $item->cv_status == 1 &&
                                        $item->motivation_status == 1 &&
                                        $item->passport_status == 1 &&
                                        $item->transcript_status == 1)
                                @else
                                    <div class="flex-container1 flex justify-end w-full">
                                        <button type="submit" class="change-btn">Save</button>
                                    </div>
                                @endif
                            </form>
                        @else
                            <form action="{{ route('file_update', $item->info_id) }}" method="POST"
                                enctype="multipart/form-data" class="flex flex-wrap">
                                @csrf
                                <hr class="custom-hr">
                                <br>
                                <div class="container overflow-hidden text-center">
                                    <div class="row gy-5">
                                        <!-- CV Section -->
                                        <div class="col-6">
                                            <div class="fileviewer">
                                                <div class="p-4">
                                                    @if ($item->cv_status == 1)
                                                        <div
                                                            style="border-radius: 20px; border: 1px solid #04499b; padding: 10px;">
                                                            <label for="cv"
                                                                class="block font-medium mb-2 it">Curriculum Vitae
                                                                (CV)</label>
                                                            <div class="d-flex mb-4 w-100 pr-2">
                                                                <h1 class="h13" style="padding: 10px;">current file :
                                                                </h1>
                                                                <a href="{{ asset('storage/uploads/cv/' . $item->cv_file) }}"
                                                                    target="_blank" class="border rounded px-4 py-2"><i
                                                                        class="fa-solid fa-file-pdf"></i> View file</a>
                                                            </div>
                                                            <div class="alert alert-success alert-dismissible fade show custom-alert1"
                                                                role="alert">
                                                                <i class="fa-solid fa-circle-check"
                                                                    style="color: #008f64;"></i> Pass!
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div
                                                            style="border-radius: 20px; border: 1px solid #04499b; padding: 10px;">
                                                            <label for="cv"
                                                                class="block font-medium mb-2 it">Curriculum Vitae
                                                                (CV)</label>
                                                            <div class="d-flex mb-4 w-100 pr-2">
                                                                <h1 class="h13" style="padding: 10px;">current file :
                                                                </h1>
                                                                <a href="{{ asset('storage/uploads/cv/' . $item->cv_file) }}"
                                                                    target="_blank" class="border rounded px-4 py-2"><i
                                                                        class="fa-solid fa-file-pdf"></i> View file</a>
                                                            </div>
                                                            <div class="alert alert-success alert-dismissible fade show custom-alert1"
                                                                role="alert">
                                                                <i class="fa-solid fa-circle-xmark"
                                                                    style="color: #ff0000;"></i>ปิดการแก้ไขแล้ว!
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Transcript Section -->
                                        <div class="col-6">
                                            <div class="fileviewer">
                                                <div class="p-4">
                                                    @if ($item->transcript_status == 1)
                                                        <div
                                                            style="border-radius: 20px; border: 1px solid #04499b; padding: 10px;">
                                                            <label for="study_record"
                                                                class="block font-medium mb-2 it">Study Record
                                                                (Transcript)</label>
                                                            <div class="d-flex mb-4 w-100 pr-2">
                                                                <h1 class="h13" style="padding: 10px;">current file :
                                                                </h1>
                                                                <a href="{{ asset('storage/uploads/transcript/' . $item->transcript_file) }}"
                                                                    target="_blank"
                                                                    class="border rounded px-4 py-2 flex-grow-1"><i
                                                                        class="fa-solid fa-file-pdf"></i> View file</a>
                                                            </div>
                                                            <div class="alert alert-success alert-dismissible fade show custom-alert1"
                                                                role="alert">
                                                                <i class="fa-solid fa-circle-check"
                                                                    style="color: #008f64;"></i> Pass!
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div
                                                            style="border-radius: 20px; border: 1px solid #04499b; padding: 10px;">
                                                            <label for="study_record"
                                                                class="block font-medium mb-2 it">Study Record
                                                                (Transcript)</label>
                                                            <div class="d-flex mb-4 w-100 pr-2">
                                                                <h1 class="h13" style="padding: 10px;">current file :
                                                                </h1>
                                                                <a href="{{ asset('storage/uploads/transcript/' . $item->transcript_file) }}"
                                                                    target="_blank"
                                                                    class="border rounded px-4 py-2 flex-grow-1"><i
                                                                        class="fa-solid fa-file-pdf"></i> View file</a>
                                                            </div>
                                                            <div class="alert alert-danger alert-dismissible fade show custom-alert1"
                                                                role="alert">
                                                                <i class="fa-solid fa-circle-xmark"
                                                                    style="color: #ff0000;"></i> ปิดการแก้ไขแล้ว!
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Passport Section -->
                                        <div class="col-6">
                                            <div class="fileviewer">
                                                <div class="p-4">
                                                    @if ($item->passport_status == 1)
                                                        <div
                                                            style="border-radius: 20px; border: 1px solid #04499b; padding: 10px;">
                                                            <label for="main_passport_page"
                                                                class="block font-medium mb-2 it">Main Passport
                                                                Page</label>
                                                            <div class="d-flex mb-4 w-100 pr-2">
                                                                <h1 class="h13" style="padding: 10px;">current file :
                                                                </h1>
                                                                <a href="{{ asset('storage/uploads/passport/' . $item->passport_file) }}"
                                                                    target="_blank"
                                                                    class="border rounded px-4 py-2 flex-grow-1"><i
                                                                        class="fa-solid fa-file-pdf"></i> View file</a>
                                                            </div>
                                                            <div class="alert alert-success alert-dismissible fade show custom-alert1"
                                                                role="alert">
                                                                <i class="fa-solid fa-circle-check"
                                                                    style="color: #008f64;"></i> Pass!
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div
                                                            style="border-radius: 20px; border: 1px solid #04499b; padding: 10px;">
                                                            <label for="main_passport_page"
                                                                class="block font-medium mb-2 it">Main Passport
                                                                Page</label>
                                                            <div class="d-flex mb-4 w-100 pr-2">
                                                                <h1 class="h13" style="padding: 10px;">current file :
                                                                </h1>
                                                                <a href="{{ asset('storage/uploads/passport/' . $item->passport_file) }}"
                                                                    target="_blank"
                                                                    class="border rounded px-4 py-2 flex-grow-1"><i
                                                                        class="fa-solid fa-file-pdf"></i> View file</a>
                                                            </div>
                                                            <div class="alert alert-danger alert-dismissible fade show custom-alert1"
                                                                role="alert">
                                                                <i class="fa-solid fa-circle-xmark"
                                                                    style="color: #ff0000;"></i> ปิดการแก้ไขแล้ว!
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Motivation Letter Section -->
                                        <div class="col-6">
                                            <div class="fileviewer">
                                                <div class="p-4">
                                                    @if ($item->motivation_status == 1)
                                                        <div
                                                            style="border-radius: 20px; border: 1px solid #04499b; padding: 10px;">
                                                            <label for="motivation_letter"
                                                                class="block font-medium mb-2 it">Motivation Letter</label>
                                                            <div class="d-flex mb-4 w-100 pr-2">
                                                                <h1 class="h13" style="padding: 10px;">current file :
                                                                </h1>
                                                                <a href="{{ asset('storage/uploads/motivation/' . $item->motivation_file) }}"
                                                                    target="_blank"
                                                                    class="border rounded px-4 py-2 flex-grow-1"><i
                                                                        class="fa-solid fa-file-pdf"></i> View file</a>
                                                            </div>
                                                            <div class="alert alert-success alert-dismissible fade show custom-alert1"
                                                                role="alert">
                                                                <i class="fa-solid fa-circle-check"
                                                                    style="color: #008f64;"></i> Pass!
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div
                                                            style="border-radius: 20px; border: 1px solid #04499b; padding: 10px;">
                                                            <label for="motivation_letter"
                                                                class="block font-medium mb-2 it">Motivation Letter</label>
                                                            <div class="d-flex mb-4 w-100 pr-2">
                                                                <h1 class="h13" style="padding: 10px;">current file :
                                                                </h1>
                                                                <a href="{{ asset('storage/uploads/motivation/' . $item->motivation_file) }}"
                                                                    target="_blank"
                                                                    class="border rounded px-4 py-2 flex-grow-1"><i
                                                                        class="fa-solid fa-file-pdf"></i> View file</a>
                                                            </div>
                                                            <div class="alert alert-danger alert-dismissible fade show custom-alert1"
                                                                role="alert">
                                                                <i class="fa-solid fa-circle-xmark"
                                                                    style="color: #ff0000;"></i> ปิดการแก้ไขแล้ว!
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- Modals --}}
    <div class="modal fade" id="confirm_right{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 900px;">
            <div class="modal-content">
                <h5 class="modal-title h1form" id="exampleModalLabel" style="text-align: center;">
                    <br>Applicants required file
                </h5>
                <hr class="custom-hr">

                <!-- Terms and Conditions Section -->
                <div style="padding: 10px; max-height: 300px; overflow-y: auto;">
                    <h1 class="h12">Terms and Conditions of the Internship</h1>
                    <p><strong>• Regulations and conditions</strong></p>
                    <p>&nbsp;&nbsp;○ Bench fee waiver and stipend 6,000 THB per month</p>
                    <p>&nbsp;&nbsp;○ Non-immigrant “ED” visa (study permit)</p>
                    <p>&nbsp;&nbsp;○ Health insurance</p>
                    <p>&nbsp;&nbsp;○ Free of infectious diseases; mental and physical conditions support the research
                        activities.</p>
                    <p>&nbsp;&nbsp;○ In case of leave, written consent from the host-advisor required</p>
                    <hr class="custom-hr">
                    <p><strong>• Responsible conduct of research</strong></p>
                    <p><strong>• Safe Lab Practices</strong></p>
                    <hr class="custom-hr">
                    <div><label for="agree_terms">
                            <input type="checkbox" id="agree_terms" name="agree_terms" class="form-check-input"
                                required>&nbsp;

                            I understand and agree to the above conditions. By clicking, I affirm my commitment to the
                            research internship. Failure to comply with these terms and conditions shall result in
                            disciplinary actions up to the termination of your position as a research internship student.
                        </label>
                    </div>
                </div>
                <!-- End of Terms and Conditions Section -->

                <!-- Custom Alert Section -->
                <div id="customAlert" class="alert alert-danger custom-alert" style="display: none; text-align: center;">
                    You must agree to the terms and conditions before confirming.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div style="text-align: center;">
                        <form id="confirm_form" action="{{ route('confirm_right', $item->id) }}" method="POST"
                            enctype="multipart/form-data" onsubmit="return validateCheckbox()">
                            @csrf
                            <div style="text-align: center;">
                                <button type="submit" name="confirm_right" value="1" class="change-btn1"
                                    style="margin-right: 10%;">Confirm</button>
                                <button type="submit" name="confirm_right" value="2" class="change-btn2"
                                    style="margin-left: 10%;">Didn't Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateCheckbox() {
            const checkbox = document.getElementById('agree_terms');
            const customAlert = document.getElementById('customAlert');

            if (!checkbox.checked) {
                customAlert.style.display = 'block';
                return false; // Prevent form submission
            }
            customAlert.style.display = 'none';
            return true; // Allow form submission
        }
    </script>





    {{-- <div id="personalModal" class="modal">
        <p>@include('layouts.personal', [
            'item' => $item,
            'edit' => $edit,
        ])</p>
    </div>
    <div id="educationModal" class="modal">
        <p>@include('layouts/education', [
            'item' => $item,
            'edit' => $edit,
        ])</p>
    </div>
    <div id="fileeditModal" class="modal">
        <p>@include('layouts/file', ['item' => $item, 'edit' => $edit])</p>
    </div> --}}

    {{-- Script for swap status page --}}
    <script>
        $(document).ready(function() {

            function attachEventListeners() {
                $(document).on('click', '.personaledit', function() {
                    const personalModal = document.getElementById("personalModal");
                    personalModal.style.display = "block";
                });

                $(document).on('click', '.educationedit', function() {
                    const educationModal = document.getElementById("educationModal");
                    educationModal.style.display = "block";
                });

                $(document).on('click', '.fileedit', function() {
                    const fileeditModal = document.getElementById("fileeditModal");
                    fileeditModal.style.display = "block";
                });

                $(document).on('click', '.close', function() {
                    const modalId = $(this).data('modalId');
                    closeModal(modalId);
                });

                $(window).on('click', function(event) {
                    $('.modal').each(function() {
                        if (event.target === this) {
                            closeModal(this.id);
                        }
                    });
                });

                $(document).on('keydown', function(event) {
                    if (event.key === 'Escape') {
                        $('.modal').each(function() {
                            closeModal(this.id);
                        });
                    }
                });
            }

            function closeModal(modalId) {
                document.getElementById(modalId).style.display = "none";
            }
            attachEventListeners();
        });


        function showConfirmation() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, proceed!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Complete!',
                        'Your action has been completed.',
                        'success'
                    );
                    closeConfirmationModal();
                }
            });
        }

        function openConfirmationModal() {
            document.getElementById('confirmmodal').style.display = 'block';
        }

        function closeConfirmationModal() {
            document.getElementById('confirmmodal').style.display = 'none';
        }

        // This function is optional, it can be used if needed
        function showConfirmation() {
            closeConfirmationModal();
        }
    </script>
@endsection
