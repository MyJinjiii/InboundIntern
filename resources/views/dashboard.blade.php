@extends('layouts/navigation')
@extends('layouts/sidebar')
@section('title')
    Admin Dashboard
@endsection
@section('header')
    <h1 class="admissionstatus">Admin Dashboard</h1>
@endsection
<?php
$fromNonScholarship = true;
?>
@section('content')
    <br><br><br><br><br><br><br>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="flex justify-center items-center h-screen">
        <div class="overflow-" style="max-height: 80vh;">
            <div class="bg-white p-8 rounded-lg shadow-lg" style="width: 900px;">
                <canvas id="myPieChart" width="400" height="400"></canvas>
            </div>
            <script>
                var ctx = document.getElementById('myPieChart').getContext('2d');
                var data = {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: 'My First Dataset',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'red',
                            'blue',
                            'yellow',
                            'green',
                            'purple',
                            'orange'
                        ]
                    }]
                };

                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: data
                });
            </script>
        </div>
    </div>
@endsection
