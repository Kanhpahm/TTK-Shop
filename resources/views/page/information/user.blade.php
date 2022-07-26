<script>
    var big_image;

    $(document).ready(function() {
        BrowserDetect.init();

        // Init Material scripts for buttons ripples, inputs animations etc, more info on the next link https://github.com/FezVrasta/bootstrap-material-design#materialjs
        $('body').bootstrapMaterialDesign();

        window_width = $(window).width();

        $navbar = $('.navbar[color-on-scroll]');
        scroll_distance = $navbar.attr('color-on-scroll') || 500;

        $navbar_collapse = $('.navbar').find('.navbar-collapse');

        //  Activate the Tooltips
        $('[data-toggle="tooltip"], [rel="tooltip"]').tooltip();

        // Activate Popovers
        $('[data-toggle="popover"]').popover();

        if ($('.navbar-color-on-scroll').length != 0) {
            $(window).on('scroll', materialKit.checkScrollForTransparentNavbar);
        }

        materialKit.checkScrollForTransparentNavbar();

        if (window_width >= 768) {
            big_image = $('.page-header[data-parallax="true"]');
            if (big_image.length != 0) {
                $(window).on('scroll', materialKit.checkScrollForParallax);
            }

        }


    });

    $(document).on('click', '.navbar-toggler', function() {
        $toggle = $(this);

        if (materialKit.misc.navbar_menu_visible == 1) {
            $('html').removeClass('nav-open');
            materialKit.misc.navbar_menu_visible = 0;
            $('#bodyClick').remove();
            setTimeout(function() {
                $toggle.removeClass('toggled');
            }, 550);

            $('html').removeClass('nav-open-absolute');
        } else {
            setTimeout(function() {
                $toggle.addClass('toggled');
            }, 580);


            div = '<div id="bodyClick"></div>';
            $(div).appendTo("body").click(function() {
                $('html').removeClass('nav-open');

                if ($('nav').hasClass('navbar-absolute')) {
                    $('html').removeClass('nav-open-absolute');
                }
                materialKit.misc.navbar_menu_visible = 0;
                $('#bodyClick').remove();
                setTimeout(function() {
                    $toggle.removeClass('toggled');
                }, 550);
            });

            if ($('nav').hasClass('navbar-absolute')) {
                $('html').addClass('nav-open-absolute');
            }

            $('html').addClass('nav-open');
            materialKit.misc.navbar_menu_visible = 1;
        }
    });

    materialKit = {
        misc: {
            navbar_menu_visible: 0,
            window_width: 0,
            transparent: true,
            fixedTop: false,
            navbar_initialized: false,
            isWindow: document.documentMode || /Edge/.test(navigator.userAgent)
        },

        initFormExtendedDatetimepickers: function() {
            $('.datetimepicker').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });
        },

        initSliders: function() {
            // Sliders for demo purpose
            var slider = document.getElementById('sliderRegular');

            noUiSlider.create(slider, {
                start: 40,
                connect: [true, false],
                range: {
                    min: 0,
                    max: 100
                }
            });

            var slider2 = document.getElementById('sliderDouble');

            noUiSlider.create(slider2, {
                start: [20, 60],
                connect: true,
                range: {
                    min: 0,
                    max: 100
                }
            });
        },

        checkScrollForParallax: function() {
            oVal = ($(window).scrollTop() / 3);
            big_image.css({
                'transform': 'translate3d(0,' + oVal + 'px,0)',
                '-webkit-transform': 'translate3d(0,' + oVal + 'px,0)',
                '-ms-transform': 'translate3d(0,' + oVal + 'px,0)',
                '-o-transform': 'translate3d(0,' + oVal + 'px,0)'
            });
        },

        checkScrollForTransparentNavbar: debounce(function() {
            if ($(document).scrollTop() > scroll_distance) {
                if (materialKit.misc.transparent) {
                    materialKit.misc.transparent = false;
                    $('.navbar-color-on-scroll').removeClass('navbar-transparent');
                }
            } else {
                if (!materialKit.misc.transparent) {
                    materialKit.misc.transparent = true;
                    $('.navbar-color-on-scroll').addClass('navbar-transparent');
                }
            }
        }, 17)
    };

    // Returns a function, that, as long as it continues to be invoked, will not
    // be triggered. The function will be called after it stops being called for
    // N milliseconds. If `immediate` is passed, trigger the function on the
    // leading edge, instead of the trailing.

    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this,
                args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            }, wait);
            if (immediate && !timeout) func.apply(context, args);
        };
    };

    var BrowserDetect = {
        init: function() {
            this.browser = this.searchString(this.dataBrowser) || "Other";
            this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator
                .appVersion) || "Unknown";
        },
        searchString: function(data) {
            for (var i = 0; i < data.length; i++) {
                var dataString = data[i].string;
                this.versionSearchString = data[i].subString;

                if (dataString.indexOf(data[i].subString) !== -1) {
                    return data[i].identity;
                }
            }
        },
        searchVersion: function(dataString) {
            var index = dataString.indexOf(this.versionSearchString);
            if (index === -1) {
                return;
            }

            var rv = dataString.indexOf("rv:");
            if (this.versionSearchString === "Trident" && rv !== -1) {
                return parseFloat(dataString.substring(rv + 3));
            } else {
                return parseFloat(dataString.substring(index + this.versionSearchString.length + 1));
            }
        },

        dataBrowser: [{
                string: navigator.userAgent,
                subString: "Chrome",
                identity: "Chrome"
            },
            {
                string: navigator.userAgent,
                subString: "MSIE",
                identity: "Explorer"
            },
            {
                string: navigator.userAgent,
                subString: "Trident",
                identity: "Explorer"
            },
            {
                string: navigator.userAgent,
                subString: "Firefox",
                identity: "Firefox"
            },
            {
                string: navigator.userAgent,
                subString: "Safari",
                identity: "Safari"
            },
            {
                string: navigator.userAgent,
                subString: "Opera",
                identity: "Opera"
            }
        ]

    };
