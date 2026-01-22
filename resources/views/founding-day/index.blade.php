<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>مجموعة الفرقان للتعليم وتقنية المعلومات</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>

        * {
            margin: 0;
            padding: 0
        }

        html {
            height: 100%
        }

        p {
            color: grey
        }

        .btn-primary {
            background-color: #38643f !important;
            border-color: #38643f !important;
        }

        @if(app()->getLocale() != 'ar')
            .text-right {
            text-align: left !important;
        }


        .label-time {
            margin-left: 20px !important;
        }
        @endif

        @if(app()->getLocale() == 'ar')
            .label-time {
            margin-right: 20px !important;
        }
        @endif

        .back-ground{
            height: 106vh;
            position: fixed;
            right: 7vh;
        }

        #heading {
            text-transform: uppercase;
            color: #38643f;
            font-weight: normal;
            font-family: 'Cairo', sans-serif;
        }
        #last-price{
            color: red;
            font-size: 18px;
        }
        #msform {
            text-align: center;
            position: relative;
            margin-top: 20px;
            font-family: 'Cairo', sans-serif;
        }
        button  {
            font-family: 'Cairo', sans-serif;
        }

        #std-name {
            cursor: default !important;
        }

        #msform fieldset {
            border: 0 none;
            border-radius: 0.5rem;
            box-sizing: border-box;
            width: 100%;
            margin: 0;
            padding-bottom: 20px;
            position: relative
        }

        .input-time {
            width: auto !important;
        }

        .form-card {
            text-align: left
        }

        #msform fieldset:not(:first-of-type) {
            display: none
        }

        #msform input,
        #msform textarea {
            padding: 8px 15px 8px 15px;
            border: 1px solid #ccc;
            border-radius: 0px;
            margin-bottom: 25px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            font-family: 'Cairo', sans-serif;
            color: #2C3E50;
            background-color: #ECEFF1;
            font-size: 16px;
            letter-spacing: 1px
        }

        #msform input:focus,
        #msform textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #38643f;
            outline-width: 0
        }

        #msform .action-button {
            width: 100px;
            background: #38643f;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 0px 10px 5px;
            float: left
        }

        #msform .action-button:hover,
        #msform .action-button:focus {
            background-color: #38643f
        }

        #msform .action-button-previous {
            width: 100px;
            background: #616161;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px 10px 0px;
            float: left
        }
        .prices_small{
            display: block;
            padding: 4px 0px;
            font-weight: bold;
            font-size: 16px;
            font-family: cairo;
            color: #333;
        }
        .more-small{

            font-weight: normal;
            font-size: 14px;
            color: #4a4a4a;
        }
        #msform .action-button-previous:hover,
        #msform .action-button-previous:focus {
            background-color: #000000
        }
        ul {
            list-style-position: inside;
        }
        .card {
            /*background: #fff;*/
            z-index: 0;
            border: none;
            position: relative;
        }

        .fs-title {
            font-size: 25px;
            color: #38643f;
            margin-bottom: 15px;
            font-weight: normal;
            text-align: left
        }

        .purple-text {
            color: #38643f;
            font-weight: normal
        }

        .steps {
            font-size: 25px;
            color: gray;
            margin-bottom: 10px;
            font-weight: normal;
            text-align: right
        }

        .fieldlabels {
            color: gray;
            text-align: left
        }

        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: lightgrey
        }

        #progressbar .active {
            color: #38643f
        }

        #progressbar li {
            list-style-type: none;
            font-size: 15px;
            width: 33%;
            float: left;
            position: relative;
            font-weight: 400
        }

        #progressbar #account:before {
            font-family: FontAwesome;
            content: "\f13e"
        }

        #progressbar #register-options:before {
            font-family: FontAwesome;
            content: "\f008"
        }

        #progressbar #personal:before {
            font-family: FontAwesome;
            content: "\f007"
        }

        #progressbar #payment:before {
            font-family: FontAwesome;
            content: "\f030"
        }

        #progressbar #confirm:before {
            font-family: FontAwesome;
            content: "\f00c"
        }

        #table-installment .green {
            color: green !important;
            font-weight: bold;
        }
        #table-installment th {
            color: red !important;
            font-weight: bold;
        }
        #progressbar li:before {
            width: 50px;
            height: 50px;
            line-height: 45px;
            display: block;
            font-size: 20px;
            color: #ffffff;
            background: lightgray;
            border-radius: 50%;
            margin: 0 auto 10px auto;
            padding: 2px
        }

        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: lightgray;
            position: absolute;
            left: 0;
            top: 25px;
            z-index: -1
        }

        #msform label, #payment-form label {
            color: black !important;
            font-weight: bold !important;
            font-family: 'Cairo', sans-serif;
        }

        #msform #checks-section label {
            color: black !important;
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #38643f
        }

        .progress {
            height: 20px
        }

        .progress-bar {
            background-color: #38643f
        }

        .fit-image {
            width: 100%;
            object-fit: cover
        }
        #top-nav-links .nav-item {
            margin: 5px;
        }
        #top-nav-links .nav-item a {
            background: transparent !important;
            border-color: transparent !important;
            color: #f68b32 !important;
            font-size: 13px;
            font-weight: bold;
            font-family: Cairo;
        }

        header {
            background-color: rgba(69, 70, 73, 0.0);
            width: 100%;
            height: 60px;
            position: fixed;
            z-index: 999;
            top: 16px;
            right: 0;
            display: flex;
            align-items: center;
        }
        header img {
            margin-right: 10px;
        }

        @media only screen and (max-width: 600px){
            #top-nav-links {
                width: 100%!important;
                flex-direction: row!important;
                justify-content: center!important;
                align-items: center!important;
            }
        }
        #msform input.input-time{
            margin-bottom: 0 !important;
        }
        #favorite_times .label-time{

            margin-right: 0 !important;

        }
        #cover-bg {
            background-image: url("https://furqanshop.com/new-students/images/logo.jpg");
            width: 100%;
            height: 96px;
            margin-top: 25px;
            margin-bottom: 25px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
        }

    </style>
    <style>
        *, *::after, *::before {
            box-sizing: border-box
        }

        html {
            padding: 1rem;
            background-color: #FFF;
            font-family: 'Cairo', sans-serif;, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif
        }

        #payment-form {
            position: relative;
        }

        iframe {
            width: 100%
        }

        .one-liner {
            display: flex;
            flex-direction: column
        }

        #pay-button {
            border: none;
            border-radius: 3px;
            color: #FFF;
            font-weight: 500;
            height: 40px;
            width: 100%;
            background-color: #13395E;
            box-shadow: 0 1px 3px 0 rgba(19, 57, 94, 0.4)
        }
        #last-button {
            position: relative;
            top: 180px;
            margin-bottom: 200px !important
        }

        #cash:active {
            background-color: #0B2A49;
            box-shadow: 0 1px 3px 0 rgba(19, 57, 94, 0.4)
        }

        #pay-button:hover {
            background-color: #15406B;
            box-shadow: 0 2px 5px 0 rgba(19, 57, 94, 0.4)
        }

        #pay-button:disabled {
            background-color: #697887;
            box-shadow: none
        }

        #pay-button:not(:disabled) {
            cursor: pointer
        }

        .card-frame {
            border: solid 1px #13395E;
            border-radius: 3px;
            width: 100%;
            margin-bottom: 8px;
            height: 40px;
            box-shadow: 0 1px 3px 0 rgba(19, 57, 94, 0.2)
        }

        .card-frame.frame--rendered {
            opacity: 1
        }

        .card-frame.frame--rendered.frame--focus {
            border: solid 1px #13395E;
            box-shadow: 0 2px 5px 0 rgba(19, 57, 94, 0.15)
        }

        .card-frame.frame--rendered.frame--invalid {
            border: solid 1px #D96830;
            box-shadow: 0 2px 5px 0 rgba(217, 104, 48, 0.15)
        }

        .success-payment-message {
            color: #13395E;
            line-height: 1.4
        }

        #apply_coupon_btn {
            width: 50%;
        }
        .token {
            color: #b35e14;
            font-size: 0.9rem;
            font-family: 'Cairo', sans-serif;
        }

        @media screen and (min-width: 31rem) {
            .one-liner {
                flex-direction: row
            }

            .card-frame {
                width: 318px;
                margin-bottom: 0
            }

            #pay-button {
                width: 175px;
                margin-left: 8px
            }
        }</style>
    <style>
        .select2.select2-container {
            width: 100% !important;
            display: block !important;
        }
        .select2-selection--single {
            height: 33px!important;
        }
        #cover-bg {
            background-image: url("{{ asset('images/logo.jpg') }}");
            width: 100%;
            height: 96px;
            margin-top: 25px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
        }

        #times li {
            font-weight: bold !important;
        }
        #top-nav-links .nav-item {
            margin: 5px;
        }
        #top-nav-links .nav-item a {
            background: transparent !important;
            border-color: transparent !important;
            color: #f68b32 !important;
            font-size: 13px;
            font-weight: bold;
            font-family: Cairo;
        }

        header {
            background-color: #2425265c;
            width: 100%;
            height: 60px;
            position: fixed;
            z-index: 999;
            top: 0;
            right: 0;
            display: flex;
            align-items: center;
        }
        header img {
            margin-right: 10px;
        }
        @if(LaravelLocalization::getCurrentLocale() == 'en')
            .back-ground {

                left: 7vh;
            }
        #msform .action-button {

            float: right;
        }
        #msform .action-button-previous {

            margin: 10px 0px 10px 5px;
            float: right;
        }
        @endif
    </style>

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}?v=5.1">
    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-P79LV4M');
    </script>
    <!-- End Google Tag Manager -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-N7F13ZWW74"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-N7F13ZWW74');
    </script>
