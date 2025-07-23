<meta charset="UTF-8">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'>
<meta charset="UTF-8">
<script src="https://kit.fontawesome.com/87bcf3e0a4.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@vite('resources/css/app.css')
<link rel="icon" href="https://www.sci.psu.ac.th/wp-content/uploads//2021/06/original-sci-logo-th-01.svg">
<style>
    input[type="file"] {
        display: none;
    }

    .dropdown-content {
        display: none;
        position: relative;
        background: var(--navbar-dark-primary);
        min-width: 160px;
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        z-index: 1;
        color: var(--navbar-light-primary);
    }

    .dropdown-content a {
        padding: 12px 16px;
        display: block;
        color: inherit;
        text-decoration: inherit;
    }   

    .dropdown-content a:hover {
        background: var(--navbar-dark-primary);
    }

    .dropdown-btn:hover .dropdown-content {
        display: block;
    }

    .dropdown-content1 {
        display: none;
        position: relative;
        /* Change absolute to relative */
        background: var(--navbar-dark-primary);
        min-width: 160px;
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        z-index: 1;
        color: var(--navbar-light-primary);
    }

    .dropdown-content1 a {
        padding: 12px 16px;
        display: block;
        color: inherit;
        text-decoration: inherit;
    }

    .dropdown-content1 a:hover {
        background: var(--navbar-dark-primary);
    }

    .dropdown-btn:hover .dropdown-content1 {
        display: block;
    }
    .nav-button1 {
        position: relative;
        margin-left: 10%;
        height: 54px;
        display: flex;
        align-items: center;
        color: var(--navbar-light-secondary);
        direction: ltr;
        cursor: pointer;
        z-index: 1;
        transition: color 0.2s;
    }

    .nav-button1:nth-of-type(1):hover {
        color: var(--navbar-dark-secondary);
    }

    .nav-button1:nth-of-type(1):hover~#nav-content-highlight {
        top: 16px;
    }

    .nav-button1:nth-of-type(2):hover {
        color: var(--navbar-dark-secondary);
    }

    .nav-button1:nth-of-type(2):hover~#nav-content-highlight {
        top: 70px;
    }

    .nav-button1:nth-of-type(3):hover {
        color: var(--navbar-dark-secondary);
    }

    .nav-button1:nth-of-type(3):hover~#nav-content-highlight {
        top: 124px;
    }

    .nav-button1:nth-of-type(4):hover {
        color: var(--navbar-dark-secondary);
    }

    .nav-button1:nth-of-type(4):hover~#nav-content-highlight {
        top: 178px;
    }

    .nav-button1:nth-of-type(5):hover {
        color: var(--navbar-dark-secondary);
    }

    .nav-button1:nth-of-type(5):hover~#nav-content-highlight {
        top: 232px;
    }

    .nav-button1:nth-of-type(6):hover {
        color: var(--navbar-dark-secondary);
    }

    .nav-button1:nth-of-type(6):hover~#nav-content-highlight {
        top: 286px;
    }

    .nav-button1:nth-of-type(7):hover {
        color: var(--navbar-dark-secondary);
    }

    .nav-button1:nth-of-type(7):hover~#nav-content-highlight {
        top: 340px;
    }

    .nav-button1:nth-of-type(8):hover {
        color: var(--navbar-dark-secondary);
    }

    .nav-button1:nth-of-type(8):hover~#nav-content-highlight {
        top: 394px;
    }

    .hr {
        color: #084cdf;
    }

</style>
<div id="nav-bar" >
    <input id="nav-toggle" type="checkbox" />
    <div id="nav-header"><a id="nav-title">Admin Panel</a>
        <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
        <hr class="custom-hr" />
    </div>
    <div id="nav-content">
        <a href="#" id="usersDropdown">
            <div class="nav-button dropdown-btn"><i class="fas fa-users"></i><span>User</span></div>
        </a>
        <div class="dropdown-content">
            <div class="nav-button1">
                <a href="{{ route('alluser') }}">All Users</a>
            </div>
            <div class="nav-button1">
                <a href="{{ route('scholarship') }}">Scholarship</a>
            </div>
            <div class="nav-button1">
                <a href="{{ route('nonscholarship') }}">Non-Scholarship</a>
            </div>
            
        </div>
        <a href="{{ route('advisor') }}">
            <div class="nav-button"><i class="fas fa-user-tie"></i><span>advisor</span></div>
        </a>
        <a href="#" id="programDropdown">
            <div class="nav-button dropdown-btn"><i class="fas fa-clipboard-list"></i><span>Program</span></div>
        </a>
        <div class="dropdown-content1">
            <div class="nav-button1">
                <a href="{{ route('allprogram') }}"> All Programs</a>
            </div>
            <div class="nav-button1">
                <a href="{{ route('Program.approve') }}">Approve Programs</a>
            </div>
        </div>
        <a href="{{ route('ann') }}">
            <div class="nav-button" id="announcementBtn"><i class="fas fa-bell"></i><span>Announcement</span>
            </div>
        </a>
        <a href="{{ route('admin.dashboard') }}">
            <div class="nav-button"><i class="fas fa-chart-line"></i><span>Dashboard</span></div>
        </a>
        <a href="{{ route('index') }}">
            <div class="nav-button"><i class="fas fa-address-book"></i><span>Program page</span></div>
        </a>
        <a href="{{ route('setting') }}">
            <div class="nav-button"><i class="fas fa-solid fa-gear"></i><span>Setting</span></div>
        </a>
        <a href="{{ route('editrole') }}">
            <div class="nav-button"><i class="fas fa-solid fa-gear"></i><span>Edit Role</span></div>
        </a>
        <div id="nav-content-highlight"></div>
    </div>
</div>

    
<script>
    (function() {
        const usersDropdown = document.getElementById('usersDropdown');
        const dropdownContent = document.querySelector('.dropdown-content');

        usersDropdown.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
        });

        // Event listener to close dropdown when clicking outside
        window.addEventListener('click', function(event) {
            if (!event.target.matches('.dropdown-btn')) {
                dropdownContent.style.display = 'none';
            }
        });
    })(); // Immediately Invoked Function Expression (IIFE) for encapsulation
    (function() {
        const programDropdown = document.getElementById('programDropdown');
        const dropdownContent1 = document.querySelector('.dropdown-content1');

        programDropdown.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            dropdownContent1.style.display = dropdownContent1.style.display === 'block' ? 'none' : 'block';
        });

        // Event listener to close dropdown when clicking outside
        window.addEventListener('click', function(event) {
            if (!event.target.matches('.dropdown-btn')) {
                dropdownContent1.style.display = 'none';
            }
        });
    })();
</script>
