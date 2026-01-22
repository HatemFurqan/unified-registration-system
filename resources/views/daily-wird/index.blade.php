<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Portion</title>
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
            background-color: #25408F !important;
            border-color: #25408F !important;
        }

        .label-time {
            font-size: 15px !important;
        }

        .input-time {
            width: auto !important;
        }

        @if(app()->getLocale() != 'ar')
            .text-right {
            text-align: left !important;
        }

        .input-time {
            margin: 0 !important;
        }

        #arabic_level .label-time,
        #quran_level .label-time {
            margin-left: 23px !important;
        }
        @endif

        @if(app()->getLocale() == 'ar')
            span.phone-number-code {
            direction: ltr !important;
        }

        #arabic_level .label-time,
        #quran_level .label-time {
            margin-right: 23px !important;
        }
        @endif

        #heading {
            text-transform: uppercase;
            color: #25408F;
            font-weight: normal;
        }

        #msform {
            text-align: center;
            position: relative;
            margin-top: 20px;
            font-family: 'Cairo', sans-serif;
        }

        #std-name {
            cursor: default !important;
        }

        #msform fieldset {
            background: white;
            border: 0 none;
            border-radius: 0.5rem;
            box-sizing: border-box;
            width: 100%;
            margin: 0;
            padding-bottom: 20px;
            position: relative
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
            border: 1px solid #25408F;
            outline-width: 0
        }

        #msform .action-button {
            width: 100px;
            background: #25408F;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 0px 10px 5px;
            border-radius: 5px;
        }

        #msform .action-button:hover,
        #msform .action-button:focus {
            background-color: #311B92
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
            border-radius: 5px;
        {{ app()->getLocale() == 'en' ? 'margin-right: 30% !important;' : 'margin-left: 30% !important;' }}
}

        #msform .action-button-previous:hover,
        #msform .action-button-previous:focus {
            background-color: #000000
        }

        .card {
            z-index: 0;
            border: none;
            position: relative
        }

        .fs-title {
            font-size: 25px;
            color: #25408F;
            margin-bottom: 15px;
            font-weight: normal;
            text-align: left
        }

        .purple-text {
            color: #25408F;
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
            color: #25408F
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
            content: "\f09d"
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

        #msform label {
            color: black !important;
            font-weight: bold !important;
            font-family: 'Cairo', sans-serif;
        }

        #msform #checks-section label {
            color: black !important;
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #25408F
        }

        .ltr {
            direction: ltr !important;
        }

        .progress {
            height: 20px
        }

        .progress-bar {
            background-color: #25408F
        }

        .fit-image {
            width: 100%;
            object-fit: cover
        }
    </style>

    <style>
        .ltr-table {
            margin: auto !important;
        }
        .ltr-table tr td{
            text-align: center !important;
            font-size: 12pt;
            color: #000000;
            font-width: bold;
            padding: 5px;
        }

        #accordion .card button {
            text-align: left;
        }

        @if(app()->getLocale() == 'ar')
        #msform .label-right {
            text-align: right !important;
        }
        .rtl-reverse {
            flex-direction: row !important;
        }
        .rtl-text {
            text-align: right !important;
        }
        .select2-results__option {
            text-align: right !important;
        }
        #father_whatsApp_number,
        #mother_whatsApp_number {
            text-align: left !important;
        }
        #accordion h5,
        #accordion .card-body {
            text-align: justify !important;
        }

        #accordion .card button {
            text-align: right !important;
        }
        @endif
    </style>

    {{--  checkout frame styles  --}}
    <style>*,*::after,*::before{box-sizing:border-box}html{padding:1rem;background-color:#FFF;font-family: 'Cairo', sans-serif;, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif}#payment-form{width:31.5rem;margin:0 auto}iframe{width:100%}.one-liner{display:flex;flex-direction:column}#pay-button{border:none;border-radius:3px;color:#FFF;font-weight:500;height:40px;width:100%;background-color:#13395E;box-shadow:0 1px 3px 0 rgba(19,57,94,0.4)}#pay-button:active{background-color:#0B2A49;box-shadow:0 1px 3px 0 rgba(19,57,94,0.4)}#pay-button:hover{background-color:#15406B;box-shadow:0 2px 5px 0 rgba(19,57,94,0.4)}#pay-button:disabled{background-color:#697887;box-shadow:none}#pay-button:not(:disabled){cursor:pointer}.card-frame{border:solid 1px #13395E;border-radius:3px;width:100%;margin-bottom:8px;height:40px;box-shadow:0 1px 3px 0 rgba(19,57,94,0.2)}.card-frame.frame--rendered{opacity:1}.card-frame.frame--rendered.frame--focus{border:solid 1px #13395E;box-shadow:0 2px 5px 0 rgba(19,57,94,0.15)}.card-frame.frame--rendered.frame--invalid{border:solid 1px #D96830;box-shadow:0 2px 5px 0 rgba(217,104,48,0.15)}.success-payment-message{color:#13395E;line-height:1.4}.token{color:#b35e14;font-size:0.9rem;font-family: 'Cairo', sans-serif;}@media screen and (min-width: 31rem){.one-liner{flex-direction:row}.card-frame{width:318px;margin-bottom:0}#pay-button{width:175px;margin-left:8px}}</style>

    <style>
        .select2.select2-container {
            width: 100% !important;
            display: block !important;
        }
        .select2-selection--single {
            height: 33px!important;
            display: flex !important;
            align-items: center !important;
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
            background-color: #24408e;
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

        #new_student_section + .select2-container--default .select2-selection--single,
        #std-section + .select2-container--default .select2-selection--single{
            height: 100% !important;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}?v=5.1">

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-P79LV4M');</script>
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

<header class="justify-content-between flex-row-reverse">
    <ul class="navbar-nav d-flex justify-content-between flex-row">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li class="nav-item active">
                <a class="nav-link font-weight-bold" style="color: white; padding: 0 5px"
                   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"> {{ $properties['native'] }}
                    <span class="sr-only">(current)</span>
                </a>
            </li>
        @endforeach
    </ul>

    <a href="https://eservices.fg2020.com/" target="_blank">
        <img src="https://eservices.fg2020.com/assets/images/nlogo.png" alt="" width="163" height="50">
    </a>
</header>

<div class="container-fluid">

    <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-center" style="margin-top: 70px;">
        <ul class="navbar-nav" id="top-nav-links">
            <li class="nav-item">
                <a class="btn btn-primary" data-toggle="modal" data-target="#Terms-And-Conditions" href="#">{{ __('Terms And Conditions') }}</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" data-toggle="modal" data-target="#Refund-Policy" href="#">{{ __('Refund Policy') }}</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary" data-toggle="modal" data-target="#Privacy-Policy" href="#">{{ __('Privacy Policy') }}</a>
            </li>
        </ul>
    </nav>

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

    <div id="cover-bg"></div>


    @include('partials.errors')

    <div class="alert alert-danger d-none" id="support-cookies" style="text-align: center;font-weight: bold;">{!! __('Support Cookies') !!}</div>

    <div class="row justify-content-center">
        <div class="col-11 col-sm-9 col-md-6 text-center p-0 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2 id="heading">{{ __('Page Title') }}</h2>

                <form id="msform" action="{{ route('registration.daily-wird.resubscribe') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- progressbar -->
                    <ul id="progressbar" class="d-flex flex-row">
                        <li class="active" id="account"><strong>{{ __('resubscribe.Information and notes') }}</strong></li>
                        <li id="personal"><strong>{{ __('resubscribe.Register') }}</strong></li>
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
                                    <h2 class="fs-title text-center">{{ __('General information') }}</h2>
                                </div>
                            </div>

                            <p class="{{ app()->getLocale() == 'ar' ? 'text-right' : '' }}">{{ __('Please see the fee installment method', ['price' => 5]) }}</p>

                            <div class="w-100">
                                <table class="table table-bordered text-center" id="table-installment">
                                    <tr>
                                        <td style="font-weight: bold; color: black">{{ __('Class duration') }}</td>
                                        <td>{{ __('35 minutes or 70 minutes (five days a week)') }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; color: black">{{ __('Period') }}</td>
                                        <td class="green">{{ __('You can choose your preferred time according to your convenience') }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; color: black">{{ __('Tuition fees') }}</td>
                                        <td class="green">{{ __('$200 for 35 minutes and $400 for 70 minutes per semester') }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; color: black">{{ __('Term duration') }}</td>
                                        <td class="green">{{ __('4 months') }}</td>
                                    </tr>
                                </table>
                            </div>

                            <span class="text-center d-block" style="color: #ea3223; font-weight: bold;">{{ __('Note: The above fees are inclusive of bank fees') }}</span>

                            <span class="d-block text-center">{{ __('If you had any questions regarding the payment options and methods') }}</span>

                            <span class="w-100 text-center d-block" style="color: #bb271a; font-weight: bold;">{{ __('virtual office link:') }}</span>

                            <a class="w-100 text-center d-block" href="{{ __('https://furqangroup.zoom.us/j/99947595293') }}">{{ __('https://furqangroup.zoom.us/j/99947595293') }}</a>

                            <br>

                            <span class="w-100 text-center d-block" style="color: #bb271a; font-weight: bold;">{{ __('Virtual office times:') }}</span>

                            <span class="w-100 text-center d-block" style="color: #48742b; font-weight: bold;">{{ __('From Sunday till Thursday') }}</span>
                            <span class="w-100 text-center d-block" style="color: #bb271a; font-weight: bold;">{{ __('at') }}</span>

                            <ul class="{{ app()->getLocale() == 'ar' ? 'text-right' : '' }}">
                                <li>{{ __('09:00AM - 10:00PM Mecca time (GMT + 3)') }}</li>
                                <li>{{ __('06:00AM - 07:00PM Morocco and France time (GMT+1)') }}</li>
                                <li>{{ __('01:00 AM - 02:00 PM New York (GMT - 5)') }}</li>
                            </ul>

                            <div id="course_types">
                                <label class="text-right w-100 label-right">{{ __('Choose the required duration') }}</label>
                                <div class="form-group text-right mb-0">
                                    <input class=" input-time" type="radio" name="course_type" id="{{ __('70 minutes') }}" data-price="{{ $course_70->price }}" value="{{ $course_70->id }}" required>
                                    <label class="form-check-label label-time" for="{{ __('70 minutes') }}">{{ __('70 minutes') }}</label>
                                </div>
                                <div class="form-group text-right">
                                    <input class=" input-time" type="radio" name="course_type" id="{{ __('35 minutes') }}" data-price="{{ $course_35->price }}" value="{{ $course_35->id }}" required>
                                    <label class="form-check-label label-time" for="{{ __('35 minutes') }}">{{ __('35 minutes') }}</label>
                                </div>
                            </div>

                            <span class="w-100 text-center d-block" style="color: black; font-weight: bold;">{{ __('We wish you all good health and success by Allah will.') }}</span>

                        </div>

                        <input type="button" name="next" class="next action-button" value="{{ __('resubscribe.Next') }}" />
                    </fieldset>

                    <!-- Second Step-->
                    <fieldset>
                    <div class="form-card">

                        <div class="row">
                            <div class="col-7">
                                <h2 class="fs-title">{{ __('Register') }}</h2>
                            </div>
                        </div>

                        <div class="input-group mb-3" id="study-before-section">
                            <label for="signature-label" class="text-right w-100 label-right">{{ __('study at the Center before') }}:</label>
                            <div class="form-group text-right w-100">
                                <input class=" input-time" type="radio" name="study_before" id="yes" value="yes" required>
                                <label class="form-check-label label-time" for="yes">
                                    {{ __('yes') }}
                                </label>
                            </div>
                            <div class="form-group text-right w-100">
                                <input class=" input-time" type="radio" name="study_before" id="no" value="no" required>
                                <label class="form-check-label label-time" for="no">
                                    {{ __('no') }}
                                </label>
                            </div>
                        </div>

                        <div id="preferred-time">
                            <label for="preferred-time" class="text-right w-100 label-right">{{ __('Enter your preferred time') }}</label>
                            <input type="time" class="form-control {{ app()->getLocale() == 'ar' ? 'text-right' : '' }}" id="preferred-time" name="preferred_time" required>
                        </div>

                        <div id="study_before_student" class="d-none">
                            <div class="input-group mb-3 text-right flex-nowrap" id="select-gender">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="std-section">{{ __('gender') }}</label>
                                </div>
                                <select class="custom-select js-select2" name="section" id="std-section" data-previous-id="select-gender">
                                    <option selected value="">{{ __('resubscribe.Choose') }}...</option>
                                    <option value="1">{{ __('Male') }}</option>
                                    <option value="2">{{ __('Female') }}</option>
                                </select>
                            </div>

                            <div class="form-group text-right">
                                <label for="std-number" class="text-right">{{ __('resubscribe.Serial Number') }}</label>
                                <input type="number" min="0" name="student_number" value="{{ old('student_number') }}" class="form-control" id="std-number" placeholder="{{ __('resubscribe.Serial Number') }}">
                            </div>

                            <div class="form-group text-center">
                                <p class="text-center" style="font-size: 13px;color: black;">{{ __('Email Serial Number') }}</p>
                            </div>

                            <div class="form-group text-center">
                                <button type="button" class="btn btn-primary w-50" id="std-number-search">{{ __('resubscribe.Search') }}</button>
                            </div>

                            <div class="form-group text-right" id="std-name-section">
                                <div class="alert alert-danger d-none" role="alert">
                                </div>
                                <label for="std-name" class="text-right">{{ __('resubscribe.Name') }} *</label>
                                <input type="text" min="0" name="student_name" class="form-control" id="std-name" value="{{ old('student_name') }}" placeholder="..." readonly>
                            </div>

                        </div>

                        <br>

                        {{-- yes studied (already_studied)--}}
                        <div id="already_studied" class="d-none">
                            <div class="row">
                                <div class="col-6 col-md-4 text-right" id="nationality-studied-options">
                                    <label for="nationality_studied">{{ __('Nationality') }}</label>
                                    <select name="nationality_studied" class="form-control js-select2" id="nationality_studied" data-previous-id="nationality-studied-options">
                                        <option selected value="">{{ __('resubscribe.Choose') }}...</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-md-4 text-right" id="country-residence-options">
                                    <label for="country_residence_studied">{{ __('Country of residence') }}</label>
                                    <select name="country_residence_studied" class="form-control js-select2" id="country_residence_studied" data-previous-id="country-residence-options">
                                        <option selected value="">{{ __('resubscribe.Choose') }}...</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 col-md-4 text-right">
                                    <label for="city">{{ __('city') }}</label>
                                    <input type="text" name="city_studied" class="form-control" id="city" value="{{ old('city_studied') }}" placeholder="{{ __('city') }}">
                                </div>

                                <div class="col-6 col-md-4 text-right">
                                    <label for="id_number">{{ __('ID/Passport Number') }}</label>
                                    <input type="text" name="id_number_studied" class="form-control" value="{{ old('id_number_studied') }}" placeholder="{{ __('ID/Passport Number') }}">
                                </div>
                            </div>

                            <br>
                            <hr>

                            <div class="row">
                                <div class="col-6 text-right" id="father-whatsApp-studied">
                                    <label for="father_whatsApp_studied">{{ __('Father’s WhatsApp Number') }}</label>
                                    <select name="father_whatsApp_studied" class="form-control js-select2 country-code" id="father_whatsApp_studied" data-previous-id="father-whatsApp-studied">
                                        <option selected value="">{{ __('resubscribe.Choose') }}...</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->code }}" {{ old('father_whatsApp_studied') == $country->code ? 'selected' : '' }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="d-flex flex-nowrap flex-row-reverse rtl-reverse">
                                        <input type="text" name="father_whatsApp_number_studied" value="{{ old('father_whatsApp_number_studied') }}" id="father_whatsApp_number_studied" class="form-control m-0 ltr phone-number">
                                        <div class="input-group-append">
                                            <span class="input-group-text phone-number-code">+</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 text-right" id="mother-whatsapp-options">
                                    <label for="mother_whatsApp_studied">{{ __('Mother’s WhatsApp Number') }}</label>
                                    <select name="mother_whatsApp_studied" class="form-control js-select2 country-code" id="mother_whatsApp_studied" data-previous-id="mother-whatsapp-options">
                                        <option selected value="">{{ __('resubscribe.Choose') }}...</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->code }}" {{ old('mother_whatsApp_studied') == $country->code ? 'selected' : '' }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="d-flex flex-nowrap flex-row-reverse rtl-reverse">
                                        <input type="text" name="mother_whatsApp_number_studied" value="{{ old('mother_whatsApp_number_studied') }}" id="mother_whatsApp_number_studied" class="form-control m-0 ltr phone-number">
                                        <div class="input-group-append">
                                            <span class="input-group-text phone-number-code">+</span>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="col-6 text-right mt-2">
                                    <label for="father_email">{{ __('Father’s E-mail') }}</label>
                                    <input type="email" name="father_email_studied" value="{{ old('father_email_studied') }}" id="father_email" class="form-control" placeholder="{{ __('Father’s E-mail') }}">
                                    <input type="email" name="confirm_father_email_studied" value="{{ old('confirm_father_email_studied') }}" id="confirm_father_email" class="form-control" placeholder="{{ __('Confirm Father’s E-mail') }}">
                                </div>

                                <br>

                                <div class="col-6 text-right mt-2">
                                    <label for="mother_email">{{ __('Mother’s E-mail') }}</label>
                                    <input type="email" name="mother_email_studied" id="mother_email" value="{{ old('mother_email_studied') }}" class="form-control" placeholder="{{ __('Mother’s E-mail') }}">
                                    <input type="email" name="confirm_mother_email_studied" value="{{ old('confirm_mother_email_studied') }}" id="confirm_mother_email" class="form-control" placeholder="{{ __('Confirm Mother’s E-mail') }}">
                                </div>

                                <p class="text-center w-100" style="color: #ff0000;">{{ __('Note: messages are sent on the (Email).') }}</p>

                                <br>

                                <div class="col-12 text-right" id="preferred-language-options">
                                    <label for="preferred_language">{{ __('Preferred language') }}</label>
                                    <select name="preferred_language_studied" class="form-control js-select2" id="preferred_language" data-previous-id="preferred-language-options">
                                        <option selected value="">{{ __('resubscribe.Choose') }}...</option>
                                        <option value="Arabic" {{ old('preferred_language_studied') == 'Arabic' ? 'selected' : '' }}>{{ __('Arabic') }}</option>
                                        <option value="English" {{ old('preferred_language_studied') == 'English' ? 'selected' : '' }}>{{ __('English') }}</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div id="not_study_before_student" class="d-none">
                            <div class="form-group text-right">
                                <div class="alert alert-danger d-none" id="birthdate-alert" role="alert">{{ __('The student must be 5 years old or over to register.') }}</div>
                                <label for="birthdate">{{ __('Birthdate') }}</label>
                                <input type="date" class="form-control" name="birthdate" value="{{ old('birthdate') }}" id="birthdate" placeholder="{{ __('Birthdate') }}">
                            </div>
                            <div class="input-group mb-3 text-right flex-nowrap" id="new-student-gender">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="std-section">{{ __('gender') }}</label>
                                </div>
                                <select class="custom-select js-select2" name="new_student_section" id="new_student_section" data-previous-id="new-student-gender">
                                    <option selected value="">{{ __('resubscribe.Choose') }}...</option>
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
                                <div class="col-6 col-md-4 text-right" id="nationality-options-section">
                                    <label for="nationality">{{ __('Nationality') }}</label>
                                    <select name="nationality" class="form-control js-select2" id="nationality" data-previous-id="nationality-options-section">
                                        <option selected value="">{{ __('resubscribe.Choose') }}...</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-md-4 text-right" id="country-residence-options-section">
                                    <label for="country_residence">{{ __('Country of residence') }}</label>
                                    <select name="country_residence" class="form-control js-select2" id="country_residence" data-previous-id="country-residence-options-section">
                                        <option selected value="">{{ __('resubscribe.Choose') }}...</option>
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
                                    <label for="id_number">{{ __('ID/Passport Number') }}</label>
                                    <input type="text" name="id_number" class="form-control" value="{{ old('id_number') }}" placeholder="{{ __('ID/Passport Number') }}">
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-6 text-right" id="father-whatsapp-new">
                                    <label for="father_whatsApp">{{ __('Father’s WhatsApp Number') }}</label>
                                    <select name="father_whatsApp" class="form-control js-select2 country-code" id="father_whatsApp" data-previous-id="father-whatsapp-new">
                                        <option selected value="">{{ __('resubscribe.Choose') }}...</option>
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

                                <div class="col-6 text-right" id="mother-whatsapp-section">
                                    <label for="mother_whatsApp">{{ __('Mother’s WhatsApp Number') }}</label>
                                    <select name="mother_whatsApp" class="form-control js-select2 country-code" id="mother_whatsApp" data-previous-id="mother-whatsapp-section">
                                        <option selected value="">{{ __('resubscribe.Choose') }}...</option>
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
                                    <input type="email" name="father_email" value="{{ old('father_email') }}" id="father_email" class="form-control" placeholder="{{ __('Father’s E-mail') }}">
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

                                <div class="col-12 text-right" id="preferred-language-section">
                                    <label for="preferred_language">{{ __('Preferred language') }}</label>
                                    <select name="preferred_language" class="form-control js-select2" id="preferred_language" data-previous-id="preferred-language-section">
                                        <option selected value="">{{ __('resubscribe.Choose') }}...</option>
                                        <option value="Arabic">{{ __('Arabic') }}</option>
                                        <option value="English">{{ __('English') }}</option>
                                    </select>
                                </div>

                            </div>

                            <hr>

                            <div class="row">

                                {{--        Start arabic_level                 --}}
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
                                {{--        End Reading arabic_level                 --}}

                                <hr style="width: 100%">

                                <br>
                                <br>
                                {{--                Start quran_level                 --}}
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
                                {{--                End quran_level                 --}}

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
                                        <input class=" input-time checkbox-options" type="radio" id="other-option" value="other">
                                        <label class="form-check-label label-time" for="other-option">
                                            {{ __('Other') }}
                                        </label>
                                        <textarea name="hear_about_textbox" class="d-none" id="hear_about_textbox" cols="30" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="col-12 text-right">

                                    <div class="form-group text-right w-100">
                                        <label class="form-check-label label-time w-100" for="student_id">
                                            {{ __('Student ID') }}
                                        </label>
                                        <input class=" input-time" type="file" name="student_id" id="student_id">
                                    </div>

                                </div>

                            </div>

                            <hr>

                        </div>

                        <div class="mt-2" id="guardian_commitment_section">
                            <label class="text-right w-100 label-right" style="color: #ff0000 !important;">{{ __('Guardian Signature') }}:</label>
                            <div class="form-group text-right">
                                <input class=" input-time" type="radio" name="guardian_commitment" id="guardian_commitment">
                                <label class="form-check-label label-time" style="color: #ff0000 !important;" for="guardian_commitment">
                                    {{ __('Guardian Commitment') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="button" name="previous" class="previous action-button-previous">
                        <i class="fa {{ app()->getLocale() == 'ar' ? 'fa-arrow-right' : 'fa-arrow-left'  }} " aria-hidden="true"></i>
                        {{ __('resubscribe.Previous') }}
                    </button>
                    <button type="button" name="next" class="next action-button">
                        {{ __('resubscribe.Next') }}
                        <i class="fa {{ app()->getLocale() == 'ar' ? 'fa-arrow-left' : 'fa-arrow-right'  }} " aria-hidden="true"></i>
                    </button>
                </fieldset>

                    <!-- Last Step-->
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
                                    {{ __('resubscribe.terms and conditions') }}
                                </label>
                                <div class="invalid-feedback">
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="form-check text-right d-flex">
                                <input class=" w-auto" type="radio" name="payment_method" id="checkout_gateway" value="checkout_gateway">
                                <label class="form-check-label mr-4" for="checkout_gateway">
                                    {!! __('Payment via credit card') !!}
                                    <span id="course-price"> - </span>$
                                </label>
                            </div>

                            <div>
                                <img class="text-center d-block" style="width: 38%;margin: auto;margin-top: 9px;" src="{{ asset('card-icons/cards.png') }}" alt="Cards icons">
                            </div>
                            <br>

                        </div>

                        <input type="hidden" name="token_pay" id="token_pay">
                    </div>

                    <button type="button" name="previous" style="margin: 0 !important; margin-top: 10px;" class="previous action-button-previous">
                        <i class="fa {{ app()->getLocale() == 'ar' ? 'fa-arrow-right' : 'fa-arrow-left'  }} " aria-hidden="true"></i>
                        {{ __('resubscribe.Previous') }}
                    </button>

                </fieldset>

                    <input type="hidden" name="hidden_apply_coupon" id="hidden_apply_coupon">

                    <button class="btn btn-primary d-none" id="pay-button-full-free" style="width: 40%; margin-bottom: 15px; background-color: #f68b32 !important;font-weight: bold; border: transparent;" disabled>
                        {{ __('resubscribe.Checkout') }}
                        <i class="fas fa-spinner fa-spin d-none"></i>
                    </button>
                </form>

                <form id="payment-form" method="POST" action="https://merchant.com/charge-card" class="d-none">

                    <div class="form-group text-right" id="apply-coupon" style="width: 50%; margin: auto;">
                        <label for="apply_coupon" class="text-right">{{ __('resubscribe.Enter coupon') }}</label>
                        <input type="text" aria-describedby="coupon-description" name="apply_coupon" class="form-control" id="apply_coupon" placeholder="{{ __('resubscribe.Enter coupon') }}" title="{{ __('resubscribe.Enter coupon') }}">
                        <small id="coupon-description" class="form-text text-muted"></small>

                        <div class="form-group text-center">
                            <button type="button" class="btn btn-primary" id="apply_coupon_btn" style="width: 70% !important;">{{ __('resubscribe.Apply') }}</button>
                        </div>
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

                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    {{ __('Why Al-Furqan Group?') }}
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                {!! __('Why Al-Furqan Group text') !!}
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    {{ __('What is quality assurance?') }}
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                {!! __('What is quality assurance text') !!}
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    {{ __('What educational paths are available?') }}
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                {!! __('What educational paths are available text')  !!}
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    {{ __('How do I choose the right path for me or my child?') }}
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body">
                                {!! __('How do I choose the right path for me or my child text') !!}
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    {{ __('What categories and ages can register?') }}
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                            <div class="card-body">
                                {!! __('What categories and ages can register text') !!}
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingSix">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    {{ __('What are the school times and days?') }}
                                </button>
                            </h5>
                        </div>
                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                            <div class="card-body">
                                {!! __('What are the school times and days text') !!}
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingSeven">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    {{ __('What are the tuition fees?') }}
                                </button>
                            </h5>
                        </div>
                        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                            <div class="card-body">
                                {!! __('What are the tuition fees text') !!}
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingEight">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                    {{ __('What is the registration method? When will the student start studying?') }}
                                </button>
                            </h5>
                        </div>
                        <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
                            <div class="card-body">
                                {!! __('What is the registration method? When will the student start studying text') !!}
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingNine">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                    {{ __('I need more details, how do I contact you?') }}
                                </button>
                            </h5>
                        </div>
                        <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion">
                            <div class="card-body">
                                {!! __('I need more details, how do I contact you text') !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{--                    <form id="payment-form" method="POST" action="https://merchant.com/charge-card">--}}
                {{--                        <div class="one-liner" style="flex-direction: column;justify-content: space-between;align-items: center;height: 100px;">--}}
                {{--                            <div class="card-frame"></div>--}}
                {{--                            <button class="btn btn-primary" id="pay-button" disabled>--}}
                {{--                                إتمام الدفع--}}
                {{--                            </button>--}}
                {{--                        </div>--}}
                {{--                        <p class="error-message text-center"></p>--}}
                {{--                        <p class="success-payment-message text-center"></p>--}}
                {{--                    </form>--}}
            </div>
            <div class="modal-footer d-none">
                <button type="button" class="d-none" id="close-modal" data-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>

<!-- add frames script -->
<script src="https://cdn.checkout.com/js/framesv2.min.js"></script>
<script src="{{ asset('app.js') }}?v=9m3.5"></script>

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
    <img height="1" width="1" style="display:none"
         src="https://www.facebook.com/tr?id=5803897389689429&ev=PageView&noscript=1"
    /></noscript>
<!-- End Meta Pixel Code -->

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P79LV4M"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<script>
    $(document).ready(function(){

        $('.js-select2').select2();

        var current_fs, next_fs, previous_fs; //fieldsets
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

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now) {
                    // for making fieldset appear animation
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

        $(document).on('change', '[name="course_type"]', function (){
            $('#course-price').html(' ' + $(this).data('price'));
        });

        $(document).on('click', 'form #pay-button-full-free', function (e) {
            $('#pay-button-full-free .fa-spinner').removeClass('d-none');
        });

        $(document).on('click', 'form #apply_coupon_btn', function (e) {
            $('#hidden_apply_coupon').val($('form #apply_coupon').val());
            let is_study_before = $('input[name="study_before"]:checked').val();

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('registration.daily-wird.applyCoupon') }}?std_number=' + $('form #std-number').val() + '&code=' + $('form #apply_coupon').val() + '&study_before=' + is_study_before + '&email=' + $('form #father_email').val() + '&course_type=' + $("input[name='course_type']:checked").val(),
                success: function (data) {
                    if(data.price_after_discount == 0){
                        $('.card-frame').addClass('d-none');
                        $('#pay-button').addClass('d-none');
                        $('#pay-button-full-free').removeClass('d-none');
                        $('#pay-button-full-free').attr('disabled', false);
                    }else{
                        $('.card-frame').removeClass('d-none');
                        $('#pay-button').removeClass('d-none');
                        $('#pay-button-full-free').addClass('d-none');
                        $('#pay-button-full-free').attr('disabled', true);
                    }
                    $('#coupon-description').html("{{ __('resubscribe.discount total is') }}" + data.discount + "$ " + "{{ __('resubscribe.and price after discount is') }}" + data.price_after_discount + "$ ");
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

        $(document).on('click', 'form #std-number-search', function (e) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('registration.daily-wird.getStudentInfo') }}?std_number=' + $('form #std-number').val() + '&std_section=' + $('form #std-section').val() + '&form_type=new_students',
                success: function (data) {
                    $('form #std-name').val(data.name);
                    $('form #std-name').css('border-color', 'green');
                    $('form #std-name-section .alert').addClass('d-none');
                    $('#already_studied').removeClass('d-none');
                },
                error: function (data){
                    $('form #std-name').val('');
                    $('form #std-name').attr("placeholder", '!');
                    $('form #std-name').attr("title", '!');
                    $('form #std-name').css('border-color', 'red');
                    $('form #std-name-section .alert').html(data.responseJSON.msg);
                    $('form #std-name-section .alert').removeClass('d-none');
                    $('#already_studied').addClass('d-none');
                }
            });
        });

        $(document).on('click', 'form #hsbc', function (e) {

            if($('#agree-terms').is(':checked')){
                $("#hsbc-section-elements").removeClass('d-none');
                $("#hsbc-section-elements").show();
                $("#hsbc-section-elements input").prop('required', true);
                $("#hsbc-section-elements input[type=checkbox]").removeAttr('required');

                $("#payment-form").addClass('d-none');

                $("#submit-main-form").removeAttr('disabled');
                $("#submit-main-form").removeClass('btn-secondary');
                $("#submit-main-form").addClass('btn-primary');
                $("#submit-main-form").removeClass('d-none');
            }else{
                e.preventDefault();
                alert('{{ __('You must agree that the previous information is correct') }}');
            }
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

        function validate(current_fs) {
            let inputs = current_fs.find("input[required]");
            let studyBeforeRadio = current_fs.find('input[name=study_before]');
            let guardianCommitment = current_fs.find('input[name=guardian_commitment]');
            let preferred_time = current_fs.find('#preferred-time');
            let arabic_level = current_fs.find('input[name=arabic_level]');
            let quran_level  = current_fs.find('input[name=quran_level]');
            let hear_about  = current_fs.find("input[name='hear_about[]']");
            let select_options = current_fs.find("select[required]");
            let course_type  = current_fs.find('input[name=course_type]');

            let flag = true;
            let studyBeforeRadioStatus = false;

            for (let index = 0; index < studyBeforeRadio.length; ++index) {
                if (!studyBeforeRadio[index].checked){
                    $(studyBeforeRadio[index]).css('border-color', 'red');
                    flag = false;
                    studyBeforeRadioStatus = false;
                }else{
                    $(studyBeforeRadio[index]).css('border-color', 'green');
                    flag = true;
                    if (studyBeforeRadio[index].value == 'no'){
                        studyBeforeRadioStatus = true;
                    }
                    break;
                }
            }

            if (studyBeforeRadio !== undefined){
                if (!flag){
                    $('#study-before-section .error-msg-times').remove();
                    $('#study-before-section').prepend(`<div class="alert alert-danger error-msg-times text-right" role="alert">
                                                  {{ __('You must confirm one of the following options') }}
                    </div>`);
                    return false;
                }else{
                    $('#study-before-section .error-msg-times').remove();
                }
            }

            for (let index = 0; index < course_type.length; ++index) {
                if (!course_type[index].checked){
                    $(course_type[index]).css('border-color', 'red');
                    flag = false;
                }else{
                    $(course_type[index]).css('border-color', 'green');
                    flag = true;
                    break;
                }
            }

            if (course_type !== undefined){
                if (!flag){
                    $('#course_types .error-msg-times').remove();
                    $('#course_types').prepend(`<div class="alert alert-danger error-msg-times text-right" role="alert">
                                                  {{ __('You must confirm one of the following options') }}
                    </div>`);
                    return false;
                }else{
                    $('#course_types .error-msg-times').remove();
                }
            }

            if (studyBeforeRadioStatus == true){
                for (let index = 0; index < arabic_level.length; ++index) {
                    if (!arabic_level[index].checked){
                        $(arabic_level[index]).css('border-color', 'red');
                        flag = false;
                    }else{
                        $(arabic_level[index]).css('border-color', 'green');
                        flag = true;
                        break;
                    }
                }

                if (arabic_level !== undefined){
                    if (!flag){
                        $('#arabic_level .error-msg-times').remove();
                        $('#arabic_level').prepend(`<div class="alert alert-danger error-msg-times text-right" role="alert">
                                                  {{ __('You must confirm one of the following options') }}
                        </div>`);
                        flag = false;
                    }else{
                        $('#arabic_level .error-msg-times').remove();
                    }
                }

                for (let index = 0; index < quran_level.length; ++index) {
                    if (!quran_level[index].checked){
                        $(quran_level[index]).css('border-color', 'red');
                        flag = false;
                    }else{
                        $(quran_level[index]).css('border-color', 'green');
                        flag = true;
                        break;
                    }
                }

                if (quran_level !== undefined){
                    if (!flag){
                        $('#quran_level .error-msg-times').remove();
                        $('#quran_level').prepend(`<div class="alert alert-danger error-msg-times text-right" role="alert">
                                                  {{ __('You must confirm one of the following options') }}
                        </div>`);
                        flag = false;
                    }else{
                        $('#quran_level .error-msg-times').remove();
                    }
                }

                for (let index = 0; index < hear_about.length; ++index) {
                    if (!hear_about[index].checked){
                        $(hear_about[index]).css('border-color', 'red');
                        flag = false;
                    }else{
                        $(hear_about[index]).css('border-color', 'green');
                        flag = true;
                        break;
                    }
                }

                if (hear_about !== undefined){
                    if (!flag){
                        $('#hear_about .error-msg-times').remove();
                        $('#hear_about').prepend(`<div class="alert alert-danger error-msg-times text-right" role="alert">
                                                  {{ __('You must confirm one of the following options') }}
                        </div>`);
                        flag = false;
                    }else{
                        $('#hear_about .error-msg-times').remove();
                    }
                }

            }

            for (index = 0; index < inputs.length; ++index) {
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

            for (index = 0; index < select_options.length; ++index) {
                let selector = $(select_options[index]).prop('id');
                if (select_options[index].value == ""){
                    $('#' + selector + ' + .select2-container--default').css('border', '1px solid red');
                    $('#' + selector + ' + .select2-container--default').css('border-radius', '5px');
                    flag = false;
                }else{
                    $('#' + selector + ' + .select2-container--default').css('border', '1px solid green');
                    $('#' + selector + ' + .select2-container--default').css('border-radius', '5px');
                }
            }

            if (preferred_time.prop('required')){
                if (!preferred_time.val()){
                    $(preferred_time).css('border-color', 'red');
                    flag = false;
                }
            }

            // if (!$('#not_study_before_student').hasClass('d-none')){
            if (guardianCommitment[0] !== undefined){
                if (!guardianCommitment[0].checked){
                    $('#guardian_commitment_section .error-msg-times').remove();
                    $('#guardian_commitment_section').prepend(`<div class="alert alert-danger error-msg-times text-right" role="alert">
                                                  {{ __('You must confirm your familiarity with the distance education system') }}
                    </div>`);
                    flag = false;
                }else{
                    $('#guardian_commitment_section .error-msg-times').remove();
                }
            }
            // }

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

        // $(document).on('change', 'select[name="father_whatsApp_studied"]', function (e) {
        //     $('input[name="father_whatsApp_number_studied"]').val(" " + $(this).val() + "+");
        // });

        $(document).on('change', '.country-code', function (e) {
            $(this).closest('div').find('.input-group-append .phone-number-code').html('+' + $(this).val());
        });

        $(document).on('change', 'form [type="email"]', function (e) {
            var email = $(this);
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if (!filter.test(email.val())) {
                email.val('');
                email.css('border-color', 'red');
                alert('{{ __('Please provide a valid email address') }}');
                email.focus;
            }
        });

        //====================
        // $(document).on('change', 'select[name="father_whatsApp"]', function (e) {
        //     $('input[name="father_whatsApp_number"]').val(" " + $(this).val() + "+");
        // });

        // $(document).on('change', 'select[name="mother_whatsApp"]', function (e) {
        //     $('input[name="mother_whatsApp_number"]').val(" " + $(this).val() + "+");
        // });

        // $(document).on('change', 'input[name="quran_school"]', function (e) {
        //     if($(this).val() == 'no'){
        //         $('input[name="name_school"]').removeAttr('required');
        //         $('#name-school-section').addClass('d-none');
        //     }else{
        //         $('input[name="name_school"]').prop('required', true);
        //         $('#name-school-section').removeClass('d-none');
        //     }
        // });

        $(document).on('change', 'input[name="study_before"]', function (e) {

            if ($(this).val() == 'yes'){
                $('#study_before_student').removeClass('d-none');
                $('#not_study_before_student').removeClass('d-none');
                $('#not_study_before_student').addClass('d-none');

                $('#already_studied input, #already_studied select').prop('required', true);
                $('#not_study_before_student input, #not_study_before_student select').removeAttr('required');

                $('#study_before_student input, #study_before_student select').prop('required', true);

                $(".checkbox-options").removeAttr('required');
            }else{
                $('#not_study_before_student').removeClass('d-none');
                $('#study_before_student').removeClass('d-none');
                $('#study_before_student').addClass('d-none');

                $('#already_studied').addClass('d-none');
                $('#already_studied input, #already_studied select').removeAttr('required');
                $('#not_study_before_student input, #not_study_before_student select').prop('required', true);

                $('#study_before_student input, #study_before_student select').removeAttr('required');
                $(".checkbox-options").removeAttr('required');

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