</script>
<style>
    .main-raised {
        margin: -60px 30px 0;
        border-radius: 6px;
        box-shadow: 0 16px 24px 2px rgba(0, 0, 0, .14), 0 6px 30px 5px rgba(0, 0, 0, .12), 0 8px 10px -5px rgba(0, 0, 0, .2);
    }

    .main {
        background: #FFF;
        position: relative;
        z-index: 3;
    }

    .profile-page .profile {
        text-align: center;
    }

    .profile-page .profile img {
        max-width: 160px;
        width: 100%;
        margin: 0 auto;
        -webkit-transform: translate3d(0, -50%, 0);
        -moz-transform: translate3d(0, -50%, 0);
        -o-transform: translate3d(0, -50%, 0);
        -ms-transform: translate3d(0, -50%, 0);
        transform: translate3d(0, -50%, 0);
    }

    .img-raised {
        box-shadow: 0 5px 15px -8px rgba(0, 0, 0, .24), 0 8px 10px -5px rgba(0, 0, 0, .2);
    }

    .rounded-circle {
        border-radius: 50% !important;
    }

    .img-fluid,
    .img-thumbnail {
        max-width: 100%;
        height: auto;
    }

    .title {
        margin-top: 30px;
        margin-bottom: 25px;
        min-height: 32px;
        color: #3C4858;
        font-weight: 700;
        font-family: "Roboto Slab", "Times New Roman", serif;
    }

    .profile-page .description {
        margin: 1.071rem auto 0;
        max-width: 600px;
        color: #999;
        font-weight: 300;
    }

    p {
        font-size: 14px;
        margin: 0 0 10px;
    }

    .profile-page .profile-tabs {
        margin-top: 4.284rem;
    }

    .nav-pills,
    .nav-tabs {
        border: 0;
        border-radius: 3px;
        padding: 0 15px;
    }

    .nav .nav-item {
        position: relative;
        margin: 0 2px;
    }

    .nav-pills.nav-pills-icons .nav-item .nav-link {
        border-radius: 4px;
    }

    .nav-pills .nav-item .nav-link.active {
        color: #fff;
        background-color: #9c27b0;
        box-shadow: 0 5px 20px 0 rgba(0, 0, 0, .2), 0 13px 24px -11px rgba(156, 39, 176, .6);
    }

    .nav-pills .nav-item .nav-link {
        line-height: 24px;
        font-size: 12px;
        font-weight: 500;
        min-width: 100px;
        color: #555;
        transition: all .3s;
        border-radius: 30px;
        padding: 10px 15px;
        text-align: center;
    }

    .nav-pills .nav-item .nav-link:not(.active):hover {
        background-color: rgba(200, 200, 200, .2);
    }


    .nav-pills .nav-item i {
        display: block;
        font-size: 30px;
        padding: 15px 0;
    }

    .tab-space {
        padding: 20px 0 50px;
    }

    .profile-page .gallery {
        margin-top: 3.213rem;
        padding-bottom: 50px;
    }

    .profile-page .gallery img {
        width: 100%;
        margin-bottom: 2.142rem;
    }

    .profile-page .profile .name {
        margin-top: -80px;
    }

    img.rounded {
        border-radius: 6px !important;
    }

    .tab-content>.active {
        display: block;
    }

    /*buttons*/
    .btn {
        position: relative;
        padding: 12px 30px;
        margin: .3125rem 1px;
        font-size: .75rem;
        font-weight: 400;
        line-height: 1.428571;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 0;
        border: 0;
        border-radius: .2rem;
        outline: 0;
        transition: box-shadow .2s cubic-bezier(.4, 0, 1, 1), background-color .2s cubic-bezier(.4, 0, .2, 1);
        will-change: box-shadow, transform;
    }

    .btn.btn-just-icon {
        font-size: 20px;
        height: 41px;
        min-width: 41px;
        width: 41px;
        padding: 0;
        overflow: hidden;
        position: relative;
        line-height: 41px;
    }

    .btn.btn-just-icon fa {
        margin-top: 0;
        position: absolute;
        width: 100%;
        transform: none;
        left: 0;
        top: 0;
        height: 100%;
        line-height: 41px;
        font-size: 20px;
    }

    .btn.btn-link {
        background-color: transparent;
        color: #999;
    }

    /* dropdown */




    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1000;
        float: left;
        min-width: 11rem !important;
        margin: .125rem 0 0;
        font-size: 1rem;
        color: #212529;
        text-align: left;
        background-color: #fff;
        background-clip: padding-box;
        border-radius: .25rem;
        transition: transform .3s cubic-bezier(.4, 0, .2, 1), opacity .2s cubic-bezier(.4, 0, .2, 1);
    }



    .dropdown-menu .dropdown-item,
    .dropdown-menu li>a {
        position: relative;
        width: auto;
        display: flex;
        flex-flow: nowrap;
        align-items: center;
        color: #333;
        font-weight: 400;
        text-decoration: none;
        font-size: .8125rem;
        border-radius: .125rem;
        margin: 0 .3125rem;
        transition: all .15s linear;
        min-width: 7rem;
        padding: 0.625rem 1.25rem;
        min-height: 1rem !important;
        overflow: hidden;
        line-height: 1.428571;
        text-overflow: ellipsis;
        word-wrap: break-word;
    }

    .dropdown-menu.dropdown-with-icons .dropdown-item {
        padding: .75rem 1.25rem .75rem .75rem;
    }

    .dropdown-menu.dropdown-with-icons .dropdown-item .material-icons {
        vertical-align: middle;
        font-size: 24px;
        position: relative;
        margin-top: -4px;
        top: 1px;
        margin-right: 12px;
        opacity: .5;
    }

    /* footer */
