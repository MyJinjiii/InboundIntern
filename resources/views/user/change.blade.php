@extends('layouts/navigation')
@section('title')
    Inbound Internship System
@endsection

@section('log')
    Login
@endsection

@section('header')
    <h1 class="admissionstatus">Update</h1>
@endsection

@section('content')
    <style>
        table {
            width: 100%;
            height: 100%;
            margin: auto;
        }

        th {
            text-align: center;
            padding: 12px;
            color: white;
            background-color: #044A9C;
            font-size: 18px;
        }

        td {
            padding: 12px;
            color: #044A9C;
            vertical-align: top;
        }

        tbody {
            margin-top: 20px;
            text-align: center;
            ;
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
            /* Enable flexbox for the container */
            justify-content: space-between;
            /* Distribute buttons evenly */
            margin: 2.5%;
            margin-bottom: 0%;
        }

        .card {
            margin-top: 2%;
        }

        .admissionstatusindex {
            color: #04499b;
            text-align: center;
            font-size: 35px;
            font-family: "PSU Stidti", sans-serif;
            line-height: 1.2;
            outline: none;
            width: 80%;
            margin: 0 auto;
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
    </style>@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

  <div class="card">
    <h2 class="admissionstatusindex">Update User Information</h2>
    
    <!-- ฟอร์มเปลี่ยนชื่อและนามสกุล -->
    <form action="{{ route('user.updateName') }}" method="POST">
        @csrf
        <table>
            <thead>
                <tr>
                    <th colspan="2">Update Name and Lastname</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Name</td>
                    <td>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" required>
                    </td>
                </tr>
                <tr>
                    <td>Lastname</td>
                    <td>
                        <input type="text" name="lastname" value="{{ Auth::user()->surname ?? '' }}" required>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="pagination">
            <button type="submit" class="change-btn">Update Name</button>
        </div>
    </form>
</div>

<div class="card">
    <h2 class="admissionstatusindex">Update Password</h2>
    
    <!-- ฟอร์มเปลี่ยนรหัสผ่าน -->
    <form action="{{ route('user.updatePassword') }}" method="POST">
        @csrf
        <table>
            <thead>
                <tr>
                    <th colspan="2">Update Password</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>New Password</td>
                    <td>
                        <input type="password" name="password" placeholder="Enter new password" required>
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="password_confirmation" placeholder="Confirm new password" required>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="pagination">
            <button type="submit" class="change-btn">Update Password</button>
        </div>
    </form>
</div>
@endsection
