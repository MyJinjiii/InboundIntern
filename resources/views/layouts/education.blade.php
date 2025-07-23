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
<div class="flex justify-center items-center h-screen">
    <div class="overflow-" style="max-height: 80vh;">
        <div class="bg-white p-8 rounded-lg shadow-lg"
            style="width: 900px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <h1 class="h11">Education Information</h1>
            <button class="commentclose" onclick="closeModal('educationModal')">&times;</button>
            @foreach ($userInfoAndStatus as $userInfoAndStatus)
                @if ($edit->is_active == 1)
                    <form action="{{ route('edu_update', $userInfoAndStatus->info_id) }}" method="POST"
                        enctype="multipart/form-data" class="flex flex-wrap">
                        @csrf
                        <hr class="custom-hr"><br>
                        <div class="mb-4 w-1 pr-2">
                            <label for="level_of_studies" class="block font-small mb-2 it">Level of Studies</label>
                            <input type="text" id="level_of_studies" name="level_of_studies"
                                value="{{ $userInfoAndStatus->level_of_studies }}"
                                class="border rounded px-4 py-2 w-full" readonly>
                        </div>
                        <div class="mb-4 w-1 pr-2">
                            <label for="year_of_study" class="block font-medium mb-2 it">Year of Study</label>
                            <input type="text" id="year_of_study" name="year_of_study"
                                value="{{ $userInfoAndStatus->year_of_study }}" class="border rounded px-4 py-2 w-full"
                                readonly>
                        </div>
                        <div class="mb-4 w-2 pr-2">
                            <label for="study_program" class="block font-medium mb-2 it">Study Program / Major</label>
                            <input type="text" id="study_program" name="study_program"
                                value="{{ $userInfoAndStatus->study_program }}" class="border rounded px-4 py-2 w-full"
                                readonly>
                        </div>
                        <div class="mb-4 w-4 pr-2">
                            <label for="faculty" class="block font-medium mb-2 it">Faculty</label>
                            <input type="text" id="faculty" name="faculty"
                                value="{{ $userInfoAndStatus->faculty }}" class="border rounded px-4 py-2 w-full"
                                readonly>
                        </div>
                        <div class="mb-4 w-4 pr-2">
                            <label for="university" class="block font-medium mb-2 it">University</label>
                            <input type="text" id="university" name="university"
                                value="{{ $userInfoAndStatus->university }}"class="border rounded px-4 py-2 w-full"
                                readonly>
                        </div>
                        <div class="mb-4 w-4 pr-2">
                            <label for="country" class="block font-medium mb-2 it">Country of university</label>
                            <input type="text" id="country" name="country"
                                value="{{ $userInfoAndStatus->country }}" class="border rounded px-4 py-2 w-full"
                                readonly>
                        </div>
                        <br>
                        <hr class="custom-hr"><br>

                        @if ($fromScholarship)
                            <div class="mb-4 w-2 pr-2">
                                <label for="advisor" class="block font-medium mb-2 it">Name of PSU Advisor (if
                                    applicable)</label>
                                <input type="text" id="advisor" name="advisor"
                                    value="{{ $userInfoAndStatus->advisor }}" class="border rounded px-4 py-2 w-full"
                                    readonly>

                                <label for="topic" class="block font-medium mb-2 it">Topic of Research
                                    Focus</label>
                                <input type="text" id="topic" name="topic"
                                    value="{{ $userInfoAndStatus->topic }}" class="border rounded px-4 py-2 w-full"
                                    readonly>
                            </div>
                        @else
                            <div class="mb-4 w-2 pr-2">
                                <label for="Program_Focus" class="block font-medium mb-2 it">Research topics of
                                    interest</label>
                                <input type="text" id="Program_Focus" name="Program_Focus"
                                    class="border rounded px-4 py-2 w-full"
                                    value="{{ $userInfoAndStatus->program_focus }}" readonly>
                                <label for="program_focus" class="block font-medium mb-2 it">Program Focus</label>
                                <input type="text" id="program_focus" name="program_focus"
                                    class="border rounded px-4 py-2 w-full"
                                    value="{{ $userInfoAndStatus->program_focus }}" readonly>
                            </div>
                        @endif

                        <div class="mb-4 w-1 pr-2">
                            <label for="internship_duration" class="block font-medium mb-2 it">Internship
                                Duration</label>
                            <input type="text" id="internship_duration" name="internship_duration"
                                value="{{ $userInfoAndStatus->internship_duration }}"
                                class="border rounded px-4 py-2 w-full" readonly>
                        </div>
                        <div class="mb-4 w-1 pr-2">
                            <label for="start_date" class="block font-medium mb-2 it">Starting Date</label>
                            <input type="date" id="start_date" name="start_date"
                                value="{{ $userInfoAndStatus->start_date }}" class="border rounded px-4 py-2 w-full"
                                pattern="\d{1,2}/\d{1,2}/\d{4}" readonly>
                        </div>
                        <div class="mb-4 w-1 pr-2">
                            <label for="ending_date" class="block font-medium mb-2 it">Ending Date</label>
                            <input type="date" id="ending_date" name="ending_date"
                                value="{{ $userInfoAndStatus->ending_date }}" class="border rounded px-4 py-2 w-full"
                                pattern="\d{1,2}/\d{1,2}/\d{4}"readonly>
                        </div>
                    </form>
                @else
                    <form action="{{ route('edu_update', $userInfoAndStatus->info_id) }}" method="POST"
                        enctype="multipart/form-data" class="flex flex-wrap">
                        @csrf
                        <hr class="custom-hr"><br>
                        <div class="mb-4 w-1 pr-2">
                            <label for="level_of_studies" class="block font-small mb-2 it">Level of Studies</label>
                            <input type="text" id="level_of_studies" name="level_of_studies"
                                value="{{ $userInfoAndStatus->level_of_studies }}"
                                class="border rounded px-4 py-2 w-full">
                        </div>
                        <div class="mb-4 w-1 pr-2">
                            <label for="year_of_study" class="block font-medium mb-2 it">Year of Study</label>
                            <input type="text" id="year_of_study" name="year_of_study"
                                value="{{ $userInfoAndStatus->year_of_study }}"
                                class="border rounded px-4 py-2 w-full">
                        </div>
                        <div class="mb-4 w-2 pr-2">
                            <label for="study_program" class="block font-medium mb-2 it">Study Program / Major</label>
                            <input type="text" id="study_program" name="study_program"
                                value="{{ $userInfoAndStatus->study_program }}"
                                class="border rounded px-4 py-2 w-full">
                        </div>
                        <div class="mb-4 w-4 pr-2">
                            <label for="faculty" class="block font-medium mb-2 it">Faculty</label>
                            <input type="text" id="faculty" name="faculty"
                                value="{{ $userInfoAndStatus->faculty }}" class="border rounded px-4 py-2 w-full">
                        </div>
                        <div class="mb-4 w-4 pr-2">
                            <label for="university" class="block font-medium mb-2 it">University</label>
                            <input type="text" id="university" name="university"
                                value="{{ $userInfoAndStatus->university }}"class="border rounded px-4 py-2 w-full">
                        </div>
                        <div class="mb-4 w-4 pr-2">
                            <label for="country" class="block font-medium mb-2 it">Country of university</label>
                            <input type="text" id="country" name="country"
                                value="{{ $userInfoAndStatus->country }}" class="border rounded px-4 py-2 w-full">
                        </div>
                        <br>
                        <hr class="custom-hr"><br>

                        <div class="mb-4 w-2 pr-2">
                            @if ($fromScholarship)
                                <label for="topic" class="block font-medium mb-2 it">Research topics of
                                    interest</label>
                                <input type="text" id="topic" name="topic"
                                    value="{{ $userInfoAndStatus->topic }}" class="border rounded px-4 py-2 w-full"
                                    readonly>
                                <label for="advisor" class="block font-medium mb-2 it">Name of PSU Advisor (if
                                    applicable)</label>
                                <input type="text" id="advisor" name="advisor"
                                    value="{{ $userInfoAndStatus->advisor }}" class="border rounded px-4 py-2 w-full"
                                    readonly>
                            @else
                                <div class="mb-4 w-2 pr-2">
                                    <label for="program_focus" class="block font-medium mb-2 it">Program Focus</label>
                                    <input type="text" id="program_focus" name="program_focus"
                                        class="border rounded px-4 py-2 w-full"
                                        value="{{ $userInfoAndStatus->program_focus }}" readonly>
                                    <label for="topic" class="block font-medium mb-2 it">Topic of Research
                                        Focus</label>
                                    <input type="text" id="topic" name="topic"
                                        value="{{ $userInfoAndStatus->topic }}"
                                        class="border rounded px-4 py-2 w-full" readonly>
                                </div>
                            @endif
                        </div>
                        <div class="mb-4 w-1 pr-2">
                            <label for="internship_duration" class="block font-medium mb-2 it">Internship
                                Duration</label>
                            <input type="text" id="internship_duration" name="internship_duration"
                                value="{{ $userInfoAndStatus->internship_duration }}"
                                class="border rounded px-4 py-2 w-full">
                        </div>
                        <div class="mb-4 w-1 pr-2">
                            <label for="start_date" class="block font-medium mb-2 it">Starting Date</label>
                            <input type="date" id="start_date" name="start_date"
                                value="{{ $userInfoAndStatus->start_date }}" class="border rounded px-4 py-2 w-full"
                                pattern="\d{1,2}/\d{1,2}/\d{4}">
                        </div>
                        <div class="mb-4 w-1 pr-2">
                            <label for="ending_date" class="block font-medium mb-2 it">Ending Date</label>
                            <input type="date" id="ending_date" name="ending_date"
                                value="{{ $userInfoAndStatus->ending_date }}" class="border rounded px-4 py-2 w-full"
                                pattern="\d{1,2}/\d{1,2}/\d{4}">
                        </div>
                        <div class="flex-container1 flex justify-end w-full">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                        </div>
                    </form>
                @endif
            @endforeach
        </div>
    </div>
