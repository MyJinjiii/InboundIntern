@extends('layouts/navigation')
@extends('layouts/sidebar')
@section('title')
    Website setting
@endsection
@section('header')
    <h1 class="admissionstatus">Edit Role </h1>
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

    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }

        th,
        td {
            border: 1px solid #ccc;
            text-align: left;
            padding: 10px;
        }

        th {
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:nth-child(odd) {
            background-color: #fff;
        }
    </style>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $key => $user)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $user->name }} {{ $user->surname }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->user_type == 'admin')
                        <span>{{ $user->user_type }}</span> 
                    @else
                        <form action="{{ route('updateUserType', $user->id) }}" method="POST">
                            @csrf
                            <select name="user_type" class="form-select">
                                <option value="user" {{ $user->user_type == 'user' ? 'selected' : '' }}>User</option>
                                <option value="advisor" {{ $user->user_type == 'advisor' ? 'selected' : '' }}>Advisor</option>
                                <option value="admin" {{ $user->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    @endif
                </td>
                <td>
                    @if ($user->user_type != 'admin')
                        <form action="{{ route('deleteUser', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @else
                        <span class="text-muted">Cannot delete Admin</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    
    
    






    <script>
        function updateLabel(input) {
            const label = document.querySelector(`label[for="${input.id}"]`);
            const fileName = input.files.length > 0 ? input.files[0].name : 'Choose PDF File';
            label.textContent = fileName;
        }
    </script>
@endsection
