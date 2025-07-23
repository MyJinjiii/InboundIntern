<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
</style>
<?php
$fromScholarship = isset($_GET['fromScholarship']) && $_GET['fromScholarship'] === 'true';
?>
<div class="flex justify-center items-center h-screen">
    <div class="overflow-" style="max-height: 80vh;">
        <div class="bg-white p-8 rounded-lg shadow-lg" style="width: 900px;">
            <h1 class="h11">Applicants Profile</h1>
            @if (Route::currentRouteName() !== 'alluser')
                <div class="flex-container">
                    <button class="changestatusBtn change-btn">Interview Result</button>
                    <button class="commentBtn change-btn">Add Comment</button>
                </div>
            @endif
            @foreach ($user_info as $user_info)
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data"
                    class="flex flex-wrap">
                    @csrf
                    <hr class="custom-hr"><br>
                    <div class="mb-4 w-1 pr-2">
                        <label for="email" class="block font-medium mb-2 it">Email</label>
                        <input type="email" id="email" name="email" class="border rounded px-4 py-2 w-full"
                            value="{{ $user_info->email }}" readonly>
                    </div>
                    <div class="mb-4 w-1 pr-2">
                        <label for="title" class="block font-medium mb-2 it">Title.</label>
                        <input type="text" id="title" name="title" class="border rounded px-4 py-2 w-full"
                            value="{{ $user_info->title }}" readonly>
                    </div>
                    <div class="mb-4 w-2 pr-2">
                        <label for="name" class="block font-medium mb-2 it">Name</label>
                        <input type="text" id="name" name="name" class="border rounded px-4 py-2 w-full"
                            value="{{ $user_info->name }}" readonly>
                    </div>
                    <div class="mb-4 w-2 pr-2">
                        <label for="surname" class="block font-medium mb-2 it">Surname</label>
                        <input type="text" id="surname" name="surname" class="border rounded px-4 py-2 w-full"
                            value="{{ $user_info->surname }}" readonly>
                    </div>
                    <div class="mb-4 w-2 pr-2">
                        <label for="tel" class="block font-medium mb-2 it">Phone Number with country code</label>
                        <input type="tel" id="tel" name="tel" class="border rounded px-4 py-2 w-full"
                            value="{{ $user_info->tel }}" pattern="^\+\d{1,3}\s?\d{3,}$" readonly>
                    </div>
                    <div class="mb-4 w-1 pr-2">
                        <label for="level_of_studies" class="block font-small mb-2 it">Level of Studies</label>
                        <input type="text" id="level_of_studies" name="level_of_studies"
                            value="{{ $user_info->level_of_studies }}" class="border rounded px-4 py-2 w-full" readonly>
                    </div>
                    <div class="mb-4 w-1 pr-2">
                        <label for="year_of_study" class="block font-medium mb-2 it">Year of Study</label>
                        <input type="text" id="year_of_study" name="year_of_study"
                            value="{{ $user_info->year_of_study }}" class="border rounded px-4 py-2 w-full" readonly>
                    </div>
                    <div class="mb-4 w-2 pr-2">
                        <label for="study_program" class="block font-medium mb-2 it">Study Program / Major</label>
                        <input type="text" id="study_program" name="study_program"
                            value="{{ $user_info->study_program }}" class="border rounded px-4 py-2 w-full" readonly>
                    </div>
                    <div class="mb-4 w-4 pr-2">
                        <label for="faculty" class="block font-medium mb-2 it">Faculty</label>
                        <input type="text" id="faculty" name="faculty" class="border rounded px-4 py-2 w-full"
                            value="{{ $user_info->study_program }}" readonly>
                    </div>
                    <div class="mb-4 w-4 pr-2">
                        <label for="university" class="block font-medium mb-2 it">University</label>
                        <input type="text" id="university" name="university" class="border rounded px-4 py-2 w-full"
                            value="{{ $user_info->university }}" readonly>
                    </div>
                    <div class="mb-4 w-4 pr-2">
                        <label for="country" class="block font-medium mb-2 it">Country of university</label>
                        <input type="text" id="country" name="country" class="border rounded px-4 py-2 w-full"
                            value="{{ $user_info->university }}" readonly>
                    </div>
                    <br>
                    <hr class="custom-hr"><br>
                    <div class="mb-4 w-2 pr-2">
                        @if ($fromScholarship)
                            <label for="Program_Focus" class="block font-medium mb-2 it">Research topics of
                                interest</label>
                            <input type="text" id="Program_Focus" name="Program_Focus"
                                class="border rounded px-4 py-2 w-full" value="{{ $user_info->Program_Focus }}"
                                readonly>
                            <label for="advisor" class="block font-medium mb-2 it">Name of PSU Advisor (if
                                applicable)</label>
                            <input type="text" id="advisor" name="advisor" value="{{ $user_info->advisor }}"
                                class="border rounded px-4 py-2 w-full" readonly>
                        @else
                            <div class="mb-4 w-2 pr-2">
                                <label for="Program_Focus" class="block font-medium mb-2 it">Program Focus</label>
                                <input type="text" id="Program_Focus" name="Program_Focus"
                                    class="border rounded px-4 py-2 w-full" value="{{ $user_info->Program_Focus }}"
                                    readonly>
                                <label for="topic" class="block font-medium mb-2 it">Topic of Research
                                    Focus</label>
                                <input type="text" id="topic" name="topic" value="{{ $user_info->topic }}"
                                    class="border rounded px-4 py-2 w-full" readonly>
                            </div>
                        @endif
                    </div>

                    <div class="mb-4 w-1 pr-2">
                        <label for="internship_duration" class="block font-medium mb-2 it">Internship Duration</label>
                        <input type="text" id="internship_duration" name="internship_duration"
                            value="{{ $user_info->internship_duration }}" class="border rounded px-4 py-2 w-full"
                            readonly>
                    </div>
                    <div class="mb-4 w-1 pr-2">
                        <label for="starting_date" class="block font-medium mb-2 it">Starting Date</label>
                        <input type="date" id="starting_date" name="starting_date"
                            class="border rounded px-4 py-2 w-full" readonly pattern="\d{1,2}/\d{1,2}/\d{4}">
                    </div>
                    <div class="mb-4 w-1 pr-2">
                        <label for="ending_date" class="block font-medium mb-2 it">Ending Date</label>
                        <input type="date" id="ending_date" name="ending_date"
                            class="border rounded px-4 py-2 w-full" readonly pattern="\d{1,2}/\d{1,2}/\d{4}">
                    </div>

                    <br>
                    <hr class="custom-hr"><br>
                    <div class="mmm">
                        <div class="item">
                            <label for="cv" class="block font-medium mb-2 it">Curriculum Vitae (CV)</label>
                            <button type="file" id="cv" name="cv"
                                class="border rounded px-4 py-2 w-full" accept=".pdf">
                                <i class="fa-solid fa-file-pdf"></i> เบิ่งแน
                            </button>
                        </div>
                        <div class="item">
                            <label for="study_record" class="block font-medium mb-2 it">Study Record
                                (Transcript)
                            </label>
                            <button type="file" id="study_record" name="study_record"
                                class="border rounded px-4 py-2 w-full" accept=".pdf">
                                <i class="fa-solid fa-file-pdf"></i> เบิ่งแน
                            </button>
                        </div>
                        <div class="item">
                            <label for="motivation_letter" class="block font-medium mb-2 it">Motivation Letter</label>
                            <button type="file" id="motivation_letter" name="motivation_letter"
                                class="border rounded px-4 py-2 w-full" accept=".pdf">
                                <i class="fa-solid fa-file-pdf"></i> เบิ่งแน
                            </button>
                        </div>
                        <div class="item">
                            <label for="main_passport_page" class="block font-medium mb-2 it">Main Passport
                                Page</label>
                            <button type="file" id="main_passport_page" name="main_passport_page"
                                class="border rounded px-4 py-2 w-full" accept=".pdf">
                                <i class="fa-solid fa-file-pdf"></i> เบิ่งแน
                            </button>
                        </div>
                </form>
            @endforeach
        </div>
    </div>
</div>
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
