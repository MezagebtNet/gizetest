<style>
    .dark-mode .btn-refresh.btn-outline-info:hover {
        color: #fff;
        background-color: #db8a34;
        border-color: #dba934;
    }
    .dark-mode .btn-refresh.btn-outline-info {
        color: #fff;

        border-color: #dba934;
    }

    .dark-mode .card-title, .dark-mode .card-date {
        color: white !important;
    }
    .dark-mode .ribbon-wrapper, .ribbon-wrapper {
        right: 0px;
        top: 0px;
    }

    .ribbon-wrapper .ribbon, .ribbon {
/*
        box-shadow: 4px 3px 3px rgba(0,0,0,.6) !important;
        background-color: #80aa74 !important; */
        box-shadow: 4px 3px 3px rgba(0,0,0,.6) !important;
        background-color: #eccf6f !important;
        border-top: 6px solid #b27f49;
        /* padding: 3px 0 6px 0 !important; */
        color: black;
        text-shadow: none;
        font-weight: 900;
        padding: 0px 0px 1px 0px !important;
        margin: 0 3px;
    }
    .fc-widget-header {
        background: none;
    }
    .dark-mode .fc-unthemed td.fc-today {
    background: #fcf8e32e;
}
    .dark-mode .alert-success {
        color: #343232;
        }


    .dropdown-menu {
        margin: 0.5rem 0;
    }

    /* Modal Player */
    .remodal-close {}

    .remodal {
        max-width: 1250px;
        background: transparent !important;
    }

    @media only screen and (max-width: 600px) {
        .remodal {
            padding: 2px;
        }

        .remodal-close {
            top: -31px;
            left: -9px;
        }

    }

    .remodal,
    .remodal-wrapper,

    video {
        width: 100vw;
        max-height: 100vh;
    }

    /*  End of Modal Player */


    .dark-mode .dropdown-item:hover {
        background:none;
        background-color: #3f474e !important;
    }

    .dark-mode .dropdown-item .btn {
        color: white;
    }


    hr {
        border-top: 1px solid rgba(145, 140, 140, 0.26);
    }

    .dark-mode .fc .fc-list-sticky .fc-list-day>* {
        background: #000;
    }

    .dark-mode .fc .fc-list-event:hover td {
        background-color: #434343b3;
    }

    .scroll4::-webkit-scrollbar {
        width: 10px;
    }

    .scroll4::-webkit-scrollbar-thumb {
        background: #666;
        border-radius: 20px;
    }

    .scroll4::-webkit-scrollbar-track {
        background: #ddd;
        border-radius: 20px;
    }

    .main-header.dropdown-legacy .dropdown-menu {
        top: 49px;
    }

    .dark-mode a {
        color: #f39c12;
    }

    /* a:hover, a:not(.channel-cark-link):hover {
        color: #ffc107;

    } */
    .dark-mode a:not(.btn):hover,
    a:not(.channel-cark-link):hover {
        color: #d8ae2f;

    }

    .dark-mode a:not(.btn):hover {
        color: #ffc107;
    }

    .badge-warning {
        color: #ffffff;
        font-size: 0.7rem !important;
        background-color: #df1717;
        font-weight: 600 !important;
    }

    .navbar .badge {
        position: absolute;
        right: -2px;
        top: 6px;
    }

    .navbar-expand .navbar-nav .nav-link {
        padding-right: 0.6rem;
        padding-left: 0.6rem;
    }

    @media screen and (max-width: 295px) {
        .sticky-top {
            top: 96px;
        }


    }

    @media screen and (max-width: 296px) {
        .sticky-top {
            top: 96px;
            position: sticky;
            position: -webkit-sticky;
            /* top: 96px; */

            background-color: #f4f6f9;
            box-shadow: 0 0px 12px #3b3b3bb0;
            margin-left: -7px !important;
            margin-right: -7px !important;
        }

    }

    @media screen and (min-width: 296px) and (max-width: 501px) {

        .sticky-top {
            position: sticky;
            position: -webkit-sticky;
            top: 54px;

            background-color: #f4f6f9;
            box-shadow: 0 0px 12px #3b3b3bb0;
            margin-left: -7px !important;
            margin-right: -7px !important;
        }


    }



    @media screen and (max-width: 265px) {

        .dropdown-menu-lg {
            min-width: 60vw !important;
            right: 0 !important;
            position: absolute;
            margin-right: -100% !important;
        }

        .navbar-no-expand .dropdown-menu {
            position: fixed !important;
            left: 0px !important;
            width: 100% !important;
            right: 0px !important;
            /* left: -100% !important; */
            /* top: 95px !important; */
        }

        .dropdown-item {
            padding-top: 10px !important;
            padding-bottom: 10px !important;
        }

        .sticky-top {
            position: sticky;
            position: -webkit-sticky;
            /* top: 96px; */

            background-color: #f4f6f9;
            box-shadow: 0 0px 12px #3b3b3bb0;
            margin-left: -7px !important;
            margin-right: -7px !important;
        }

        .dark-mode .sticky-top {
            background-color: black;
        }

        .video-card {
            min-width: 100%;
            max-width: 22rem;
        }

        .videos-grid-wrapper {
            padding-left: 7px !important;
            padding-right: 7px !important;
        }
    }

    @media screen and (min-width: 266px) and (max-width: 570px) {
        .dropdown-menu-lg {
            min-width: 60vw !important;
            right: 0 !important;
            position: absolute;
            margin-right: -100% !important;
        }
    }

    /* ----------- 0 - 436px ----------- */
    @media screen and (max-width: 436px) {
        .navbar-no-expand .nav-link {
            padding-left: 0.6rem !important;
            padding-right: 0.6rem !important;

        }

        .dropdown-menu-lg {
            min-width: 60vw !important;
            right: 0 !important;
            position: absolute;
            margin-right: -100% !important;
        }

        .navbar-no-expand .dropdown-menu {
            position: fixed !important;
            left: 0px !important;
            width: 100% !important;
            right: 0px !important;
            /* left: -100% !important; */
            /* top: 95px !important; */
        }

        .dropdown-item {
            padding-top: 10px !important;
            padding-bottom: 10px !important;
        }

        .dark-mode .sticky-top {
            background-color: black;
        }

        .video-card {
            min-width: 100%;
            max-width: 22rem;
        }

        .videos-grid-wrapper {
            padding-left: 7px !important;
            padding-right: 7px !important;
        }
    }



    .dark-mode {
        background-color: #23252a !important;
        color: #fff;
    }

    .dark-mode .navbar-gray-dark,
    .dark-mode .main-footer {
        background-color: #000 !important;
        color: #fff;
        border-width: 0px;
    }

    .dark-mode .content-wrapper {
        background-color: #23252a;
        color: #fff;
    }

    body {
        /* font-family: 'Nunito'; */
        font-family: 'Source Sans pro';
        background: #f7fafc;
    }

</style>
