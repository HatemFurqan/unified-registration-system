<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Furqan Group - Personalized Learning</title>
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome (v6 for consistency) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <link rel="icon" type="image/x-icon" href="https://furqanshop.com/new-students/favicon.ico">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- New CSS from the modern design -->
    <style>
        :root {
            --primary: #25408f;
            --primary-dark: #1c3272;
            --primary-light: rgba(37, 64, 143, 0.1);
            --green: #22c55e;
            --red: #ef4444;
            --blue: #3b82f6;
            --purple: #8b5cf6;
            --amber: #f59e0b;
            --secondary-original: #6c757d;
        }

        html {
            padding: 0 !important;
        }

        body {
            font-family: "Cairo", sans-serif;
            background: linear-gradient(to bottom, #f9fafb, #f3f4f6);
            min-height: 100vh;
            padding-top: 0;
        }

        /* --- Header Styles --- */
        .site-header {
            background: linear-gradient(to right,
                    var(--primary),
                    rgba(37, 70, 171, 0.9));
            color: white;
        }

        .site-header .navbar-brand img {
            max-height: 50px;
        }

        .virtual-office-btn {
            background-color: rgba(255, 255, 255, 0.2);
            transition: background-color 0.3s;
            color: white !important;
            border: none;
        }

        .virtual-office-btn:hover {
            background-color: rgba(255, 255, 255, 0.3);
            color: white !important;
        }

        .site-header .dropdown-toggle {
            color: white !important;
        }

        .site-header .nav-link.policy-btn {
            color: #F68B32 !important;
            font-weight: 600;
        }

        .site-header .nav-link.policy-btn:hover {
            color: rgba(246, 139, 50, 0.8) !important;
        }

        .site-header .dropdown-menu {
            min-width: auto;
        }

        .site-header .dropdown-item.active,
        .site-header .dropdown-item:active {
            background-color: var(--primary);
        }

        /* --- Main Banner & Hero --- */
        .main-banner {
            background: linear-gradient(to right, var(--primary), var(--primary-dark));
            border-radius: 0.75rem 0.75rem 0 0;
            padding: 2.5rem;
            text-align: center;
            color: white;
        }

        .page-cover-image {
            max-height: 96px;
            width: auto;
            background-position: center;
            background-repeat: no-repeat;
            background-size: contain;
        }

        .page-title-section {
            background-color: #e9ecef;
        }

        .page-title-section h1 {
            color: var(--primary);
        }

        /* --- Card Styles --- */
        .custom-card {
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-radius: 0.75rem;
            overflow: hidden;
            background-color: white;
        }

        .card-header-gradient-blue {
            background: linear-gradient(to right, #e0f2fe, #e0e7ff);
            border-bottom: 1px solid #dbeafe;
        }

        .card-header-gradient-green {
            background: linear-gradient(to right, #dcfce7, #d1fae5);
            border-bottom: 1px solid #bbf7d0;
        }

        .card-header-gradient-purple {
            background: linear-gradient(to right, #ede9fe, #e0e7ff);
            border-bottom: 1px solid #ddd6fe;
        }

        .icon-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .blue-circle {
            background-color: #dbeafe;
        }

        .green-circle {
            background-color: #d1fae5;
        }

        .purple-circle {
            background-color: #ede9fe;
        }

        /* --- Stepper Styles --- */
        .stepper-main-container {
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-radius: 0 0 0.75rem 0.75rem;
            overflow: hidden;
            background-color: #ffffff;
        }

        .stepper-container {
            padding: 1.5rem;
            border-bottom: 1px solid #f3f4f6;
            background-color: #f9fafb;
        }

        .stepper-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 33.333%;
            cursor: default;
        }

        .stepper-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5rem;
            transition: all 0.3s;
            font-weight: bold;
        }

        .stepper-circle.active {
            background-color: var(--primary);
            color: white;
        }

        .stepper-circle.completed {
            background-color: var(--green);
            color: white;
        }

        .stepper-circle.inactive {
            border: 2px solid #d1d5db;
            color: #9ca3af;
            background-color: #e5e7eb;
        }

        .stepper-label {
            font-size: 0.8rem;
            font-weight: 500;
            text-align: center;
            color: #6b7280;
        }

        .stepper-label.active {
            color: var(--primary);
        }

        .stepper-label.completed {
            color: var(--green);
        }

        .stepper-progress {
            height: 0.5rem;
            background-color: #e5e7eb;
            border-radius: 9999px;
            margin-top: 1rem;
            position: relative;
        }

        .stepper-progress-bar {
            position: absolute;
            top: 0;
            height: 100%;
            background-color: var(--primary);
            border-radius: 9999px;
            transition: width 0.5s, background-color 0.5s;
        }

        html[dir="rtl"] .stepper-progress-bar {
            right: 0;
        }

        html[dir="ltr"] .stepper-progress-bar {
            left: 0;
        }

        .stepper-progress-bar.completed {
            background-color: var(--green);
        }

        /* --- Form Styling--- */
        #msform .form-step {
            background: white;
            border: 0 none;
            border-radius: 0.5rem;
            box-sizing: border-box;
            width: 100%;
            margin: 0;
            position: relative;
            display: none;
        }

        #msform .form-step.active {
            display: block;
            animation: fadeIn 0.5s;
        }

        .fs-title {
            font-size: 1.75rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            font-weight: bold;
            text-align: center;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 0.375rem;
        }

        .form-check-input {
            border: 1px solid grey;
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        #std-name {
            cursor: default !important;
            background-color: #e9ecef;
        }

        /* --- Session Selection Cards --- */
        .session-card {
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            border: 1px solid #dee2e6;
            border-radius: 0.75rem;
            background-color: white;
        }

        .session-card:hover {
            border-color: var(--primary);
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .session-card.selected {
            border-color: var(--primary);
            background-color: var(--primary-light);
            box-shadow: 0 0.25rem 0.5rem rgba(37, 64, 143, 0.15);
        }

        .session-card.selected .btn-outline-primary {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .session-card input[type="radio"] {
            display: none;
        }

        .session-card .card-body {
            padding: 1.5rem;
        }

        .session-card .card-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .session-card .card-text {
            color: #6b7280;
        }

        .session-card.is-invalid {
            border: 2px solid var(--red);
        }

        .session-card.is-valid {
            border: 2px solid var(--green);
        }

        /* --- Button Styles --- */
        .btn-primary {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark) !important;
            border-color: var(--primary-dark) !important;
        }

        .action-button {
            background: var(--primary);
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0.375rem;
            cursor: pointer;
            padding: 10px 20px;
            margin: 10px 5px;
            transition: background-color 0.3s;
        }

        .action-button:hover,
        .action-button:focus {
            background-color: var(--primary-dark);
        }

        .action-button-previous {
            background: var(--secondary-original);
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0.375rem;
            cursor: pointer;
            padding: 10px 20px;
            margin: 10px 5px;
            transition: background-color 0.3s;
        }

        .action-button-previous:hover,
        .action-button-previous:focus {
            background-color: #5a6268;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* --- Payment Form Styles --- */
        #payment-form-container {
            width: 100%;
        }
        #payment-form {
            margin: 0 auto;
        }

        #payment-form iframe {
            width: 100%;
        }

        #payment-form .card-frame {
            border: solid 1px #13395E;
            border-radius: 3px;
            margin-bottom: 8px;
            height: 40px;
            box-shadow: 0 1px 3px 0 rgba(19, 57, 94, 0.2);
        }

        #payment-form .card-frame.frame--focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 0.25rem rgba(37, 64, 143, 0.25) !important;
        }

        #payment-form .card-frame.frame--invalid {
            border-color: var(--red) !important;
        }

        #pay-button {
            border: none;
            border-radius: 3px;
            min-height: 40px;
            width: 100%;
            background-color: #13395E;
            box-shadow: 0 1px 3px 0 rgba(19, 57, 94, 0.4);
            font-family: 'Cairo', sans-serif;
            font-weight: bold;
            color: #fc0;
        }
        #paypal-pay-button div {
            width: 100% !important;
            min-width: auto;
            margin-top: 8px;
        }

        #apple-pay-button {
            -webkit-appearance: -apple-pay-button;
            -apple-pay-button-type: plain;
            -apple-pay-button-style: black;
            display: block;
            height: 40px;
            vertical-align: middle;
            margin: 8px auto;
        }

        #google-pay-button div button {
            width: 100% !important;
            min-width: auto;
        }

        .coupon-form {
            border: 1px solid #ccc;
            padding: 8px 16px;
            margin: 1rem 0;
            border-radius: 8px;
            background: #f9f9f9;
        }

        .coupon-form input {
            text-align: center;
        }

        .coupon-form button {
            width: 100% !important;
            margin-top: 8px;
        }

        #pay-button-full-free {
            background-color: var(--green) !important;
            border-color: var(--green) !important;
            color: white !important;
            font-weight: bold;
            width: 100%;
            padding: 10px 20px;
            border-radius: 0.375rem;
        }

        /* Error messages for validation */
        .error-msg-alert {
            font-size: 0.875em;
            color: var(--red);
            margin-top: 0.25rem;
        }

        input.is-invalid,
        select.is-invalid,
        textarea.is-invalid {
            border-color: var(--red) !important;
        }

        .form-check-input.is-invalid~.form-check-label {
            color: var(--red);
        }

        input:invalid,
        select:invalid,
        textarea:invalid {
            box-shadow: none;
        }

        /* Styling for radio cards */
        .radio-card-group .radio-card {
            border: 1px solid rgb(216, 218, 222);
            border-radius: 0.375rem;
            padding: 0.75rem 1rem;
            margin-bottom: 0.75rem;
            transition: all 0.2s ease-in-out;
            cursor: pointer;
        }

        .radio-card-group .radio-card:hover {
            background-color: #f9fafb;
            border-color: var(--primary-light);
        }

        .radio-card-group .radio-card input[type="radio"] {
            margin-top: 0.2rem;
        }

        .radio-card-group .radio-card input[type="radio"]:checked+.form-check-label {
            color: var(--primary);
            font-weight: 600;
        }

        .radio-card-group .radio-card.selected {
            border-color: var(--primary);
            background-color: var(--primary-light);
        }

        .form-check-label {
            width: 100%;
        }
         .lastDiv {
            width: 60% !important;
            margin: 0 auto;
        }
        /* for small screens */
        @media (max-width: 767px) {
            .lastDiv {
                width: 100% !important;
            }
        }

        /* RTL support */
        html[dir="rtl"] .me-2 {
            margin-left: 0.5rem !important;
            margin-right: 0 !important;
        }

        html[dir="rtl"] .ms-2 {
            margin-right: 0.5rem !important;
            margin-left: 0 !important;
        }

        html[dir="rtl"] .float-right {
            float: right !important;
            margin-right: -1.5em;
        }
    </style>
