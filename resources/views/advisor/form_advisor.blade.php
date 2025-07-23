@extends('layouts/navigation')
@section('title')
    Internship Admission
@endsection

@section('log')
    Login
@endsection

@section('header')
    <h1 class="admissionstatus">Internship Admission</h1>
@endsection

@section('content')
    <style>
        .card {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .form-label {
            font-weight: bold;
            color: #044A9C;
        }

        .form-control {
            border: 1px solid #044A9C;
        }

        .form-control:focus {
            border-color: #044A9C;
            box-shadow: none;
        }

        .change-btn {
            background-color: #044A9C;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .change-btn:hover {
            background-color: #033a7c;
        }

        .alert {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .error-message {
            color: red;
        }

        .h123 {
            font-size: 45px;
            text-align: center;
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
            text-align: center;
        }

        .change-btn:hover {
            background-color: #04499b;
            color: #ffffff;
        }

        .flex-container1 {
            text-align: right;
            color: #04499b;
            margin-right: 10px;
        }
    </style>

    <div class="container my-5">
        <div class="card">
            <h1 class="h123">Advisor Information</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('Advisor.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="division" class="form-label">Division name <span style="color: red">*</span></label>
                    <select id="division" name="division" class="form-control select2" required>
                        <option value="" disabled selected>-- Please select a division --</option>
                        <option value="Physical Science">Physical Science</option>
                        <option value="Biological Science">Biological Science</option>
                        <option value="Computational Science">Computational Science</option>
                        <option value="Health and Applied Sciences">Health and Applied Sciences</option>
                    </select>
                    @error('division')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    <p class="form-text">(e.g., Department of Computer Science)</p>
                </div>
                <div class="form-group">
                    <label for="programname" class="form-label">Program name <span style="color: red">*</span></label>
                    <select id="programname" name="program" class="form-control select2" required>
                        <option value="" disabled selected>-- Please select a program --</option>
                    </select>
                    @error('program')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    <p class="form-text">(e.g., Summer Internship Program)</p>
                </div>

                <div class="form-group">
                    <label for="advisorname" class="form-label">Advisor name <span style="color: red">*</span></label>
                    <input type="text" id="advisorname" name="prof_name" class="form-control"
                        value="{{ auth()->user()->title.' '.auth()->user()->name .' '. auth()->user()->surname }}">
                    @error('prof_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    <p class="form-text">(e.g., Dr. John Doe)</p>
                </div>

                <div class="form-group">
                    <label for="shortintroduction" class="form-label">Short introduction to your lab or research and
                        facilities <span style="color: red">*</span></label>
                    <input type="text" id="shortintroduction" name="short" class="form-control"
                        value="{{ old('short') }}">
                    @error('short')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    <p class="form-text">(e.g., We focus on artificial intelligence and robotics.)</p>
                </div>

                <div class="form-group">
                    <label for="listofresearch" class="form-label">List of research topics <span
                            style="color: red">*</span></label>
                    <textarea id="listofresearch" name="topic" class="form-control" rows="4">{{ old('topic') }}</textarea>
                    @error('topic')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    <p class="form-text">(e.g., Natural Language Processing, Computer Vision)</p>
                </div>


                <div class="form-group">
                    <label for="othersupport" class="form-label">Other support <span
                            style="color: blue">(optional)</span></label>
                    <input type="text" id="othersupport" name="support" class="form-control"
                        value="{{ old('support') }}">
                    <p class="form-text">(e.g., Laboratory equipment, technical assistance)</p>
                </div>

                <div class="form-group">
                    <label for="detail" class="form-label">Detail <span style="color: blue">(optional)</span></label>
                    <input type="url" id="detail" name="details" class="form-control" value="{{ old('details') }}">
                    <p class="form-text">(e.g., More information about advisor (link))</p>
                </div>
                <div class="flex-container1">
                    <button type="submit" class="change-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function cleanTextarea() {
            let textarea = document.getElementById('listofresearch');
            textarea.value = textarea.value.replace(/\s+/g, ' ').trim();
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const divisionSelect = document.getElementById('division');
            const programSelect = document.getElementById('programname');

            const programs = {
                'Physical Science': [
                    'Physics',
                    'Geophysics',
                    'Chemistry',
                    'Materials Science',
                    'Polymer Science and Technology'
                ],
                'Biological Science': [
                    'Biology',
                    'Microbiology',
                    'Molecular Biotechnology and Bioinformatics'
                ],
                'Computational Science': [
                    'Mathematics',
                    'Applied Statistics',
                    'Computer Science',
                    'ICT'
                ],
                'Health and Applied Sciences': [
                    'Anatomy',
                    'Physiology',
                    'Pharmacology',
                    'Forensic Science',
                    'Biochemistry'
                ]
            };

            divisionSelect.addEventListener('change', function() {
                const selectedDivision = this.value;
                programSelect.innerHTML =
                    '<option value="" disabled selected>-- Please select a program --</option>'; // Reset options

                if (programs[selectedDivision]) {
                    programs[selectedDivision].forEach(function(program) {
                        const option = document.createElement('option');
                        option.value = program;
                        option.textContent = program;
                        programSelect.appendChild(option);
                    });
                }
            });
        });
    </script>
@endsection
