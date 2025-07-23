@extends('layouts/navigation')
@extends('layouts/sidebar')
@section('title')
    All Advisor
@endsection
@section('header')
    <h1 class="admissionstatus">All Advisor</h1>
@endsection
@section('content')
    <style>
        table {
            width: 100%;
            margin: auto;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            margin: 0;
            border-bottom: 1px solid #ddd;
            vertical-align: middle;
        }

        th {
            text-align: center;
            padding: 12px;
            color: white;
            background-color: #044A9C;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 18px;
        }

        tbody {
            margin-top: 20px;
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
            justify-content: space-between;
            margin: 2.5%;
            margin-bottom: 0%;
        }

        .card {
            width: 65%;
            height: auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-color: #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06);
            margin: 5% auto;
        }

        .no-border-bottom td {
            border-bottom: none;
        }

        td {
            padding: 12px;
            color: #044A9C;
            vertical-align: top;
        }
    </style>
@if ($advisors->count() > 0)
<div class="card">
    <table>
        <thead>
            <tr class="no-border-bottom">
                <th style="border-radius: 20px 0 0 0;" class="number-column">No.</th>
                <th>Name-Surname</th>
                <th>Email</th>
                <th>Program</th>    
            </tr>
        </thead>
        <tbody id="table-body">
            @foreach($advisors as $advisor)
                <tr>
                    <td class="info-container" style="text-align: left;">{{ ($advisors->currentPage() - 1) * $advisors->perPage() + $loop->iteration }}</td>
                    <td id="name-surname">{{ $advisor->title }}{{ $advisor->name }} {{ $advisor->surname }}</td>
                    <td id="email" style="text-align: center;">{{ $advisor->email }}</td>
                    <td id="program" style="text-align: center;">
                        @if ($advisor->research_list->count() > 0)
                            @foreach ($advisor->research_list as $research)
                                {{ $research->program }}<br>
                            @endforeach
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{!! $advisors->links() !!}
@else
<div class="alert alert-warning" role="alert" style="text-align: center; width: 50%; margin: 0 auto;"><i class="fa-solid fa-triangle-exclamation"></i> ไม่มี Advisor ในขณะนี้</div>
@endif

@endsection