</head>
<body>

        <div class="row">
            <div class="col-md-5">
                <img class="back-ground" src="{{asset('images/img.jpg')}}" alt="">
            </div>
            <div class="col-md-7">
                <div class="alert alert-danger d-none" id="support-cookies" style="text-align: center;font-weight: bold;">{!! __('Support Cookies') !!}</div>
                <div class="row justify-content-center mt-5">
                    <div class="col-11 col-sm-9 col-md-11 col-lg-11 col-xl-11 text-center p-0">
                        <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                            <h2 id="heading">{{ __('Page Title') }}</h2>
                            <form id="msform" action="{{ route('registration.founding-day.resubscribe') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- progressbar -->
                                <ul id="progressbar" class="d-flex flex-row">
                                    <li class="active" id="account"><strong>{{ __('resubscribe.Information and notes') }}</strong></li>
                                    <li id="personal"><strong>{{ __('resubscribe.Register') }}</strong></li>
                                    <li id="register-options"><strong>{{ __('subscribe_type') }}</strong></li>
                                    <li id="confirm"><strong>{{ __('resubscribe.Payment and termination') }}</strong></li>
                                </ul>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <br>
                                <!-- First Step-->
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-12">
{{--                                                <h2 class="fs-title text-center">{{ __('resubscribe.Information and notes') }}</h2>--}}
                                                <h2 class="fs-title text-center">العرض أنتهى ويمكن التسجيل من خلال استمارة التالية</h2>
                                                <h2 class="fs-title text-center">
                                                    <a href="https://furqanshop.com/new-students/" tabindex="0" role="button" data-testid="inline-card-resolved-view" class="css-118vsk3">استمارة المستجدين</a>
                                                </h2>
                                            </div>
                                        </div>
                                        <!--
                                        <p class="text-center">
                                            <span class="font-weight-bold">{!! __('EG-branch Enroll now in this semester for') !!} {{ $course->price . '$' }} {!! __('EG-branch a one-time fee of $50 for course materials') !!}</span>
                                            <br>
                                            <span class="font-weight-bold">{!! __('EG-branch Please note that the current semester ends on') !!}</span>
                                            <span class="font-weight-bold d-block">{!! __('EG-branch Please note that the current semester ends on 2') !!}</span>
                                            <br>
                                            <br>
                                            <span class="text-center d-block w-100 font-weight-bold">{!! __('EG-branch Learning System') !!}</span>
                                            <span class="text-center d-block w-100 font-weight-bold">{!! __('EG-branch Click here') !!}</span>
                                        </p>
                                        <p>
                                            <span class="d-block" style="color: #bb271a; font-weight: bold;"></span>
                                            <span class="d-block" style="color: #bb271a; font-weight: bold;"></span>
                                            <br>
                                            <span class="d-block {{ app()->getLocale() == 'ar' ? 'text-right' : '' }}">
                                                {{ __('If you had any questions regarding the payment options and methods') }}
                                            </span>
                                            <span class="w-100 text-center d-block" style="color: #bb271a; font-weight: bold;">
                                                {{ __('virtual office link:') }}
                                            </span>
                                            <a class="w-100 text-center d-block" href="{{ __('https://furqangroup.zoom.us/j/99947595293') }}">
                                                {{ __('https://furqangroup.zoom.us/j/99947595293') }}
                                            </a>
                                            <br>
                                            <span class="w-100 text-center d-block" style="color: #bb271a; font-weight: bold;">
                                                {{ __('Virtual office times:') }}
                                            </span>
                                            <span class="w-100 text-center d-block" style="color: #48742b; font-weight: bold;">
                                                {{ __('From Sunday till Thursday') }}
                                            </span>
                                            <ul class="text-right">
                                                <li>{{ __('09:00AM - 10:00PM Mecca time (GMT + 3)') }}</li>
                                                <li>{{ __('07:00AM - 08:00PM Morocco and France time (GMT+1)') }}</li>
                                                <li>{{ __('01:00AM - 02:00PM New York time (GMT-5)') }}</li>
                                            </ul>
                                            <span class="w-100 text-center d-block" style="color: black; font-weight: bold;">
                                                {{ __('We wish you all good health and success by Allah will') }}
                                            </span>
                                        </p>
                                        <div id="signature-section">
                                            <label for="signature-label" class="text-right w-100 label-right" style="color: #ff0000 !important;font-size: 14px;">{{ __('Guardian Signature') }}:</label>
                                            <div class="form-group text-right">
                                                <input class="input-time" type="radio" name="signature" id="signature" value="{{ __('Signature') }}" required>
                                                <label class="form-check-label label-time" style="color: #ff0000 !important;" for="signature">
                                                    {{ __('Signature') }}
                                                </label>
                                            </div>
                                        </div>
                                        -->
                                    </div>

                                    <!--
                                    <button type="button" name="next" class="next action-button">
                                        {{ __('resubscribe.Next') }}
                                        <i class="fa {{ app()->getLocale() == 'ar' ? 'fa-arrow-left' : 'fa-arrow-right'  }} " aria-hidden="true"></i>
                                    </button>
                                    -->
                                </fieldset>
                                <!--
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">{{ __('resubscribe.Register') }}</h2>
                                            </div>
                                        </div>
                                        <div id="not_study_before_student" class="">
                                            <div class="form-group text-right">
                                                <div class="alert alert-danger d-none" id="birthdate-alert" role="alert">{{ __('The student must be 5 years old or over to register.') }}</div>
                                                <label for="birthdate">{{ __('Birthdate') }}</label>
                                                <input type="date" class="form-control" name="birthdate" value="{{ old('birthdate') }}" id="birthdate" placeholder="{{ __('Birthdate') }}">
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text" for="std-section">{{ __('gender') }}</label>
                                                </div>
                                                <select class="custom-select" name="new_student_section" id="new_student_section">
                                                    <option value="null" selected>{{ __('resubscribe.Choose') }}...</option>
                                                    <option value="1">{{ __('Male') }}</option>
                                                    <option value="2">{{ __('Female') }}</option>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 text-right">
                                                    <label for="first_name">{{ __('First Name') }}</label>
                                                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="form-control" placeholder="{{ __('First Name') }}">
                                                </div>
                                                <div class="col-6 text-right">
                                                    <label for="father_name">{{ __('Father Name') }}</label>
                                                    <input type="text" name="father_name" class="form-control" value="{{ old('father_name') }}" id="father_name" placeholder="{{ __('Father Name') }}">
                                                </div>
                                                <div class="col-6 text-right">
                                                    <label for="grandfather_name">{{ __('Grandfather Name') }}</label>
                                                    <input type="text" class="form-control" name="grandfather_name" value="{{ old('grandfather_name') }}" id="grandfather_name" placeholder="{{ __('Grandfather Name') }}">
                                                </div>
                                                <div class="col-6 text-right">
                                                    <label for="family_name">{{ __('Family Name') }}</label>
                                                    <input type="text"  name="family_name" class="form-control"id="family_name" value="{{ old('family_name') }}" placeholder="{{ __('Family Name') }}">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-6 col-md-4 text-right">
                                                    <label for="nationality">{{ __('Nationality') }}</label>
                                                    <select name="nationality" class="form-control js-select2" id="nationality">
                                                        <option value="null" selected>{{ __('resubscribe.Choose') }}...</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6 col-md-4 text-right">
                                                    <label for="country_residence">{{ __('Country of residence') }}</label>
                                                    <select name="country_residence" class="form-control js-select2" id="country_residence">
                                                        <option value="null" selected>{{ __('resubscribe.Choose') }}...</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6 col-md-4 text-right">
                                                    <label for="city">{{ __('city') }}</label>
                                                    <input type="text" name="city" class="form-control" id="city" value="{{ old('city') }}" placeholder="{{ __('city') }}">
                                                </div>
                                                <div class="col-6 col-md-4 text-right">
                                                    <label for="postal_code">{{ __('Postal code') }}</label>
                                                    <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" class="form-control" placeholder="{{ __('Postal code') }}">
                                                </div>
                                                <div class="col-6 col-md-4 text-right">
                                                    <label for="id_number">{{ __('ID/Passport Number') }}</label>
                                                    <input type="text" id="id_number" name="id_number" class="form-control" value="{{ old('id_number') }}" placeholder="{{ __('ID/Passport Number') }}">
                                                </div>
                                                <div class="col-12 col-md-12 text-right">
                                                    <label for="address">{{ __('Address - Street - Building') }}</label>
                                                    <input type="text" id="address" name="address" class="form-control"/>
                                                </div>

                                                <p class="text-center w-100" style="color: #ff0000;">{{ __('sure the address is correct') }}</p>
                                            </div>
                                            <br>
                                            <hr>
                                            <div class="row">
                                                <div class="col-6 text-right">
                                                    <label for="father_whatsApp">{{ __('Father’s WhatsApp Number') }}</label>
                                                    <select name="father_whatsApp" class="form-control js-select2 country-code" id="father_whatsApp">
                                                        <option value="null" selected>{{ __('resubscribe.Choose') }}...</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{ $country->code }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="d-flex flex-nowrap flex-row-reverse rtl-reverse">
                                                        <input type="text" name="father_whatsApp_number" value="{{ old('father_whatsApp_number') }}" id="father_whatsApp_number" class="form-control m-0 ltr phone-number">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text phone-number-code">+</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <label for="mother_whatsApp">{{ __('Mother’s WhatsApp Number') }}</label>
                                                    <select name="mother_whatsApp" class="form-control js-select2 country-code" id="mother_whatsApp">
                                                        <option value="null" selected>{{ __('resubscribe.Choose') }}...</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{ $country->code }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="d-flex flex-nowrap flex-row-reverse rtl-reverse">
                                                        <input type="text" name="mother_whatsApp_number" value="{{ old('mother_whatsApp_number') }}" id="mother_whatsApp_number" class="form-control m-0 ltr phone-number">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text phone-number-code">+</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="col-6 text-right mt-2">
                                                    <label for="father_email">{{ __('Father’s E-mail') }}</label>
                                                    <input type="email" name="father_email" value="{{ old('father_email') }}" id="father_email" class="form-control father_email" placeholder="{{ __('Father’s E-mail') }}">
                                                    <input type="email" name="confirm_father_email" value="{{ old('confirm_father_email') }}" id="confirm_father_email" class="form-control" placeholder="{{ __('Confirm Father’s E-mail') }}">
                                                </div>
                                                <br>
                                                <div class="col-6 text-right mt-2">
                                                    <label for="mother_email" style="font-size: 15px;">{{ __('Mother’s E-mail') }}</label>
                                                    <input type="email" name="mother_email" value="{{ old('mother_email') }}" id="mother_email" class="form-control" placeholder="{{ __('Mother’s E-mail') }}">
                                                    <input type="email" name="confirm_mother_email" value="{{ old('confirm_mother_email') }}" id="confirm_mother_email" class="form-control" placeholder="{{ __('Confirm Mother’s E-mail') }}">
                                                </div>
                                                <p class="text-center w-100" style="color: #ff0000;">{{ __('Note: messages are sent on the (Email).') }}</p>
                                                <br>
                                                <div class="col-12 text-right">
                                                    <label for="preferred_language">{{ __('Preferred language') }}</label>
                                                    <select name="preferred_language" class="form-control" id="preferred_language">
                                                        <option value="null" selected>{{ __('resubscribe.Choose') }}...</option>
                                                        <option value="Arabic">{{ __('Arabic') }}</option>
                                                        <option value="English">{{ __('English') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12 text-right" id="arabic_level">
                                                    <label for="std-email-conf" class="text-right w-100 label-right">{{ __('How do you rate your level of reading in Arabic?') }}</label>
                                                    <div class="form-group text-right">
                                                        <input class="form-check-input input-time" type="radio" required name="arabic_level" id="{{ __('I can read fluently') }}" value="{{ __('I can read fluently') }}">
                                                        <label class="form-check-label label-time" for="{{ __('I can read fluently') }}">
                                                            {{ __('I can read fluently') }}
                                                        </label>
                                                    </div>
                                                    <div class="form-group text-right">
                                                        <input class="form-check-input input-time" type="radio" required name="arabic_level" id="{{ __('I can read but find some words and sentences difficult') }}" value="{{ __('I can read but find some words and sentences difficult') }}">
                                                        <label class="form-check-label label-time" for="{{ __('I can read but find some words and sentences difficult') }}">
                                                            {{ __('I can read but find some words and sentences difficult') }}
                                                        </label>
                                                    </div>
                                                    <div class="form-group text-right">
                                                        <input class="form-check-input input-time" type="radio" required name="arabic_level" id="{{ __('I cant read Arabic at all') }}" value="{{ __('I cant read Arabic at all') }}">
                                                        <label class="form-check-label label-time" for="{{ __('I cant read Arabic at all') }}">
                                                            {{ __('I cant read Arabic at all') }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <hr style="width: 100%">
                                                <br>
                                                <br>
                                                <div class="col-12 text-right" id="quran_level">
                                                    <label for="std-email-conf" class="text-right w-100 label-right">{{ __('How would you rate your level in reciting the Noble Quran?') }}</label>
                                                    <div class="form-group text-right">
                                                        <input class="form-check-input input-time" type="radio" required name="quran_level" id="{{ __('I can recite the Noble Quran with the provisions of Tajweed') }}" value="{{ __('I can recite the Noble Quran with the provisions of Tajweed') }}">
                                                        <label class="form-check-label label-time" for="{{ __('I can recite the Noble Quran with the provisions of Tajweed') }}">
                                                            {{ __('I can recite the Noble Quran with the provisions of Tajweed') }}
                                                        </label>
                                                    </div>
                                                    <div class="form-group text-right">
                                                        <input class="form-check-input input-time" type="radio" required name="quran_level" id="{{ __('I can recite the Noble Quran, but I find it difficult to apply the provisions of intonation') }}" value="{{ __('I can recite the Noble Quran, but I find it difficult to apply the provisions of intonation') }}">
                                                        <label class="form-check-label label-time" for="{{ __('I can recite the Noble Quran, but I find it difficult to apply the provisions of intonation') }}">
                                                            {{ __('I can recite the Noble Quran, but I find it difficult to apply the provisions of intonation') }}
                                                        </label>
                                                    </div>
                                                    <div class="form-group text-right">
                                                        <input class="form-check-input input-time" type="radio" required name="quran_level" id="{{ __('I cant recite the Noble Quran with the provisions of Tajweed') }}" value="{{ __('I cant recite the Noble Quran with the provisions of Tajweed') }}">
                                                        <label class="form-check-label label-time" for="{{ __('I cant recite the Noble Quran with the provisions of Tajweed') }}">
                                                            {{ __('I cant recite the Noble Quran with the provisions of Tajweed') }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <hr style="width: 100%">
                                                <br>
                                                <br>
                                                <div class="col-12 text-right" id="hear_about">
                                                    <label class="text-right w-100 label-right">{{ __('How did you hear about Furqan Group?') }}</label>
                                                    <div class="form-group text-right w-100">
                                                        <input class=" input-time checkbox-options" type="checkbox" name="hear_about[]" id="from-family-friends" value="{{ __('From family and friends') }}">
                                                        <label class="form-check-label label-time" for="from-family-friends">
                                                            {{ __('From family and friends') }}
                                                        </label>
                                                    </div>
                                                    <div class="form-group text-right w-100">
                                                        <input class=" input-time checkbox-options" type="checkbox" name="hear_about[]" id="from-social-media-option" value="{{ __('From social media') }}">
                                                        <label class="form-check-label label-time" for="from-social-media-option">
                                                            {{ __('From social media') }}
                                                        </label>
                                                    </div>
                                                    <div class="form-group text-right w-100">
                                                        <input class=" input-time checkbox-options" type="checkbox" name="hear_about[]" id="from-course-option" value="{{ __('From the course of Qaidah Nuraniah') }}">
                                                        <label class="form-check-label label-time" for="from-course-option">
                                                            {{ __('From the course of Qaidah Nuraniah') }}
                                                        </label>
                                                    </div>
                                                    <div class="form-group text-right w-100">
                                                        <input class=" input-time checkbox-options" type="checkbox" id="other-option" name="hear_about[]" value="other">
                                                        <label class="form-check-label label-time" for="other-option">
                                                            {{ __('Other') }}
                                                        </label>
                                                        <textarea name="hear_about_textbox" class="d-none" id="hear_about_textbox" cols="30" rows="5"></textarea>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="col-12 text-right" id="certificate_passing">
                                                    <label class="text-right w-100 label-right">{{ __('Did you get Qaidah Nuraniah Certificate before?') }}</label>
                                                    <div class="form-group text-right w-100">
                                                        <input class=" input-time checkbox-options" type="radio" name="certificate_passing" id="certificate-passing-yes" value="yes">
                                                        <label class="form-check-label label-time" for="certificate-passing-yes">
                                                            {{ __('yes') }}
                                                        </label>
                                                        <br>
                                                        <label class="form-check-label label-time d-none" id="certificate_file_label" for="certificate_file">{{ __('Upload Your Certificate') }}</label>
                                                        <input type="file" name="certificate_file" class="d-none" id="certificate_file">
                                                    </div>
                                                    <div class="form-group text-right w-100">
                                                        <input class=" input-time checkbox-options" type="radio" name="certificate_passing" id="certificate-passing-no" value="{{ __('no') }}">
                                                        <label class="form-check-label label-time" for="certificate-passing-no">
                                                            {{ __('no') }}
                                                        </label>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="col-12 text-right" id="memorized_parts">
                                                    <label class="text-right w-100 label-right">{{ __('Have you memorized parts of the Quran?') }}</label>
                                                    <div class="form-group text-right w-100">
                                                        <input class=" input-time checkbox-options" type="radio" name="memorized_parts" id="memorized-parts-yes" value="yes">
                                                        <label class="form-check-label label-time" for="memorized-parts-yes">
                                                            {{ __('yes') }}
                                                        </label>
                                                        <br>
                                                        <label class="form-check-label label-time d-none" id="memorized_parts_count_label" for="memorized_parts_count">{{ __('How many parts?') }}</label>
                                                        <input type="number" name="memorized_parts_count" class="d-none" id="memorized_parts_count">
                                                    </div>
                                                    <div class="form-group text-right w-100">
                                                        <input class=" input-time checkbox-options" type="radio" name="memorized_parts" id="memorized-parts-no" value="{{ __('No') }}">
                                                        <label class="form-check-label label-time" for="memorized-parts-no">
                                                            {{ __('no') }}
                                                        </label>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="col-12 text-right">
                                                    <div class="form-group text-right w-100">
                                                        <label class="form-check-label label-time w-100" for="student_id">
                                                            {{ __('Student ID') }}
                                                        </label>
                                                        <input class="input-time" type="file" name="student_id" id="student_id">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div id="favorite_times">
                                                <label for="std-email-conf" class="text-right w-100 label-right">{{ __('Choose your preferred schedule') }}</label>
                                                <div class="form-group text-right">
                                                    <input class=" input-time" type="radio" name="favorite_time" id="{{ __('Morning Session | 09:00 am - 12:00 pm GMT+3') }}" value="{{ __('Morning Session | 09:00 am - 12:00 pm GMT+3') }}" required>
                                                    <label class="form-check-label label-time" for="{{ __('Morning Session | 09:00 am - 12:00 pm GMT+3') }}">
                                                        {{ __('Morning Session | 09:00 am - 12:00 pm GMT+3') }}
                                                    </label>
                                                </div>
                                                <div class="form-group text-right">
                                                    <input class=" input-time" type="radio" name="favorite_time" id="{{ __('Evening Session 1 | 03:00 pm - 06:00 pm GMT+3') }}" value="{{ __('Evening Session 1 | 03:00 pm - 06:00 pm GMT+3') }}" required>
                                                    <label class="form-check-label label-time" for="{{ __('Evening Session 1 | 03:00 pm - 06:00 pm GMT+3') }}">
                                                        {{ __('Evening Session 1 | 03:00 pm - 06:00 pm GMT+3') }}
                                                    </label>
                                                </div>
                                                <div class="form-group text-right">
                                                    <input class=" input-time" type="radio" name="favorite_time" id="{{ __('Evening Session 2 | 07:00 pm - 10:00 pm GMT+3') }}" value="{{ __('Evening Session 2 | 07:00 pm - 10:00 pm GMT+3') }}" required>
                                                    <label class="form-check-label label-time" for="{{ __('Evening Session 2 | 07:00 pm - 10:00 pm GMT+3') }}">
                                                        {{ __('Evening Session 2 | 07:00 pm - 10:00 pm GMT+3') }}
                                                    </label>
                                                </div>
                                                <div class="form-group text-right">
                                                    <input class=" input-time" type="radio" name="favorite_time" id="{{ __('Evening Session 3 | 11:00 pm - 02:00 am GMT+3') }}" value="{{ __('Evening Session 3 | 11:00 pm - 02:00 am GMT+3') }}" required>
                                                    <label class="form-check-label label-time" for="{{ __('Evening Session 3 | 11:00 pm - 02:00 am GMT+3') }}">
                                                        {{ __('Evening Session 3 | 11:00 pm - 02:00 am GMT+3') }}
                                                    </label>
                                                </div>
                                                <div class="form-group text-right">
                                                    <input class=" input-time" type="radio" name="favorite_time" id="{{ __('Evening Session 4 | 02:00 am - 05:00 am GMT+3') }}" value="{{ __('Evening Session 4 | 02:00 am - 05:00 am GMT+3') }}" required>
                                                    <label class="form-check-label label-time" for="{{ __('Evening Session 4 | 02:00 am - 05:00 am GMT+3') }}">
                                                        {{ __('Evening Session 4 | 02:00 am - 05:00 am GMT+3') }}
                                                    </label>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-7 col-md-7 text-right">
                                                    <label for="student_referral">{{ __('student_referral') }}</label>
                                                    <input type="text" name="student_referral" id="student_referral" value="{{ old('student_referral') }}" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="mt-2" id="guardian_commitment_section">
                                                <label class="text-right w-100 label-right" style="color: #ff0000 !important;">{{ __('Guardian Signature') }}:</label>
                                                <div class="form-group text-right">
                                                    <input class=" input-time" type="radio" name="guardian_commitment" id="guardian_commitment">
                                                    <label class="form-check-label label-time" style="color: #ff0000 !important; font-size: 14px" for="guardian_commitment">
                                                        {{ __('Guardian Commitment') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" name="next" class="next action-button">
                                        {{ __('resubscribe.Next') }}
                                        <i class="fa {{ app()->getLocale() == 'ar' ? 'fa-arrow-left' : 'fa-arrow-right'  }} " aria-hidden="true"></i>
                                    </button>
                                    <button type="button" name="previous" class="previous action-button-previous">
                                        <i class="fa {{ app()->getLocale() == 'ar' ? 'fa-arrow-right' : 'fa-arrow-left'  }} " aria-hidden="true"></i>
                                        {{ __('resubscribe.Previous') }}
                                    </button>
                                </fieldset>
                                Second Step-->
                                <!--
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">{{ __('subscribe_type') }}</h2>
                                            </div>
                                        </div>
                                        <br>
                                        <div id="subscribe-type-section">
                                            <label for="std-email-conf" class="text-right w-100 label-right">{{ __('Choose your preferred subscribe_type') }}</label>
                                            <div class="form-group text-right">
                                                <input class="form-check-input input-time" type="radio" required name="payment_type" id="payment_type_cash" value="Regular">
                                                <label class="form-check-label label-time" for="payment_type_cash">
                                                    {{ __('subscribe_type_cash') }}
                                                </label>
                                            </div>
                                            <div class="form-group text-right">
                                                <input class="form-check-input input-time" required type="radio" name="payment_type" id="payment_type_instalments" value="Recurring">
                                                <label class="form-check-label label-time" for="payment_type_instalments">
                                                    {{ __('subscribe_type_instalments') }}
                                                </label>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="mr-3 ml-3 mb-5" id="cash-details" style="display: none">
                                            <p class="text-center">
                                                <span class="font-weight-bold">{!! __('EG-branch Enroll now in this semester for') !!} {{ $course->price . '$' }} {!! __('EG-branch a one-time fee of $50 for course materials') !!}</span>
                                                <br>
                                                <span class="font-weight-bold">{!! __('EG-branch Please note that the current semester ends on') !!}</span>
                                                <br>
                                                <br>
                                                <span class="text-center d-block w-100 font-weight-bold">{!! __('EG-branch Learning System') !!}</span>
                                                <span class="text-center d-block w-100 font-weight-bold">{!! __('EG-branch Click here') !!}</span>
                                            </p>
                                        </div>
                                        <div class="mr-3 ml-3 mb-5" id="instalments-details" style="display: none">
                                            <p class="{{ app()->getLocale() == 'ar' ? 'text-right' : '' }}">
                                                {{ __('Dear Guardian, Please see the fee installment method', ['price' => $course->price]) }}
                                            </p>
                                            <div class="w-100">
                                                <table class="table table-bordered text-center" id="table-installment">
                                                    <tr>
                                                        <th>{{ '#' }}</th>
                                                        <th>%</th>
                                                        <th>{{ __('Amount') }}</th>
                                                        <th>{{ __('Due Date') }}</th>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: bold; color: black">{{ __('First Payment') }}</td>
                                                        <td class="green">40%</td>
                                                        <td class="green">{{ $course->amountRecurringFirst / 100 }}$</td>
                                                        <td class="green">{{ __('When registering') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: bold; color: black">{{ __('Second Payment') }}</td>
                                                        <td class="green">30%</td>
                                                        <td class="green">{{ $course->amountRecurringSecond / 100 }}$</td>
                                                        <td class="green">{{ $date1 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-weight: bold; color: black">{{ __('Third Payment') }}</td>
                                                        <td class="green">30%</td>
                                                        <td class="green">{{ $course->amountRecurringThird / 100 }}$</td>
                                                        <td class="green">{{ $date2 }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <span class="text-center d-block" style="color: #ea3223; font-weight: bold;">
                                                {{ __('Note: The above fees are inclusive of bank fees') }}
                                            </span>
                                            <br>
                                        </div>
                                    </div>
                                    <button type="button" name="next" class="next action-button">
                                        {{ __('resubscribe.Next') }}
                                        <i class="fa {{ app()->getLocale() == 'ar' ? 'fa-arrow-left' : 'fa-arrow-right'  }} " aria-hidden="true"></i>
                                    </button>
                                    <button type="button" name="previous" class="previous action-button-previous">
                                        <i class="fa {{ app()->getLocale() == 'ar' ? 'fa-arrow-right' : 'fa-arrow-left'  }} " aria-hidden="true"></i>
                                        {{ __('resubscribe.Previous') }}
                                    </button>
                                </fieldset>
                                register-options -->
                                <!-- Last Step-->
                                <!--
                                <fieldset id="checks-section">

                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="fs-title text-center">{{ __('resubscribe.Payment and termination') }}</h2>
                                            </div>
                                        </div>

                                        <div class="form-group text-right">

                                            <div class="form-check text-right d-flex">
                                                <input class=" w-auto" type="checkbox" value="" id="agree-terms" required>
                                                <label class="form-check-label mr-4" for="agree-terms">
                                                    {{ __('1- Agree terms and conditions') }}
                                                    <span class="agree-of-instalments" class="mt-2">
                                                        {{ __('2- Agree terms and conditions', ['amgount' => $course->amountRecurringSecond / 100, 'amdount' => $course->amountRecurringSecond / 100]) }}
                                                    </span>
                                                </label>
                                                <div class="invalid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div>
                                            <div class="form-check text-right d-flex">
                                                <input class=" w-auto" type="radio" name="payment_method" id="checkout_gateway" value="checkout_gateway">
                                                <label class="form-check-label mr-4" for="checkout_gateway">
                                                    <span class="agree-of-instalments-cash" class="mt-2">
                                                        {!! __('EG-branch Payment via credit card', ['amount' => $course->amountRecurringFirst / 100]) !!}
                                                    </span>
                                                    <span class="agree-of-instalments" class="mt-2">
                                                        {!! __('EG-branch Payment via credit card_1', ['amount' => $course->amountRecurringFirst / 100]) !!}
                                                    </span>
                                                </label>
                                            </div>
                                            <div>
                                                <img class="text-center d-block" style="width: 38%;margin: auto;margin-top: 9px;" src="{{ asset('card-icons/cards.png') }}" alt="Cards icons">
                                            </div>
                                        </div>
                                        <input type="hidden" name="token_pay" id="token_pay">
                                    </div>
                                    <button type="button" name="previous" style="margin: 0 !important; margin-top: 10px;" class="previous action-button-previous">
                                        <i class="fa {{ app()->getLocale() == 'ar' ? 'fa-arrow-right' : 'fa-arrow-left'  }} " aria-hidden="true"></i>
                                        {{ __('resubscribe.Previous') }}
                                    </button>

                                </fieldset>
                                -->
                                <!--
                                <input type="hidden" name="hidden_apply_coupon" id="hidden_apply_coupon">
                                <button type="submit" class="btn btn-primary d-none" id="pay-button-full-free" style="width: 40%; margin-bottom: 15px; background-color: #f68b32 !important;font-weight: bold; border: transparent;" disabled>
                                    {{ __('resubscribe.Checkout') }}
                                    <i class="fas fa-spinner fa-spin d-none"></i>
                                </button>
                                -->
                            </form>
                            <form id="payment-form" method="POST" action="https://merchant.com/charge-card" class="d-none">

                                <div class="form-group text-right" id="apply-coupon" style="width: 50%; margin: auto;">
                                    <label for="apply_coupon" class="text-right">{{ __('resubscribe.Enter coupon') }}</label>
                                    <input type="text" aria-describedby="coupon-description" name="apply_coupon" class="form-control text-center" id="apply_coupon" placeholder="" title="">
                                    <small id="coupon-description" class="form-text text-muted mb-2"></small>
                                    <div class="form-group text-center">
                                        <button type="button" class="btn btn-primary" id="apply_coupon_btn" style="width: 70% !important;">{{ __('resubscribe.Apply') }}</button>
                                    </div>
                                    <hr>
                                </div>

                                <div class="one-liner" style="flex-direction: column;justify-content: space-between;align-items: center;height: 100px;">
                                    <div class="card-frame"></div>
                                    <button class="btn btn-primary" id="pay-button" disabled>
                                        {{ __('resubscribe.Checkout') }}
                                        <i class="fas fa-spinner fa-spin d-none"></i>
                                    </button>
                                </div>

                                <p class="error-message text-center"></p>
                                <p class="success-payment-message text-center"></p>
                            </form>
                        </div>
                    </div>
                </div>

                <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-center" style="margin-top: 70px;">
                    <ul class="navbar-nav" id="top-nav-links">
                        <li class="nav-item">
                            <a class="btn btn-primary" data-toggle="modal" data-target="#Terms-And-Conditions" href="#">{{ __('EG-branch Terms And Conditions') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary" data-toggle="modal" data-target="#Refund-Policy" href="#">{{ __('EG-branch Refund Policy') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary" data-toggle="modal" data-target="#Privacy-Policy" href="#">{{ __('EG-branch Privacy Policy') }}</a>
                        </li>
                    </ul>
                </nav>

                <header class="justify-content-between flex-row-reverse">
                    <ul class="navbar-nav d-flex justify-content-between flex-row ml-4 mr-4">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if($localeCode != LaravelLocalization::getCurrentLocale())
                            <li class="nav-item active">
                                <a class="nav-link font-weight-bold" style="color: #181616;padding: 0 5px;font-family: 'Cairo';font-weight: normal !important;"
                                   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"> {{ $properties['native'] }}
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            @endif
                        @endforeach
                    </ul>

                    <a href="https://eservices.fg2020.com/" class="mr-3 ml-3" target="_blank">
                        <img src="https://eservices.fg2020.com/assets/images/nlogo.png" alt="" width="163" height="50">
                    </a>
                </header>

            </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="Terms-And-Conditions" tabindex="-1" role="dialog" aria-labelledby="Terms-And-Conditions" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Terms And Conditions') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! __('Terms And Conditions Text') !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Refund-Policy" tabindex="-1" role="dialog" aria-labelledby="Refund-Policy" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Refund Policy') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! __('Refund Policy Text') !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Privacy-Policy" tabindex="-1" role="dialog" aria-labelledby="Privacy-Policy" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Privacy Policy') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! __('Privacy Policy Text') !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- add frames script -->
<script src="https://cdn.checkout.com/js/framesv2.min.js"></script>
<script src="{{ asset('app.js') }}?v=2024.25"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Meta Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '5803897389689429');
    fbq('track', 'PageView');
</script>
<noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=5803897389689429&ev=PageView&noscript=1"/>
</noscript>
<!-- End Meta Pixel Code -->
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P79LV4M" height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<script>
    var instalmentsPrice = {{$course->amountRecurringFirst / 100}};
    var cashPrice = {{$course->price}};
    $(document).ready(function(){

        $('#not_study_before_student input, #not_study_before_student select').prop('required', true);
        $('#not_study_before_student #address').prop('required', true);
        $('#not_study_before_student #student_referral').prop('required', false);
        $('.js-select2').select2();

        var current_fs, next_fs, previous_fs;
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;

        setProgressBar(current);

        $(".next").click(function(){

            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;

            current_fs = $(this).parent();

            if(validate(current_fs)){
                next_fs = $(this).parent().next();

                //Add Class Active
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                //show the next fieldset
                next_fs.show();

                //hide the current fieldset with style
                current_fs.animate({opacity: 0}, {
                    step: function(now) {

                        // for making fieldset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({'opacity': opacity});
                    },
                    duration: 500
                });
                setProgressBar(++current);
            }
            if($('#checkout_gateway').is(':checked')){
                $("#payment-form").removeClass('d-none');
            }
        });

        $(".previous").click(function(){
            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
            previous_fs.show();
            current_fs.animate({opacity: 0}, {
                step: function(now) {
                    opacity = 1 - now;
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({'opacity': opacity});
                },
                duration: 500
            });
            setProgressBar(--current);
            $('#checkout_gateway').prop('checked', false);
            $('#agree-terms').prop('checked', false);
            $("#payment-form").addClass('d-none');
        });

        function setProgressBar(curStep){
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width",percent+"%")
        }

        $(".submit").click(function(){
            return false;
        })

        $(document).on('click', 'form #pay-button-full-free', function (e) {
            $('#pay-button-full-free .fa-spinner').removeClass('d-none');
            $('#pay-button-full-free').addClass('d-none');
        });

        $(document).on('click', 'form #apply_coupon_btn', function (e) {
            $('#hidden_apply_coupon').val($('form #apply_coupon').val());
            let paymentType = $('input[name="payment_type"]:checked').val();
            let is_study_before = $('input[name="study_before"]:checked').val();



            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('registration.founding-day.applyCoupon') }}?std_number=' + $('form #std-number').val() + '&code=' + $('form #apply_coupon').val() + '&study_before=' + is_study_before + '&payment_type=' + paymentType,
                success: function (data) {
                    const payButton = $('#pay-button-full-free');
                    if(data.price_after_discount == 0){
                        $('.card-frame').addClass('d-none');
                        $('#pay-button').addClass('d-none');
                        $('#payment-form').css({'top': '-80px'});
                        $("input[name='hear_about[]']").prop('required',false)
                        $("#d-none").prop('required',false)
                        payButton.removeClass('d-none');
                        payButton.css({'position': 'relative', 'top': '190px', 'z-index': 999});
                        payButton.attr('disabled', false);
                    }else{
                        $('.card-frame').removeClass('d-none');
                        $('#pay-button').removeClass('d-none');
                        payButton.addClass('d-none');
                        payButton.attr('disabled', true);
                    }



                    let text = ""

                    if($('input[name="payment_type"]:checked').val() === 'Recurring'){
                        text = data.price_after_discount > 0 ? "<span class='prices_small more-small'>" + "{{ __('First Payment') }} :" + data.price_after_discount *  (40 / 100) + "$ </span>"
                            + "<span class='prices_small more-small'>" + "{{ __('Second Payment') }} :" + data.price_after_discount * (30 /100) + "$ </span>"
                            + "<span class='prices_small more-small'>" + "{{ __('Third Payment') }} :" + data.price_after_discount *  (30 / 100) + "$ </span>" : ''
                    }
                    $('#coupon-description').html(
                        "<span class='prices_small'>"
                        + "{{ __('resubscribe.discount total is') }}" + data.discount
                        + "$ </span> "
                        + "<span class='prices_small'>"
                        + "{{ __('resubscribe.and price after discount is') }}"
                        + data.price_after_discount
                        + "$ </span>"
                        + text
                    );
                },
                error: function (data){
                    $('.card-frame').removeClass('d-none');
                    $('#pay-button').removeClass('d-none');
                    $('#pay-button-full-free').addClass('d-none');
                    $('#pay-button-full-free').attr('disabled', true);
                    $('#coupon-description').html(data.responseJSON.msg);
                }
            });
        });

        $(document).on('click', 'form #checkout_gateway', function (e) {

            if($('#agree-terms').is(':checked')){
                $("#hsbc-section-elements").addClass('d-none');
                $("#hsbc-section-elements").hide();
                $("#hsbc-section-elements input").removeAttr('required');

                $("#payment-form").removeClass('d-none');
                $("#submit-main-form").addClass('d-none');

            }else{
                e.preventDefault();
                alert('{{ __('You must agree that the previous information is correct') }}');
            }

        });

        $('input[type=radio][name=payment_type]').change(function() {
            if (this.value === 'Regular') {
                $('#cash-details').css('display', 'block');
                $('#instalments-details').css('display', 'none');
                $('.agree-of-instalments').css('display', 'none');
                $('.agree-of-instalments-cash').css('display', 'block');
                $('.last-price').text(cashPrice);
            }
            else if (this.value === 'Recurring') {
                $('#instalments-details').css('display', 'block');
                $('#cash-details').css('display', 'none');
                $('.agree-of-instalments').css('display', 'block');
                $('.agree-of-instalments-cash').css('display', 'none');
                $('.last-price').text(instalmentsPrice);
            }
        });

        function validate(current_fs) {
            //        $('input[type=radio][name=subscribe_type]').change(function() {

            let inputs = current_fs.find("input[required]");
            let signature = $('#signature-section input[type=radio]');
            let paymentType = current_fs.find('input[name=payment_type]');
            let favoriteTimes = current_fs.find('input[name=favorite_time]');
            let guardianCommitment = current_fs.find('input[name=guardian_commitment]');
            let address = current_fs.find('#address');
            let address_studied = current_fs.find('#address_studied');
            let arabic_level = current_fs.find('input[name=arabic_level]');
            let quran_level  = current_fs.find('input[name=quran_level]');
            let hear_about  = current_fs.find("input[name='hear_about[]']");
            let certificate_passing = current_fs.find('input[name=certificate_passing]');
            let memorized_parts = current_fs.find('input[name=memorized_parts]');
            let flag = true;

            if (!signature[0].checked){
                $('#signature-section .error-msg-times').remove();
                $('#signature-section').prepend(`<div class="alert alert-danger error-msg-times text-right" role="alert">{{ __('You must confirm your familiarity with the distance education system') }}</div>`);
                flag = false;
                console.log($(this));
            }else{
                $('#signature-section .error-msg-times').remove();
            }
            for (let index = 0; index < paymentType.length; ++index) {
                if (paymentType[index].checked) {
                    $(paymentType[index]).css('border-color', 'green');
                    $('#subscribe-type-section .error-msg-times').remove();
                    break;
                } else {
                    $(paymentType[index]).css('border-color', 'red');
                    $('#subscribe-type-section .error-msg-times').remove();
                    $('#subscribe-type-section').prepend(`<div class="alert alert-danger error-msg-times text-right" role="alert">{{ __('You must confirm one of the following options') }}</div>`);
                }
                if ((paymentType.length - 1) == index) {
                    flag = false;
                }
            }
            current_fs.find('select[required]').each(function() {
                if ($(this).val() == "null") {
                    $(this).css('border-color', 'red');
                    $(this).parent().find('.error-msg-times').remove();
                    $(this).parent().prepend(`<div class="alert alert-danger error-msg-times w-100 text-right" role="alert">{{ __('You must confirm one of the following options') }}`);
                    flag = false;
                }else{
                    $(this).parent().find('.error-msg-times').remove();
                    $(this).css('border-color', 'green');
                }
            });

            for (let index = 0; index < favoriteTimes.length; ++index) {
                if (favoriteTimes[index].checked) {
                    $(favoriteTimes[index]).css('border-color', 'green');
                    $('#favorite_times .error-msg-times').remove();
                    break;
                } else {
                    $(favoriteTimes[index]).css('border-color', 'red');
                    $('#favorite_times .error-msg-times').remove();
                    $('#favorite_times').prepend(`<div class="alert alert-danger error-msg-times text-right" role="alert">{{ __('You must confirm one of the following options') }}</div>`);
                }
                if ((favoriteTimes.length - 1) == index) {
                    flag = false;
                }
            }

            for (let index = 0; index < arabic_level.length; ++index) {
                if (arabic_level[index].checked) {
                    $(arabic_level[index]).css('border-color', 'green');
                    $('#arabic_level .error-msg-times').remove();
                    break;
                } else {
                    $(arabic_level[index]).css('border-color', 'red');
                    $('#arabic_level .error-msg-times').remove();
                    $('#arabic_level').prepend(`<div class="alert alert-danger error-msg-times text-right" role="alert">{{ __('You must confirm one of the following options') }}</div>`);
                }

                if ((arabic_level.length - 1) == index) {
                    flag = false;
                    console.log($(this));
                }

            }

            for (let index = 0; index < quran_level.length; ++index) {
                if (quran_level[index].checked) {
                    $(quran_level[index]).css('border-color', 'green');
                    $('#quran_level .error-msg-times').remove();
                    // flag = true;
                    break;
                } else {
                    $(quran_level[index]).css('border-color', 'red');
                    $('#quran_level .error-msg-times').remove();
                    $('#quran_level').prepend(`<div class="alert alert-danger error-msg-times text-right" role="alert">{{ __('You must confirm one of the following options') }}</div>`);
                }

                if ((quran_level.length - 1) == index) {
                    flag = false;
                }
            }

            for (let index = 0; index < certificate_passing.length; ++index) {
                if (certificate_passing[index].checked) {
                    $(certificate_passing[index]).css('border-color', 'green');
                    $('#certificate_passing .error-msg-times').remove();
                    break;
                } else {
                    $(certificate_passing[index]).css('border-color', 'red');
                    $('#certificate_passing .error-msg-times').remove();
                    $('#certificate_passing').prepend(`<div class="alert alert-danger error-msg-times text-right" role="alert">{{ __('You must confirm one of the following options') }}</div>`);
                }
                if ((certificate_passing.length - 1) == index) {
                    flag = false;
                }
            }

            for (let index = 0; index < memorized_parts.length; ++index) {
                if (memorized_parts[index].checked) {
                    $(memorized_parts[index]).css('border-color', 'green');
                    $('#memorized_parts .error-msg-times').remove();
                    break;
                } else {
                    $(memorized_parts[index]).css('border-color', 'red');
                    $('#memorized_parts .error-msg-times').remove();
                    $('#memorized_parts').prepend(`<div class="alert alert-danger error-msg-times text-right" role="alert">{{ __('You must confirm one of the following options') }}</div>`);
                }
                if ((memorized_parts.length - 1) == index) {
                    flag = false;
                }
            }

            for (let index = 0; index < hear_about.length; ++index) {
                if (hear_about[index].checked) {
                    $(hear_about[index]).css('border-color', 'green');
                    $('#hear_about .error-msg-times').remove();
                    break;
                } else {
                    $(hear_about[index]).css('border-color', 'red');
                    $('#hear_about .error-msg-times').remove();
                    $('#hear_about').prepend(`<div class="alert alert-danger error-msg-times text-right" role="alert">{{ __('You must confirm one of the following options') }}</div>`);
                }
                if ((hear_about.length - 1) == index) {
                    flag = false;
                }
            }

            for (let index = 0; index < inputs.length; ++index) {
                if (inputs[index].value == null || inputs[index].value == ""){
                    $(inputs[index]).css('border-color', 'red');
                    flag = false;
                }else{
                    $(inputs[index]).css('border-color', 'green');
                }

                if ($(inputs[index]).attr('id') == 'std-email' || $(inputs[index]).attr('id') == 'std-email-conf'){
                    if ($('#std-email').val() == $('#std-email-conf').val() &&
                        $('#std-email').val() != "" &&
                        $('#std-email').val() != null &&
                        $('#std-email-conf').val() != "" &&
                        $('#std-email-conf').val() != null
                    ){
                        $('#std-email-conf').css('border-color', 'green');
                        $('#std-email').css('border-color', 'green');
                    }else{
                        $('#std-email-conf').css('border-color', 'red');
                        $('#std-email').css('border-color', 'red');
                        flag = false;
                    }
                }
            }

            if (address.prop('required')){
                if (!address.val()){
                    $(address).css('border-color', 'red');
                    flag = false;
                    console.log($(this));
                }
            }
            if (address_studied.prop('required')){
                if (!address_studied.val()){
                    $(address_studied).css('border-color', 'red');
                    flag = false;
                }
            }
            if (guardianCommitment[0] !== undefined){
                if (guardianCommitment[0].checked){
                    $('#guardian_commitment_section .error-msg-times').remove();
                }else{
                    $('#guardian_commitment_section .error-msg-times').remove();
                    $('#guardian_commitment_section').prepend(`<div class="alert alert-danger error-msg-times text-right" role="alert">{{ __('You must confirm your familiarity with the distance education system') }}</div>`);
                    flag = false;
                }
            }

            return flag;
        }


        $(document).on('change', 'form#msform input[required], form#msform textarea[required]', function (e) {
            if ($(this).val() != "" && $(this).val() != null){
                $(this).css('border-color', 'green');
            }
        });

        $(document).on('click', 'form#msform #other-option', function (e) {
            $('form#msform #hear_about_textbox').toggleClass('d-none');
        });

        $(document).on('click', 'form#msform #certificate-passing-yes', function (e) {
            $('form#msform #certificate_file').removeClass('d-none');
            $('form#msform #certificate_file_label').removeClass('d-none');
            $("form#msform #certificate_file").prop('required', true);
        });

        $(document).on('click', 'form#msform #certificate-passing-no', function (e) {
            $('form#msform #certificate_file').addClass('d-none');
            $('form#msform #certificate_file_label').addClass('d-none');
            $("form#msform #certificate_file").removeAttr('required');
        });

        $(document).on('click', 'form#msform #memorized-parts-yes', function (e) {
            $('form#msform #memorized_parts_count').removeClass('d-none');
            $('form#msform #memorized_parts_count_label').removeClass('d-none');
            $("form#msform #memorized_parts_count").prop('required', true);
        });

        $(document).on('click', 'form#msform #memorized-parts-no', function (e) {
            $('form#msform #memorized_parts_count').addClass('d-none');
            $('form#msform #memorized_parts_count_label').addClass('d-none');
            $("form#msform #memorized_parts_count").removeAttr('required');
        });

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear() - 5;
            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [year, month, day].join('-');
        }

        function dateCompare(current_date, future_date){
            const date1 = new Date(current_date);
            const date2 = new Date(future_date);
            // greater than
            if(date1 > date2){
                return false;
                // less than
            } else if(date1 < date2){
                return true;
                //equal
            } else{
                return true;
            }
        }

        $(document).on('change', 'form#msform input#birthdate', function (e) {
            let CurrentDateTime = new Date();
            let CurrentDateTime2 = formatDate(CurrentDateTime);
            let birthdate_month  = $('form#msform input#birthdate').val();
            if(!dateCompare(CurrentDateTime2, birthdate_month)){
                $('#birthdate-alert').addClass('d-none');
                $('form#msform input#birthdate').css('border-color', 'green');
            }else{
                $('#birthdate-alert').removeClass('d-none');
                $('form#msform input#birthdate').css('border-color', 'red');
                $('form#msform input#birthdate').val('');
            }
        });

        $(document).on('change', '.country-code', function (e) {
            $(this).closest('div').find('.input-group-append .phone-number-code').html('+' + $(this).val());
        });

        $(document).on('change', 'form [type="email"]', function (e) {
            const email = $(this);
            const filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!filter.test(email.val())) {
                email.val('');
                email.css('border-color', 'red');
                alert('{{ __('Please provide a valid email address') }}');
                email.focus;
            }
        });

        if (navigator.cookieEnabled == false) {
            $('#support-cookies').removeClass('d-none');
        }else{
            $('#support-cookies').addClass('d-none');
        }

        $("input#birthdate").flatpickr({
            enableTime: false,
            dateFormat: "m/d/Y",
        });

        $("input#transfer_date").flatpickr({
            enableTime: false,
            dateFormat: "m/d/Y",
        });

    });
</script>

</body>
</html>
