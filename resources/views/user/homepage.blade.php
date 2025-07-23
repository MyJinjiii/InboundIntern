@include('layouts/navigation')

<style>
    body {
        background-color: #f0f0f0;
        height: 100vh;
        margin: 0;
    }

    .slider {
        position: relative;
        width: 100%;
        max-width: 750px;
        height: 430px;
        margin: auto;
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        background-color: #ffffff;
    }

    .slides {
        display: flex;
        transition: transform 1s ease-in-out;
    }

    .slides img {
        min-width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .dots {
        position: absolute;
        bottom: 15px;
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .dot {
        height: 12px;
        width: 12px;
        margin: 0 3px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .active {
        background-color: #717171;
    }

    .card-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        /* Adjust the gap between the cards */
        margin: 20px auto;
        margin-top: 5%;
        width: 100%;
        max-width: 900px;
    }

    .card1 {
        width: 200px;
        height: 300px;
        background-color: #f0f0f0;
        border-radius: 8px;
       
        text-align: center;
        overflow: hidden;
        transition: transform 0.3s ease;
        margin: auto;
    }

    .card1 img {
        border-radius: 8px;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
        /* Smooth transition */
    }

    .card1:hover img {
        transform: scale(1.1);
        /* Enlarge the image on hover */
    }
</style>

<div class="slider">
    <div class="slides">
        @foreach($logos as $logo)
        <img src="{{ asset('storage/uploads/FileManagement/cover/' . $logo->image) }}" alt="">
        @endforeach
    </div>
    <div class="dots">
        @foreach($logos as $key => $logo)
        <span class="dot{{ $key === 0 ? ' active' : '' }}"></span>
        @endforeach
    </div>
</div>


<div class="card-container">
    <div class="card1"><a href="{{ route('index') }}"><img
                src="{{asset('storage/uploads/announcements/Register.png')}}"
                alt=""></a></div>
                <div class="card1">
                    @if (!empty($full_ann->file) && Storage::disk('public')->exists('uploads/FileManagement/full_announcement/' . $full_ann->file))
                        <a href="{{ asset('storage/uploads/FileManagement/full_announcement/' . $full_ann->file) }}" target="_blank">
                            <img src="{{ asset('storage/uploads/announcements/Register_1.png') }}" alt="">
                        </a>
                    @else
                        <p></p>
                    @endif
                </div>
                
                <div class="card1">
                    @if (!empty($final->file) && Storage::disk('public')->exists('uploads/FileManagement/final_announcement/' . $final->file))
                        <a href="{{ asset('storage/uploads/FileManagement/final_announcement/' . $final->file) }}" target="_blank">
                            <img src="{{ asset('storage/uploads/announcements/Register_2.png') }}" alt="">
                        </a>
                    @else
                        <p></p>
                    @endif
                </div>
                
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelector('.slides');
        const images = document.querySelectorAll('.slides img');
        const dots = document.querySelectorAll('.dot');

        let index = 0;
        const interval = 3000; // Change image every 3 seconds

        function changeSlide() {
            index++;
            if (index >= images.length) {
                index = 0;
            }
            slides.style.transform = `translateX(${-index * 100}%)`;

            dots.forEach((dot, idx) => {
                if (idx === index) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }

        setInterval(changeSlide, interval);
    });
</script>
