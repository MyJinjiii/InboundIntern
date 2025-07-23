@extends('layouts/navigation')
@extends('layouts/sidebar')
@section('title')
All Non-Scholarship Applicants
@endsection
@section('header')
    <h1 class="admissionstatus">All Non-Scholarship Applicants</h1>
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
            border: 1px solid #04499b;
            border-color: #04499b;
            border-radius: 10px;
            padding: 5px 15px;
            background-color: #ffffff;
            color: #04499b;
            transition: background-color 0.3s, color 0.3s;
        }

        .change-btn1:hover {
            background-color: #31d300;
            color: #ffffff;
            border-color: #31d300;
        }

        .change-btn2 {
            border: 1px solid #04499b;
            border-color: #04499b;
            border-radius: 10px;
            padding: 5px 15px;
            background-color: #ffffff;
            color: #04499b;
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

        .mmm {
            display: flex;
            flex-wrap: wrap;
        }

        .item {
            flex: 0 0 calc(50% - 16px);
            /* Two items per row with some spacing */
            margin: 8px;
            /* Adjust spacing between items */
        }

        .commentmodal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .commentmodal-content {
            background-color: #fefefe;
            margin: 20% auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 8px;
            max-width: 400px;
            text-align: center;
        }

        .commentclose {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            margin-left: 10%;
        }

        .commentclose:hover,
        .commentclose:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .comment-options {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .commentChoice {
            flex-grow: 1;
            /* Make buttons same width */
            background-color: #ffffff;
            border: 1px solid #04499b;
            color: 04499b;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
        }

        .commentChoice:hover {
            background-color: #04499b;
            color: #ffffff;
        }

        #commentTextArea {
            display: none;
            margin-top: 20px;
        }

        #commentText {
            width: 100%;
            height: 100px;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        #commentTextArea button {
            background-color: #04499b;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border: none;
            border-radius: 8px;
        }

        #commentTextArea button:hover {
            background-color: #011f4d;
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
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @if ($user_info->count() > 0)
    <div class="card">
        <table>
            <thead>
                <tr class="no-border-bottom">
                    <th style="border-radius: 20px 0 0 0;" class="number-column">No.</th>
                    <th>Name</th>
                    <th>Document</th>
                    <th>file</th>
                    <th>Status</th>
                    <th style="border-radius: 0 20px 0 0;">ผ่านไหมจ๊ะ</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php
                $fromScholarship = isset($_GET['fromScholarship']) && $_GET['fromScholarship'] === 'false';
                ?>
                @foreach ($user_info as $info)
                    <tr class="no-border-bottom">
                        <td class="info-container" style="text-align: left;">{{ $info->id }}
                        </td>
                        <td>{{ $info->name }}&nbsp;{{ $info->surname }}
                        </td>
                        <td id="filecheck">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#User_Profile{{ $info->id }}">
                                View Profile
                            </button>
                        </td>
                        <td id>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#User_file{{ $info->id }}">
                                View file
                            </button>
                        </td>
                        <td style="color: orange;">
                            &nbsp;&nbsp;&nbsp;<i class="fas fa-spinner fa-spin-pulse"></i>&nbsp;ยังไม่ตรวจจ้า
                        
                        </td> {{-- ถ้าผ่านให้โชว์สถานะเป็น completed --}}
                        <td>
                            <div class="flex-container">
                                <button class="changestatusBtn change-btn">Interview Result</button>
                                
                            </div>
                        </td>
                    </tr>
                    <div class="modal fade" id="User_Profile{{ $info->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Applicants Profile</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>



                                <div class="modal-body">
                                    <!-- Modal content goes here -->


                                    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data"
                                        class="flex flex-wrap">
                                        @csrf
                                        <hr class="custom-hr"><br>
                                        <div class="mb-4 w-1 pr-2">
                                            <label for="email" class="block font-medium mb-2 it">Email</label>
                                            <input type="email" id="email" name="email"
                                                class="border rounded px-4 py-2 w-full" value="{{ $info->email }}"
                                                readonly>
                                        </div>
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
                                        <div class="mb-4 w-2 pr-2">
                                            <label for="tel" class="block font-medium mb-2 it">Phone Number with
                                                country code</label>
                                            <input type="tel" id="tel" name="tel"
                                                class="border rounded px-4 py-2 w-full" value="{{ $info->tel }}"
                                                pattern="^\+\d{1,3}\s?\d{3,}$" readonly>
                                        </div>
                                        <div class="mb-4 w-1 pr-2">
                                            <label for="level_of_studies" class="block font-small mb-2 it">Level of
                                                Studies</label>
                                            <input type="text" id="level_of_studies" name="level_of_studies"
                                                value="{{ $info->level_of_studies }}"
                                                class="border rounded px-4 py-2 w-full" readonly>
                                        </div>
                                        <div class="mb-4 w-1 pr-2">
                                            <label for="year_of_study" class="block font-medium mb-2 it">Year of
                                                Study</label>
                                            <input type="text" id="year_of_study" name="year_of_study"
                                                value="{{ $info->year_of_study }}" class="border rounded px-4 py-2 w-full"
                                                readonly>
                                        </div>
                                        <div class="mb-4 w-2 pr-2">
                                            <label for="study_program" class="block font-medium mb-2 it">Study Program /
                                                Major</label>
                                            <input type="text" id="study_program" name="study_program"
                                                value="{{ $info->study_program }}"
                                                class="border rounded px-4 py-2 w-full" readonly>
                                        </div>
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
                                        <br>
                                        <hr class="custom-hr"><br>
                                        <div class="mb-4 w-2 pr-2">
                                            @if ($fromScholarship)
                                                <label for="Program_Focus" class="block font-medium mb-2 it">Research
                                                    topics of
                                                    interest</label>
                                                <input type="text" id="Program_Focus" name="Program_Focus"
                                                    class="border rounded px-4 py-2 w-full"
                                                    value="{{ $info->Program_Focus }}" readonly>
                                                <label for="advisor" class="block font-medium mb-2 it">Name of PSU
                                                    Advisor (if
                                                    applicable)</label>
                                                <input type="text" id="advisor" name="advisor"
                                                    value="{{ $info->advisor }}" class="border rounded px-4 py-2 w-full"
                                                    readonly>
                                            @else
                                                <div class="mb-4 w-2 pr-2">
                                                    <label for="Program_Focus" class="block font-medium mb-2 it">Program
                                                        Focus</label>
                                                    <input type="text" id="Program_Focus" name="Program_Focus"
                                                        class="border rounded px-4 py-2 w-full"
                                                        value="{{ $info->Program_Focus }}" readonly>
                                                    <label for="topic" class="block font-medium mb-2 it">Topic of
                                                        Research
                                                        Focus</label>
                                                    <input type="text" id="topic" name="topic"
                                                        value="{{ $info->topic }}"
                                                        class="border rounded px-4 py-2 w-full" readonly>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="mb-4 w-1 pr-2">
                                            <label for="internship_duration" class="block font-medium mb-2 it">Internship
                                                Duration</label>
                                            <input type="text" id="internship_duration" name="internship_duration"
                                                value="{{ $info->internship_duration }}"
                                                class="border rounded px-4 py-2 w-full" readonly>
                                        </div>
                                        <div class="mb-4 w-1 pr-2">
                                            <label for="starting_date" class="block font-medium mb-2 it">Starting
                                                Date</label>
                                            <input type="date" id="starting_date" name="starting_date"
                                                class="border rounded px-4 py-2 w-full" readonly
                                                pattern="\d{1,2}/\d{1,2}/\d{4}">
                                        </div>
                                        <div class="mb-4 w-1 pr-2">
                                            <label for="ending_date" class="block font-medium mb-2 it">Ending Date</label>
                                            <input type="date" id="ending_date" name="ending_date"
                                                class="border rounded px-4 py-2 w-full" readonly
                                                pattern="\d{1,2}/\d{1,2}/\d{4}">
                                        </div>

                                        <br>

                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="User_file{{ $info->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Applicants required file</h5>
                                </div>
                                <div class="flex-container1">
                              
                                <button class="commentBtn change-btn">Add Comment</button>
                            </div>
                                <div class="modal-body">
                                    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data"
                                        class="flex flex-wrap">
                                        @csrf
                                        <hr class="custom-hr"><br>
                                        <div class="mmm">
                                            <div class="item">
                                                <label for="cv" class="block font-medium mb-2 it">Curriculum Vitae
                                                    (CV)
                                                </label>
                                                <button type="file" id="cv" name="cv"
                                                    class="border rounded px-4 py-2 w-full" accept=".pdf">
                                                    <i class="fa-solid fa-file-pdf"></i> เบิ่งแน
                                                </button>
                                            </div>
                                            <div class="item">
                                                <label for="study_record" class="block font-medium mb-2 it">Study Record
                                                    (Transcript)</label>
                                                <button type="file" id="study_record" name="study_record"
                                                    class="border rounded px-4 py-2 w-full" accept=".pdf">
                                                    <i class="fa-solid fa-file-pdf"></i> เบิ่งแน
                                                </button>
                                            </div>
                                            <div class="item">
                                                <label for="motivation_letter"
                                                    class="block font-medium mb-2 it">Motivation Letter</label>
                                                <button type="file" id="motivation_letter" name="motivation_letter"
                                                    class="border rounded px-4 py-2 w-full" accept=".pdf">
                                                    <i class="fa-solid fa-file-pdf"></i> เบิ่งแน
                                                </button>
                                            </div>
                                            <div class="item">
                                                <label for="main_passport_page" class="block font-medium mb-2 it">Main
                                                    Passport Page</label>
                                                <button type="file" id="main_passport_page" name="main_passport_page"
                                                    class="border rounded px-4 py-2 w-full" accept=".pdf">
                                                    <i class="fa-solid fa-file-pdf"></i> เบิ่งแน
                                                </button>
                                            </div>
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
    <div id="mycommentmodal" class="modal">
        <div class="commentmodal-content">
            <button class="commentclose" onclick="closeModal()">&times;</button>
            <div class="comment-options">
                <h1 class="h12">Add the comment for</h1>
                <hr class="custom-hr">
                <button class="commentChoice" onclick="showCommentTextArea(1)">Personal Information</button>
                <button class="commentChoice" onclick="showCommentTextArea(2)">Education Information</button>
                <button class="commentChoice" onclick="showCommentTextArea(3)">Required document</button>
            </div>
            <div id="commentTextArea" style="display: none;">
                <textarea id="commentText" placeholder="Write your comment here..."></textarea>
                <button type="submit">Save</button>
            </div>
        </div>
    </div>
    <div id="commentuser" class="modal">
        <div class="modal-content text-color">
            <h1 class="h12">Comment</h1>
            <hr class="custom-hr">
            <textarea style="width: 100%"></textarea>
            <div class="flex-container1">
                <button class="change-btn3" style="margin-top: 5%;">Save</button>
            </div>
        </div>
    </div>
    <div id="changestatus" class="modal">
        <div class="modal-content text-color">
            <h1 class="h12">Interview Result</h1>
            <hr class="custom-hr">
            @if (Route::currentRouteName() == 'pansumpad')
                <div style="text-align: center;">
                    <button class="change-btn1" style="margin-right: 10%;" onclick="showConfirmation()">Confirm</button>
                    <button class="change-btn2" style="margin-left: 10%;" onclick="showConfirmation()">Didn't
                        Confirm</button>
                </div>
            @else
                <div style="text-align: center;">
                    <button class="change-btn1" style="margin-right: 10%;" onclick="showConfirmation()">Accepted</button>
                    <button class="change-btn2" style="margin-left: 10%;" onclick="showConfirmation()">Declined</button>
                </div>
            @endif
        </div>
    </div>
    @else
    <div class="alert alert-warning" role="alert" style="text-align: center; width: 50%; margin: 0 auto;"><i
            class="fa-solid fa-triangle-exclamation"></i> ไม่มี User ที่สมัครแบบไม่มีทุน
    </div>
    @endif
@endsection
