<style>
    .container1 {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin: 0 auto; 
        margin-top: 0%;
        max-width: 80%;
    }

    .card {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

        width: 300px;
        text-align: center;
        height: 490px; /* Fixed height for card */
        overflow: hidden; /* Prevent overflow */
    }

    .card img {
        border-radius: 8px;
        width: 300px;
        height: 490px;
        object-fit: cover;
        transition: transform 0.3s ease;
        /* Smooth transition */
    }

    .card:hover img {
        transform: scale(1.1);
        /* Enlarge the image on hover */
    }
</style>
@extends('layouts/navigation')
@section('title')
    Student or Advisor
@endsection
@section('header')
    <h1 class="admissionstatus">Student or Advisor</h1>
@endsection
@section('content')
<br><br><br><br>
<div class="container1">
    <div class="card"><a href="{{ route('register') }}">
        <img src="https://www.creativefabrica.com/wp-content/uploads/2020/11/30/College-Student-with-Book-and-Laptop-Graphics-6921405-1.jpg" alt=""></a>
    </div>
    <div class="card"><a href="{{ route('advisor.register') }}">
        <img src="https://img.freepik.com/premium-vector/business-flat-drawing-young-businessman-pointing-away-hands-together-showing-presenting-something-while-standing-smiling-emotion-body-language-cartoon-style-design-vector-illustration_620206-339.jpg" alt=""></a>
    </div>
</div>
@endsection