</style>

{{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
<!------ Include the above in your HEAD tag ---------->
@extends('client.client-master')
@section('title', Auth::user()->name)

@section('content-client')

    <head>
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesgeet" href="https://rawgit.com/creativetimofficial/material-kit/master/assets/css/material-kit.css"> --}}
    </head>

    <body class="profile-page">
        <br>
        <br>
        <br>
        <div class="page-header header-filter" data-parallax="true"
            style="background-image:url('http://wallpapere.org/wp-content/uploads/2012/02/black-and-white-city-night.png');">
        </div>
        <div class="main main-raised">
            <div class="profile-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 ml-auto mr-auto">
                            <div class="profile">
                                <div class="avatar">
                                    <img src=" {{ asset(Auth::user()->avatar) }}"
                                        class="img-raised rounded-circle img-fluid">
                                </div>
                                <div class="name">
                                    <h1 class="title">
                                        {{ Auth::user()->name }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="description text-center">
                    </div>
                    <div class="row">
                        <div class="col-md-6 ml-auto mr-auto">
                            <div class="profile-tabs">
                                <ul class="nav nav-pills nav-pills-icons justify-content-center" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#studio" role="tab" data-toggle="tab">
                                            Quyền : {{ Auth::user()->role == 1 ? 'Admin' : 'Người dùng' }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="#studio" role="tab" data-toggle="tab">
                                            Username: {{ Auth::user()->username }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#works" role="tab" data-toggle="tab">
                                            Email: {{ Auth::user()->email }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#favorite" role="tab" data-toggle="tab">
                                            Xem đơn hàng của bạn
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="description text-center">
                                <a href="{{ route('logOut') }}" class="nav-item nav-link">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
                                </a>



                            </div>
                        </div>
                    </div>

                    @php
                        $totalPrice = 0;
                    @endphp
                    <div class="tab-content tab-space">
                        <div class="tab-pane text-center gallery" id="favorite">
                            <div class="row">
                                <div class="col-md ml-auto">

                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-black text-xxs font-weight-bolder ">
                                                    STT
                                                </th>
                                                <th class="text-uppercase text-black text-xxs font-weight-bolder  ps-2">
                                                    Người nhận
                                                </th>
                                                <th class="text-uppercase text-black text-xxs font-weight-bolder  ps-2">Số
                                                    điện thoại
                                                </th>
                                                <th class="text-uppercase text-black text-xxs font-weight-bolder  ps-2">
                                                    Địa chỉ</th>
                                                <th class="text-uppercase text-black text-xxs font-weight-bolder  ps-2">
                                                    Tình trạng</th>
                                                <th class="text-uppercase text-black text-xxs font-weight-bolder  ps-2">
                                                    </th>
                                            </tr>
                                        </thead>
                                        <style>
                                            .profile-page .gallery img {
                                                width: 30%;
                                                margin-bottom: 1.142rem;
                                            }

                                            td {
                                                width: 20%;
                                            }
                                        </style>
                                        <tbody>
                                            @foreach ($customers as $index => $item)
                                                <tr>
                                                    <td>
                                                        {{ $index + 1 }}
                                                    </td>
                                                    <td>
                                                        {{ $item->name }}
                                                    </td>
                                                    <td>
                                                        {{ $item->phone }}
                                                    </td>
                                                    <td>
                                                        {{ $item->address }}
                                                    </td>
                                                    <td>
                                                        
                                                            @if ($item->status == 0)
                                                            <sub style="color:rgb(250, 188, 102)"> Đang xử lý </sub>
                                                                    <form method="POST"
                                                                    action="{{ route('changeOrdStt', $item->id) }}">
                                                                   @csrf
                                                                   <br>
                                                                    <button class="btn btn-danger btn-sm"> Hủy đơn</button>
                                                            </form>
                                                            @elseif($item->status == 1)
                                                                <sub style="color:rgb(246, 168, 60)"> Đã xử lý</sub>
                                                            @elseif($item->status == 2)
                                                                <sub style="color:rgb(168, 222, 52)"> Đang vận chuyển</sub>
                                                            @elseif($item->status == 3)
                                                                <sub style="color:green">Thành công</sub>
                                                            @elseif($item->status == 4)
                                                                <sub style="color:rgb(252, 0, 8)"> Đơn hàng đã bị hủy </sub>
                                                            @elseif($item->status == 5)
                                                                <sub style="color:rgb(255, 4, 4)"> Đã hủy đơn
                                                                    hàng</sub>
                                                            @endif
                                                       
                                                    </td>
                                                    
                                                    <td>
                                                        <a href="{{ route('billDetail', $item->id) }}">
                                                            <i class="fa fa-eye" style="font-size:28px;color:	#50EBEC"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach


                                            {{-- @foreach ($orders as $item)
                                                @php
                                                    $price = $item->price * $item->quantity;
                                                    $totalPrice += $price;
                                                @endphp
                                                <tr>
                                                    <td>
                                                        {{ $item->products->name }}
                                                    </td>
                                                    <td>
                                                        <img src="{{ asset($item->products->image) }}" alt="">
                                                    </td>
                                                    <td>
                                                        {{ number_format($item->price, 0, ',', '.') }}
                                                    </td>
                                                    <td>
                                                        {{ $item->quantity }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($price, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <div>
                                                Tổng tiền:
                                                <b>{{ number_format($totalPrice, 0, ',', '.') . ' VNĐ' }}</b><br>
                                                <span> Trạng thái đơn hàng:
                                                    @if ($customers->status == 0)
                                                        <b>Đang xử lý</b>
                                                        <form method="POST"
                                                            action="{{ route('changeOrdStt', $customers->id) }}">
                                                            @csrf
                                                            <button class="btn btn-danger"> Hủy Đơn</button>
                                                        </form>
                                                    @elseif($customers->status == 1)
                                                        <div style="color:green"> <b>Đã xử lý</b></div>
                                                        <form method="POST"
                                                            action="{{ route('changeOrdStt', $customers->id) }}">
                                                            @csrf
                                                            <button class="btn btn-danger"> Hủy Đơn</button>
                                                        </form>
                                                    @elseif($customers->status == 2)
                                                        <div style="color:green"> <b>Đang vận chuyển</b></div>
                                                        <form method="POST"
                                                            action="{{ route('changeOrdStt', $customers->id) }}">
                                                            @csrf
                                                            <button class="btn btn-danger"> Hủy Đơn</button>
                                                        </form>
                                                    @elseif($customers->status == 3)
                                                        <div style="color:green"> <b>Thành công</b></div>
                                                    @elseif($customers->status == 4)
                                                        <div style="color:rgb(250, 9, 9)"> <b>Đơn đặt hàng của bạn đã
                                                                bị hệ thống hủy</b></div>
                                                    @elseif($customers->status == 5)
                                                        <div style="color:rgb(255, 4, 4)"> <b>Đã hủy đơn hàng</b></div>
                                                    @else
                                                        Đang giao hàng
                                                    @endif
                                                </span>
                                            </div> --}}

                                        </tbody>

                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
    </body>
@endsection
<style>
    .gg-eye-alt {
    position: relative;
    display: block;
    transform: scale(var(--ggs,1));
    width: 24px;
    height: 18px;
    border-bottom-right-radius: 100px;
    border-bottom-left-radius: 100px;
    overflow: hidden;
    box-sizing: border-box
}
.gg-eye-alt::after,
.gg-eye-alt::before {
    content: "";
    display: block;
    border-radius: 100px;
    position: absolute;
    box-sizing: border-box
}
.gg-eye-alt::after {
    top: 2px;
    box-shadow:
        inset 0 -8px 0 2px,
        inset 0 0 0 2px;
    width: 24px;
    height: 24px
}
.gg-eye-alt::before {
    width: 8px;
    height: 8px;
    border: 2px solid transparent;
    box-shadow:
        inset 0 0 0 6px,
        0 0 0 4px,
        6px 0 0 0,
        -6px 0 0 0 ;
    bottom: 4px;
    left: 8px
}
</style>
<link href='https://css.gg/eye-alt.css' rel='stylesheet'>
<script>
    
</script>