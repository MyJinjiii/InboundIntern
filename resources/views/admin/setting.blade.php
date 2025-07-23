@extends('layouts/navigation')
@extends('layouts/sidebar')
@section('title')
    Website setting
@endsection
@section('header')
    <h1 class="admissionstatus">Website setting</h1>
@endsection
@section('content')
    <style>
        .buttonchangepage {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .change-btnsetting {
            border: 1px solid #04499b;
            border-color: #04499b;
            border-radius: 10px;
            padding: 5px 15px;
            background-color: #ffffff;
            color: #04499b;
            transition: background-color 0.3s, color 0.3s;
            margin-left: 5%;
            margin-right: 5%;
        }

        .change-btnsetting:hover {
            background-color: #122241;
            color: #ffffff;
            border-color: #122241;
        }

        .container11 {
            display: flex;
            justify-content: center;

            gap: 1px;
            margin: 0 auto;
            margin-top: 0%;
            max-width: 60%;
        }

        .card1 {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            height: auto;
            padding: 20px;
            margin: 20px auto;
            overflow: hidden;
        }

        .card3 {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            height: auto;
            padding: 20px;
            margin: 20px auto;
            overflow: hidden;
        }

        .card2 {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 700px;
            margin: 20px auto;
            padding: 20px;
            box-sizing: border-box;
            overflow: hidden;
            text-align: center;
            margin-left: 20px;
        }

        .h12 {
            font-size: 25px;
            text-align: center;
            color: #04499b;
        }

        .custom-hr {
            width: 100%;
            margin-left: 10px;
            border-top: 1px solid #ddd;
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
            background-color: #ff0b03;
            color: #ffffff;
            border-color: #ff0b03;
        }

        .change-btn4 {
            border: 1px solid #459980;
            border-color: #459980;
            border-radius: 10px;
            padding: 5px 15px;
            background-color: #ffffff;
            color: #459980;
            transition: background-color 0.3s, color 0.3s;
        }

        .change-btn4:hover {
            background-color: #63E6BE;
            color: #ffffff;
            border-color: #63E6BE;
        }

        .custom-file-input {
            cursor: pointer;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px;
            background-color: #f8f9fa;
        }

        .custom-file-label {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px;
            cursor: pointer;
        }

        .change-btndelete {
            border: 1px solid #04499b;
            border-color: #04499b;
            border-radius: 10px;
            padding: 5px 15px;
            background-color: #ffffff;
            color: #04499b;
            transition: background-color 0.3s, color 0.3s;
            margin-left: 5%;
            margin-right: 5%;
        }

        .change-btndelete:hover {
            background-color: #c40000;
            color: #ffffff;
            border-color: #c40000;
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
    </style>
    <br><br>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container11">
        <div class="card1">

            <div class="card-header">
                <h1 class="h12">Upload Cover Image</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('cover') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group"><br>
                        <div style="text-align: right; font-size: 12px;">
                            <a style="color: red; margin-right: 5px;">*ขนาดของรูปต้องไม่เกิน 800px * 500px</a>
                        </div><br>
                        <div style="display: flex; align-items: center;">
                            <label for="title" style="margin-right: 10px;">Title:</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                    </div><br>
                    <div class="form-group">
                        <label for="file" class="change-btnsetting">Choose image File:</label>
                        <input name="image" type="file" class="form-control-file" id="file" style="display: none;"
                            onchange="updateLabel(this)" required>

                    </div><br>
                    <button type="submit" class="change-btnsetting" style="margin-left: 70%;">Submit</button>
                </form>
                <hr class="custom-hr">

                @foreach ($cover as $cover)
                    <h5 class="card-title">{{ $loop->iteration }}. {{ $cover->title }}</h5>
                    <p class="card-text">{{ $cover->image }}</p>
                    <button type="button" class="change-btnsetting" data-bs-toggle="modal"
                        data-bs-target="#modal{{ $cover->id }}">
                        <i class="fa fa-eye" aria-hidden="true"></i> View
                    </button>

                    <button type="button" class="change-btndelete" data-bs-toggle="modal"
                        data-bs-target="#deleteModal{{ $cover->id }}">
                        <i class="fa fa-trash" aria-hidden="true"></i> Delete
                    </button>
                    <br><br>

                    <!-- View Modal -->
                    <div class="modal fade" id="modal{{ $cover->id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel{{ $cover->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title h12" id="exampleModalLabel{{ $cover->id }}">Image Title:
                                        {{ $cover->title }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{ asset('storage/uploads/FileManagement/cover/' . $cover->image) }}"
                                        class="img-fluid" alt="{{ $cover->title }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="change-btnsetting" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $cover->id }}" tabindex="-1"
                        aria-labelledby="deleteModalLabel{{ $cover->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="h12" id="deleteModalLabel{{ $cover->id }}">Delete Cover
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this cover?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('cover.destroy', $cover->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="change-btn"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="change-btn2">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- 0 = false 1 = true  --}}
        @if (session('success_edit'))
            <div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
                {{ session('success_edit') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show custom-alert" role="alert">
                {{ session('error') }}
            </div>
        @endif



        @if ($edit && $edit->date_end == '9999-12-31')
            <div class="status-forms">
                <!-- Register Status Form -->
                <div class="card2" style="display: flex; flex-wrap: wrap; gap: 20px;">
                    <div class="status-section">
                        @if ($edit->regis_status == 0 && $edit->edit_status == 0 && $edit->confirm_status == 0)
                            <form action="{{ route('updateRegis', $edit->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <h1 class="h12">End this round</h1>
                                <hr class="custom-hr">
                                <input type="hidden" name="edit" value="0"><br>
                                <button type="button" class="change-btn2" data-bs-toggle="modal"
                                    data-bs-target="#confirmModal">
                                    End this round
                                </button>
                            </form>
                            <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="h12" id="confirmModalLabel">Confirm Action</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to end this round? This action cannot be undone.
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('updatedateend', $edit->id) }}" method="POST"
                                                id="confirmForm">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="edit" value="0">
                                                <button type="button" class="change-btn"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="change-btn2">End</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Display other forms if necessary -->
                        @endif
                    </div>
                    {{-- 0 = false 1 = true  --}}

                    <!-- Other status sections -->
                    <!-- Register Status Form -->

                    <div class="status-section">
                        @if ($edit->regis_status == '0')
                            <form action="{{ route('updateRegis', $edit->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <h1 class="h12">Register Status</h1>
                                <hr class="custom-hr">
                                <h1 class="h12" style="color:#ff0000">
                                    <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i>&nbsp;&nbsp;Inactive
                                </h1>
                                <input type="hidden" name="edit" value="1"><br>
                                <button type="submit" class="change-btn4">Turn On</button>
                            </form>
                        @else
                            <form action="{{ route('updateRegis', $edit->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <h1 class="h12">Register Status</h1>
                                <hr class="custom-hr">
                                <h1 class="h12" style="color:#63E6BE">
                                    <i class="fa-solid fa-circle-check" style="color: #63E6BE;"></i>&nbsp;&nbsp;Active
                                </h1>
                                <input type="hidden" name="edit" value="0"><br>
                                <button type="submit" class="change-btn2">Turn Off</button>
                            </form>
                        @endif
                    </div>

                    <!-- Edit Status Form -->
                    <div class="status-section">
                        @if ($edit->edit_status == '0')
                            <form action="{{ route('updateEdit', $edit->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <h1 class="h12">Edit Status</h1>
                                <hr class="custom-hr">
                                <h1 class="h12" style="color:#ff0000">
                                    <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i>&nbsp;&nbsp;Inactive
                                </h1>
                                <input type="hidden" name="edit" value="1"><br>
                                <button type="submit" class="change-btn4">Turn On</button>
                            </form>
                        @else
                            <form action="{{ route('updateEdit', $edit->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <h1 class="h12">Edit Status</h1>
                                <hr class="custom-hr">
                                <h1 class="h12" style="color:#63E6BE">
                                    <i class="fa-solid fa-circle-check" style="color: #63E6BE;"></i>&nbsp;&nbsp;Active
                                </h1>
                                <input type="hidden" name="edit" value="0"><br>
                                <button type="submit" class="change-btn2">Turn Off</button>
                            </form>
                        @endif
                    </div>

                    <!-- Confirm Status Form -->
                    <div class="status-section">
                        @if ($edit->confirm_status == '0')
                            <form action="{{ route('updateConfirm', $edit->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <h1 class="h12">Confirm Status</h1>
                                <hr class="custom-hr">
                                <h1 class="h12" style="color:#ff0000">
                                    <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i>&nbsp;&nbsp;Inactive
                                </h1>
                                <input type="hidden" name="edit" value="1"><br>
                                <button type="submit" class="change-btn4">Turn On</button>
                            </form>
                        @else
                            <form action="{{ route('updateConfirm', $edit->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <h1 class="h12">Confirm Status</h1>
                                <hr class="custom-hr">
                                <h1 class="h12" style="color:#63E6BE">
                                    <i class="fa-solid fa-circle-check" style="color: #63E6BE;"></i>&nbsp;&nbsp;Active
                                </h1>
                                <input type="hidden" name="edit" value="0"><br>
                                <button type="submit" class="change-btn2">Turn Off</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="card2">
                <form action="{{ route('round') }}" method="POST">
                    @csrf
                    <h1 class="h12">สร้างรอบการสมัคร</h1>
                    <hr class="custom-hr">

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="year">Date</label>/
                        <input type="text" name="date_start" class="form-control" value="{{ $current }}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="year">ปี</label>
                        <input type="text" name="year" class="form-control" value="{{ $currentYear }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="round">รอบ</label>
                        <input type="text" name="round" class="form-control" value="{{ $roundNumber += 1 }}">
                    </div>
                    <button type="submit" class="btn btn-success">Create</button>
                </form>
            </div>
        @endif


    </div>





    <script>
        function updateLabel(input) {
            const label = document.querySelector(`label[for="${input.id}"]`);
            const fileName = input.files.length > 0 ? input.files[0].name : 'Choose PDF File';
            label.textContent = fileName;
        }
    </script>
@endsection
