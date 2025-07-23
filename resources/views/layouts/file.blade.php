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
        <div class="bg-white p-8 rounded-lg shadow-lg" style="width: 900px;">
            <h1 class="h11">Required document</h1>
            <button class="commentclose" onclick="closeModal('fileeditModal')">&times;</button>
            @foreach ($userInfoAndStatus as $userInfoAndStatus)
                @if ($edit->is_active == 1)
                    <form action="{{ route('file_update', $userInfoAndStatus->info_id) }}" method="POST"
                        enctype="multipart/form-data" class="flex flex-wrap">
                        @csrf
                        <hr class="custom-hr"><br>
                        <div class="container overflow-hidden text-center">
                            <div class="row gy-5">
                                <div class="col-6">
                                    <div class="fileviewer">
                                        <div class="p-4">
                                            <label for="cv" class="block font-medium mb-2 it">Curriculum
                                                Vitae
                                                (CV)
                                            </label>
                                            <a href="{{ asset('storage/uploads/cv/' . $userInfoAndStatus->cv_file) }}"
                                                target="_blank" style="display: block; width: 100%;"
                                                class="border rounded px-4 py-2"><i class="fa-solid fa-file-pdf"></i>
                                                เบิ่งแน
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="fileviewer">
                                        <div class="p-4">
                                            <label for="study_record" class="block font-medium mb-2 it">Study
                                                Record
                                                (Transcript)</label>
                                            <a href="{{ asset('storage/uploads/transcript/' . $userInfoAndStatus->transcript_file) }}"
                                                target="_blank" style="display: block; width: 100%;"
                                                class="border rounded px-4 py-2"><i class="fa-solid fa-file-pdf"></i>
                                                เบิ่งแน
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="fileviewer">
                                        <div class="p-4">
                                            <label for="main_passport_page" class="block font-medium mb-2 it">Main
                                                Passport Page</label>
                                            <a href="{{ asset('storage/uploads/passport/' . $userInfoAndStatus->passport_file) }}"
                                                target="_blank" style="display: block; width: 100%;"
                                                class="border rounded px-4 py-2"> <i class="fa-solid fa-file-pdf"></i>
                                                เบิ่งแน
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="fileviewer">
                                        <div class="p-4">
                                            <label for="motivation_letter" class="block font-medium mb-2 it">Motivation
                                                Letter</label>
                                            <a href="{{ asset('storage/uploads/motivation/' . $userInfoAndStatus->motivation_file) }}"
                                                target="_blank" style="display: block; width: 100%;"
                                                class="border rounded px-4 py-2"> <i class="fa-solid fa-file-pdf"></i>
                                                เบิ่งแน
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @else
                    <form action="{{ route('file_update', $userInfoAndStatus->info_id) }}" method="POST"
                        enctype="multipart/form-data" class="flex flex-wrap">
                        @csrf
                        <hr class="custom-hr"><br>
                        <div class="container overflow-hidden text-center">
                            <div class="row gy-5">
                                <div class="col-6">
                                    <div class="fileviewer">
                                        <div class="p-4">
                                            <label for="cv" class="block font-medium mb-2 it">Curriculum
                                                Vitae
                                                (CV)
                                            </label>
                                            <a href="{{ asset('storage/uploads/cv/' . $userInfoAndStatus->cv_file) }}"
                                                target="_blank" style="display: block; width: 100%;"
                                                class="border rounded px-4 py-2"><i class="fa-solid fa-file-pdf"></i>
                                                เบิ่งแน
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="fileviewer">
                                        <div class="p-4">
                                            <label for="study_record" class="block font-medium mb-2 it">Study
                                                Record
                                                (Transcript)</label>
                                            <a href="{{ asset('storage/uploads/transcript/' . $userInfoAndStatus->transcript_file) }}"
                                                target="_blank" style="display: block; width: 100%;"
                                                class="border rounded px-4 py-2"><i class="fa-solid fa-file-pdf"></i>
                                                เบิ่งแน
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="fileviewer">
                                        <div class="p-4">
                                            <label for="main_passport_page" class="block font-medium mb-2 it">Main
                                                Passport Page</label>
                                            <a href="{{ asset('storage/uploads/passport/' . $userInfoAndStatus->passport_file) }}"
                                                target="_blank" style="display: block; width: 100%;"
                                                class="border rounded px-4 py-2"> <i class="fa-solid fa-file-pdf"></i>
                                                เบิ่งแน
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="fileviewer">
                                        <div class="p-4">
                                            <label for="motivation_letter" class="block font-medium mb-2 it">Motivation
                                                Letter</label>
                                            <a href="{{ asset('storage/uploads/motivation/' . $userInfoAndStatus->motivation_file) }}"
                                                target="_blank" style="display: block; width: 100%;"
                                                class="border rounded px-4 py-2"> <i class="fa-solid fa-file-pdf"></i>
                                                เบิ่งแน
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
</div>