</head>

<body>

    <!-- New Header -->
    <header class="site-header shadow-sm">
        <div class="container d-flex justify-content-between align-items-center py-3 px-md-3">
            <a class="navbar-brand" href="https://eservices.fg2020.com/" target="_blank">
                <img src="https://eservices.fg2020.com/assets/images/nlogo.png" alt="Furqan Group Logo" />
            </a>
            <div class="d-flex align-items-center gap-2 gap-md-3">
                <div class="d-flex flex-column align-items-center flex-md-row gap-2">
                    <a href="https://furqangroup.zoom.us/j/99947595293" target="_blank" rel="noopener noreferrer" class="virtual-office-btn d-flex align-items-center justify-content-center btn-sm gap-1 px-3 py-2 btn text-decoration-none ">
                        <i class="fas fa-video"></i>
                        <span class="d-none d-sm-inline">{{ __('Virtual Office') }}</span>
                    </a>
                    <a href="https://www.furqangroup.com/sa/pages/424" target="_blank" rel="noopener noreferrer" class="srf-btn d-flex align-items-center justify-content-center gap-1 px-3 py-2 btn-sm btn btn-outline-light text-decoration-none ">
                        <i class="fas fa-info-circle"></i>
                        <span class="d-none d-sm-inline">{{ __('SRF') }}</span>
                    </a>
                </div>
                <div class="dropdown">
                    <button class="btn btn-link text-decoration-none dropdown-toggle" type="button"
                        id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-globe me-1"></i>
                        <span>{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @php $isActive = (app()->getLocale() == $localeCode); @endphp
                            <li>
                                <a class="dropdown-item @if ($isActive) active @endif"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <nav class="d-flex justify-content-center py-2 bg-light w-100 ">
            <ul class="nav p-0 justify-content-center">
                <li class="nav-item">
                    <button class="nav-link policy-btn" data-bs-toggle="modal" data-bs-target="#policyModal"
                        data-policytype="terms">{{ __('Terms And Conditions') }}</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link policy-btn" data-bs-toggle="modal" data-bs-target="#policyModal"
                        data-policytype="refund">{{ __('Refund Policy') }}</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link policy-btn" data-bs-toggle="modal" data-bs-target="#policyModal"
                        data-policytype="privacy">{{ __('Privacy Policy') }}</button>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="py-4 text-center page-title-section">
        <div class="container">
            <img src="https://furqanshop.com/new-students/images/logo.jpg" alt="Furqan Group Cover"
                class="mb-3 page-cover-image" />
            <h1 class="h2 fw-bold">{{ __('Second semester 2022 - one to one') }}</h1>
            <p class="lead text-muted">
                <span class="fw-bold">{!! __('hero subheader') !!}</span>
            </p>
        </div>
    </section>

    <div class="alert alert-danger d-none" id="support-cookies" style="text-align: center;font-weight: bold;">{!! __('Support Cookies') !!}</div>

    <!-- Main Content -->
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8">
                    <div class="main-banner">
                        <h4>{{ __('start registration') }}</h4>
                    </div>
                    <div class="stepper-main-container">
                        <!-- New Stepper -->
                        <div class="stepper-container">
                            <div class="d-flex justify-content-between" id="stepper">
                                <div class="stepper-item" data-step="1">
                                    <div class="stepper-circle active">1</div>
                                    <div class="stepper-label active">{{ __('resubscribe.Information and notes') }}
                                    </div>
                                </div>
                                <div class="stepper-item" data-step="2">
                                    <div class="stepper-circle inactive">2</div>
                                    <div class="stepper-label inactive">{{ __('resubscribe.Register') }}</div>
                                </div>
                                <div class="stepper-item" data-step="3">
                                    <div class="stepper-circle inactive">3</div>
                                    <div class="stepper-label inactive">
                                        {{ __('resubscribe.Payment and termination') }}
                                    </div>
                                </div>
                            </div>
                            <div class="stepper-progress mt-3">
                                <div class="stepper-progress-bar" id="stepperProgressBar" style="width: 0;"></div>
                            </div>
                        </div>

                        <!-- Form Content -->
                        <div class="p-3 p-md-4">
                            <form id="msform" action="{{ route('registration.one-to-one.resubscribe') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <!-- Step 1: Information -->
                                <div class="form-step active" id="step1Content">
                                    <div class="fs-title mb-4">{{ __('resubscribe.General information') }}</div>

                                    <div class="custom-card mb-4">
                                        <div class="card-header-gradient-blue p-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="icon-circle blue-circle"><i
                                                        class="fas fa-info-circle text-primary"></i></div>
                                                <h4 class="mb-0 fs-5 fw-semibold text-dark">
                                                    {{ __('Program Details') }}
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="card-body p-3 p-md-4">
                                            @if (app()->getLocale() == 'ar')
                                                <p>
                                                    أعزاءنا أولياء الأمور.. تم فتح مجال التسجيل في نظام التعليم الفردي
                                                    لطلاب وطالبات قسم الحفظ، حيث يتميز نظام التعليم الفردي بتخصيص معلم
                                                    خاص لكل طالب، وتقليل مدة الحلقة مع الحفاظ على جودة التعليم المعهودة،
                                                    يرجى الاطلاع على التفاصيل التالية:
                                                </p>
                                                <table class="table table-bordered my-3 text-center text-capitalize">
                                                    <tbody>
                                                        <tr>
                                                            <td>الفئة المستهدفة:</td>
                                                            <td class="text-success fw-bold">طلاب وطالبات قسم الحفظ</td>
                                                        </tr>
                                                        <tr>
                                                            <td>مدة الحصة:</td>
                                                            <td class="text-success fw-bold">ساعة يوميا (5 أيام في الأسبوع)</td>
                                                        </tr>
                                                        <tr>
                                                            <td>الفترة:</td>
                                                            <td class="text-success fw-bold">يمكن اختيار الوقت المفضل ضمن الأوقات المحددة أدناه</td>
                                                        </tr>
                                                        <tr>
                                                            <td>الرسوم الدراسية:</td>
                                                            <td class="text-success fw-bold">{{ $course->price }}$ ({{ intval($course->price * 3.75) }} ريال) للمدة المتبقية من الفصل الدراسي</td>
                                                        </tr>
                                                        <tr>
                                                            <td>مدة الفصل الدراسي:</td>
                                                            <td class="text-success fw-bold">4 أشهر</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            @else
                                                <p>Dear Parents,<br> The registration in the one-to-one classes for students in the memorization (Hifz) program is open now. In the one-to-one class system, a private tutor is assigned for each student individually. The class duration is reduced while the quality of education is maintained equally to the regular class systems. Kindly review the following details:</p>
                                                <table class="table table-bordered my-3 text-capitalize text-center">
                                                    <tbody>
                                                        <tr>
                                                            <td>Target group</td>
                                                            <td class="text-success fw-bold">Students in Memorization program (Hifz)</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Class duration</td>
                                                            <td class="text-success fw-bold">1 hour, 5 days a week (Sunday to Thursday)</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Time</td>
                                                            <td class="text-success fw-bold">The desired session can be chosen below</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Fees</td>
                                                            <td class="text-success fw-bold">{{ $course->price }}$ ({{ intval($course->price * 3.75) }} SAR) for the remaining duration of the semester</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Semester duration</td>
                                                            <td class="text-success fw-bold">4 months</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            @endif
                                        <p class="text-muted ">{{ __('Important! If you would like to register for the') }}</p>
                                        </div>
                                    </div>

                                    <div class="custom-card mb-4">
                                        <div class="card-header-gradient-green p-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="icon-circle green-circle"><i class="fas fa-headset text-success"></i></div>
                                                <h4 class="mb-0 fs-5 fw-semibold text-dark">{{ __('Virtual Office Hours') }}</h4>
                                            </div>
                                        </div>
                                        <div class="card-body p-4">
                                            <p class="text-dark">{{ __('CS Help') }}</p>
                                            <div class="bg-light p-3 rounded border">
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    <p class="fw-medium text-primary mb-0">{{ __('Virtual Office Link') }}</p>
                                                </div>
                                                <a href="https://furqangroup.zoom.us/j/99947595293" target="_blank" rel="noopener noreferrer" class="text-primary d-block mb-3 bg-white p-2 rounded border text-decoration-none text-truncate">https://furqangroup.zoom.us/j/99947595293</a>
                                                <p class="fw-medium text-primary mb-2">{{ __('Office Hours') }}</p>
                                                <p class="small text-muted mb-1">{{ __('Work Days') }}</p>
                                                <ul class="list-unstyled ps-3 small text-muted">
                                                    <li>{{ __('Makka Time') }}</li>
                                                    <li>{{ __('France Time') }}</li>
                                                    <li>{{ __('NY Time') }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Step 2: Registration -->
                                <div class="form-step" id="step2Content">
                                    <div class="fs-title mb-4">{{ __('resubscribe.Register') }}</div>

                                    <div class="custom-card mb-4">
                                        <div class="card-header-gradient-purple p-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="icon-circle purple-circle"><i class="fas fa-user-check text-purple"></i></div>
                                                <h4 class="mb-0 fs-5 fw-semibold text-dark">{{ __('student info') }}</h4>
                                            </div>
                                        </div>
                                        <div class="card-body p-3 p-md-4">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="std-section" class="form-label">{{ __('resubscribe.Section') }}</label>
                                                    <select class="form-select" name="section" id="std-section" required>
                                                        <option value="" selected>{{ __('resubscribe.Choose') }}...</option>
                                                        <option value="1">{{ __('resubscribe.Male') }}</option>
                                                        <option value="2">{{ __('resubscribe.Female') }}</option>
                                                    </select>
                                                    <div class="error-msg-alert"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="std-number" class="form-label">{{ __('resubscribe.Serial Number') }}</label>
                                                    <input type="number" min="0" name="student_number" class="form-control" id="std-number" placeholder="{{ __('resubscribe.Serial Number') }}" required>
                                                    <div class="error-msg-alert"></div>
                                                </div>
                                                <div class="col-12 text-center">
                                                    <div id="std-number-search-error" class="alert alert-danger text-center d-none" role="alert"></div>
                                                    <button type="button" class="btn btn-primary w-50" id="std-number-search">
                                                        <i class="fas fa-search me-2"></i>{{ __('resubscribe.Search') }}
                                                    </button>
                                                </div>
                                                <div class="col-12">
                                                    <label for="std-name" class="form-label">{{ __('resubscribe.Name') }} *</label>
                                                    <input type="text" name="student_name" class="form-control" id="std-name" placeholder="..." required readonly>
                                                    <div class="error-msg-alert"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="custom-card mb-4">
                                        <div class="card-header-gradient-blue p-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="icon-circle blue-circle"><i class="fas fa-map-marker-alt text-primary"></i></div>
                                                <h4 class="mb-0 fs-5 fw-semibold text-dark">{{ __('contact location') }}</h4>
                                            </div>
                                        </div>
                                        <div class="card-body p-3 p-md-4">
                                            <div class="row g-3">
                                                <div class="col-md-12">
                                                    <label for="residence_country" class="form-label">{{ __('resubscribe.Country of Residence') }}</label>
                                                    <select class="form-select" name="residence_country" id="residence_country" required>
                                                        <option value="" selected> - </option>
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->id }}" data-country-name="{{ $country->name }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="error-msg-alert"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="std-email" class="form-label">{{ __('resubscribe.Email') }}</label>
                                                    <input type="email" class="form-control" name="email" id="std-email" placeholder="{{ __('resubscribe.Email') }}" required>
                                                    <div class="error-msg-alert"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="std-email-conf" class="form-label">{{ __('resubscribe.Confirm Email') }}</label>
                                                    <input type="email" class="form-control" name="email_confirmation" id="std-email-conf" placeholder="{{ __('resubscribe.Confirm Email') }}" required>
                                                    <div class="error-msg-alert"></div>
                                                </div>
                                                <div class="col-12 d-none" id="discount-reason-image-div">
                                                    <label for="discount-reason-image" class="form-label">{{ __('Discount Reason Image') }}</label>
                                                    <input type="file" name="discount_reason_image" class="form-control" id="discount-reason-image">
                                                    <div class="error-msg-alert"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="custom-card mb-4">
                                        <div class="card-header-gradient-green p-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="icon-circle green-circle"><i class="fas fa-clock text-success"></i></div>
                                                <h4 class="mb-0 fs-5 fw-semibold text-dark">{{ __('preferred schedule') }}</h4>
                                            </div>
                                        </div>
                                        <div class="card-body p-3 p-md-4">
                                            <p class="form-label fw-medium mb-3">{{ __('Choose your preferred schedule') }} <span class="fw-bold">GMT+3</span></p>

                                            <div id="favorite_times_male" class="d-none">
                                                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3">
                                                    @foreach($favorite_times_male as $index => $slot)
                                                        <div class="col">
                                                            <div class="card session-card h-100">
                                                                <div class="card-body text-center d-flex flex-column justify-content-center">
                                                                    <h6 class="card-title">{{ $slot->title }}</h6>
                                                                    <input type="radio" name="favorite_time" id="timeSlotMale{{ $index }}" value="{{ $slot->title }}" required>
                                                                    <label for="timeSlotMale{{ $index }}" class="btn btn-sm btn-outline-primary w-100 stretched-link mt-auto">{{ __('Select') }}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div id="favorite_times_female" class="d-none">
                                                 <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3">
                                                    @foreach($favorite_times_female as $index => $slot)
                                                        <div class="col">
                                                            <div class="card session-card h-100">
                                                                <div class="card-body text-center d-flex flex-column justify-content-center">
                                                                    <h6 class="card-title">{{ $slot->title }}</h6>
                                                                    <input type="radio" name="favorite_time" id="timeSlotFemale{{ $index }}" value="{{ $slot->title }}" required>
                                                                    <label for="timeSlotFemale{{ $index }}" class="btn btn-sm btn-outline-primary w-100 stretched-link mt-auto">{{ __('Select') }}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div id="time-slot-error" class="error-msg-alert w-100 mt-2"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 3: Payment -->
                                <div class="form-step" id="step3Content">
                                    <div class="fs-title mb-4">{{ __('resubscribe.Payment and termination') }}</div>
                                    <div class="custom-card mb-4">
                                        <div class="card-header-gradient-blue p-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="icon-circle blue-circle"><i class="fas fa-file-signature text-primary"></i></div>
                                                <h4 class="mb-0 fs-5 fw-semibold text-dark">{{ __('Confirmation') }}</h4>
                                            </div>
                                        </div>
                                        <div class="card-body p-3 p-md-4">
                                            <div id="signature-section" class="radio-card-group">
                                                <label class="form-label fw-medium text-danger">{{ __('Guardian Signature') }}:</label>
                                                <div class="form-check radio-card">
                                                    <input class="form-check-input {{ app()->getLocale() == 'ar' ? 'float-right' : '' }}" type="checkbox" name="signature" id="agree-terms" value="Signed" required>
                                                    <label class="form-check-label" for="agree-terms">{{ __('resubscribe.terms and conditions') }}</label>
                                                </div>
                                                <div class="error-msg-alert"></div>
                                            </div>
                                            <div class="form-check d-none">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       name="payment_method"
                                                       data-base-course-amount="{{ $course->price }}"
                                                       data-course-amount="{{ $course->price }}"
                                                       id="checkout_gateway"
                                                       value="checkout_gateway" checked required>
                                                <label class="form-check-label" for="checkout_gateway">
                                                    {!! __('Payment via credit card') !!} -
                                                    <span id="course-price-display" class="fw-bold">${{ $course->price }}</span>
                                                    <span id="amount" class="d-none">{{ $course->price }}</span>
                                                </label>
                                                <span id="discount-reasodn" class="d-block small text-danger fw-bold mt-1"></span>
                                                <img class="d-block mt-2" style="max-width: 200px;" src="{{ asset('card-icons/cards.png') }}" alt="Cards icons">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-card mb-4" id="registration_summary_card">
                                        <div class="card-header-gradient-blue p-3">
                                            <div class="d-flex align-items-center gap-2 gap-md-3">
                                                <div class="icon-circle blue-circle"><i class="fas fa-file-invoice-dollar text-primary"></i></div>
                                                <h4 class="mb-0 fs-5 fw-semibold text-dark">{{ __('registration summary') }}</h4>
                                            </div>
                                        </div>
                                        <div class="card-body p-3 p-md-4">
                                            <p><span class="d-block ">{{ __('dear student') }} <span id="dear-std" class="text-success"></span></span><span class="d-block mb-3">{{ __('dear student cont') }}</span></p>
                                            <div class=" col-sm-12 col-md-7" style="margin: 0 auto;">
                                                <div id="couponParent">
                                                    <div class="coupon-form" id="apply-coupon-section">
                                                        <label for="apply_coupon" class="form-label">{{ __('resubscribe.Enter coupon') }}</label>
                                                        <input type="text" name="apply_coupon" class="form-control" id="apply_coupon">
                                                        <small id="coupon-description" class="form-text text-muted d-block mt-1"></small>
                                                        <button type="button" class="btn btn-primary btn-sm" id="apply_coupon_btn">
                                                            {{ __('resubscribe.Apply') }}
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="bg-light p-3 rounded border mb-4">
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <span class="text-muted">{{__('tuition fee:')}}</span>
                                                        <span id="tuition_fee_summary" class="fw-medium">${{$course->price}}.00</span>
                                                    </div>
                                                    <div id="discount_summary_row" class="d-none mb-2">
                                                        <div class="d-flex justify-content-between text-success">
                                                            <span>{{__('discount')}}</span>
                                                            <span id="discount_amount_summary" class="badge bg-success" style="line-height: 1.7;min-width: 68px;display: block;text-align: end;">-$0.00</span>
                                                        </div>
                                                    </div>
                                                    <div id="custom_price_summary_row" >
                                                        <div class="d-flex justify-content-between text-success">
                                                            <span id="discount-reason" class="d-block small text-danger fw-bold mt-1"></span>
                                                            <span id="discount-amount" class="badge bg-success" style="line-height: 1.7;min-width: 68px;display: block;text-align: end;">-$0.00</span>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                    <div class="d-flex justify-content-between fw-bold fs-5">
                                                        <span>{{__('Total:')}}</span>
                                                        <span id="total_price_summary">${{$course->price}}.00</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100 mt-2 d-none" id="pay-button-full-free">
                                        {{ __('resubscribe.Checkout') }} (Free)
                                        <i class="fas fa-spinner fa-spin d-none ms-1"></i>
                                    </button>
                                </div>

                                <!-- Hidden Fields -->
                                <input type="hidden" name="hidden_apply_coupon" id="hidden_apply_coupon">
                                <input type="hidden" name="token_pay" id="token_pay">
                                <input type="hidden" name="api_url" id="api_url" value="{{ url('') }}">
                                <input type="hidden" name="mode_key" id="mode_key" value="{{ env('CHECKOUT_PK') }}">
                                <input type="hidden" name="mode_pay" id="mode_pay" value="{{ env('CHECKOUT_MODE') }}">
                                <input type="hidden" name="google_merchant_id" id="google_merchant_id"  value="{{ env('GOOGLE_MERCHANT_ID') }}">
                                <input type="hidden" name="paypal_clientid" id="paypal_clientid" value="{{env('PAYPAL_MODE') === 'sandbox' ? env('PAYPAL_SANDBOX_CLIENT_ID') : env('PAYPAL_LIVE_CLIENT_ID')}}">
                                <input type="hidden" name="token_pay_type" id="token_pay_type">
                            </form>

                            <!-- Checkout.com Payment Form -->
                            <div id="payment-form-container" class="d-none">
                                <form id="payment-form" method="POST" action="https://merchant.com/charge-card">
                                    <div class="custom-card">
                                        <div class="card-header-gradient-purple p-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="icon-circle purple-circle"><i class="fas fa-credit-card text-purple"></i></div>
                                                <h4 class="mb-0 fs-5 fw-semibold text-dark">{{ __('Secure Payment') }}</h4>
                                            </div>
                                        </div>
                                        <div class="card-body lastDiv p-3 p-md-4">
                                            <label class="form-label">{{ __('Card Information') }}</label>
                                            <div class="card-frame"></div>
                                            <p class="error-message text-danger small mt-1"></p>
                                            <button class="btn btn-primary w-100" id="pay-button" disabled>
                                                {{ __('resubscribe.Checkout') }}
                                                <i class="fas fa-spinner fa-spin d-none ms-1"></i>
                                            </button>
                                            <hr class="my-3">
{{--                                            <div id="apple-pay-button" class="d-none mb-2"></div>--}}
                                            {{--<div id="google-pay-button" class="mb-2"></div>--}}
                                            <div id="paypal-pay-button"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="d-flex justify-content-between mt-4">
                                @if (app()->getLocale() == 'ar')
                                    <button type="button" name="previous" class="previous action-button-previous d-none">
                                        <i class="fas fa-arrow-right me-2"></i>{{ __('resubscribe.Previous') }}
                                    </button>
                                    <button type="button" name="next" class="next action-button ms-2">
                                        {{ __('resubscribe.Next') }}<i class="fas fa-arrow-left ms-2"></i>
                                    </button>
                                @else
                                    <button type="button" name="previous" class="previous action-button-previous d-none">
                                        <i class="fas fa-arrow-left me-2"></i>{{ __('resubscribe.Previous') }}
                                    </button>
                                    <button type="button" name="next" class="next action-button me-2">
                                        {{ __('resubscribe.Next') }}<i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Policy Modal -->
        <div class="modal fade" id="policyModal" tabindex="-1" aria-labelledby="policyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content p-4 ">
                    <div class="modal-header bg-transparent border-0">
                        <h5 class="modal-title" id="policyModalLabel">Policy</h5>
                        <button type="button" class="btn bg-transparent border-0 btn-light btn-sm" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18" /><path d="m6 6 12 12" /></svg>
                        </button>
                    </div>
                    <div class="modal-body" id="policyModalBody"></div>
                </div>
            </div>
        </div>
    </main>

    <!-- JS Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.checkout.com/js/framesv2.min.js"></script>
    <script src="https://pay.google.com/gp/p/js/pay.js"></script>
    <script src="https://applepay.cdn-apple.com/jsapi/v1/apple-pay-sdk.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_MODE') === 'sandbox' ? env('PAYPAL_SANDBOX_CLIENT_ID') : env('PAYPAL_LIVE_CLIENT_ID')}}&components=buttons&disable-funding=credit,card&locale=en_US"></script>

    <!-- Original App JS for Payment -->
    <script src="{{ asset('app.js') }}?v=7"></script>
    <script src="{{ asset('pay-apple.js') }}?v=7"></script>
    {{--    <script src="{{ asset('pay-google.js') }}?v=7"></script>--}}
    <script src="{{ asset('pay-pal.js') }}?v=7"></script>

    <!-- Script & Payment -->
    <script>
        $(document).ready(function() {
            // --- New UI Stepper & Form Logic ---
            const formSteps = $('#msform .form-step');
            const nextBtn = $('.next');
            const prevBtn = $('.previous');
            const stepperItems = $('#stepper .stepper-item');
            const stepperProgressBar = $('#stepperProgressBar');
            let currentFormStep = 0;

            function updateUIForStep(stepIndex) {
                formSteps.removeClass('active').eq(stepIndex).addClass('active');
                stepperItems.each(function(idx) {
                    const circle = $(this).find('.stepper-circle');
                    const label = $(this).find('.stepper-label');
                    circle.removeClass('active completed inactive');
                    label.removeClass('active completed');
                    if (idx < stepIndex) {
                        circle.addClass('completed').html('<i class="fas fa-check"></i>');
                        label.addClass('completed');
                    } else if (idx === stepIndex) {
                        circle.addClass('active').text(idx + 1);
                        label.addClass('active');
                    } else {
                        circle.addClass('inactive').text(idx + 1);
                    }
                });
                const progressPercentage = (stepIndex / (formSteps.length - 1)) * 100;
                stepperProgressBar.css('width', progressPercentage + '%').toggleClass('completed', stepIndex === formSteps.length - 1);
                prevBtn.toggleClass('d-none', stepIndex === 0);
                nextBtn.toggleClass('d-none', stepIndex === formSteps.length - 1);

                if (stepIndex === formSteps.length - 1) {
                    if ($('#agree-terms').is(':checked')) {
                        const amount = parseFloat(document.getElementById('checkout_gateway').getAttribute('data-course-amount') || 0);
                        if (amount > 0) {
                            $('#payment-form-container').removeClass('d-none');
                            $('#pay-button-full-free').addClass('d-none');
                        } else {
                            $('#payment-form-container').addClass('d-none');
                            $('#pay-button-full-free').removeClass('d-none').prop('disabled', false);
                        }
                    } else {
                        $('#payment-form-container').addClass('d-none');
                        $('#pay-button-full-free').addClass('d-none');
                    }
                } else {
                    $('#payment-form-container').addClass('d-none');
                    $('#pay-button-full-free').addClass('d-none');
                }
                currentFormStep = stepIndex;
            }

            function validateStep(currentStepElement) {
                let isValid = true;
                currentStepElement.find('.is-invalid').removeClass('is-invalid');
                currentStepElement.find('.error-msg-alert').empty();

                currentStepElement.find('input[required]:visible, select[required]:visible').each(function() {
                    const field = $(this);
                    const value = field.val() ? (typeof field.val() === 'string' ? field.val().trim() : field.val()) : "";
                    let fieldValid = true;
                    let errorMsg = "{{ __('This field is required.') }}";

                    if (value === "" || value === null) {
                        fieldValid = false;
                    } else if (field.is('#std-email-conf') && value !== $('#std-email').val()) {
                        fieldValid = false;
                        errorMsg = "{{ __('Emails do not match') }}";
                    }

                    if (!fieldValid) {
                        isValid = false;
                        field.addClass('is-invalid');
                        field.closest('.form-group, .col-md-6, .col-12').find('.error-msg-alert').text(errorMsg);
                    } else {
                        field.removeClass('is-invalid');
                    }
                });

                // Special validation for favorite time radio buttons
                const favoriteTimeRadios = currentStepElement.find('input[name="favorite_time"]:visible');
                if ($('#std-section').val() && favoriteTimeRadios.length > 0 && favoriteTimeRadios.filter(':checked').length === 0) {
                    isValid = false;
                    $('#time-slot-error').text("{{ __('You must choose the appropriate time') }}");
                    favoriteTimeRadios.closest('.session-card').addClass('is-invalid');
                } else if (favoriteTimeRadios.length > 0) {
                    $('#time-slot-error').empty();
                    favoriteTimeRadios.closest('.session-card').removeClass('is-invalid');
                    favoriteTimeRadios.filter(':checked').closest('.session-card').addClass('is-valid');
                }

                // Signature validation
                const signatureCheckbox = currentStepElement.find('#agree-terms');
                if(signatureCheckbox.length > 0 && !signatureCheckbox.is(':checked')) {
                    isValid = false;
                    signatureCheckbox.addClass('is-invalid');
                    signatureCheckbox.closest('#signature-section').find('.error-msg-alert').text("{{ __('You must agree to the terms.') }}");
                }

                return isValid;
            }

            // --- Event Handlers ---
            nextBtn.click(function() {
                if (validateStep(formSteps.eq(currentFormStep))) {
                    $('html, body').animate({ scrollTop: 0 }, 'fast');
                    updateUIForStep(currentFormStep + 1);
                }
            });

            prevBtn.click(function() {
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                updateUIForStep(currentFormStep - 1);
            });

            $(".session-card").click(function(e) {
                if (e.target.tagName !== "INPUT") {
                    $(this).find('input[type="radio"]').prop("checked", true).trigger("change");
                }
            });
            $('input[name="favorite_time"]').change(function() {
                $(".session-card").removeClass("selected is-valid");
                if ($(this).is(":checked")) {
                    $(this).closest(".session-card").addClass("selected is-valid");
                    $('#time-slot-error').empty();
                }
            });

            $('#agree-terms').change(function() {
                updateUIForStep(currentFormStep);
                 if ($(this).is(":checked")) {
                    $(this).removeClass('is-invalid');
                    $(this).closest('#signature-section').find('.error-msg-alert').empty();
                }
            });

            $('#std-section').change(function() {
                $('input[name="favorite_time"]').prop('checked', false);
                $('.session-card').removeClass('selected is-valid');

                const selectedSection = $(this).val();
                if (selectedSection == "1") { // Male
                    $('#favorite_times_male').removeClass('d-none');
                    $('#favorite_times_female').addClass('d-none');
                } else if (selectedSection == "2") { // Female
                    $('#favorite_times_female').removeClass('d-none');
                    $('#favorite_times_male').addClass('d-none');
                } else {
                    $('#favorite_times_male').addClass('d-none');
                    $('#favorite_times_female').addClass('d-none');
                }
            });

            $('.policy-btn').on('click', function() {
                const policyType = $(this).data('policytype');
                let title, contentKey;
                if (policyType === 'terms') { title = "{{ __('Terms And Conditions') }}"; contentKey = 'Terms And Conditions Text'; }
                else if (policyType === 'refund') { title = "{{ __('Refund Policy') }}"; contentKey = 'Refund Policy Text'; }
                else if (policyType === 'privacy') { title = "{{ __('Privacy Policy') }}"; contentKey = 'Privacy Policy Text'; }
                const translations = {
                    'Terms And Conditions Text': `{!! ${'termsAndConditionsText_' . app()->getLocale()} ?? '-' !!}`,
                    'Refund Policy Text': `{!! ${'refundPolicyText_' . app()->getLocale()} ?? '-' !!}`,
                    'Privacy Policy Text': `{!! ${'privacyPolicyText_' . app()->getLocale()} ?? '-' !!}`
                };
                $('#policyModalLabel').text(title);
                $('#policyModalBody').html(translations[contentKey] || 'Content not found.');
            });

            // --- AJAX and Payment Logic ---
            $('#pay-button-full-free').click(function(e) {
                e.preventDefault();
                $(this).find('.fa-spinner').removeClass('d-none');
                $(this).prop('disabled', true);
                $('#msform').submit();
            });

            $('#apply_coupon_btn').click(function() {
                $('#hidden_apply_coupon').val($('#apply_coupon').val());
                $('#discount_summary_row').addClass('d-none');
                $('#custom_price_summary_row').removeClass('d-none');
                document.getElementById('checkout_gateway').setAttribute('data-course-amount',
                document.getElementById('checkout_gateway').getAttribute('data-base-course-amount'));

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('registration.one-to-one.applyCoupon') }}?std_number=' + $('#std-number').val() + '&std_section=' + $('#std-section').val() + '&code=' + $('#apply_coupon').val(),
                    success: function(data) {
                        document.getElementById('checkout_gateway').setAttribute('data-course-amount', data.price_after_discount);
                        $('#discount_summary_row').removeClass('d-none');
                        $('#discount_amount_summary').text('-$' + data.discount.toFixed(2));
                        $('#total_price_summary').text('$' + data.price_after_discount.toFixed(2));
                        $('#custom_price_summary_row').addClass('d-none');
                        //$('#coupon-description').html("{{ __('resubscribe.discount total is') }} $" + data.discount + ". {{ __('resubscribe.and price after discount is') }} $" + data.price_after_discount + ".").removeClass('text-danger').addClass('text-success');
                        updateUIForStep(currentFormStep);
                    },
                    error: function(data) {
                        if($('#apply_coupon').val().length > 1){
                            $('#coupon-description').html(data.responseJSON.msg || 'Error').addClass('text-danger').removeClass('text-success');
                        }else{
                            $('#coupon-description').html('');
                        }
                        $('#discount_summary_row').addClass('d-none');

                        const originalTotal = (Math.round(document.getElementById('checkout_gateway').getAttribute('data-course-amount') * 100) / 100);
                        $('#total_price_summary').text('$' + originalTotal.toFixed(2));
                        if (currentFormStep === formSteps.length - 1) {
                            updateUIForStep(currentFormStep);
                        }
                    },
                    complete: function() {
                    }
                });
            });

            $('#std-number-search').click(function() {
                document.getElementById('checkout_gateway').setAttribute('data-course-amount', document.getElementById('checkout_gateway').getAttribute('data-base-course-amount'));
                $('#total_price_summary').text('$' + (Math.round(document.getElementById('checkout_gateway').getAttribute('data-course-amount') * 100) / 100).toFixed(2));
                fetchStudentData($('#std-number').val(), $('#std-section').val(), 'one_to_one', 'clicked');
            });

            // --- AUTO-FILL FROM URL PARAMS ---
            const urlParams = new URLSearchParams(window.location.search);
            const serial = urlParams.get('serial');
            const section = urlParams.get('section');
            if (serial && section) {
                $('form #std-number').val(serial);
                $('form #std-section').val(section);
                fetchStudentData(serial, section, 'one_to_one', 'params');
            }

            function fetchStudentData(studentNumber, studentSection, formType, reqType = 'clicked') {
                $('#hidden_apply_coupon').val('');
                $('#apply_coupon').val('');
                $('#discount_summary_row').addClass('d-none');
                $('#std-number-search-error').addClass('d-none');
                $('#custom_price_summary_row').removeClass('d-none');
                $('#discount-reason-image-div').addClass('d-none');
                $('#std-number-search').prop('disabled', true).find('i').removeClass('fa-search').addClass('fa-spinner fa-spin');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('registration.one-to-one.getStudentInfo') }}?std_number=' + studentNumber + '&std_section=' + studentSection + '&form_type=one_to_one',
                    success: function(data) {
                        handleStudentData(data);
                        $('#std-section').trigger('change');
                    },
                    error: function(_data) {
                        $('#std-name').val('').addClass('is-invalid').attr("placeholder", '{{ __('resubscribe.serial number is incorrect') }}');
                        $('#amount').text('{{ $course->price }}');
                        $('#discount-reason').html('');
                        $('#std-number-search-error').html(_data.responseJSON.msg);
                        $('#std-number-search-error').removeClass("d-none");
                    },
                    complete: function() {
                        $('#std-number-search').prop('disabled', false).find('i').removeClass('fa-spinner fa-spin').addClass('fa-search');

                    }
                });
            }
            function handleStudentData(data) {
                const formattedPrice = parseFloat(data.amount).toFixed(2);
                // Update all visible price displays
                $('#course-price-display').text('$' + formattedPrice);
                $('#tuition_fee_summary').text('$' +  parseFloat(data.base_amount).toFixed(2));  // Updates tuition fee in summary
                $('#total_price_summary').text('$' + formattedPrice);
                // Reset any coupon that might have been applied before fetching the new student
                $('#discount_summary_row').addClass('d-none');
                $('#apply_coupon').val('');
                $('#coupon-description').html('');
                // This is a great addition for the summary card!
                $('#std-name').val(data.name).removeClass('is-invalid').addClass('is-valid');
                $('#std-email').val(data.email);
                $('#std-email-conf').val(data.email);
                $('#dear-std').text(data.name);
                // Your existing logic (which is correct)
                $('form #amount').html(data.amount);
                document.getElementById('checkout_gateway').setAttribute('data-course-amount', data.amount);
                document.getElementById('checkout_gateway').setAttribute('data-base-course-amount', data.amount);

                $('#residence_country option[data-country-name="' + data.residence_country_name + '"]').prop('selected', true);
                $('input[name="favorite_time"]').filter('[value="' + data.favorite_time + '"]').prop('checked', true).trigger('change');

                if (data.discount_reason) {
                    $('#discount-reason').html('سبب الخصم/ ' + data.discount_reason);
                    $('#discount-amount').html(' - $' + parseFloat(data.discount_amount).toFixed(2));
                } else {
                    $('#discount-reason').html('');
                    $('#discount-amount').html('');
                }

                if (data.discount_reason === 'كفالة') {
                    $('#discount-reason-image-div').removeClass('d-none').find('input').prop('required', true);
                } else {
                    $('#discount-reason-image-div').addClass('d-none').find('input').prop('required', false);
                }


                // This is important to re-evaluate if the fetched student has a free course
                updateUIForStep(currentFormStep);
            }


            if (navigator.cookieEnabled === false) {
                $('#support-cookies').removeClass('d-none');
            }

            updateUIForStep(0);
        });
    </script>
</body>

</html>
