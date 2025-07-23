    @extends('layouts/navigation')
    @section('title')
        Internship Application Form
    @endsection
    @section('header')
        <h1 class="admissionstatus">Internship Application Form</h1>
    @endsection
    <style>
        .form-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            /* Optional: Adds space between elements */
        }

        .mb-4 {
            margin-bottom: 1rem;
            /* Ensure consistent margin */
        }

        .w-1,
        .w-2,
        .pr-2 {
            width: 100%;
            /* Ensure full width for elements */
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

        /* Increase border width for a denser border */
        .bg-white {
            border: 2px solid #e2e8f0;
            /* Adjust border width as needed */
        }

        /* Optional: Adjust border radius for a denser appearance */
        .rounded-lg {
            border-radius: 8px;
            /* Adjust border radius as needed */
        }
    </style>
    <?php
    $Scholarship = isset($_GET['Scholarship']) && $_GET['Scholarship'] === 'true';
    
    ?>
    @section('content')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <br><br><br><br><br><br><br>
        <div class="flex justify-center items-center h-screen">
            <div class="overflow-" style="max-height: 80vh;">
                <div class="bg-white p-8 rounded-lg shadow-lg" style="width: 900px;">

                    <form action="@if (isset($prof) && isset($topic)) {{ route('scholarship_store') }} @endif"method="post"
                        enctype="multipart/form-data" class="flex flex-wrap">
                        @csrf
                        @method('post')
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <h1 class="h1form">Personal information</h1>
                        <hr class="custom-hr"><br>
                        <div class="form-container">

                            <div class="mb-4 w-1 pr-2">
                                <label for="email" class="block font-medium mb-2 it">Email</label>
                                <input type="email" id="email" name="email" class="border rounded px-4 py-2 w-full"
                                    value="{{ Auth::user()->email }}" readonly>
                            </div>
                            <div class="flex mb-4 w-full pr-2">
                                <div class="w-1/4 pr-2">
                                    <label for="title" class="block font-medium mb-2 it">Title</label>
                                    <input type="text" name="title" id="title"
                                        class="border rounded px-4 py-2 w-full" value="{{ Auth::user()->title }}" readonly>
                                </div>
                                <div class="w-1/4 pr-2">
                                    <label for="name" class="block font-medium mb-2 it">Name</label>
                                    <input type="text" id="name" name="name" value="{{ Auth::user()->name }}"
                                        class="border rounded px-4 py-2 w-full" readonly>
                                </div>
                                <div class="w-1/4 pr-2">
                                    <label for="surname" class="block font-medium mb-2 it">Surname</label>
                                    <input type="text" id="surname" name="surname" value="{{ Auth::user()->surname }}"
                                        class="border rounded px-4 py-2 w-full" required>
                                </div>
                            </div>
                        </div>
                        <div class="flex mb-4 w-full pr-2">
                            <div class="mb-4 w-2 pr-2">
                                <label for="tel" class="block font-medium mb-2 it">Phone Number with country
                                    code</label>
                                <input type="tel" id="tel" name="tel" class="border rounded px-4 py-2 w-full"
                                    pattern="^\+\d{1,3}\s?\d{3,}$" required>
                            </div>
                        </div><br><br><br>
                        <h1 class="h1form">Education information</h1>
                        <hr class="custom-hr"><br>
                        <div class="flex mb-4 w-full pr-2">
                            @if ($Scholarship)
                                <div class="mb-4 w-1 pr-2">
                                    <label for="level_of_studies" class="block font-small mb-2 it">Level of Studies</label>
                                    <select name="level_of_studies" id="level_of_studies"
                                        class="border rounded px-4 py-2 w-full" required>
                                        <option value="" disabled selected> </option>
                                        <option value="Bachelor">Bachelor's degree</option>
                                        <option value="Master">Master's degree</option>
                                        <option value="Doctoral">Doctoral degree</option>
                                    </select>
                                </div>
                            @else
                                <div class="mb-4 w-1 pr-2">
                                    <label for="level_of_studies" class="block font-small mb-2 it">Level of Studies</label>
                                    <select name="level_of_studies" id="level_of_studies"
                                        class="border rounded px-4 py-2 w-full" required>
                                        <option value="" disabled selected> </option>
                                        <option value="Master">Master's degree</option>
                                        <option value="Doctoral">Doctoral degree</option>
                                    </select>
                                </div>
                            @endif
                            <div class="mb-4 w-1 pr-2">
                                <label for="year_of_study" class="block font-medium mb-2 it">Year of Study</label>
                                <select name="year_of_study" id="year_of_study" class="border rounded px-4 py-2 w-full"
                                    required>
                                    <option value="" disabled selected> </option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                            <div class="mb-4 w-2 pr-2">
                                <label for="study_program" class="block font-medium mb-2 it">Study Program / Major</label>
                                <input type="text" id="study_program" name="study_program"
                                    class="border rounded px-4 py-2 w-full" required>
                            </div>
                        </div>


                        <div class="mb-4 w-4 pr-2">
                            <label for="faculty" class="block font-medium mb-2 it">Faculty</label>
                            <input type="text" id="faculty" name="faculty" class="border rounded px-4 py-2 w-full"
                                required>
                        </div>
                        <div class="mb-4 w-4 pr-2">
                            <label for="university" class="block font-medium mb-2 it">University</label>
                            <input type="text" id="university" name="university"
                                class="border rounded px-4 py-2 w-full" required>
                        </div>

                        <div class="mb-4 w-4 pr-2">

                            <label for="country" class="block font-medium mb-2 it">Country of university</label>
                            <select id="country" name="country" class="border rounded px-4 py-2 w-full select2"
                                required>
                                <option value="">เลือกประเทศของมหาวิทยาลัย</option>
                                @include('/layouts/countries')
                            </select>
                        </div>

                        <br><br><br><br><br>
                        <h1 class="h1form">Internship information</h1>
                        <hr class="custom-hr"><br>
                        <div class="mb-4 w-4 pr-2">
                            <label for="division" class="block font-medium mb-2 it">Division</label>
                            <input type="text" id="division"  @if (isset($research_list->id)) value="{{ $research_list->division }}" readonly
                            @else
                            value="" @endif
                            name="division" class="border rounded px-4 py-2 w-full"
                                required>
                        </div>
                        <div class="mb-4 w-2 pr-2">
                            @if ($Scholarship)
                                <label for="Program_Focus" class="block font-medium mb-2 it">Program Focus</label>
                                <input type="text" id="program_focus" name="program_focus"
                                    class="border rounded px-4 py-2 w-full">
                            @else
                                <label for="topic" class="block font-medium mb-2 it">Topic of Research Focus</label>
                                <input type="hidden" name="topic_id" value="{{ $research_list->id }}">
                                <input type="text" id="topic"
                                    @if (isset($research_list->id)) value="{{ $research_list->topic }}" readonly   
                                    @else
                                        value="" 
                                    @endif 
                                    value="" name="topic" class="border rounded px-4 py-2 w-full">
                            @endif
                        </div>
                        <div class="mb-4 w-2 pr-2">
                            @if ($Scholarship)
                                <label for="program_focus" class="block font-medium mb-2 it">Research topics of
                                    interest</label>
                                <input type="text" id="program_focus" name="program_focus"
                                    class="border rounded px-4 py-2 w-full">
                            @else
                                <label for="advisor" class="block font-medium mb-2 it">Name of PSU Advisor (if
                                    applicable)</label>
                                <input type="text" id="advisor"
                                    @if (isset($research_list)) value="{{ $research_list->prof_name }}" readonly 
                                    @else
                                        value="" 
                                    @endif
                                    name="advisor" class="border rounded px-4 py-2 w-full">
                            @endif
                        </div>
                        <div class="mb-4 w-1 pr-2">
                            <label for="internship_duration" class="block font-medium mb-2 it">Internship Duration</label>
                            <select name="internship_duration" id="internship_duration"
                                class="border rounded px-4 py-2 w-full" required>
                                <option value="" selected disabled> </option>
                                <option value="4 months">4 month</option>
                                <option value="5 months">5 months</option>
                                <option value="6 months">6 months</option>
                            </select>
                        </div>
                        <div class="flex mb-4 w-full pr-2">
                            <div class="mb-4 w-1 pr-2">
                                <label for="start_date" class="block font-medium mb-2 it">Starting Date</label>
                                <input type="date" id="start_date" name="start_date"
                                    class="border rounded px-4 py-2 w-full" required pattern="\d{1,2}/\d{1,2}/\d{4}"
                                    placeholder="dd/mm/yyyy">
                            </div>
                           
                        </div>
                        <br><br><br><br><br>
                        <h1 class="h1form">Required document</h1>
                        <hr class="custom-hr"><br>
                        <div class="mb-4 w-3 pr-2">
                            <label for="cv_file" class="block font-medium mb-2 it">Curriculum Vitae (CV)</label>
                            <input type="file" id="cv_file" name="cv_file" class="border rounded px-4 py-2 w-full"
                                accept=".pdf" required>
                        </div>
                        <div class="mb-4 w-3 pr-2">
                            <label for="transcript_file" class="block font-medium mb-2 it">Study Record
                                (Transcript)</label>
                            <input type="file" id="transcript_file" name="transcript_file"
                                class="border rounded px-4 py-2 w-full" accept=".pdf" required>
                        </div>
                        <br>
                        <div class="mb-4 w-3 pr-2">
                            <label for="motivation_file" class="block font-medium mb-2 it">Motivation Letter</label>
                            <input type="file" id="motivation_file" name="motivation_file"
                                class="border rounded px-4 py-2 w-full" accept=".pdf" required>
                        </div>
                        <div class="mb-4 w-3 pr-2">
                            <label for="passport_file" class="block font-medium mb-2 it">Main Passport Page</label>
                            <input type="file" id="passport_file" name="passport_file"
                                class="border rounded px-4 py-2 w-full" accept=".pdf" required>
                        </div>
                        <!-- Add other file upload fields here as required -->
                        <input type="hidden" name="id_for_store"value="{{ Auth::user()->id }}">
                        <div class="flex-container1 flex justify-end w-full">
                            <button type="submit"
                                class="change-btn">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#country').select2({
                    width: '100%', // กำหนดความกว้างให้เต็มพื้นที่
                    height: '100%'
                    theme: 'default', // กำหนดธีมของ Select2
                    dropdownCssClass: 'border rounded px-4 py-2', // เพิ่มคลาส CSS สำหรับ dropdown
                    placeholder: 'เลือกประเทศของมหาวิทยาลัย'
                });
            });
        </script>
    @endsection
