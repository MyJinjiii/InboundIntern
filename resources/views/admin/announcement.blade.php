@extends('layouts/sidebar')
@extends('layouts/navigation')

@section('title')
    Announcement
@endsection

@section('header')
    <h1 class="admissionstatus">Announcement</h1>
@endsection

@section('content')
    <style>
        .h11 {
            color: #04499b;
            font-size: 35px;
            text-align: center;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            margin: 0.625rem;
            padding: 0.625rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
            width: 31.25rem;
            height: 31.25rem;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .iframe-container {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding-top: 56.25%;
        }

        .iframe-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        h1 {
            font-size: 40px;
            color: #04499b;
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

        .card1 {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            padding: 20px;
            margin: 20px;
            overflow: hidden;
        }

        .card2 {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin: 20px;
            padding: 20px;
            box-sizing: border-box;
            overflow: hidden;
        }

        .card-wrapper {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: center;
        }
    </style>
    <br>
    <div class="card-wrapper" style="display: flex; gap: 5px; flex-wrap: wrap; align-items: flex-start;">

        <div class="card1">
            <div class="card-header">
                <h1 class="h11">Current file</h1>
            </div>
            <div class="card-body">
                @if ($full_ann)
                    <div class="iframe-container">
                        <iframe src="{{ asset('storage/uploads/FileManagement/full_announcement/' . $full_ann->file) }}"
                            allow="autoplay"></iframe>
                    </div>
                    <p>Name: {{ $full_ann->name }}</p>
                    <p>File: {{ $full_ann->file }}</p>
                @else
                    <p style="text-align: center;">No current file available.</p>
                @endif
            </div>
            @if ($full_ann)
                <button type="button" class="change-btn3" data-bs-toggle="modal" data-bs-target="#fullModal">
                    Edit
                </button>
                <button type="button" class="change-btn2" data-bs-toggle="modal" data-bs-target="#fullModaldelete">
                    delete
                </button>
            @else
                <button type="button" class="change-btn3" data-bs-toggle="modal" data-bs-target="#fullModal">
                    Add
                </button>
            @endif
        </div>


        <div class="card2">
            <div class="card-header">
                <h1 class="h11">Internship Result</h1>
            </div>
            <div class="card-body">
                @if ($final)
                    <div class="iframe-container">
                        <iframe src="{{ asset('storage/uploads/FileManagement/final_announcement/' . $final->file) }}"
                            allow="autoplay"></iframe>
                    </div>
                    <p>Name: {{ $final->name }}</p>
                    <p>File: {{ $final->file }}</p>
                @else
                    <p style="text-align: center;">No internship result available.</p>
                @endif
            </div>
            @if ($final)
                <button type="button" class="change-btn3" data-bs-toggle="modal" data-bs-target="#finalModal">
                    Edit
                </button>
                <button type="button" class="change-btn2" data-bs-toggle="modal" data-bs-target="#finalModaldelete">
                    delete
                </button>
            @else
                <button type="button" class="change-btn3" data-bs-toggle="modal" data-bs-target="#finalModal">
                    Add
                </button>
            @endif
        </div>

    </div>
    <!-- Full Announcement Modal -->
    <div class="modal fade" id="fullModal" tabindex="-1" aria-labelledby="fullModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h1form" id="fullModalLabel" style="text-align: center">
                        Upload PDF File
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('full_ann') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="full_name">Name:</label>
                            <input type="text" class="form-control" id="full_name" name="name" required><br>
                            <label for="full_file" class="change-btn3">Choose PDF File:</label>
                            <input name="file" type="file" class="form-control-file" id="full_file"
                                style="display: none;" onchange="updateLabel(this)">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="change-btn2" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="change-btn">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Final Announcement Modal -->
    <div class="modal fade" id="finalModal" tabindex="-1" aria-labelledby="finalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title h1form" id="fullModalLabel" style="text-align: center">
                        Upload PDF File
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('final_ann') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="final_name">Name:</label>
                            <input type="text" class="form-control" id="final_name" name="name" required><br>
                            <label for="final_file" class="change-btn3">Choose PDF File:</label>
                            <input name="file" type="file" class="form-control-file" id="final_file"
                                style="display: none;" onchange="updateLabel(this)" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="change-btn2" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="change-btn">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Full Announcement Delete Modal -->
    @if ($full_ann)
        <div class="modal fade" id="fullModaldelete" tabindex="-1" aria-labelledby="fullModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fullModalLabel" style="text-align: center">
                            Delete Full Announcement
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('full_ann_delete', $full_ann->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            Are you sure you want to delete this data?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Final Announcement Delete Modal -->
    @if ($final)
        <div class="modal fade" id="finalModaldelete" tabindex="-1" aria-labelledby="finalModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="finalModalLabel" style="text-align: center">
                            Delete Final Announcement
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('final_ann_delete', $final->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            Are you sure you want to delete this data?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <script>
        function updateLabel(input) {
            const label = document.querySelector(`label[for="${input.id}"]`);
            const fileName = input.files.length > 0 ? input.files[0].name : 'Choose PDF File';
            label.textContent = fileName;
        }
    </script>
@endsection
