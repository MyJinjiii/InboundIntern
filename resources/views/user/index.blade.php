@extends('layouts/navigation')
@section('title')
    Inbound Internship System
@endsection

@section('log')
    Login
@endsection

@section('header')
    <h1 class="admissionstatus">Inbound Internship System</h1>
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
    </style>
     @if ($budgetYear->regis_status == 1)
    @if ($research_list->count() > 0)
       
            <h2 class="admissionstatusindex" style="margin-top: 60px; margin-bottom: 40px;">List of offered placement</h2>
            <div class="card" style="margin-bottom: 60px;">
                <table>
                    <thead>
                        <tr>
                            <th style="border-radius: 20px 0 0 0;" class="number-column">No.</th>
                            <th>Division</th>
                            <th>Program</th>
                            <th>Advisor name</th>
                            <th>Short introduction of laboratory and facilities</th>
                            <th>List of research topics</th>
                            <th>Other support</th>
                            <th>detail</th>
                            <th style="border-radius: 0 20px 0 0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach ($research_list as $research)
                            <tr>
                                <td>{{ ($research_list->currentPage() - 1) * $research_list->perPage() + $loop->iteration }}
                                </td>
                                <td>{{ $research->division }}</td>
                                <td>{{ $research->program }}</td>
                                <td>{{ $research->prof_name }}</td>
                                <td>{{ $research->short }}</td>
                                <td style="text-align: left">{!! nl2br(e($research->topic)) !!}</td>
                                <td>{{ $research->support }}</td>
                                <td><a href="{{ $research->details }}" target="blank"><button class="change-btn">More
                                            detail</button></a></td>
                                <td>
                                    <a href="{{ route('form', [
                                        'topic_id' => $research->id,
                                        'id' => Auth::check() ? Auth::user()->id : 'default_id', // ใช้ค่า 'default_id' เมื่อไม่มีผู้ใช้ล็อกอิน
                                    ]) }}"
                                        type="submit"><button class="change-btn">Apply</button></a>



                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <br><br>
                {!! $research_list->links() !!}
            </div>
      
    @else
        <div class="alert alert-warning" role="alert" style="text-align: center; width: 50%; margin: 0 auto;"><i
                class="fa-solid fa-triangle-exclamation"></i> ไม่มี Program ให้สมัครในขณะนี้ค่ะ
        </div>
    @endif
    @else
    <div style="text-align: center; margin-top: 60px;">
        <h1 style="font-size: 2rem; color: red;">ปิดการรับสมัคร</h1>
        <p style="font-size: 1.2rem; margin-top: 20px;">ขออภัย ระบบปิดการรับสมัครชั่วคราว
            กรุณาติดตามข่าวสารหรือกลับมาใหม่ในภายหลัง</p>
    </div>
@endif
@endsection
