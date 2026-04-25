<link rel="stylesheet" href="{{ asset('gallery-external/parallax/jarallax.css') }}">
<style>
    img,
    .card-wrap,
    .card-wrapper,
    .video-wrapper,
    .mbr-figure iframe,
    .google-map iframe,
    .slide-content,
    .plan,
    .card,
    .item-wrapper {
    border-radius: 2rem !important;
    }
    .video-wrapper {
    overflow: hidden;
    }
    body {
    /* font-family: var(--display1-font, 'Inter Tight'); */
    background: color-mix(in srgb, var(--dominant-color, #0f1305) 10%, transparent);
    
    }

    .form-control {
    font-family: var(--display1-font);
    /* font-size: 1.4rem; */
    /* line-height: 1.3; */
    font-weight: 400;
    border-radius: 40px !important;
    }
</style>
<style>
    .cid-u2OeWPZDyq {
        z-index: 1000;
        width: 100%;
        position: relative;
    }

    .cid-u2OeWPZDyq .dropdown-item:before {
        font-family: Moririse2 !important;
        content: "\e966";
        display: inline-block;
        width: 0;
        position: absolute;
        left: 1rem;
        top: 0.5rem;
        margin-right: 0.5rem;
        line-height: 1;
        font-size: inherit;
        vertical-align: middle;
        text-align: center;
        overflow: hidden;
        transform: scale(0, 1);
        transition: all 0.25s ease-in-out;
    }

    @media (max-width: 767px) {
        .cid-u2OeWPZDyq .navbar-toggler {
            transform: scale(0.8);
        }
    }

    .cid-u2OeWPZDyq .navbar-brand {
        flex-shrink: 0;
        align-items: center;
        margin-right: 0;
        padding: 10px 0;
        transition: all 0.3s;
        word-break: break-word;
        z-index: 1;
    }

    .cid-u2OeWPZDyq .navbar-brand img {
        max-width: 100%;
        max-height: 100%;
    }

    .cid-u2OeWPZDyq .navbar-brand .navbar-caption {
        line-height: inherit !important;
    }

    .cid-u2OeWPZDyq .navbar-brand .navbar-logo a {
        outline: none;
    }

    .cid-u2OeWPZDyq .navbar-nav {
        margin: auto;
        margin-left: 0;
        margin-left: auto;
    }

    .cid-u2OeWPZDyq .navbar-nav .nav-item {
        padding: 0 !important;
        transition: 0.3s all !important;
    }

    .cid-u2OeWPZDyq .navbar-nav .nav-item .nav-link {
        padding: 16px !important;
        margin: 0 !important;
        border-radius: 1rem !important;
        transition: 0.3s all !important;
    }

    .cid-u2OeWPZDyq .navbar-nav .nav-item .nav-link:hover {
        background-color: rgba(27, 31, 10, 0.06);
    }

    .cid-u2OeWPZDyq .navbar-nav .open .nav-link::after {
        transform: rotate(180deg);
    }

    @media (min-width: 992px) {
        .cid-u2OeWPZDyq .navbar-nav .open .nav-link::before {
            content: "";
            width: 100%;
            height: 20px;
            top: 100%;
            background: transparent;
            position: absolute;
        }
    }

    .cid-u2OeWPZDyq .navbar-nav .dropdown-item {
        padding: 12px !important;
        border-radius: 0.5rem !important;
        margin: 0 8px !important;
        transition: 0.3s all !important;
    }

    .cid-u2OeWPZDyq .navbar-nav .dropdown-item:hover {
        background-color: rgba(27, 31, 10, 0.06);
    }

    @media (min-width: 992px) {
        .cid-u2OeWPZDyq .navbar-nav {
            padding-left: 1.5rem;
        }
    }

    .cid-u2OeWPZDyq .nav-link {
        width: fit-content;
        position: relative;
    }

    .cid-u2OeWPZDyq .navbar-logo {
        margin: 0 !important;
    }

    @media (max-width: 767px) {
        .cid-u2OeWPZDyq .navbar-logo {
            padding-left: 0;
        }
    }

    .cid-u2OeWPZDyq .navbar-caption {
        padding-left: 1rem;
        padding-right: 0.5rem;
    }

    @media (max-width: 767px) {
        .cid-u2OeWPZDyq .nav-dropdown {
            padding-bottom: 0.5rem;
        }
    }

    .cid-u2OeWPZDyq .nav-dropdown .link.dropdown-toggle::after {
        margin-left: 0.5rem;
        margin-top: 0.2rem;
        transition: 0.3s all;
    }

    .cid-u2OeWPZDyq .container {
        display: flex;
        height: 90px;
        padding: 0.5rem 0.6rem;
        flex-wrap: nowrap;
        background: rgba(255, 255, 255, 0.8) !important;
        left: 0;
        right: 0;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: flex-end;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        border-radius: 100vw;
        margin-top: 1rem;
        background-color: #ffffff;
        box-shadow: 0 30px 60px 0 rgba(27, 31, 10, 0.08);
    }

    @media (max-width: 992px) {
        .cid-u2OeWPZDyq .container {
            padding-right: 2rem;
        }
    }

    @media (max-width: 767px) {
        .cid-u2OeWPZDyq .container {
            width: 95%;
            height: 56px !important;
            padding-right: 1rem;
            margin-top: 0rem;
        }
    }

    .cid-u2OeWPZDyq .iconfont-wrapper {
        color: #000000 !important;
        font-size: 1.5rem;
        padding-right: 0.5rem;
    }

    .cid-u2OeWPZDyq .dropdown-menu {
        flex-wrap: wrap;
        flex-direction: column;
        max-width: 100%;
        padding: 12px 4px !important;
        border-radius: 1.5rem;
        transition: 0.3s all !important;
        min-width: auto;
        background: #ffffff;
        background: rgba(255, 255, 255, 0.8) !important;
    }

    .cid-u2OeWPZDyq .nav-item:focus,
    .cid-u2OeWPZDyq .nav-link:focus {
        outline: none;
    }

    .cid-u2OeWPZDyq .dropdown .dropdown-menu .dropdown-item {
        width: auto;
        transition: all 0.25s ease-in-out;
    }

    .cid-u2OeWPZDyq .dropdown .dropdown-menu .dropdown-item::after {
        right: 0.5rem;
    }

    .cid-u2OeWPZDyq .dropdown .dropdown-menu .dropdown-item .mbr-iconfont {
        margin-right: 0.5rem;
        vertical-align: sub;
    }

    .cid-u2OeWPZDyq .dropdown .dropdown-menu .dropdown-item .mbr-iconfont:before {
        display: inline-block;
        transform: scale(1, 1);
        transition: all 0.25s ease-in-out;
    }

    .cid-u2OeWPZDyq .collapsed .dropdown-menu .dropdown-item:before {
        display: none;
    }

    .cid-u2OeWPZDyq .collapsed .dropdown .dropdown-menu .dropdown-item {
        padding: 0.235em 1.5em 0.235em 1.5em !important;
        transition: none;
        margin: 0 !important;
    }

    .cid-u2OeWPZDyq .navbar {
        min-height: 90px;
        transition: all 0.3s;
        border-bottom: 1px solid transparent;
        background: transparent !important;
        padding: 0 !important;
        border: none !important;
        box-shadow: none !important;
        border-radius: 0 !important;
    }

    .cid-u2OeWPZDyq .navbar.opened {
        transition: all 0.3s;
    }

    .cid-u2OeWPZDyq .navbar .dropdown-item {
        padding: 0.5rem 1.8rem;
    }

    .cid-u2OeWPZDyq .navbar .navbar-logo img {
        min-width: 6rem;
        object-fit: cover;
    }

    .cid-u2OeWPZDyq .navbar .navbar-collapse {
        z-index: 1;
        justify-content: flex-end;
    }

    .cid-u2OeWPZDyq .navbar.collapsed {
        justify-content: center;
    }

    .cid-u2OeWPZDyq .navbar.collapsed .nav-item .nav-link::before {
        display: none;
    }

    .cid-u2OeWPZDyq .navbar.collapsed.opened .dropdown-menu {
        top: 0;
    }

    @media (min-width: 992px) {
        .cid-u2OeWPZDyq .navbar.collapsed.opened:not(.navbar-short) .navbar-collapse {
            max-height: calc(98.5vh - 3rem);
        }
    }

    .cid-u2OeWPZDyq .navbar.collapsed .dropdown-menu .dropdown-submenu {
        left: 0 !important;
    }

    .cid-u2OeWPZDyq .navbar.collapsed .dropdown-menu .dropdown-item:after {
        right: auto;
    }

    .cid-u2OeWPZDyq .navbar.collapsed .dropdown-menu .dropdown-toggle[data-toggle="dropdown-submenu"]:after {
        margin-left: 0.5rem;
        margin-top: 0.2rem;
        border-top: 0.35em solid;
        border-right: 0.35em solid transparent;
        border-left: 0.35em solid transparent;
        border-bottom: 0;
        top: 41%;
    }

    .cid-u2OeWPZDyq .navbar.collapsed ul.navbar-nav li {
        margin: auto;
    }

    .cid-u2OeWPZDyq .navbar.collapsed .dropdown-menu .dropdown-item {
        padding: 0.25rem 1.5rem;
        text-align: center;
    }

    .cid-u2OeWPZDyq .navbar.collapsed .icons-menu {
        padding-left: 0;
        padding-right: 0;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

    @media (max-width: 767px) {
        .cid-u2OeWPZDyq .navbar {
            min-height: 72px;
        }

        .cid-u2OeWPZDyq .navbar .navbar-logo img {
            height: 2.5rem !important;
            min-width: 2.5rem !important;
        }
    }

    @media (max-width: 991px) {
        .cid-u2OeWPZDyq .navbar .nav-item .nav-link::before {
            display: none;
        }

        .cid-u2OeWPZDyq .navbar.opened .dropdown-menu {
            top: 0;
        }

        .cid-u2OeWPZDyq .navbar .dropdown-menu .dropdown-submenu {
            left: 0 !important;
        }

        .cid-u2OeWPZDyq .navbar .dropdown-menu .dropdown-item:after {
            right: auto;
        }

        .cid-u2OeWPZDyq .navbar .dropdown-menu .dropdown-toggle[data-toggle="dropdown-submenu"]:after {
            margin-left: 0.5rem;
            margin-top: 0.2rem;
            border-top: 0.35em solid;
            border-right: 0.35em solid transparent;
            border-left: 0.35em solid transparent;
            border-bottom: 0;
            top: 40%;
        }

        .cid-u2OeWPZDyq .navbar .dropdown-menu .dropdown-item {
            padding: 0.25rem 1.5rem !important;
            text-align: center;
        }

        .cid-u2OeWPZDyq .navbar .navbar-brand {
            flex-shrink: initial;
            flex-basis: auto;
            word-break: break-word;
            padding-right: 10px;
        }

        .cid-u2OeWPZDyq .navbar .navbar-toggler {
            flex-basis: auto;
        }

        .cid-u2OeWPZDyq .navbar .icons-menu {
            padding-left: 0;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
    }

    .cid-u2OeWPZDyq .navbar.navbar-short .navbar-logo img {
        height: 2rem;
    }

    .cid-u2OeWPZDyq .dropdown-item.active,
    .cid-u2OeWPZDyq .dropdown-item:active {
        background-color: transparent;
    }

    .cid-u2OeWPZDyq .navbar-expand-lg .navbar-nav .nav-link {
        padding: 0;
    }

    .cid-u2OeWPZDyq .nav-dropdown .link.dropdown-toggle {
        margin-right: 1.667em;
    }

    .cid-u2OeWPZDyq .nav-dropdown .link.dropdown-toggle[aria-expanded="true"] {
        margin-right: 0;
        padding: 0.667em 1.667em;
    }

    .cid-u2OeWPZDyq .navbar.navbar-expand-lg .dropdown .dropdown-menu {
        background: #ffffff;
    }

    .cid-u2OeWPZDyq .navbar.navbar-expand-lg .dropdown .dropdown-menu .dropdown-submenu {
        margin: 0;
        left: 105%;
        transform: none;
        top: -12px;
    }

    .cid-u2OeWPZDyq .navbar .dropdown.open>.dropdown-menu {
        display: flex;
    }

    .cid-u2OeWPZDyq ul.navbar-nav {
        flex-wrap: wrap;
    }

    .cid-u2OeWPZDyq .navbar-buttons {
        text-align: center;
        min-width: 140px;
    }

    @media (max-width: 992px) {
        .cid-u2OeWPZDyq .navbar-buttons {
            text-align: left;
        }
    }

    .cid-u2OeWPZDyq button.navbar-toggler {
        outline: none;
        width: 31px;
        height: 20px;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
        align-self: center;
    }

    .cid-u2OeWPZDyq button.navbar-toggler .hamburger span {
        position: absolute;
        right: 0;
        width: 30px;
        height: 2px;
        border-right: 5px;
        background-color: #000000;
    }

    .cid-u2OeWPZDyq button.navbar-toggler .hamburger span:nth-child(1) {
        top: 0;
        transition: all 0.2s;
    }

    .cid-u2OeWPZDyq button.navbar-toggler .hamburger span:nth-child(2) {
        top: 8px;
        transition: all 0.15s;
    }

    .cid-u2OeWPZDyq button.navbar-toggler .hamburger span:nth-child(3) {
        top: 8px;
        transition: all 0.15s;
    }

    .cid-u2OeWPZDyq button.navbar-toggler .hamburger span:nth-child(4) {
        top: 16px;
        transition: all 0.2s;
    }

    .cid-u2OeWPZDyq nav.opened .hamburger span:nth-child(1) {
        top: 8px;
        width: 0;
        opacity: 0;
        right: 50%;
        transition: all 0.2s;
    }

    .cid-u2OeWPZDyq nav.opened .hamburger span:nth-child(2) {
        transform: rotate(45deg);
        transition: all 0.25s;
    }

    .cid-u2OeWPZDyq nav.opened .hamburger span:nth-child(3) {
        transform: rotate(-45deg);
        transition: all 0.25s;
    }

    .cid-u2OeWPZDyq nav.opened .hamburger span:nth-child(4) {
        top: 8px;
        width: 0;
        opacity: 0;
        right: 50%;
        transition: all 0.2s;
    }

    .cid-u2OeWPZDyq .navbar-dropdown {
        padding: 0 1rem;
    }

    .cid-u2OeWPZDyq a.nav-link {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cid-u2OeWPZDyq .icons-menu {
        flex-wrap: nowrap;
        display: flex;
        justify-content: center;
        padding-left: 1rem;
        padding-right: 1rem;
        padding-top: 0.3rem;
        text-align: center;
    }

    @media (max-width: 992px) {
        .cid-u2OeWPZDyq .icons-menu {
            justify-content: flex-start;
            margin-bottom: 0.5rem;
        }
    }

    @media screen and (-ms-high-contrast: active),
    (-ms-high-contrast: none) {
        .cid-u2OeWPZDyq .navbar {
            height: 70px;
        }

        .cid-u2OeWPZDyq .navbar.opened {
            height: auto;
        }

        .cid-u2OeWPZDyq .nav-item .nav-link:hover::before {
            width: 175%;
            max-width: calc(100% + 2rem);
            left: -1rem;
        }
    }

    .cid-u2OeWPZDyq .navbar .dropdown>.dropdown-menu {
        display: none;
        width: max-content;
        max-width: 500px !important;
        transform: translateX(-50%);
        top: calc(100% + 20px);
        left: 50%;
    }

    .cid-u2OeWPZDyq .navbar .dropdown>.dropdown-menu .dropdown-item {
        line-height: 1 !important;
    }

    .cid-u2OeWPZDyq .navbar .dropdown>.dropdown-menu .dropdown .dropdown-item {
        align-items: center;
        display: flex;
        height: max-content !important;
        min-height: max-content !important;
    }

    .cid-u2OeWPZDyq .navbar .dropdown>.dropdown-menu .dropdown .dropdown-item::after {
        display: inline-block;
        position: static;
        margin-left: 0.5rem;
        margin-top: 0;
        margin-right: 0;
        margin-bottom: 0;
        transition: 0.3s all;
        transform: rotate(-90deg);
    }

    .cid-u2OeWPZDyq .navbar .dropdown>.dropdown-menu .dropdown.open .dropdown-item::after {
        transform: rotate(0deg);
    }

    .cid-u2OeWPZDyq .mbr-section-btn {
        margin: -0.6rem -0.6rem;
    }

    .cid-u2OeWPZDyq .navbar-toggler {
        margin-left: 12px;
        margin-right: 8px;
        order: 1000;
    }

    @media (max-width: 991px) {
        .cid-u2OeWPZDyq .navbar-brand {
            margin-right: auto;
        }

        .cid-u2OeWPZDyq .navbar-collapse {
            z-index: -1 !important;
            position: absolute;
            top: 110%;
            left: 0;
            width: 100%;
            padding: 1rem;
            border-radius: 1.5rem;
            background: #ffffff;
            opacity: 1;
            border-color: rgba(255, 255, 255, 0.8) !important;
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(8px);
        }

        .cid-u2OeWPZDyq .navbar-nav .nav-item .nav-link::after {
            margin-left: 10px;
        }

        .cid-u2OeWPZDyq .navbar-nav .dropdown-item:hover {
            background-color: rgba(27, 31, 10, 0.06);
        }

        .cid-u2OeWPZDyq .navbar .dropdown>.dropdown-menu {
            max-width: 100% !important;
            transform: translateX(0);
            top: 10px;
            left: 0;
            padding: 8px !important;
            border-radius: 1rem;
            background-color: rgba(27, 31, 10, 0.04) !important;
        }

        .cid-u2OeWPZDyq .navbar .dropdown>.dropdown-menu .dropdown-item {
            padding: 8px !important;
            line-height: 1 !important;
            margin-bottom: 4px !important;
        }

        .cid-u2OeWPZDyq .navbar .dropdown>.dropdown-menu .dropdown .dropdown-item {
            align-items: center;
            display: flex;
            height: max-content !important;
            min-height: max-content !important;
        }

        .cid-u2OeWPZDyq .navbar .dropdown>.dropdown-menu .dropdown .dropdown-item::after {
            display: inline-block;
            position: static;
            margin-left: 0.5rem;
            margin-top: 0;
            margin-right: 0;
            margin-bottom: 0;
            transition: 0.3s all;
            transform: rotate(0deg);
        }

        .cid-u2OeWPZDyq .navbar .dropdown>.dropdown-menu .dropdown.open .dropdown-item::after {
            transform: rotate(180deg);
        }

        .cid-u2OeWPZDyq .navbar .dropdown>.dropdown-menu .dropdown-submenu {
            position: static;
            width: 100%;
            max-width: 100% !important;
            transform: translateX(0) !important;
            top: 0;
            left: 0;
            padding: 8px !important;
            border-radius: 1rem;
            background-color: rgba(27, 31, 10, 0.04) !important;
        }

        .cid-u2OeWPZDyq .navbar .dropdown.open>.dropdown-menu {
            display: flex !important;
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media (max-width: 575px) {
        .cid-u2OeWPZDyq .navbar-collapse {
            padding: 1rem;
        }
    }
</style>

<style>
    .cid-u2OeWPZsNE {
        display: flex;
    }

    @media (min-width: 768px) {
        .cid-u2OeWPZsNE {
            align-items: flex-end;
        }

        .cid-u2OeWPZsNE .row {
            justify-content: flex-start;
        }

        .cid-u2OeWPZsNE .content-wrap {
            padding: 1rem 3rem;
        }
    }

    @media (max-width: 991px) and (min-width: 768px) {
        .cid-u2OeWPZsNE .content-wrap {
            min-width: 50%;
        }
    }

    @media (max-width: 767px) {
        .cid-u2OeWPZsNE {
            -webkit-align-items: center;
            align-items: flex-end;
        }

        .cid-u2OeWPZsNE .mbr-row {
            -webkit-justify-content: center;
            justify-content: center;
        }

        .cid-u2OeWPZsNE .content-wrap {
            width: 100%;
        }
    }

    .cid-u2OeWPZsNE .mbr-fallback-image.disabled {
        display: none;
    }

    .cid-u2OeWPZsNE .mbr-fallback-image {
        display: block;
        background-size: cover;
        background-position: center center;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        background: #000000;
    }

    .cid-u2OeWPZsNE .mbr-section-title,
    .cid-u2OeWPZsNE .mbr-section-subtitle {
        text-align: left;
        color: var(--dominant-color, #ffc091);
    }

    .cid-u2OeWPZsNE .mbr-text,
    .cid-u2OeWPZsNE .mbr-section-btn {
        text-align: left;
    }
</style>

<style>
    .cid-u2OeWQ02VT {
        padding-top: 5rem;
        padding-bottom: 5rem;
        background-color: transparent;
    }

    .cid-u2OeWQ02VT .mbr-fallback-image.disabled {
        display: none;
    }

    .cid-u2OeWQ02VT .mbr-fallback-image {
        display: block;
        background-size: cover;
        background-position: center center;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
    }

    .cid-u2OeWQ02VT .card-wrapper {
        background: #ffffff;
    }

    @media (max-width: 767px) {
        .cid-u2OeWQ02VT .card-wrapper {
            padding: 2rem 1.5rem;
        }
    }

    @media (min-width: 768px) and (max-width: 991px) {
        .cid-u2OeWQ02VT .card-wrapper {
            padding: 2.25rem;
        }
    }

    @media (min-width: 992px) {
        .cid-u2OeWQ02VT .card-wrapper {
            padding: 4rem;
        }
    }

    .cid-u2OeWQ02VT .mbr-text,
    .cid-u2OeWQ02VT .mbr-section-btn {
        color: #000000;
        text-align: left;
    }

    .cid-u2OeWQ02VT .card-title,
    .cid-u2OeWQ02VT .card-box {
        text-align: left;
        color: #000000;
    }
</style>

<style>
    .cid-u2OeWQ0rWX {
        padding-top: 5rem;
        padding-bottom: 3rem;

        @media (max-width: 767px) {
            padding-bottom: 4rem;
        }

        background-image: url("{{ asset('gallery-external/images/photo-1426604966848-d7adac402bff.jpeg') }}");
    }

    .cid-u2OeWQ0rWX .item-wrapper img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 50% !important;
    }

    .cid-u2OeWQ0rWX .mbr-fallback-image.disabled {
        display: none;
    }

    .cid-u2OeWQ0rWX .mbr-fallback-image {
        display: block;
        background-size: cover;
        background-position: center center;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
    }

    .cid-u2OeWQ0rWX .item-wrapper {
        background: #ffffff;
        padding: 2.25rem;
        height: 100%;
    }

    @media (max-width: 767px) {
        .cid-u2OeWQ0rWX .item-wrapper {
            padding: 1.5rem;
            margin-bottom: 1rem;
        }
    }

    @media (min-width: 992px) and (max-width: 1200px) {
        .cid-u2OeWQ0rWX .item-wrapper {
            padding: 2rem 1.5rem;
            margin-bottom: 1rem;
        }
    }

    .cid-u2OeWQ0rWX .card-title,
    .cid-u2OeWQ0rWX .iconfont-wrapper {
        color: #000000;
    }

    .cid-u2OeWQ0rWX .content-head {
        max-width: 800px;
    }

    .cid-u2OeWQ0rWX .mbr-section-title {
        color: #000000;
    }

    .cid-u2OeWQ0rWX .mbr-section-subtitle {
        color: #000000;
    }

    .cid-u2OeWQ0rWX .card-text {
        color: #000000;
    }

    .cid-u2OeWQ0rWX .item-mb {
        margin-bottom: 2rem;
    }

    @media (max-width: 767px) {
        .cid-u2OeWQ0rWX .item-mb {
            margin-bottom: 1rem;
        }
    }
</style>

<style>
    .cid-u2OeWQ0Dzs {
        padding-top: 3rem;
        padding-bottom: 3rem;
        background-color: #ffffff;
    }

    .cid-u2OeWQ0Dzs .mbr-fallback-image.disabled {
        display: none;
    }

    .cid-u2OeWQ0Dzs .item-wrapper {
        margin-top: 2rem;
        margin-bottom: 2rem;
    }

    .cid-u2OeWQ0Dzs .mbr-fallback-image {
        display: block;
        background-size: cover;
        background-position: center center;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
    }

    .cid-u2OeWQ0Dzs .mbr-iconfont {
        display: inline-flex;
        font-size: 2rem;
        color: var(--primary-color, #d70081);
        width: 80px;
        justify-content: center;
        align-items: center;
        background: #ffd7ef;
        height: 80px;
        border-radius: 50%;
    }

    .cid-u2OeWQ0Dzs .card-title,
    .cid-u2OeWQ0Dzs .iconfont-wrapper {
        color: var(--primary-color, #d70081);
        text-align: center;
    }

    .cid-u2OeWQ0Dzs .card-text {
        color: #000000;
        text-align: center;
    }

    .cid-u2OeWQ0Dzs .content-head {
        max-width: 800px;
    }

    .cid-u2OeWQ0Dzs .mbr-section-title {
        color: #000000;
    }
</style>

<style>
    .cid-u2OeWQ1veg {
        padding-top: 5rem;
        padding-bottom: 5rem;
        background-color: transparent;
    }

    .cid-u2OeWQ1veg .mbr-text {
        color: #000000;
    }

    .cid-u2OeWQ1veg .mbr-section-subtitle {
        color: #000000;
    }

    .cid-u2OeWQ1veg .mbr-section-title {
        color: #000000;
        text-align: center;
    }

    .cid-u2OeWQ1veg .mbr-text,
    .cid-u2OeWQ1veg .item .mbr-section-btn {
        text-align: left;
    }

    .cid-u2OeWQ1veg .item-wrapper {
        background: #ffffff;
        margin-bottom: 2rem;
        padding: 2.25rem;
    }

    @media (min-width: 992px) and (max-width: 1200px) {
        .cid-u2OeWQ1veg .item-wrapper {
            padding: 2rem 1.5rem;
            margin-bottom: 2rem;
        }
    }

    @media (max-width: 767px) {
        .cid-u2OeWQ1veg .item-wrapper {
            padding: 2rem 1.5rem;
            margin-bottom: 1rem;
        }
    }
</style>

<style>
    .cid-u2OeWQ1YdA {
        padding-top: 5rem;
        padding-bottom: 5rem;
        background-color: transparent;
    }

    .cid-u2OeWQ1YdA .mbr-fallback-image.disabled {
        display: none;
    }

    .cid-u2OeWQ1YdA .mbr-fallback-image {
        display: block;
        background-size: cover;
        background-position: center center;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
    }

    @media (max-width: 767px) {
        .cid-u2OeWQ1YdA .image-wrapper {
            flex-direction: column;
        }

        .cid-u2OeWQ1YdA .image-wrapper img {
            margin: auto;
            margin-bottom: 1rem;
        }
    }

    .cid-u2OeWQ1YdA .card-box {
        max-width: 750px;
        padding-top: 2rem;
        margin-left: auto;
        margin-right: 0;
    }

    .cid-u2OeWQ1YdA img,
    .cid-u2OeWQ1YdA .item-img {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }

    .cid-u2OeWQ1YdA .card-wrapper {
        background: #ffffff;
    }

    .cid-u2OeWQ1YdA .mbr-text,
    .cid-u2OeWQ1YdA .mbr-section-btn {
        color: #000000;
    }

    .cid-u2OeWQ1YdA .card-title,
    .cid-u2OeWQ1YdA .card-box {
        color: #232323;
    }

    @media (max-width: 767px) {
        .cid-u2OeWQ1YdA .card-content-text {
            padding: 2rem 1.5rem;
            margin-bottom: 1rem;
        }
    }

    @media (min-width: 768px) and (max-width: 991px) {
        .cid-u2OeWQ1YdA .card-content-text {
            padding: 2.25rem;
        }
    }

    @media (min-width: 992px) {
        .cid-u2OeWQ1YdA .card-content-text {
            padding: 4rem;
        }
    }
</style>

<style>
    .cid-u2OeWQ1TOO {
        padding-top: 6rem;
        padding-bottom: 6rem;
        background: transparent;
    }

    .cid-u2OeWQ1TOO .mbr-fallback-image.disabled {
        display: none;
    }

    .cid-u2OeWQ1TOO .mbr-fallback-image {
        display: block;
        background-size: cover;
        background-position: center center;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
    }

    @media (min-width: 768px) {
        .cid-u2OeWQ1TOO .container-fluid {
            padding: 0;
        }
    }

    .cid-u2OeWQ1TOO .embla__slide {
        position: relative;
        min-width: 490px;
        max-width: 490px;
    }

    @media (max-width: 768px) {
        .cid-u2OeWQ1TOO .embla__slide {
            min-width: 100%;
            max-width: 100%;
            margin-left: 1rem !important;
            margin-right: 1rem !important;
        }
    }

    .cid-u2OeWQ1TOO .embla__slide a {
        display: block;
        width: 100%;
    }

    .cid-u2OeWQ1TOO .embla__button--next,
    .cid-u2OeWQ1TOO .embla__button--prev {
        display: flex;
    }

    .cid-u2OeWQ1TOO .mobi-mbri-arrow-next {
        margin-left: 5px;
    }

    .cid-u2OeWQ1TOO .mobi-mbri-arrow-prev {
        margin-right: 5px;
    }

    .cid-u2OeWQ1TOO .embla__button {
        top: 50%;
        width: 60px;
        height: 60px;
        margin-top: -1.5rem;
        font-size: 22px;
        border: 2px solid #fff;
        border-radius: 50%;
        transition: all 0.3s;
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .cid-u2OeWQ1TOO .embla__button:disabled {
        cursor: default;
        display: none;
    }

    .cid-u2OeWQ1TOO .embla__button.embla__button--prev {
        left: 0;
        margin-left: 2.5rem;
    }

    .cid-u2OeWQ1TOO .embla__button.embla__button--next {
        right: 0;
        margin-right: 2.5rem;
    }

    @media (max-width: 767px) {
        .cid-u2OeWQ1TOO .embla__button {
            top: auto;
            bottom: 1rem;
        }
    }

    .cid-u2OeWQ1TOO .embla {
        position: relative;
        width: 100%;
    }

    .cid-u2OeWQ1TOO .embla__viewport {
        overflow: hidden;
        width: 100%;
    }

    .cid-u2OeWQ1TOO .embla__viewport.is-draggable {
        cursor: grab;
    }

    .cid-u2OeWQ1TOO .embla__viewport.is-dragging {
        cursor: grabbing;
    }

    .cid-u2OeWQ1TOO .embla__slide a {
        cursor: grab;
    }

    .cid-u2OeWQ1TOO .embla__slide a:active {
        cursor: grabbing;
    }

    .cid-u2OeWQ1TOO .embla__container {
        display: flex;
        user-select: none;
        -webkit-touch-callout: none;
        -khtml-user-select: none;
        -webkit-tap-highlight-color: transparent;
    }

    .cid-u2OeWQ1TOO .item-menu-overlay {
        border-radius: 2rem;
    }

    .cid-u2OeWQ1TOO .mbr-section-title {
        color: #232323;
    }

    .cid-u2OeWQ1TOO .mbr-section-subtitle {
        color: #232323;
    }

    .cid-u2OeWQ1TOO .mbr-box {
        color: #ffffff;
    }

    .cid-u2OeWQ1TOO .slide-content {
        position: relative;
        border-radius: 4px;
        height: 100%;
        display: flex;
        overflow: hidden;
        flex-flow: column nowrap;
    }

    .cid-u2OeWQ1TOO img,
    .cid-u2OeWQ1TOO .item-img {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }

    .cid-u2OeWQ1TOO .item-wrapper {
        position: relative;
    }

    .cid-u2OeWQ1TOO .content-head {
        max-width: 800px;
    }
</style>

<style>
    .cid-u2OeWQ1OmW {
        padding-top: 5rem;
        padding-bottom: 5rem;
        background-color: #ffffff;
    }

    .cid-u2OeWQ1OmW .mbr-fallback-image.disabled {
        display: none;
    }

    .cid-u2OeWQ1OmW .mbr-fallback-image {
        display: block;
        background-size: cover;
        background-position: center center;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
    }

    .cid-u2OeWQ1OmW p {
        line-height: 1.2;
    }

    .cid-u2OeWQ1OmW .embla__slide {
        display: flex;
        justify-content: center;
        position: relative;
        min-width: 770px;
        max-width: 570px;
    }

    @media (max-width: 768px) {
        .cid-u2OeWQ1OmW .embla__slide {
            min-width: 70%;
            max-width: initial;
            margin-left: 1rem !important;
            margin-right: 1rem !important;
        }
    }

    .cid-u2OeWQ1OmW .embla__button--next,
    .cid-u2OeWQ1OmW .embla__button--prev {
        display: flex;
    }

    .cid-u2OeWQ1OmW .embla__button {
        top: 50%;
        width: 60px;
        height: 60px;
        margin-top: -1.5rem;
        font-size: 22px;
        background-color: rgba(0, 0, 0, 0.5);
        color: #fff;
        border: 2px solid #fff;
        border-radius: 50%;
        transition: all 0.3s;
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .cid-u2OeWQ1OmW .embla__button:disabled {
        cursor: default;
        display: none;
    }

    .cid-u2OeWQ1OmW .embla__button:hover {
        background: #000;
        color: rgba(255, 255, 255, 0.5);
    }

    .cid-u2OeWQ1OmW .embla__button.embla__button--prev {
        left: 0;
        margin-left: 2.5rem;
    }

    .cid-u2OeWQ1OmW .embla__button.embla__button--next {
        right: 0;
        margin-right: 2.5rem;
    }

    @media (max-width: 768px) {
        .cid-u2OeWQ1OmW .embla__button {
            top: auto;
        }
    }

    .cid-u2OeWQ1OmW .item-wrapper {
        height: 100%;
    }

    .cid-u2OeWQ1OmW .item-menu-overlay {
        border-radius: 2rem;
    }

    .cid-u2OeWQ1OmW .user_image {
        max-width: 600px;
        max-height: 400px;
        margin-bottom: 1.6rem;
        overflow: hidden;
        margin: 0 auto 2rem auto;
    }

    .cid-u2OeWQ1OmW .user_image img {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
    }

    @media (max-width: 230px) {
        .cid-u2OeWQ1OmW .user_image {
            width: 100%;
            height: auto;
        }
    }

    .cid-u2OeWQ1OmW .embla {
        position: relative;
        width: 100%;
    }

    .cid-u2OeWQ1OmW .embla__viewport {
        overflow: hidden;
        width: 100%;
    }

    .cid-u2OeWQ1OmW .embla__viewport.is-draggable {
        cursor: grab;
    }

    .cid-u2OeWQ1OmW .embla__viewport.is-dragging {
        cursor: grabbing;
    }

    .cid-u2OeWQ1OmW .embla__container {
        display: flex;
        user-select: none;
        -webkit-touch-callout: none;
        -khtml-user-select: none;
        -webkit-tap-highlight-color: transparent;
    }

    .cid-u2OeWQ1OmW .user_desk {
        color: #000000;
    }

    .cid-u2OeWQ1OmW .user_name {
        color: #000000;
    }
</style>

<style>
    .cid-u2OeWQ2EM6 {
        padding-top: 6rem;
        padding-bottom: 6rem;
        background-color: #ffffff;
    }

    .cid-u2OeWQ2EM6 .item-subtitle {
        line-height: 1.2;
        color: #000000;
    }

    .cid-u2OeWQ2EM6 img,
    .cid-u2OeWQ2EM6 .item-img {
        width: 100%;
        height: 100%;
        height: 400px;
        object-fit: cover;
    }

    .cid-u2OeWQ2EM6 .item:focus,
    .cid-u2OeWQ2EM6 span:focus {
        outline: none;
    }

    .cid-u2OeWQ2EM6 .item {
        margin-bottom: 2rem;
    }

    @media (max-width: 767px) {
        .cid-u2OeWQ2EM6 .item {
            margin-bottom: 1rem;
        }
    }

    .cid-u2OeWQ2EM6 .item-wrapper {
        position: relative;
        border-radius: 4px;
        height: 100%;
        display: flex;
        flex-flow: column nowrap;
    }

    .cid-u2OeWQ2EM6 .mbr-section-title {
        color: #232323;
    }

    .cid-u2OeWQ2EM6 .mbr-text,
    .cid-u2OeWQ2EM6 .mbr-section-btn {
        color: #232323;
    }

    .cid-u2OeWQ2EM6 .item-title {
        color: #232323;
    }

    .cid-u2OeWQ2EM6 .content-head {
        max-width: 800px;
    }
</style>

<style>
    .cid-u2OeWQ2IQT {
        padding-top: 6rem;
        padding-bottom: 6rem;
        background-color: #ffffff;
    }

    .cid-u2OeWQ2IQT .mbr-fallback-image.disabled {
        display: none;
    }

    .cid-u2OeWQ2IQT .mbr-fallback-image {
        display: block;
        background-size: cover;
        background-position: center center;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
    }

    .cid-u2OeWQ2IQT .row {
        flex-direction: row-reverse;
    }
</style>

<style>
    .cid-u2OeWQ2J54 {
        padding-top: 5rem;
        padding-bottom: 4rem;
        background-color: transparent;
    }

    .cid-u2OeWQ2J54 .item-mb {
        margin-bottom: 2rem;
    }

    @media (max-width: 767px) {
        .cid-u2OeWQ2J54 .item-mb {
            margin-bottom: 1rem;
        }
    }

    .cid-u2OeWQ2J54 .item-head {
        background: var(--primary-color, #9fe870);
        padding: 2.25rem;
    }

    @media (min-width: 992px) and (max-width: 1200px) {
        .cid-u2OeWQ2J54 .item-head {
            padding: 2rem 1.5rem;
            margin-bottom: 2rem;
        }
    }

    @media (max-width: 767px) {
        .cid-u2OeWQ2J54 .item-head {
            padding: 2rem 1.5rem;
            margin-bottom: 2rem;
        }
    }

    .cid-u2OeWQ2J54 .item-content {
        padding: 2.25rem 2.25rem 0;
        background: #ffffff;
    }

    @media (min-width: 992px) and (max-width: 1200px) {
        .cid-u2OeWQ2J54 .item-content {
            padding: 0rem 1.5rem;
        }
    }

    @media (max-width: 767px) {
        .cid-u2OeWQ2J54 .item-content {
            padding: 0rem 1.5rem;
        }
    }

    .cid-u2OeWQ2J54 .item-wrapper {
        border-radius: 2rem;
        overflow: hidden;
        margin-bottom: 2rem;
        background: #ffffff;
        padding: 0rem;
        height: 100%;
        display: flex;
        flex-flow: column nowrap;
    }

    @media (max-width: 767px) {
        .cid-u2OeWQ2J54 .item-wrapper {
            margin-bottom: 1rem;
        }
    }

    @media (min-width: 992px) and (max-width: 1200px) {
        .cid-u2OeWQ2J54 .item-wrapper .item-footer {
            padding: 0 1.5rem 2rem;
        }
    }

    @media (min-width: 1201px) {
        .cid-u2OeWQ2J54 .item-wrapper .item-footer {
            padding: 0 2rem 2rem;
        }
    }

    .cid-u2OeWQ2J54 .btn {
        width: -webkit-fill-available;
    }

    .cid-u2OeWQ2J54 .item:focus,
    .cid-u2OeWQ2J54 span:focus {
        outline: none;
    }

    .cid-u2OeWQ2J54 .mbr-section-btn {
        margin-top: auto !important;
        padding: 2rem 2rem 0;
    }

    @media (max-width: 991px) {
        .cid-u2OeWQ2J54 .mbr-section-btn {
            padding: 0rem 2.25rem 2rem;
        }
    }

    @media (max-width: 767px) {
        .cid-u2OeWQ2J54 .mbr-section-btn {
            padding: 0rem 1.5rem;
            margin-bottom: 2rem;
        }
    }

    .cid-u2OeWQ2J54 .mbr-section-title {
        color: #000000;
    }

    .cid-u2OeWQ2J54 .mbr-section-subtitle {
        color: #ffffff;
    }

    .cid-u2OeWQ2J54 .mbr-text,
    .cid-u2OeWQ2J54 .mbr-section-btn {
        text-align: left;
    }

    .cid-u2OeWQ2J54 .item-title {
        text-align: left;
        color: var(--primary-text, #ffffff);
    }

    .cid-u2OeWQ2J54 .item-subtitle {
        text-align: left;
        color: var(--primary-text, #ffffff);
    }

    .cid-u2OeWQ2J54 .content-head {
        max-width: 800px;
    }
</style>

<style>
    .cid-u2OeWQ3EaF {
        padding-top: 5rem;
        padding-bottom: 5rem;
        background-color: var(--dominant-color, #260a30);
    }

    .cid-u2OeWQ3EaF input {
        padding: 1.2rem 1.5rem;
        border: none !important;
        height: 100%;
    }

    .cid-u2OeWQ3EaF input:hover {
        border: none !important;
    }

    .cid-u2OeWQ3EaF .btn {
        height: 100%;
        margin: auto;
    }

    @media (min-width: 992px) {
        .cid-u2OeWQ3EaF .text-wrapper {
            padding: 0 2rem;
        }
    }

    .cid-u2OeWQ3EaF .row {
        justify-content: center;
    }

    .cid-u2OeWQ3EaF .mbr-section-btn {
        display: flex;
        margin-bottom: 1.2rem;
        width: fit-content;
    }

    @media (min-width: 768px) {
        .cid-u2OeWQ3EaF .mbr-section-btn {
            margin-left: initial;
        }
    }

    .cid-u2OeWQ3EaF .mbr-section-btn .btn {
        width: auto;
    }

    @media (max-width: 991px) {
        .cid-u2OeWQ3EaF .image-wrapper {
            margin-bottom: 2rem;
        }

        .cid-u2OeWQ3EaF .content-wrapper {
            flex-direction: column-reverse;
        }
    }

    .cid-u2OeWQ3EaF .justify-content-center {
        align-items: center;
    }

    .cid-u2OeWQ3EaF .mbr-section-title {
        text-align: center;
        color: var(--dominant-text, #ffd7ef);
    }
</style>

<style>
    .cid-u2OeWQ3b7j {
        display: flex;
        padding-top: 6em;
        padding-bottom: 5em;
        background-color: var(--dominant-color, #393193);
    }

    .cid-u2OeWQ3b7j .mbr-fallback-image.disabled {
        display: none;
    }

    .cid-u2OeWQ3b7j .mbr-fallback-image {
        display: block;
        background-size: cover;
        background-position: center center;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
    }

    @media (min-width: 768px) {
        .cid-u2OeWQ3b7j {
            align-items: center;
        }

        .cid-u2OeWQ3b7j .row {
            justify-content: center;
        }
    }

    @media (max-width: 991px) and (min-width: 768px) {
        .cid-u2OeWQ3b7j .content-wrap {
            min-width: 50%;
        }
    }

    @media (max-width: 767px) {
        .cid-u2OeWQ3b7j {
            -webkit-align-items: center;
            align-items: center;
        }

        .cid-u2OeWQ3b7j .mbr-row {
            -webkit-justify-content: center;
            justify-content: center;
        }

        .cid-u2OeWQ3b7j .content-wrap {
            width: 100%;
            max-width: 800px;
        }
    }

    .cid-u2OeWQ3b7j .mbr-section-title {
        text-align: center;
        color: var(--dominant-text, #ffffff);
    }

    .cid-u2OeWQ3b7j .mbr-text,
    .cid-u2OeWQ3b7j .mbr-section-btn {
        text-align: center;
        color: var(--dominant-text, #ffffff);
    }
</style>

<style>
    .cid-u2OeWQ4ozm {
        padding-top: 5rem;
        padding-bottom: 5rem;
        background-color: #ffffff;
    }

    .cid-u2OeWQ4ozm .mbr-fallback-image.disabled {
        display: none;
    }

    .cid-u2OeWQ4ozm .mbr-fallback-image {
        display: block;
        background-size: cover;
        background-position: center center;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
    }

    .cid-u2OeWQ4ozm .bg-facebook {
        background: #1778f2;
        color: #ffffff;
    }

    .cid-u2OeWQ4ozm .bg-facebook:hover {
        background: #0b60cb;
    }

    .cid-u2OeWQ4ozm .bg-twitter {
        background: #1da1f2;
        color: #ffffff;
    }

    .cid-u2OeWQ4ozm .bg-twitter:hover {
        background: #0c85d0;
    }

    .cid-u2OeWQ4ozm .bg-instagram {
        background: #f00075;
        color: #ffffff;
    }

    .cid-u2OeWQ4ozm .bg-instagram:hover {
        background: #bd005c;
    }

    .cid-u2OeWQ4ozm .bg-tiktok {
        background: #000000;
        color: #ffffff;
    }

    .cid-u2OeWQ4ozm .bg-tiktok:hover {
        background: #000000;
    }

    .cid-u2OeWQ4ozm .iconfont-wrapper {
        display: inline-block;
        font-size: 32px;
        border-radius: 50%;
        width: 72px;
        height: 72px;
        line-height: 72px;
        text-align: center;
        transition: all 0.3s ease-in-out;
    }

    .cid-u2OeWQ4ozm [class^="socicon-"]:before,
    .cid-u2OeWQ4ozm [class*=" socicon-"]:before {
        line-height: 55px;
        padding: .6rem;
    }
</style>

<style>
    .cid-u2OeWQ4Ac5 {
        padding-top: 5rem;
        padding-bottom: 5rem;
        background-color: #ffffff;
    }

    .cid-u2OeWQ4Ac5 .item-subtitle {
        line-height: 1.2;
        color: #000000;
    }

    .cid-u2OeWQ4Ac5 img,
    .cid-u2OeWQ4Ac5 .item-img {
        width: 100%;
    }

    .cid-u2OeWQ4Ac5 .item:focus,
    .cid-u2OeWQ4Ac5 span:focus {
        outline: none;
    }

    .cid-u2OeWQ4Ac5 .item {
        margin-bottom: 2rem;
    }

    @media (max-width: 575px) {
        .cid-u2OeWQ4Ac5 .item {
            margin-bottom: 1rem;
        }
    }

    .cid-u2OeWQ4Ac5 .item-wrapper {
        position: relative;
        border-radius: 4px;
        height: 100%;
        display: flex;
        flex-flow: column nowrap;
    }

    .cid-u2OeWQ4Ac5 .mbr-section-title {
        color: #000000;
    }

    .cid-u2OeWQ4Ac5 .mbr-text,
    .cid-u2OeWQ4Ac5 .mbr-section-btn {
        color: #000000;
    }

    .cid-u2OeWQ4Ac5 .item-title {
        color: #000000;
        text-align: center;
    }

    .cid-u2OeWQ4Ac5 .content-head {
        max-width: 800px;
    }

    .cid-u2OeWQ4Ac5 img {
        filter: grayscale(1);
    }
</style>

<style>
    .cid-u2OeWQ4ba3 {
        padding-top: 6rem;
        padding-bottom: 6rem;
        background-color: transparent;
    }

    .cid-u2OeWQ4ba3 .mbr-overlay {
        background-color: #ffffff;
        opacity: 0.4;
    }

    .cid-u2OeWQ4ba3 form .mbr-section-btn {
        text-align: center;
        width: 100%;
    }

    .cid-u2OeWQ4ba3 form .mbr-section-btn .btn {
        display: inline-flex;
    }

    @media (max-width: 991px) {
        .cid-u2OeWQ4ba3 form .mbr-section-btn .btn {
            width: 100%;
        }
    }

    .cid-u2OeWQ4ba3 .content-head {
        max-width: 800px;
    }
</style>

<style>
    .cid-u2OeWQ4xCF {
        padding-top: 5rem;
        padding-bottom: 5rem;
        background: transparent;
    }

    .cid-u2OeWQ4xCF .mbr-fallback-image.disabled {
        display: none;
    }

    .cid-u2OeWQ4xCF .mbr-fallback-image {
        display: block;
        background-size: cover;
        background-position: center center;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
    }

    @media (max-width: 992px) {
        .cid-u2OeWQ4xCF .row .map-wrapper {
            margin-top: 2rem;
        }
    }

    @media (max-width: 767px) {
        .cid-u2OeWQ4xCF .row .map-wrapper {
            margin-top: 1rem;
        }
    }

    .cid-u2OeWQ4xCF .google-map {
        height: 100%;
        position: relative;
    }

    .cid-u2OeWQ4xCF .google-map iframe {
        height: 100%;
        width: 100%;
    }

    @media (max-width: 992px) {
        .cid-u2OeWQ4xCF .google-map iframe {
            min-height: 350px;
        }
    }

    .cid-u2OeWQ4xCF .google-map [data-state-details] {
        color: #6b6763;
        height: 1.5em;
        margin-top: -0.75em;
        padding-left: 1.25rem;
        padding-right: 1.25rem;
        position: absolute;
        text-align: center;
        top: 50%;
        width: 100%;
    }

    .cid-u2OeWQ4xCF .google-map[data-state] {
        background: #e9e5dc;
    }

    .cid-u2OeWQ4xCF .google-map[data-state="loading"] [data-state-details] {
        display: none;
    }

    .cid-u2OeWQ4xCF .card-wrapper {
        padding: 2.25rem;
        background: #ffffff;
    }

    @media (min-width: 992px) and (max-width: 1200px) {
        .cid-u2OeWQ4xCF .card-wrapper {
            padding: 1.5rem;
        }
    }

    @media (max-width: 767px) {
        .cid-u2OeWQ4xCF .card-wrapper {
            padding: 2rem 1.5rem;
        }
    }

    .cid-u2OeWQ4xCF ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .cid-u2OeWQ4xCF .content-head {
        max-width: 800px;
    }
</style>

<style>
    .cid-u2OeWQ4kpl {
        padding-top: 5rem;
        padding-bottom: 5rem;
        background-color: #000000;
    }

    .cid-u2OeWQ4kpl .social-row {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }

    .cid-u2OeWQ4kpl .social-row .soc-item {
        margin: 8px;
    }

    .cid-u2OeWQ4kpl .social-row .soc-item a:hover .mbr-iconfont,
    .cid-u2OeWQ4kpl .social-row .soc-item a:focus .mbr-iconfont {
        background-color: #ffffff;
    }

    .cid-u2OeWQ4kpl .social-row .soc-item a .mbr-iconfont {
        width: 72px;
        height: 72px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 100%;
        font-size: 32px;
        background-color: #edefeb;
        color: #000000;
        transition: all 0.3s ease-in-out;
    }

    .cid-u2OeWQ4kpl .row-links {
        width: 100%;
        justify-content: center;
    }

    .cid-u2OeWQ4kpl .header-menu {
        list-style: none;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        padding: 0;
        margin-bottom: 0;
    }

    .cid-u2OeWQ4kpl .header-menu li {
        padding: 0 1rem 1rem 1rem;
    }

    .cid-u2OeWQ4kpl .header-menu li p {
        margin: 0;
    }

    .cid-u2OeWQ4kpl .copyright {
        margin-bottom: 0;
        color: #ffffff;
        text-align: center;
    }

    .cid-u2OeWQ4kpl .mbr-section-title {
        color: #ffffff;
    }
</style>