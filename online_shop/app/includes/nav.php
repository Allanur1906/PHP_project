<?php
// Get the current request URI
$currentRoute = $_SERVER['REQUEST_URI'];
?>
<nav class="navbar navbar-expand-lg bg-dark text-white">
    <div class="container-fluid">
        <a class="navbar-brand logo" href="/">
            <div class="d-flex text-white">
                Application
            </div>
        </a>


        <button id="sidebar-toggle" class="navbar-nav mr-auto">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" \n' + '                 stroke="currentColor" stroke-width="2"\n' + '                 stroke-linecap="round"\n' + '                 stroke-linejoin="round">\n' + '                <line x1="3" y1="12" x2="21" y2="12"></line>\n' + '                <line x1="3" y1="6" x2="21" y2="6"></line>\n' + '                <line x1="3" y1="18" x2="21" y2="18"></line>\n' + '            </svg>
        </button>



        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
<!--            <div class="navbar-nav">-->
<!--                <a class="nav-link text-white" href="/online_shop/users/index">Users</a>-->
<!--                <a class="nav-link" href="/online_shop/products/index">Products</a>-->
<!--            </div>-->

            <div class="ms-auto dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= $_SESSION['email'] ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#" onclick="document.querySelector(' .hidden').submit(); return false;">Logout</a></li>
                <form action="/online_shop/logout" method="post" class="hidden">

                </form>
                </ul>
    </div>
    </div>
    </div>
</nav>


<div class="sidebar">
    <div class="menu">
        <ul class="list-group menu-lists">
            <li>
                <a href="/online_shop/products/index" class="text-decoration-none <?= $currentRoute == '/online_shop/products/index' ? 'li_active' : '' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package">
                        <line x1="16.5" y1="9.4" x2="7.5" y2="4.21" />
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96" />
                        <line x1="12" y1="22.08" x2="12" y2="12" />
                    </svg>
                    Products
                </a>
            </li>



            <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1): ?>
                <li>
                    <a href="/online_shop/users/index" class="text-decoration-none <?= $currentRoute == '/online_shop/users/index' ? 'li_active' : '' ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        <span>Users</span>
                    </a>
                </li>
            <?php endif; ?>

        </ul>
    </div>


</div>


<style>
    .sidebar {
        position: fixed;
        width: 244px;
        top: 70px;
        left: 0.2px;
        bottom: 0;
        overflow: hidden;
        height: calc(100vh - 62px);
        z-index: 1029;
        background: #2f323a;
        font-size: 14px;
    }

    .sidebar .menu {
        padding: 24px;
        overflow: auto;
    }

    .sidebar .menu-lists li {
        list-style: none;
        position: relative;
        border-radius: 2px;

    }

    .menu-lists li:hover {
        background: #4ECDC4;
    }

    .menu-lists li:hover a {
        color: #fff;
    }


    .menu-lists li a {
        color: #8f8f8f;
        display: block;
        font-size: 1.3rem;
        text-decoration: none;
        width: 100%;
        padding: 11px 3px 11px 40px;
    }


    .sidebar .menu-lists li svg {
        position: absolute;
        left: 0;
        top: 12px;
    }

    .navbar {
        background: #22242a;
        border-bottom: 1px solid #393d46;
        min-height: 70px;
    }

    .navbar .navbar-brand {
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 8px;
        width: 229px;
        margin: 0;
    }

    .navbar-nav .nav-link {
        padding: 17px 22px;
        color: #444;
    }

    #sidebar-toggle {
        margin-left: 98px;
        padding: 0;
        cursor: pointer;
        background-color: #22242a;
        color: #fff;
        border: none;
    }


    .contents {
        margin-left: 245px;
        background: #fff;
        padding: 36px 36px 36px 36px;

    }

    .li_active {
        background: #4ECDC4;
        border-radius: 2px;
        color: #fff !important;
    }
</style>

<script src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script>
    let toggle = true;
    $('#sidebar-toggle').click(function() {
        if (toggle) {
            $('.sidebar').animate({
                left: -250
            }, 400);
            $('.contents').animate({
                'margin-left': '0px'
            }, 400);
            $('.menu-toggle').css('display', 'block').animate({
                opacity: 1
            }, 400);
            // $('.select2-container').css('width','100%');
            toggle = false;
        } else {
            $('.sidebar').animate({
                left: 0.2
            }, 400);
            $('.contents').animate({
                'margin-left': '245px'
            }, 400);
            $('.menu-toggle').css('display', 'none').animate({
                opacity: 0
            }, 400);
            toggle = true;
        }
    });
</script>