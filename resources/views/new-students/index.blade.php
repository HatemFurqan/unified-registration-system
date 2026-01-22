    <!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Furqan Group - New Students</title>
        <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
        <!-- Animate.css (Optional, from new file) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

        <!-- Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

        <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Aref+Ruqaa:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400..700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


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

            .uppercase {
                text-transform: uppercase;
            }

            /* --- New Header Styles --- */
            .site-header {
                background: linear-gradient(to right,
                        var(--primary),
                        rgba(37, 64, 143, 0.9));
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
                /* Styling for dropdown */
                min-width: auto;
            }

            .site-header .dropdown-item.active,
            .site-header .dropdown-item:active {
                background-color: var(--primary);
            }


            /* --- New Card Styles --- */
            .custom-card {
                border: none;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                    0 2px 4px -1px rgba(0, 0, 0, 0.06);
                border-radius: 0.75rem;
                overflow: hidden;
                background-color: white;
                position: sticky;
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

            .card-header-gradient-amber {
                background: linear-gradient(to right, #fef3c7, #ffedd5);
                border-bottom: 1px solid #fde68a;
            }

            .card-header-gradient-red {
                background: linear-gradient(to right, #fee2e2, #ffe4e6);
                border-bottom: 1px solid #fecaca;
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

            .amber-circle {
                background-color: #fef3c7;
            }

            .red-circle {
                background-color: #fee2e2;
            }

            /* --- New Main Banner  --- */
            .main-banner {
                background: linear-gradient(to right, var(--primary), var(--primary-dark));
                border-bottom: 1px solid #dbeafe;
                border-radius: 0.75rem 0.75rem 0 0;
                padding: 2.5rem;
                text-align: center;
                color: white;

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
            @media (min-width: 600px) {
                #payment-form {
                    margin: 0 auto;
                    width: 50%;
                    border: 1px solid #ccc;
                    padding: 8px 16px;
                    border-radius: 5px;
                }
            }
            /* --- New Stepper Styles --- */
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
                transition: all 0.3s;
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
                transition: all 0.3s;
                color: #6b7280;
                /* Default color */
            }

            .stepper-label.active {
                color: var(--primary);
            }

            .stepper-label.completed {
                color: var(--green);
            }

            /* .stepper-label.inactive { color: #9ca3af; } */

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


            /* --- FAQ Panel Styles --- */
            #faqPanelContainerMobile {
                /* width: 80%; */
                margin: 0 auto 5rem auto;
            }
            .faq-panel {
                background-color: white;
                border-radius: 0.75rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                    0 2px 4px -1px rgba(0, 0, 0, 0.06);
                border: 1px solid #f3f4f6;
                display: flex;
                flex-direction: column;
                margin-bottom: 1.5rem;
                transition: transform 0.3s, opacity 0.3s;
            }
            .isSticky {

                position: sticky;
                top: 20px;
            }

            .faq-panel.hidden-mobile {
                /* Class for mobile toggle */
                transform: translateX(-100%);
                opacity: 0;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 1050;
            }

            .attention-border {
            border-radius: 10px;
            background-color: white;
            z-index: 1;
            animation: gentle-attention 2s ease-out forwards;
            }

            @keyframes gentle-attention {
            0% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
                border: 4px solid transparent;
            }
            25% {
                box-shadow: 0 0 20px 0 rgba(59, 130, 246, 0.15);
                border: 4px solid rgba(59, 130, 246, 0.3);
            }
            50% {
                box-shadow: 0 0 30px 0 rgba(59, 130, 246, 0.2);
                border: 4px solid rgba(59, 130, 246, 0.4);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
                border: 4px solid transparent;
            }
            }
            @media (min-width: 992px) {

                /* lg and up */
                .faq-panel.hidden-mobile {
                    transform: none;
                    opacity: 1;
                    position: static;
                    width: auto;
                    height: 100%;
                }
            }

            .faq-header {
                padding: 1rem;
                border-bottom: 1px solid #f3f4f6;
            }

            .faq-body {
                padding: 1rem;
                overflow-y: auto;
                flex-grow: 1;
                max-height: calc(100vh - 280px);
            }

            .faq-footer {
                padding: 1rem;
                border-top: 1px solid #f3f4f6;
                background-color: #f9fafb;
            }

            .faq-item {
                border: 1px solid #f3f4f6;
                border-radius: 0.5rem;
                margin-bottom: 0.75rem;
                overflow: hidden;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            }

            .faq-question {
                padding: 1rem;
                font-weight: 500;
                cursor: pointer;
                display: flex;
                justify-content: space-between;
                align-items: center;
                transition: background-color 0.3s;
            }

            .faq-question:hover {
                background-color: #f9fafb;
            }

            .faq-answer {
                padding: 0 1rem 1rem 1rem;
                background-color: #f9fafb;
                display: none;
                text-align: justify;
            }

            .faq-answer.show {
                display: block;
            }

            .faq-toggle-btn {
                /* For mobile */
                position: fixed;
                bottom: 1.5rem;
                z-index: 1040;
                width: 3.5rem;
                height: 3.5rem;
                border-radius: 50%;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                    0 2px 4px -1px rgba(0, 0, 0, 0.06);
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: var(--primary);
                color: white;
                border: none;
            }

            html[dir="ltr"] .faq-toggle-btn {
                left: 1.5rem;
            }

            html[dir="rtl"] .faq-toggle-btn {
                right: 1.5rem;
            }

/* --- Session Selection Cards with Time-of-Day Themes --- */
.session-card {
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    border: 2px solid transparent;
    border-radius: 1rem;
    background-color: white;
    position: relative;
    overflow: hidden;
}

.session-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0.5;
    transition: opacity 0.5s ease;
    z-index: 0;
}

.session-card:hover::before {
    opacity: 0.5
}

.session-card.selected::before {
    opacity: 0.4;
}

.session-card .card-body {
    padding: 1.5rem;
    position: relative;
    z-index: 1;
}

/* Morning Session - Sunrise (09:00 am - 12:00 pm) */
.session-card[data-session="morning"]::before,
.session-card input[value*="morning" i] ~ .card-body::before,
.session-card:has(input[value*="09:00" i])::before {
    background: linear-gradient(135deg, #ffee35ff 0%, #FF8E53 25%, #87CEEB 50%, #FFBE9D 75%, #FFD4B8 100%);
}

.session-card[data-session="morning"]::after,
.session-card:has(input[value*="09:00" i])::after {
    content: '🌔';
    position: absolute;
    font-size: 2.5rem;
    opacity: 0.95;
    top: 10px;
    left: 10px;
    z-index: 0;
}
/*
[dir="rtl"] .session-card[data-session="morning"]::after,
[dir="rtl"] .session-card:has(input[value*="09:00" i])::after {
    right: auto;
    left: 10px;
} */

/* Evening Session 1 - Midday (03:00 pm - 06:00 pm) */
.session-card[data-session="evening1"]::before,
.session-card:has(input[value*="03:00" i])::before {
    background: linear-gradient(135deg, #FFD4B8 0%, #87CEEB 30%, #4A9FD8 60%, #2E86C1 100%);
}
[dir="rtl"] .session-card[data-session="evening1"]::before,
[dir="rtl"] .session-card:has(input[value*="03:00" i])::before {
    background: linear-gradient(315deg, #FFD4B8 0%, #87CEEB 30%, #4A9FD8 60%, #2E86C1 100%);
}

.session-card[data-session="evening1"]::after,
.session-card:has(input[value*="03:00" i])::after {
    content: '🌕';
    position: absolute;
    font-size: 2.5rem;
    opacity: 0.75;
    top: 10px;
    left: 10px;
    z-index: 0;
}
/*
[dir="rtl"] .session-card[data-session="evening1"]::after,
[dir="rtl"] .session-card:has(input[value*="03:00" i])::after {
    right: auto;
    left: 10px;
} */

/* Evening Session 2 - Sunset (07:00 pm - 10:00 pm) */
.session-card[data-session="evening2"]::before,
.session-card:has(input[value*="07:00" i])::before {
    background: linear-gradient(135deg, #2E86C1 0%, #D4417D 30%, #E85A71 50%, #F77E6F 70%, #FF9A76 100%);
}
[dir="rtl"] .session-card[data-session="evening2"]::before,
[dir="rtl"] .session-card:has(input[value*="07:00" i])::before {
    background: linear-gradient(315deg, #2E86C1 0%, #D4417D 30%, #E85A71 50%, #F77E6F 70%, #FF9A76 100%);
}

.session-card[data-session="evening2"]::after,
.session-card:has(input[value*="07:00" i])::after {
    content: '🌘';
    position: absolute;
    font-size: 2.5rem;
    opacity: 0.95;
    top: 10px;
    left: 10px;
    z-index: 0;
}

/* [dir="rtl"] .session-card[data-session="evening2"]::after,
[dir="rtl"] .session-card:has(input[value*="07:00" i])::after {
    right: auto;
    left: 10px;
} */

/* Evening Session 3 - Late Night (11:00 pm - 02:00 am) */
.session-card[data-session="evening3"]::before,
.session-card:has(input[value*="11:00" i])::before {
    background: linear-gradient(135deg, #C85A54 0%, #7B2D6F 25%, #4A1B5C 50%, #2D1B3D 75%, #1a0f28 100%);
}
[dir="rtl"] .session-card[data-session="evening3"]::before,
[dir="rtl"] .session-card:has(input[value*="11:00" i])::before {
    /* background: linear-gradient(315deg, #C85A54 0%, #7B2D6F 25%, #4A1B5C 50%, #2D1B3D 75%, #1a0f28 100%); */
    background: #1c0c50ff;
}

.session-card[data-session="evening3"]::after,
.session-card:has(input[value*="11:00" i])::after {
    content: '🌙';
    position: absolute;
    font-size: 2.5rem;
    opacity: 0.95;
    top: 10px;
    right: 10px;
    z-index: 0;

}


[dir="rtl"] .session-card[data-session="evening3"]::after,
[dir="rtl"] .session-card:has(input[value*="11:00" i])::after {
    right: auto;
    left: 10px;

}

/* Evening Session 4 - Deep Night/Early Morning (02:00 am - 05:00 am) */
.session-card[data-session="evening4"]::before,
.session-card:has(input[value*="05:00" i])::before {
    background: linear-gradient(135deg, #1a0f28 0%, #0d0618 20%, #050309 40%, #020104 60%, #0a0614 80%, #1f1633 100%);
}
[dir="rtl"] .session-card[data-session="evening4"]::before,
[dir="rtl"] .session-card:has(input[value*="05:00" i])::before {
    /* background: linear-gradient(315deg, #1a0f28 0%, #0d0618 20%, #050309 40%, #020104 60%, #0a0614 80%, #1f1633 100%); */
    background: #090016ff;
}

.session-card[data-session="evening4"]::after,
.session-card:has(input[value*="05:00" i])::after {
    content: '🌒';
    position: absolute;
    font-size: 2.5rem;
    opacity: 0.95;
    top: 10px;
    left: 10px;
    z-index: 0;
}
.local-time-display {
        display: none;
    }
    .local-time-wrapper {
    border-top: 1px solid rgba(0, 0, 0, 0.28);
    padding-top: 0.2rem;
    margin-bottom: -0.5rem;
}
.local-time-text {
    color: #0d215c;
    min-height: 1.2em;
    font-size: 16px;
    margin:0;
}
.local-time-text-under {
    color: #4a2b04ff;
    min-height: 1.2em;
    font-size: 16px;
}
.local-time-text::before {
    content: '{{ __("Your Local Time:") }} ';
    font-weight: bold;
    color: #663c04ff;
    padding-right: 0.3rem;
}
[dir="rtl"] .local-time-text::before {
    content: '{{ __(":توقيتكم المحلي") }} ';
    font-weight: bold;
    color: #663c04ff;
    padding-left: 0.3rem;
    font-family: "Noto Naskh Arabic", sans-serif;
}

.session-card[data-session="evening4"]:hover .local-time-text::before,
.session-card:has(input[value*="05:00" i]):hover .local-time-text::before {
    color: #e6ecf8ff;
}
.session-card[data-session="evening3"]:hover .local-time-text::before,
.session-card:has(input[value*="11:00" i]):hover .local-time-text::before {
    color: #e6ecf8ff;

}
.session-card[data-session="evening4"]:hover .local-time-text-under,
.session-card:has(input[value*="05:00" i]):hover .local-time-text-under {
    color: #fbde76ff;
}
.session-card[data-session="evening3"]:hover .local-time-text-under,
.session-card:has(input[value*="11:00" i]):hover .local-time-text-under {
    color: #fbde76ff;

}


/* White text for Evening 4 (dark background) - only when selected */
.session-card[data-session="evening4"]:hover .card-title,
.session-card:has(input[value*="05:00" i]):hover .card-title {
    color: #ecc434ff;
}
.session-card:hover .card-title,  .session-card:hover .local-time-text-under{
    color: #b75b04ff;
}
.session-card:hover .card-macca, .session-card:hover .card-text, .session-card:hover .local-time-text::before {
    color: #000;
}

.session-card[data-session="evening4"]:hover .card-text,
.session-card:has(input[value*="05:00" i]):hover .card-text {
    color: #e5e7eb;
}

/* White text for Evening 3 (dark background) - only when hovering over card */
.session-card[data-session="evening3"]:hover .card-title,
.session-card:has(input[value*="11:00" i]):hover .card-title {
    color: #f2c522ff;
}

.session-card[data-session="evening3"]:hover .card-text, .session-card[data-session="evening3"]:hover .card-macca,
.session-card:has(input[value*="11:00" i]):hover .card-text, .session-card:has(input[value*="11:00" i]):hover .card-macca {
    color: #e5e7eb;
}
/* White text for Evening 4 (dark background) - only when hovering over card */
.session-card[data-session="evening4"]:hover .card-title,
.session-card:has(input[value*="05:00" i]):hover .card-title {
    color: #ecc434ff;
}

.session-card[data-session="evening4"]:hover .card-text, .session-card[data-session="evening4"]:hover .card-macca,
.session-card:has(input[value*="05:00" i]):hover .card-text, .session-card:has(input[value*="05:00" i]):hover .card-macca {
    color: #e5e7eb;
}

/* Hover and Selected States */
.session-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    border-color: var(--primary);
}

.session-card.selected {
    border-color: var(--primary);
    box-shadow: 0 8px 24px rgba(37, 64, 143, 0.25);
    transform: translateY(-2px);
}

.session-card.selected .btn-outline-primary {
    background-color: var(--primary);
    color: white;
    border-color: var(--primary);
}

.session-card input[type="radio"] {
    display: none;
}
.card-macca {
    color: #663c04ff;
    font-size: 16px;
    font-weight: 600;
    position: relative;
    z-index: 2;
    text-align: center;
    font-family: "Aref Ruqaa", sans-serif;
}
.point-up {
    font-size: 18px;

}

.session-card .card-title {
    color: var(--primary);
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 0.5rem;
    position: relative;
    font-family: "Aref Ruqaa", sans-serif;
    z-index: 2;
}
[dir="ltr"] .session-card .card-title {
    font-family: "Cairo", sans-serif;
    font-size: 18px;
}
.session-card .card-text {
    color: #4a2b04ff;
    font-size: 16px;
    font-weight: 600;
    position: relative;
    z-index: 2;
}

.session-card .btn-outline-primary {
    position: relative;
    z-index: 2;
    transition: all 0.2s ease;
}
.session-card .btn-outline-primary:hover {
    background-color: #F68B32;
    transform: scale(1.1);
    opacity: 0.8;
}

.session-card.is-invalid {
    border: 2px solid #dc3545;
    animation: shake 0.3s;
}

.session-card.is-valid {
    border: 2px solid #28a745;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}



            #studentTypeTabs {
                display: none;
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

            .btn-outline-primary {
                color: var(--primary);
                border-color: var(--primary);
            }

            .btn-outline-primary:hover {
                background-color: var(--primary-light);
                color: var(--primary);
            }

            .btn-success {
                background-color: var(--green) !important;
                border-color: var(--green) !important;
            }

            .btn-success:hover {
                background-color: #15803d !important;
                /* Darker green */
                border-color: #15803d !important;
            }

            .btn-rounded {
                /* From new file */
                border-radius: 9999px;
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }

            /* Original action button styles, adapted for new theme */
            .action-button {
                /* Next button */
                background: var(--primary);
                font-weight: bold;
                color: white;
                border: 0 none;
                border-radius: 0.375rem;
                /* Consistent rounding */
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
                /* Previous button */
                background: var(--secondary-original);
                /* Bootstrap secondary like original */
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
                /* Darker secondary */
            }

            /* Animation Classes */
            .fade-in {
                animation: fadeIn 0.5s;
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

            /* --- Checkout.com Card Frame Placeholder --- */
            .checkout-card-frame {
                border: 1px solid #ced4da;
                border-radius: 0.25rem;
                padding: 0.75rem;
                min-height: 40px;
                /* from original */
                background-color: #fff;
            }

            .checkout-card-frame.frame--focus {
                border-color: var(--primary) !important;
                /* Use new primary color */
                box-shadow: 0 0 0 0.25rem rgba(37, 64, 143, 0.25) !important;
            }

            .checkout-card-frame.frame--invalid {
                border-color: var(--red) !important;
                /* Use new red color */
            }

            #virtual-office-link {
                text-overflow: ellipsis;
                width: 100%;
                overflow: hidden;
            }
            /* --- Original Checkout Frame Styles (ensure these are specific enough) --- */
            #payment-form {
                margin: 0 auto;
            }

            #payment-form iframe {
                width: 100%;
            }

            #payment-form .card-frame {
                /* This is the crucial CKO frame */
                border: solid 1px #13395E;
                /* Original CKO style */
                border-radius: 3px;
                margin: 0 auto;
                height: 40px;
                box-shadow: 0 1px 3px 0 rgba(19, 57, 94, 0.2);
            }

            #payment-form .card-frame.frame--rendered {
                opacity: 1;
            }

            #payment-form .card-frame.frame--rendered.frame--focus {
                border: solid 1px #13395E;
                box-shadow: 0 2px 5px 0 rgba(19, 57, 94, 0.15);
            }

            #payment-form .card-frame.frame--rendered.frame--invalid {
                border: solid 1px #D96830;
                box-shadow: 0 2px 5px 0 rgba(217, 104, 48, 0.15);
            }
            #google-pay-button-container {
                margin: 0 auto;
                /* Center the button */

            }
            #google-pay-button div button {
                width: 100% !important;
                min-width: auto;
            }
            #payButtonDiv, #CardFTitle{
                width: 100%;
                margin: 0 auto;
            }
            #OrSpan{
                width: 100%;
                margin: 5px auto;
                text-align: center !important;
            }
            #OrSpan span {
                font-weight: bold;
                color: #13395E;
                font-size: 1.2rem;
                text-transform: uppercase;
            }
            #payment-form #pay-button {
                border: none;
                border-radius: 3px;
                min-height: 40px;
                width: 100%;
                /* Make it full width */
                background-color: #13395E;
                /* Original CKO style */
                box-shadow: 0 1px 3px 0 rgba(19, 57, 94, 0.4);
                font-family: 'Cairo', sans-serif;
                font-weight: bold;
                color: #fc0;
            }
            #CouponParent {
                margin: 0 auto;
            }
            .coupon-form {
                width: 100%;
                border: 1px solid #ccc;
                padding: 8px 16px;
                margin: 0 0 16px;
                border-radius: 8px;
                background: #f9f9f9;
            }

            .coupon-form input {
                text-align: center;
            }

            .coupon-form button {
                width: 100% !important;
                margin: 8px 0;
                font-family: 'Cairo';
            }

            #apply_coupon_btn {
                background-color: var(--primary) !important;
                border-color: var(--primary) !important;
                color: white !important;
            }

            #apply_coupon_btn:hover {
                background-color: var(--primary-dark) !important;
            }

            #pay-button-full-free {
                /* Style the free checkout button */
                background-color: var(--green) !important;
                border-color: var(--green) !important;
                color: white !important;
                font-weight: bold;
                width: 100%;
                padding: 10px 20px;
                border-radius: 0.375rem;
            }


            /* --- RTL support --- */
            html[dir="rtl"] .text-end {
                text-align: right !important;
            }

            html[dir="rtl"] .checkout-terms-box {
                display: flex;
                flex-direction: row;
                gap: 30px;
                align-items: center;
            }

            html[dir="rtl"] .float-right {
                float: right !important;
                margin-right: -1.5em;
            }

            html[dir="rtl"] .text-start {
                text-align: left !important;
            }

            html[dir="rtl"] .ms-auto {
                margin-right: auto !important;
                margin-left: 0 !important;
            }

            html[dir="rtl"] .me-auto {
                margin-left: auto !important;
                margin-right: 0 !important;
            }

            html[dir="rtl"] .me-1 {
                margin-left: 0.25rem !important;
                margin-right: 0 !important;
            }

            html[dir="rtl"] .me-2 {
                margin-left: 0.5rem !important;
                margin-right: 0 !important;
            }

            html[dir="rtl"] .me-3 {
                margin-left: 1rem !important;
                margin-right: 0 !important;
            }

            html[dir="rtl"] .ms-1 {
                margin-right: 0.25rem !important;
                margin-left: 0 !important;
            }

            html[dir="rtl"] .ms-2 {
                margin-right: 0.5rem !important;
                margin-left: 0 !important;
            }

            html[dir="rtl"] .ms-3 {
                margin-right: 1rem !important;
                margin-left: 0 !important;
            }

            html[dir="rtl"] .ps-4 {
                padding-right: 1.5rem !important;
                padding-left: 0 !important;
            }

            /* For FAQ search icon */
            html[dir="rtl"] .faq-question i {
                transform: scaleX(-1);
            }

            /* Flip chevron */
            html[dir="rtl"] .action-button i.fa-arrow-right,


            html[dir="rtl"] .action-button i.fa-arrow-left,


            html[dir="ltr"] .action-button i.fa-arrow-left,


            html[dir="ltr"] .action-button i.fa-arrow-right{}



            /* Responsive adjustments for FAQ Panel based on new file */
            @media (max-width: 991.98px) {

                /* Up to md */
                #faqPanelContainerMobile {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 90%;
                    /* Not full width, allow closing */
                    max-width: 400px;
                    height: 100%;
                    z-index: 1050;
                    /* Above backdrop */
                    transform: translateX(-100%);
                    transition: transform 0.3s ease-in-out;
                    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
                }

                #faqPanelContainerMobile.show {
                    transform: translateX(0);
                }

                .faq-panel-backdrop {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    z-index: 1045;
                    /* Below panel, above content */
                    display: none;
                    /* Hidden by default */
                }

                .faq-panel-backdrop.show {
                    display: block;
                }

                .faq-panel {
                    border-radius: 0;
                }

                /* Full height, no radius */
                #mainFormContainer {
                    width: 100%;
                }

            }

            .select2.select2-container {
                width: 100% !important;
                display: block !important;
            }

            .select2-selection--single {
                height: calc(1.5em + 0.75rem + 2px) !important;
                padding: .375rem .75rem;
                border-radius: .375rem;
                border: 1px solid #ced4da;
            }

            /* Match BS5 input */
            .select2-selection__arrow {
                height: calc(1.5em + 0.75rem + 2px) !important;
            }

            .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
                line-height: 1.5em;
            }

            #times li {
                font-weight: bold !important;
            }

            /* Check if still needed */

            /* For the image that was #cover-bg */
            .page-cover-image {
                max-height: 96px;
                width: auto;
                background-position: center;
                background-repeat: no-repeat;
                background-size: contain;
            }

            .page-title-section {
                background-color: #e9ecef;
                /* Light grey background */
            }

            .page-title-section h1 {
                color: var(--primary);
                /* Use primary color for title */
            }

            /* Alerts */
            .alert-danger {
                background-color: #f8d7da;
                border-color: #f5c6cb;
                color: #721c24;
            }

            .alert-warning {
                background-color: #fff3cd;
                border-color: #ffeeba;
                color: #856404;
            }

            .label-right {
                /* If you still need explicit right alignment for some labels */
                display: block;
                width: 100%;
                text-align: {{app()->getLocale()=='ar' ? 'right': 'left'}};
            }

            html[dir="rtl"] .label-right {
                text-align: right;
            }
            html[dir="rtl"] .input-group>:not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
        margin-left: calc(var(--bs-border-width)* -1);
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-top-left-radius: 0.375rem;
        border-bottom-left-radius: 0.375rem;
    }
            html[dir="rlt"] .input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n+3), .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-control, .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-select, .input-group:not(.has-validation)>:not(:last-child):not(.dropdown-toggle):not(.dropdown-menu):not(.form-floating) {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        border-top-right-radius: 0.375rem;
        border-bottom-right-radius: 0.375rem;
    }

            html[dir="ltr"] .label-right {
                text-align: left;
            }

            /* Error messages for validation */
            .error-msg-alert {
                /* Custom class for validation error messages */
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
                /* Remove browser default red shadow */
            }
        </style>

        <link rel="stylesheet" href="{{ asset('css/custom.css') }}?v=5.2"> <!-- Your custom overrides -->

        <!-- Google Tag Manager -->
        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l !== 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-P79LV4M');
        </script>
        <!-- End Google Tag Manager -->

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-N7F13ZWW74"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'G-N7F13ZWW74');
        </script>
    </head>

    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P79LV4M"
                height="0" width="0" style="display:none;visibility:hidden" title="Google Tag Manager"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        <!-- New Header -->
        <header class="site-header shadow-sm">
            <div class="container d-flex justify-content-between align-items-center py-3 px-md-3">
                <a class="navbar-brand" href="https://eservices.fg2020.com/" target="_blank">
                    <img src="https://eservices.fg2020.com/assets/images/nlogo.png" alt="Furqan Group Logo" />
                </a>
<span id="local-time-display" class="local-time-badge"></span>
                <div class="d-flex align-items-center gap-2 gap-md-3">
                    <a href="https://furqangroup.zoom.us/j/99947595293" target="_blank" rel="noopener noreferrer" class="virtual-office-btn d-flex align-items-center gap-1 px-3 py-2 btn text-decoration-none">
                        <i class="fas fa-video"></i>
                        <span class="d-none d-sm-inline">{{ __('Virtual Office') }}</span>
                    </a>

                    <div class="dropdown">
                        <button class="btn btn-link text-decoration-none dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-globe me-1"></i>
                            <span>{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @php $isActive = (app()->getLocale() == $localeCode); @endphp
                            <li>
                                <a class="dropdown-item   @if($isActive) active @endif"
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
                        <button class="nav-link policy-btn" data-bs-toggle="modal" data-bs-target="#policyModal" data-policytype="terms">{{ __('Terms And Conditions') }}</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link policy-btn" data-bs-toggle="modal" data-bs-target="#policyModal" data-policytype="refund">{{ __('Refund Policy') }}</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link policy-btn" data-bs-toggle="modal" data-bs-target="#policyModal" data-policytype="privacy">{{ __('Privacy Policy') }}</button>
                    </li>
                </ul>
            </nav>
        </header>

        <!-- Hero Section -->
        <section class="py-4 text-center page-title-section">
            <div class="container">
                <img
                    src="https://furqanshop.com/new-students/images/logo.jpg"
                    alt="Furqan Group Cover"
                    class="mb-3 page-cover-image" />
                <h1 class="h2 fw-bold">
                    {{ __('Page Title') }}
                </h1>
                <p class="lead text-muted">
                    <span class="fw-bold">{!! __('Registration for the second semester') !!}</span>
                </p>
            </div>
        </section>

        @include('partials.errors')
        <div class="alert alert-danger d-none my-3 container" id="support-cookies" style="text-align: center;font-weight: bold;">{!! __('Support Cookies') !!}</div>


        <!-- Main Content -->
        <div class="container py-4">
            <div class="row g-4">
                <!-- FAQ Panel - Left Side -->
                <div class="col-lg-4 d-none d-lg-block" id="faqPanelContainerDesktop">

                <div id="stickyDiv" class="isSticky">
                    <div class="faq-panel" id="faqPanel">
                        <div class="faq-header">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide text-primary lucide-circle-help-icon lucide-circle-help">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                                        <path d="M12 17h.01" />
                                    </svg>
                                    <h5 class="mb-0 fw-bold">{{ __('FAQ & Help') }}</h5>
                                </div>
                                <!-- Close button for mobile, handled by JS for the mobile container -->
                            </div>
                            <div class="position-relative mb-3 d-none">
                                <i class="fas fa-search position-absolute top-50 {{ app()->getLocale() == 'ar' ? 'end-0 ms-3' : 'start-0 ms-3' }} translate-middle-y text-muted"></i>
                                <input type="text" id="faqSearch" class="form-control {{ app()->getLocale() == 'ar' ? 'ps-3 pe-5' : 'pe-3 ps-5' }} rounded-pill" placeholder="{{ __('Search FAQs...') }}" />
                                <button class="btn-close position-absolute top-50 {{ app()->getLocale() == 'ar' ? 'start-0 me-3 ' : 'end-0 me-3' }} translate-middle-y d-none" id="clearSearchBtn" aria-label="Clear search"></button>
                            </div>
                            <ul class="nav nav-pills nav-fill {{ app()->getLocale() == 'ar' ? ' p-0' : ' me-auto' }}" id="faqTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="faq-step1-tab" data-bs-toggle="pill" data-bs-target="#faq-step1-content" type="button" role="tab" aria-controls="faq-step1-content" aria-selected="true">{{ __('Step 1') }}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="faq-step2-tab" data-bs-toggle="pill" data-bs-target="#faq-step2-content" type="button" role="tab" aria-controls="faq-step2-content" aria-selected="false">{{ __('Step 2') }}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="faq-step3-tab" data-bs-toggle="pill" data-bs-target="#faq-step3-content" type="button" role="tab" aria-controls="faq-step3-content" aria-selected="false">{{ __('Step 3') }}</button>
                                </li>
                            </ul>
                        </div>
                        <div class="faq-body">
                            <div class="tab-content" id="faqTabContent">
                                <!-- Step 1 FAQs -->
                                <div class="tab-pane fade show active" id="faq-step1-content" role="tabpanel" aria-labelledby="faq-step1-tab">
                                    <div class="faq-item">
                                        <div class="faq-question"  onclick="toggleFaqAnswer(this)">
                                        1. {{ __('Why Al-Furqan Group?') }} <i class="fas fa-chevron-down"></i>
                                        </div>
                                        <div class="faq-answer">{!! __('Why Al-Furqan Group text') !!}</div>
                                    </div>
                                    <div class="faq-item">
                                        <div class="faq-question" onclick="toggleFaqAnswer(this)">
                                        2. {{ __('What is quality assurance?') }} <i class="fas fa-chevron-down"></i>
                                        </div>
                                        <div class="faq-answer">{!! __('What is quality assurance text') !!}</div>
                                    </div>
                                    <div class="faq-item">
                                        <div class="faq-question" onclick="toggleFaqAnswer(this)">
                                        3. {{ __('What educational paths are available?') }} <i class="fas fa-chevron-down"></i>
                                        </div>
                                        <div class="faq-answer">{!! __('What educational paths are available text') !!}</div>
                                    </div>
                                </div>
                                <!-- Step 2 FAQs -->
                                <div class="tab-pane fade" id="faq-step2-content" role="tabpanel" aria-labelledby="faq-step2-tab">
                                    <div class="faq-item">
                                        <div class="faq-question" onclick="toggleFaqAnswer(this)">
                                        1.  {{ __('How do I choose the right path for me or my child?') }} <i class="fas fa-chevron-down"></i>
                                        </div>
                                        <div class="faq-answer">{!! __('How do I choose the right path for me or my child text') !!}</div>
                                    </div>
                                    <div class="faq-item">
                                        <div class="faq-question" onclick="toggleFaqAnswer(this)">
                                        2.  {{ __('What categories and ages can register?') }} <i class="fas fa-chevron-down"></i>
                                        </div>
                                        <div class="faq-answer">{!! __('What categories and ages can register text') !!}</div>
                                    </div>
                                    <div class="faq-item">
                                        <div class="faq-question" onclick="toggleFaqAnswer(this)">
                                        3.  {{ __('What are the school times and days?') }} <i class="fas fa-chevron-down"></i>
                                        </div>
                                        <div class="faq-answer">{!! __('What are the school times and days text') !!}</div>
                                    </div>
                                </div>
                                <!-- Step 3 FAQs -->
                                <div class="tab-pane fade" id="faq-step3-content" role="tabpanel" aria-labelledby="faq-step3-tab">
                                    <div class="faq-item">
                                        <div class="faq-question" onclick="toggleFaqAnswer(this)">
                                        1.  {{ __('What are the tuition fees?') }} <i class="fas fa-chevron-down"></i>
                                        </div>
                                        <div class="faq-answer">{!! __('What are the tuition fees text') !!}</div>
                                    </div>
                                    <div class="faq-item">
                                        <div class="faq-question" onclick="toggleFaqAnswer(this)">
                                        2.  {{ __('What is the registration method? When will the student start studying?') }} <i class="fas fa-chevron-down"></i>
                                        </div>
                                        <div class="faq-answer">{!! __('What is the registration method? When will the student start studying text') !!}</div>
                                    </div>
                                    <div class="faq-item">
                                        <div class="faq-question"  onclick="toggleFaqAnswer(this)">
                                        3.  {{ __('I need more details, how do I contact you?') }} <i class="fas fa-chevron-down"></i>
                                        </div>
                                        <div class="faq-answer">{!! __('I need more details, how do I contact you text') !!}</div>
                                    </div>
                                </div>
                                <div id="searchResultsContainer" class="d-none">
                                    <!-- Search results will be populated here by JS -->
                                </div>
                            </div>
                        </div>
                        <div class="faq-footer">
                            <div class="d-flex align-items-center gap-2 text-primary">
                                <i class="fas fa-comment-dots"></i>
                                <p class="mb-0 small fw-medium">{{ __('Need more help?') }}</p>
                            </div>
                            <a  href="https://furqangroup.zoom.us/j/99947595293" target="_blank" rel="noopener noreferrer" class="mt-2 small text-primary text-decoration-none d-flex align-items-center">
                                {{ __('Join our virtual office') }}
                                <i class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} ms-1 me-1"></i>
                            </a>
                        </div>
                    </div>
                    <div class="custom-card mb-4" id="registration_summary_card">
                                        <div class="card-header-gradient-blue p-3">
                                            <div class="d-flex align-items-center gap-2 gap-md-3">
                                                <div class="icon-circle blue-circle"><i class="fas fa-file-invoice-dollar text-primary"></i></div>
                                                <h4 class="mb-0 fs-5 fw-semibold text-dark">{{ __('Registration Summary & Terms') }}</h4>
                                            </div>
                                        </div>
                                        <div class="card-body p-3 p-md-4">
                                            <div class="bg-light p-3 rounded border mb-4" style=" margin-bottom: 168px !important; ">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span class="text-muted">{{__('Tuition Fee:')}}</span>
                                                    <span class="fw-medium">${{$course->price}}.00</span>
                                                </div>
                                                <div id="discount_summary_row" class="d-none">
                                                    <div class="d-flex justify-content-between text-success">
                                                        <span>{{__('Discount:')}}</span>
                                                        <span id="discount_amount_summary" class="badge bg-success">-$0.00</span>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="d-flex justify-content-between fw-bold fs-5">
                                                    <span>{{__('Total:')}}</span>
                                                    <span id="total_price_summary">${{$course->price}}.00</span>
                                                </div>
                                            </div>



                                            <div class="border-top border-bottom py-3 d-none my-3">
                                                <p class="text-danger fw-semibold text-center mb-0 small">
                                                    {!! __('Payment Bag Note') !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                </div>
                </div>

                <!-- Main Form - Right Side -->
                <div class="col-lg-8" id="mainFormContainer">
                    <div class="main-banner">
                        <h4>{{ __('Registration for the second semester') }}</h4>
                    </div>
                    <div class="stepper-main-container">
                        <!-- New Stepper -->
                        <div class="stepper-container">
                            <div class="d-flex justify-content-between" id="stepper">
                                <div class="stepper-item" data-step="1">
                                    <div class="stepper-circle active">1</div>
                                    <div class="stepper-label active">{{ __('resubscribe.Information and notes') }}</div>
                                </div>
                                <div class="stepper-item" data-step="2">
                                    <div class="stepper-circle inactive">2</div>
                                    <div class="stepper-label inactive">{{ __('resubscribe.Register') }}</div>
                                </div>
                                <div class="stepper-item" data-step="3">
                                    <div class="stepper-circle inactive">3</div>
                                    <div class="stepper-label inactive">{{ __('resubscribe.Payment and termination') }}</div>
                                </div>
                            </div>
                            <div class="stepper-progress mt-3">
                                <div class="stepper-progress-bar" id="stepperProgressBar" style="width: 0;"></div>
                            </div>
                        </div>

                        <!-- Form Content -->
                        <div class="p-3 p-md-4">
                            <form id="msform" action="{{ route('registration.new-students.resubscribe') }}?branch=all" method="POST" enctype="multipart/form-data">
                                @csrf
                                <!-- Step 1: Information -->
                                <div class="form-step active" id="step1Content">
                                    <div class="fs-title mb-4">{{ __('resubscribe.General information') }}</div>

                                    <div class="custom-card mb-4">
                                        <div class="card-header-gradient-blue p-3">
                                            <div class="d-flex align-items-center gap-2 gap-md-3">
                                                <div class="icon-circle blue-circle"><i class="fas fa-info-circle text-primary"></i></div>
                                                <h4 class="mb-0 fs-5 fw-semibold text-dark">{{ __('Program Details') }}</h4>
                                            </div>
                                        </div>
                                        <div class="card-body p-3 p-md-4">
                                            <p class="text-center">
                                                <span class="fw-bold">{!! __('Enroll now in this semester for') !!} {{ $course->price . '$' }} {!! __('a one-time fee of $50 for course materials') !!}</span>
                                                <br>
                                                <span class="fw-bold">{!! __('Please note that the current semester ends on') !!}</span>
                                            </p>
                                            <div class="alert alert-warning mt-3">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-2"><i class="fas fa-exclamation-triangle"></i></div>
                                                    <div>
                                                        <span class="fw-semibold">{{__('Important:')}}</span> {{__('Please review our Class System & Educational Approach.')}}
                                                        <div class="mt-2">
                                                            <a href="{{__('Pdf File')}}" target="_blank" class="btn btn-primary btn-sm">{{__('Download PDF Guide')}}</a>
                                                            <button type="button" class="btn d-none btn-outline-primary btn-sm ms-2 view-faq-btn"><i class="fas fa-question-circle me-1"></i> {{__('View FAQs')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="custom-card mb-4">
                                                    <div class="card-header-gradient-green p-3">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="icon-circle green-circle">
                                                        <i class="fas fa-clock text-success"></i>
                                                        </div>
                                                        <h4 class="mb-0 fs-5 fw-semibold text-dark">
                                                        {{ __('Virtual Office Hours') }}
                                                        </h4>
                                                    </div>
                                                    </div>
                                                    <div class="card-body p-4">
                                                    <p class="text-dark">
                                                    {{ __('CS Help') }}
                                                    </p>

                                                    <div class="bg-light p-3 rounded border">
                                                        <div class="d-flex align-items-center gap-2 mb-2">
                                                        <i class="fas fa-video text-primary"></i>
                                                        <p class="fw-medium text-primary mb-0">
                                                            {{ __('Virtual Office Link') }}
                                                        </p>
                                                        </div>
                                                        <a
                                                        href="https://furqangroup.zoom.us/j/99947595293"
                                                        target="_blank"
                                                        rel="noopener noreferrer" id="virtual-office-link"
                                                        class="text-primary d-block mb-3 bg-white p-2 rounded border text-decoration-none"
                                                        >
                                                        https://furqangroup.zoom.us/j/99947595293
                                                        </a>

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
                                    <div class="custom-card mb-4">
                                        <div class="card-header-gradient-red p-3">
                                            <div class="d-flex align-items-center gap-2 gap-md-3">
                                                <div class="icon-circle red-circle"><i class="fas fa-check-circle text-danger"></i></div>
                                                <h4 class="mb-0 fs-5 fw-semibold text-dark">{{ __('Acknowledgment') }}</h4>
                                            </div>
                                        </div>
                                        <div class="card-body p-3 p-md-4">
                                            <div id="signature-section" class="radio-card-group">
                                                <label class="form-label fw-medium text-danger">{{ __('Guardian Signature') }}:</label>
                                                <div class="form-check radio-card">
                                                    <input class="form-check-input {{app()->getLocale() == 'ar' ? 'float-right' : ''}}"
                                                           type="radio" name="signature" id="signature_ack" value="{{ __('Signature') }}" required>
                                                    <label class="form-check-label" for="signature_ack">
                                                        {{ __('Signature') }}
                                                    </label>
                                                </div>
                                                <div class="error-msg-alert"></div> <!-- For JS validation message -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 2: Registration -->
                                <div class="form-step" id="step2Content">
                                <div class="fs-title mb-4">{{ __('resubscribe.Register') }}</div>

                                    <div class="custom-card mb-4"> <!-- "Initial Information" card -->
                                        <div class="card-header-gradient-purple p-3">
                                            <div class="d-flex align-items-center gap-2 gap-md-3">
                                                <div class="icon-circle purple-circle"><i class="fas fa-user-edit text-purple"></i></div>
                                                <h4 class="mb-0 fs-5 fw-semibold text-dark">{{ __('Initial Information') }}</h4>
                                                <button type="button" class="btn btn-outline-primary btn-sm ms-auto view-faq-btn"><i class="fas fa-question-circle me-1"></i> {{__('Need Help?')}}</button>
                                            </div>
                                        </div>
                                        <div class="card-body p-3 p-md-4">
                                            <div class="mb-4 radio-card-group" id="study-before-section">
                                                <label class="form-label fw-medium">{{ __('study at the Center before') }}:</label>
                                                <div class="form-check radio-card">
                                                    <input class="form-check-input {{app()->getLocale() == 'ar' ? 'float-right' : ''}}" type="radio" name="study_before" id="study_yes" value="yes" required>
                                                    <label class="form-check-label" for="study_yes">{{ __('yes') }}</label>
                                                </div>
                                                <div class="form-check radio-card">
                                                    <input class="form-check-input {{app()->getLocale() == 'ar' ? 'float-right' : ''}}" type="radio" name="study_before" id="study_no" value="no" required>
                                                    <label class="form-check-label" for="study_no">{{ __('no') }}</label>
                                                </div>
                                                <div class="error-msg-alert"></div>
                                            </div>

                                            <div class="mb-4" id="favorite_times_section"> <!-- Wrapper for favorite_times -->
                                                 <p class="form-label fw-medium mb-3" id="schedule-heading">
    {{ __('Choose your preferred schedule') }} (<span class="fw-bold">GMT+3</span>)
    <span id="local-gmt-display" class="d-none small text-muted"></span>
</p>
                                                <div id="favorite_times"  class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3 ">
                                                    @php
                                                        $timeSlots = [
                                                            [
                                                                'name' => __('Morning Session'),
                                                                'time' => __('Morning Session Time'),
                                                                'value' => __('Morning Session') . ' | ' . __('Morning Session Time') . ' GMT+3',
                                                                'key' => 'morning'
                                                            ],
                                                            [
                                                                'name' => __('Evening Session 1'),
                                                                'time' => __('Evening Session 1 Time'),
                                                                'value' => __('Evening Session 1') . ' | ' . __('Evening Session 1 Time') . ' GMT+3',
                                                                'key' => 'evening1'
                                                            ],
                                                            [
                                                                'name' => __('Evening Session 2'),
                                                                'time' => __('Evening Session 2 Time'),
                                                                'value' => __('Evening Session 2') . ' | ' . __('Evening Session 2 Time') . ' GMT+3',
                                                                'key' => 'evening2'
                                                            ],
                                                            [
                                                                'name' => __('Evening Session 3'),
                                                                'time' => __('Evening Session 3 Time'),
                                                                'value' => __('Evening Session 3') . ' | ' . __('Evening Session 3 Time') . ' GMT+3',
                                                                'key' => 'evening3'
                                                            ],
                                                            [
                                                                'name' => __('Evening Session 4'),
                                                                'time' => __('Evening Session 4 Time'),
                                                                'value' => __('Evening Session 4') . ' | ' . __('Evening Session 4 Time') . ' GMT+3',
                                                                'key' => 'evening4'
                                                            ],
                                                        ];
                                                    @endphp
                                                   @foreach($timeSlots as $index => $slot)
<div class="col">
    <div class="card session-card h-100" data-session-key="{{ $slot['key'] }}">
        <div class="card-body text-center d-flex flex-column justify-content-center form-check">
            <h6 class="card-title">{{ $slot['name'] }}</h6>

            {{-- This is the primary Mecca time display (always visible) --}}
            <p dir="ltr" class="card-text uppercase small mb-0 p-0">{{ $slot['time'] }}</p>
            <p dir="ltr" class="card-macca small mb-3"><span class="fw-bold point-up">👆🏿</span> {{ __('Mecca Time') }}</p>

            {{-- This is the placeholder for local time, hidden by default --}}
            <div class="local-time-wrapper d-none">
                <p dir="ltr" class="local-time-text small fw-bold"></p>
                <p dir="ltr" class="local-time-text-under small fw-bold mb-3"></p>
            </div>

            <input type="radio" name="favorite_time" id="timeSlot{{$index}}" value="{{ $slot['value'] }}" required>
            <label for="timeSlot{{$index}}" class="btn btn-sm btn-outline-primary w-100 stretched-link mt-auto">
                {{ __('Select') }}
            </label>
        </div>
    </div>
</div>
@endforeach
                                                </div> <!-- Closes #favorite_times -->
                                                <div class="error-msg-alert w-100 mt-2"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Student Details Card (Tabs for New/Returning) -->
                                    <div class="custom-card mb-4">
                                        <div class="card-header-gradient-blue p-3">
                                            <div class="d-flex align-items-center gap-2 gap-md-3">
                                                <div class="icon-circle blue-circle"><i class="fas fa-id-card text-primary"></i></div>
                                                <h4 class="mb-0 fs-5 fw-semibold text-dark">{{ __('Student Details') }}</h4>
                                            </div>
                                        </div>
                                        <div class="card-body p-0"> <!-- No padding for tab container -->
                                            <ul class="nav nav-pills  nav-fill mb-0" id="studentTypeTabs" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="returning-student-tab" data-bs-toggle="tab" data-bs-target="#returningStudentContent" type="button" role="tab" aria-controls="returningStudentContent" aria-selected="false">{{__('Returning Student')}}</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="new-student-tab" data-bs-toggle="tab" data-bs-target="#newStudentContent" type="button" role="tab" aria-controls="newStudentContent" aria-selected="true">{{__('New Student')}}</button>
                                                </li>
                                            </ul>
                                            <div class="tab-content p-3 p-md-4">
                                                <!-- Returning Student Fields (Originally #study_before_student and parts of #already_studied) -->
                                                <div class="tab-pane fade" id="returningStudentContent" role="tabpanel" aria-labelledby="returning-student-tab">

                                                <div class="alert alert-warning mt-3">
                                                    <div class="d-flex gap-3">
                                                        <div class="flex-shrink-0 {{ app()->getLocale() == 'ar' ? 'ms-3' : 'me-3' }}">
                                                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                                                        </div>
                                                        <div>
    <h5 class="alert-heading fw-bold">{{ __('returning_students_title') }}</h5>
    <p>{{ __('returning_students_message') }}</p>
    <hr>
    <p class="mb-0">{{ __('button_prompt') }}</p>
    <div class="mt-3">
        <a href="https://furqanshop.com/eservices_checkout/" class="btn btn-primary">
            <i class="fas fa-arrow-circle-right {{ app()->getLocale() == 'ar' ? 'ms-2' : 'me-2' }}"></i>
            {{ __('button_text') }}
        </a>
    </div>
</div>
                                                </div>
                                            </div>
                                                </div>

                                                <!-- New Student Fields  -->
                                                <div class="tab-pane fade show active" id="newStudentContent" role="tabpanel" aria-labelledby="new-student-tab">
                                                    <div id="not_study_before_student_fields">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label for="birthdate" class="form-label">{{ __('Birthdate') }}</label>
                                                                <input type="text" class="form-control flatpickr-date" name="birthdate" value="{{ old('birthdate') }}" id="birthdate" placeholder="{{ __('Birthdate') }}">
                                                                <div class="alert alert-danger d-none mt-1 p-2" id="birthdate-alert" role="alert">{{ __('The student must be 5 years old or over to register.') }}</div>
                                                                <div class="error-msg-alert"></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="new_student_section" class="form-label">{{ __('gender') }}</label>
                                                                <select class="form-select" name="new_student_section" id="new_student_section">
                                                                    <option value="null" selected>{{ __('resubscribe.Choose') }}...</option>
                                                                    <option value="1">{{ __('Male') }}</option>
                                                                    <option value="2">{{ __('Female') }}</option>
                                                                </select>
                                                                <div class="error-msg-alert"></div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                <label for="first_name" class="form-label">{{ __('First Name') }}</label>
                                                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="form-control" placeholder="{{ __('First Name') }}">
                                                                <div class="error-msg-alert"></div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                <label for="father_name" class="form-label">{{ __('Father Name') }}</label>
                                                                <input type="text" name="father_name" class="form-control" value="{{ old('father_name') }}" id="father_name" placeholder="{{ __('Father Name') }}">
                                                                <div class="error-msg-alert"></div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                <label for="grandfather_name" class="form-label">{{ __('Grandfather Name') }}</label>
                                                                <input type="text" class="form-control" name="grandfather_name" value="{{ old('grandfather_name') }}" id="grandfather_name" placeholder="{{ __('Grandfather Name') }}">
                                                                <div class="error-msg-alert"></div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-3">
                                                                <label for="family_name" class="form-label">{{ __('Family Name') }}</label>
                                                                <input type="text" name="family_name" class="form-control" id="family_name" value="{{ old('family_name') }}" placeholder="{{ __('Family Name') }}">
                                                                <div class="error-msg-alert"></div>
                                                            </div>

                                                            <div class="col-12">
                                                                <hr class="my-3">
                                                            </div>

                                                            <div class="col-md-6 col-lg-4">
                                                                <label for="nationality" class="form-label">{{ __('Nationality') }}</label>
                                                                <select name="nationality" class="form-select js-select2" id="nationality">
                                                                    <option value="null" selected>{{ __('resubscribe.Choose') }}...</option>
                                                                    @foreach($countries as $country)
                                                                        <option value="{{ $country->id }}" {{ old('nationality') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="error-msg-alert"></div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-4">
                                                                <label for="country_residence" class="form-label">{{ __('Country of residence') }}</label>
                                                                <select name="country_residence" class="form-select js-select2" id="country_residence">
                                                                    <option value="null" selected>{{ __('resubscribe.Choose') }}...</option>
                                                                    @foreach($countries as $country)
                                                                        <option value="{{ $country->id }}" {{ old('country_residence') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="error-msg-alert"></div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-4">
                                                                <label for="city" class="form-label">{{ __('city') }}</label>
                                                                <input type="text" name="city" class="form-control" id="city" value="{{ old('city') }}" placeholder="{{ __('city') }}">
                                                                <div class="error-msg-alert"></div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-4">
                                                                <label for="postal_code" class="form-label">{{ __('Postal code') }}</label>
                                                                <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" class="form-control" placeholder="{{ __('Postal code') }}">
                                                                <div class="error-msg-alert"></div> <!-- Added for consistency -->
                                                            </div>
                                                            <div class="col-md-6 col-lg-4">
                                                                <label for="id_number" class="form-label">{{ __('ID/Passport Number') }}</label>
                                                                <input type="text" name="id_number" class="form-control" id="id_number" value="{{ old('id_number') }}" placeholder="{{ __('ID/Passport Number') }}">
                                                                <div class="error-msg-alert"></div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-4" id="national_address_parent" style="display: none">
                                                                <label for="national_address" class="form-label">{{ __('national_address') }}</label>
                                                                <input type="text" name="national_address" class="form-control" id="national_address" value="{{ old('national_address') }}" placeholder="{{ __('national_address') }}">
                                                                <div class="error-msg-alert"></div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label for="address" class="form-label">{{ __('Address - Street - Building') }}</label>
                                                                <textarea name="address" id="address" class="form-control">{{ old('address') }}</textarea>
                                                                <div class="error-msg-alert"></div>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="text-danger small fw-medium mt-1">{{ __('sure the address is correct') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Contact Information Card (Common for New/Returning after student details are filled) -->
                                    <div class="custom-card mb-4" id="contact_information_card">
                                        <div class="card-header-gradient-green p-3">
                                            <div class="d-flex align-items-center gap-2 gap-md-3">
                                                <div class="icon-circle green-circle"><i class="fas fa-address-book text-success"></i></div>
                                                <h4 class="mb-0 fs-5 fw-semibold text-dark">{{ __('Contact Information') }}</h4>
                                            </div>
                                        </div>
                                        <div class="card-body p-3 p-md-4">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">{{ __('Father’s WhatsApp Number') }}</label>
                                                    <select name="father_whatsApp" class="form-select js-select2 country-code mb-2" id="father_whatsApp_select">
                                                        <option value="null" selected>{{ __('resubscribe.Choose') }}...</option>
                                                        @foreach($countries as $country)
                                                        <option value="{{ $country->code }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="text" name="father_whatsApp_number" value="{{ old('father_whatsApp_number') }}" id="father_whatsApp_number_input" class="form-control ltr phone-number" placeholder="123456789">
                                                    <div class="error-msg-alert"></div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">{{ __('Mother’s WhatsApp Number') }}</label>
                                                    <select name="mother_whatsApp" class="form-select js-select2 country-code mb-2" id="mother_whatsApp_select">
                                                        <option value="null" selected>{{ __('resubscribe.Choose') }}...</option>
                                                        @foreach($countries as $country)
                                                    <option value="{{ $country->code }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="text" name="mother_whatsApp_number" value="{{ old('mother_whatsApp_number') }}" id="mother_whatsApp_number_input" class="form-control ltr phone-number" placeholder="123456789">
                                                    <div class="error-msg-alert"></div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">{{ __('Father’s E-mail') }}</label>
                                                    <input type="email" name="father_email" value="{{ old('father_email') }}" class="form-control father_email_common mb-2" placeholder="{{ __('Father’s E-mail') }}" required>
                                                    <input type="email" name="confirm_father_email" value="{{old('confirm_father_email') }}" class="form-control" placeholder="{{ __('Confirm Father’s E-mail') }}" required>
                                                    <div class="error-msg-alert"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">{{ __('Mother’s E-mail') }}</label>
                                                    <input type="email" name="mother_email" value="{{  old('mother_email') }}" class="form-control mb-2" placeholder="{{ __('Mother’s E-mail') }}" required>
                                                    <input type="email" name="confirm_mother_email" value="{{  old('confirm_mother_email') }}" class="form-control" placeholder="{{ __('Confirm Mother’s E-mail') }}" required>
                                                    <div class="error-msg-alert"></div>
                                                </div>
                                                <div class="col-12">
                                                    <p class="text-danger small fw-medium mt-1">{{ __('Note: messages are sent on the (Email).') }}</p>
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label">{{ __('Preferred language') }}</label>
                                                    <select name="preferred_language" class="form-select" id="preferred_language_common" required>
                                                        <option value="null" >{{ __('resubscribe.Choose') }}...</option>
                                                        <option value="Arabic">{{ __('Arabic') }}</option>
                                                        <option value="English" >{{ __('English') }}</option>
                                                    </select>
                                                    <div class="error-msg-alert"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Additional Information Card () -->
                                    <div class="custom-card mb-4" id="new_student_additional_info_card">
                                        <div class="card-header-gradient-amber p-3">
                                            <div class="d-flex align-items-center gap-2 gap-md-3">
                                                <div class="icon-circle amber-circle"><i class="fas fa-puzzle-piece text-warning"></i></div>
                                                <h4 class="mb-0 fs-5 fw-semibold text-dark">{{ __('Additional Information (New Students)') }}</h4>
                                            </div>
                                        </div>
                                        <div class="card-body p-3 p-md-4">
                                            <div class="mb-4 radio-card-group" id="arabic_level_section">
                                                <label class="form-label fw-medium">{{ __('How do you rate your level of reading in Arabic?') }}</label>
                                                @php $arabicLevels = [__('I can read fluently'), __('I can read but find some words and sentences difficult'), __('I cant read Arabic at all')]; @endphp
                                                @foreach($arabicLevels as $idx => $level)
                                                <div class="form-check radio-card">
                                                    <input class="form-check-input {{app()->getLocale() == 'ar' ? 'float-right' : ''}}" type="radio" name="arabic_level" id="arabicLvl{{$idx}}" value="{{$level}}" required>
                                                    <label class="form-check-label" for="arabicLvl{{$idx}}">{{$level}}</label>
                                                </div>
                                                @endforeach
                                                <div class="error-msg-alert"></div>
                                            </div>

                                            <div class="mb-4 radio-card-group" id="quran_level_section">
                                                <label class="form-label fw-medium">{{ __('How would you rate your level in reciting the Noble Quran?') }}</label>
                                                @php $quranLevels = [__('I can recite the Noble Quran with the provisions of Tajweed'), __('I can recite the Noble Quran, but I find it difficult to apply the provisions of intonation'), __('I cant recite the Noble Quran with the provisions of Tajweed')]; @endphp
                                                @foreach($quranLevels as $idx => $level)
                                                <div class="form-check radio-card">
                                                    <input class="form-check-input {{app()->getLocale() == 'ar' ? 'float-right' : ''}}" type="radio" name="quran_level" id="quranLvl{{$idx}}" value="{{$level}}" required>
                                                    <label class="form-check-label" for="quranLvl{{$idx}}">{{$level}}</label>
                                                </div>
                                                @endforeach
                                                <div class="error-msg-alert"></div>
                                            </div>

                                            <div class="mb-4 radio-card-group" id="hear_about_section">
                                                <label class="form-label fw-medium">{{ __('How did you hear about Furqan Group?') }}</label>
                                                @php $hearOptions = [__('From family and friends'), __('From social media'), __('From the course of Qaidah Nuraniah')]; @endphp
                                                @foreach($hearOptions as $idx => $option)
                                                <div class="form-check radio-card">
                                                    <input class="form-check-input checkbox-options {{app()->getLocale() == 'ar' ? 'float-right' : ''}}" type="radio" name="hear_about_option" id="hearAbt{{$idx}}" value="{{$option}}" required>
                                                    <label class="form-check-label" for="hearAbt{{$idx}}">{{$option}}</label>
                                                </div>
                                                @endforeach
                                                <div class="form-check radio-card">
                                                    <input class="form-check-input checkbox-options {{app()->getLocale() == 'ar' ? 'float-right' : ''}}" type="radio" name="hear_about_option" id="hearAbtOther" value="other" required>
                                                    <label class="form-check-label" for="hearAbtOther">{{ __('Other') }}</label>
                                                </div>
                                                <textarea name="hear_about_textbox" class="form-control mt-2 d-none" id="hear_about_textbox" cols="30" rows="3" placeholder="{{__('Please specify')}}"></textarea>
                                                <input type="hidden" name="hear_about[]" id="hidden_hear_about">
                                                <div class="error-msg-alert"></div>
                                            </div>

                                            <div class="mb-4 radio-card-group" id="certificate_passing_section">
                                                <label class="form-label fw-medium">{{ __('Did you get Qaidah Nuraniah Certificate before?') }}</label>
                                                <div class="form-check radio-card">
                                                    <input class="form-check-input {{app()->getLocale() == 'ar' ? 'float-right' : ''}}" type="radio" name="certificate_passing" id="certificate-passing-yes" value="yes" required>
                                                    <label class="form-check-label" for="certificate-passing-yes">{{ __('yes') }}</label>
                                                </div>
                                                <div class="form-check radio-card">
                                                    <input class="form-check-input {{app()->getLocale() == 'ar' ? 'float-right' : ''}}" type="radio" name="certificate_passing" id="certificate-passing-no" value="no" required>
                                                    <label class="form-check-label" for="certificate-passing-no">{{ __('no') }}</label>
                                                </div>
                                                <div class="mt-2 d-none" id="certificate_file_upload_section">
                                                    <label class="form-label" for="certificate_file">{{ __('Upload Your Certificate') }}</label>
                                                    <input type="file" name="certificate_file" class="form-control" id="certificate_file" >
                                                    <div class="error-msg-alert"></div>
                                                </div>
                                                <div class="error-msg-alert"></div>
                                            </div>

                                            <div class="mb-4 radio-card-group" id="memorized_parts_section">
                                                <label class="form-label fw-medium">{{ __('Have you memorized parts of the Quran?') }}</label>
                                                <div class="form-check radio-card">
                                                    <input class="form-check-input {{app()->getLocale() == 'ar' ? 'float-right' : ''}}" type="radio" name="memorized_parts" id="memorized-parts-yes" value="yes" required>
                                                    <label class="form-check-label" for="memorized-parts-yes">{{ __('yes') }}</label>
                                                </div>
                                                <div class="form-check radio-card">
                                                    <input class="form-check-input {{app()->getLocale() == 'ar' ? 'float-right' : ''}}" type="radio" name="memorized_parts" id="memorized-parts-no" value="no" required>
                                                    <label class="form-check-label" for="memorized-parts-no">{{ __('no') }}</label>
                                                </div>
                                                <div class="mt-2 d-none" id="memorized_parts_count_section">
                                                    <label class="form-label" for="memorized_parts_count">{{ __('How many parts?') }}</label>
                                                    <input type="number" name="memorized_parts_count" class="form-control" id="memorized_parts_count" min="1" max="30" required>
                                                    <div class="error-msg-alert"></div>
                                                </div>
                                                <div class="error-msg-alert"></div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-medium" for="student_id_file">{{ __('Student ID (Upload)') }}</label>
                                                <input class="form-control" type="file" name="student_id" id="student_id_file">
                                                <div class="error-msg-alert"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Guardian Commitment (Common for all in Step 2) -->
                                    <div class="custom-card mb-4" id="guardian_commitment_card_step2">
                                        <div class="card-header-gradient-red p-3">
                                            <div class="d-flex align-items-center gap-2 gap-md-3">
                                                <div class="icon-circle red-circle"><i class="fas fa-signature text-danger"></i></div>
                                                <h4 class="mb-0 fs-5 fw-semibold text-dark">{{ __('Acknowledgment') }}</h4>
                                            </div>
                                        </div>
                                        <div class="card-body p-3 p-md-4">
                                            <div id="guardian_commitment_section" class="radio-card-group">
                                                <label class="form-label fw-medium text-danger">{{ __('Guardian Signature') }}:</label>
                                                <div class="form-check radio-card">
                                                    <input required class="form-check-input {{app()->getLocale() == 'ar' ? 'float-right' : ''}}" type="radio" name="guardian_commitment" id="guardian_commitment_ack">
                                                    <label class="form-check-label" for="guardian_commitment_ack">
                                                        {{ __('Guardian Commitment') }}
                                                    </label>
                                                </div>
                                                <div class="error-msg-alert"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div class="alert alert-success text-center d-none" id="save-data-alert" role="alert">
                                            {{ __('save_data_alert') }}
                                        </div>
                                        <button type="button" name="save-later" id="save" class="action-button" style="background-color: #fc7c01;">
                                            {{ __('save and continue later') }}
                                        </button>
                                    </div>
                                </div>

                                <!-- Step 3: Payment -->
                                <div class="form-step" id="step3Content">
                                    <div class="fs-title mb-4">{{ __('resubscribe.Payment and termination') }}</div>



                                    <div class="custom-card mb-4">
                                        <div class="card-header-gradient-green p-3">
                                            <div class="d-flex align-items-center gap-2 gap-md-3">
                                                <!-- <div class="icon-circle green-circle"><i class="fas fa-credit-card text-success"></i></div> -->
                                                <div class="icon-circle red-circle"><i class="fas fa-signature text-success"></i></div>
                                                <h4 class="mb-0 fs-5 fw-semibold text-dark">{{ __('Acknowledgment') }}</h4>
                                            </div>
                                        </div>
                                        <div class="card-body p-3 p-md-4">
                                            <div class="radio-card-group d-none">
                                                <div class="form-check radio-card">
                                                    <input class="form-check-input {{app()->getLocale() == 'ar' ? 'float-right' : ''}}"
                                                           type="radio"
                                                           name="payment_method"
                                                           data-course-amount="{{ $course->price }}"
                                                           data-base-course-amount="{{ $course->price }}"
                                                           id="checkout_gateway"
                                                           value="checkout_gateway"
                                                           checked required>
                                                    <label class="form-check-label fw-medium" for="checkout_gateway">
                                                        {!! __('Payment via credit card', ['amount' => $course->price]) !!}
                                                    </label>
                                                    <p class="text-muted small mt-1">{{__('We accept all credit cards (Mada - VISA - Master Card - American express - others)')}}</p>
                                                    <img class="mt-1" style="max-width: 200px;" src="{{ asset('card-icons/cards.png') }}" alt="Cards icons">
                                                </div>
                                                <span id="amount" class="d-none">{{$course->price}}</span>
                                                <!-- HSBC Option (removed from UI as per original comment, but logic can be re-added if needed) -->
                                            </div>
                                            <div class="form-check " id="checks-section">
                                                <div class="checkout-terms-box">
                                                    <input class="form-check-input " type="checkbox" value="" id="agree-terms" required>
                                                <label class="form-check-label small " for="agree-terms">
                                                    {{ __('resubscribe.terms and conditions') }}
                                                </label>
                                                </div>
                                                <div class="error-msg-alert block"></div>
                                            </div>
                                            <!-- Coupon Code (Part of original payment-form, moved here for UI flow) -->
                                            <div class=" col-sm-12 col-md-7" style="margin: 0 auto;">
                                            </div>
                                            <div id="CouponParent">
                                                <div class="coupon-form mt-4" id="apply-coupon-section">
                                                <label for="apply_coupon" class="form-label">{{ __('resubscribe.Enter coupon') }}</label>
                                                <input type="text" name="apply_coupon_field" class="form-control" id="apply_coupon_field" placeholder="{{__('Enter coupon code')}}">
                                                <small id="coupon-description" class="form-text text-muted d-block mt-1"></small>
                                                <div class="text-center mt-2">
                                                    <button type="button" class="btn btn-primary btn-sm" id="apply_coupon_btn_action">
                                                        {{ __('resubscribe.Apply') }}
                                                        <i class="fas fa-spinner fa-spin d-none ms-1"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <input type="hidden" name="hidden_apply_coupon" id="hidden_apply_coupon">
                                <input type="hidden" name="token_pay" id="token_pay">
                                <input type="hidden" name="api_url" id="api_url" value="{{url('')}}">
                                <input type="hidden" name="mode_key" id="mode_key" value="{{env('CHECKOUT_PK')}}">
                                <input type="hidden" name="mode_pay" id="mode_pay" value="{{env('CHECKOUT_MODE')}}">
                                <input type="hidden" name="google_merchant_id" id="google_merchant_id"  value="{{ env('GOOGLE_MERCHANT_ID') }}">
                                <input type="hidden" name="paypal_clientid" id="paypal_clientid" value="{{env('PAYPAL_MODE') === 'sandbox' ? env('PAYPAL_SANDBOX_CLIENT_ID') : env('PAYPAL_LIVE_CLIENT_ID')}}">
                                <input type="hidden" name="token_pay_type" id="token_pay_type">
                                <button class="btn btn-success w-100 mt-2 d-none" id="pay-button-full-free">
                                    {{ __('resubscribe.Checkout') }} (Free)
                                    <i class="fas fa-spinner fa-spin d-none ms-1"></i>
                                </button>
                            </form>
                                    <!-- Checkout.com Payment Form Integration -->
                                    <div class="custom-card" id="checkout_payment_card">
                                        <div class="card-header-gradient-purple p-3">
                                            <div class="d-flex align-items-center gap-2 gap-md-3">
                                                <div class="icon-circle purple-circle"><i class="fas fa-lock text-purple"></i></div>
                                                <h4 class="mb-0 fs-5 fw-semibold text-dark">{{ __('Secure Card Details') }}</h4>
                                            </div>
                                        </div>
                                        <div class="card-body p-3 p-md-4">
                                            <form id="payment-form" method="POST" action="https://merchant.com/charge-card" >
                                                <div class="mb-3">
                                                    <div id="CardFTitle">
                                                        <label class="form-label">{{__('Card Information')}}</label>
                                                    </div>
                                                    <div class="card-frame"></div>
                                                    <p class="error-message text-danger small mt-1"></p>
                                                </div>


                                                <div id="payButtonDiv">
                                                    <button class="btn btn-primary" id="pay-button" disabled>
                                                    {{ __('resubscribe.Checkout') }}
                                                    <i class="fas fa-spinner fa-spin d-none ms-1"></i>
                                                </button>
                                                </div>
                                                <div id="OrSpan" >
                                                    <span  class="text-center d-none">{{ __('or') }}</span>
                                                </div>
                                                <div id="line-separate"></div>
{{--                                                <div id="apple-pay-button" class="d-none"></div>--}}
{{--                                                <div id="google-pay-button"></div>--}}
                                                <div id="paypal-pay-button" class="mt-1"></div>

                                            </form>

                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation Buttons -->
                                <div class="d-flex justify-content-around">
                                    <button type="button" name="previous" class="previous action-button-previous d-none">
                                        <i class=" {{ app()->getLocale() == 'ar' ? 'fa fa-arrow-right' : 'fa-solid fa-arrow-left'  }}  me-2" aria-hidden="true"></i>
                                        {{ __('resubscribe.Previous') }}
                                    </button>



                                    <button type="button" name="next" class="next action-button">
                                        {{ __('resubscribe.Next') }}
                                        <i class=" {{ app()->getLocale() == 'ar' ? 'fa-solid fa-arrow-left' : 'fa fa-arrow-right'  }} ms-2" aria-hidden="true"></i>
                                    </button>
                                    <!-- Submit button for the main form (msform), primarily for HSBC or free checkout -->
                                    <!-- The actual CKO payment is triggered by #pay-button within #payment-form -->
                                    <button type="submit" id="submit-main-form-btn" class="action-button d-none" style="background-color: var(--green);">
                                        {{ __('resubscribe.Complete Registration') }}
                                        <i class="fas fa-spinner fa-spin d-none ms-1"></i>
                                    </button>
                                </div>

                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Mobile FAQ Panel Container (Initially hidden, shown by JS) -->
        <div id="faqPanelContainerMobile" class="container d-lg-none">
            <!-- Content will be cloned here by JS -->
        </div>
        <div id="faqPanelBackdropMobile" class="faq-panel-backdrop d-lg-none"></div>


        <!-- Mobile FAQ Toggle Button -->
        <!-- <button class="btn faq-toggle-btn d-lg-none" id="mobileFaqToggleBtn">
            <i class="fas fa-question-circle fs-4"></i>
        </button> -->

        <!-- Policy Modal (Single modal, content updated by JS) -->
        <div class="modal fade" id="policyModal" tabindex="-1" aria-labelledby="policyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content p-4 ">
                    <div class="modal-header bg-transparent border-0">
                        <h5 class="modal-title" id="policyModalLabel">Policy</h5>
                        <button type="button" class="btn bg-transparent border-0 btn-light btn-sm" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body" id="policyModalBody">
                        <!-- Policy content will be loaded here by JS -->
                    </div>

                </div>
            </div>
        </div>

        <!-- JS Libraries -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.checkout.com/js/framesv2.min.js"></script>
        <script src="https://pay.google.com/gp/p/js/pay.js"></script>
        <script src="https://applepay.cdn-apple.com/jsapi/v1/apple-pay-sdk.js"></script>
        <script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_MODE') === 'sandbox' ? env('PAYPAL_SANDBOX_CLIENT_ID') : env('PAYPAL_LIVE_CLIENT_ID')}}&components=buttons&disable-funding=credit,card&locale={{App::getLocale() === 'ar' ? 'en_US' : 'en_US'}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <!-- Original App JS for CKO -->
        <script src="{{ asset('app.js') }}?v=4"></script>
        <script src="{{ asset('pay-apple.js') }}?v=4"></script>
        {{--<script src="{{ asset('pay-google.js') }}?v=4"></script>--}}
        <script src="{{ asset('pay-pal.js') }}?v=5"></script>

        <!-- Meta Pixel Code -->
        <script>
            ! function(f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function() {
                    n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '5803897389689429');
            fbq('track', 'PageView');
        </script>
        <noscript>
            <img height="1" width="1" style="display:none"
                src="https://www.facebook.com/tr?id=5803897389689429&ev=PageView&noscript=1" /></noscript>
        <!-- End Meta Pixel Code -->
        <script>
            const formId = "#msform"; // ID of the form
            const formIdentifier = `${location.href}${formId}`; // Identifier used to identify the form
            const saveButton = document.getElementById(`save`); // select save button
            const formParent = document.querySelector(formId); // select form
            const formElements = formParent.elements; // get the elements in the form

            const getFormData = () => {
                let data = {[formIdentifier]: {}};
                for (const element of formElements) {
                    if (element.getAttribute("type") === 'radio') {
                        data[formIdentifier][element.id] = element.checked;
                    } else {
                        data[formIdentifier][element.id] = element.value;
                    }
                }
                return data;
            };
            const populateForm = () => {
                if (localStorage.key(formIdentifier)) {
                    const savedData = JSON.parse(localStorage.getItem(formIdentifier)); // get and parse the saved data from localStorage
                    if(savedData === null) return;
                    for (const element of formElements) {
                        if (element.name in savedData || element.id in savedData) {

                            try {
                                if (element.getAttribute("type") === 'radio') {
                                    const checkboxValue = savedData[element.id];
                                    if (checkboxValue) {
                                        element.checked = true;
                                        if (element.name === 'favorite_time') {
                                            element.closest(".session-card").classList.add("is-valid", "selected");
                                        }
                                    }
                                } else {
                                    element.value = savedData[element.id];
                                }
                            } catch (e) {
                                console.log("populateForm.error", e.message + ' ' + element.getAttribute("name"))
                            }

                        }
                    }
                }
            };
            const populateNationalAddress = () => {
                if($('#country_residence').val() == 249){
                    $('#national_address_parent').show();
                }
                $('#country_residence').change(function (e) {
                    if ($(this).val() == 249) {
                        $('#national_address_parent').show();
                    } else {
                        $('#national_address_parent').hide();
                        $('#national_address').val("");
                    }
                })
            };
            saveButton.onclick = event => {
                event.preventDefault();
                const data = getFormData();
                localStorage.setItem(formIdentifier, JSON.stringify(data[formIdentifier]));
                $('#save-data-alert').removeClass('d-none');
                setTimeout(() => $('#save-data-alert').addClass('d-none'), 4000);
            };
            populateForm();
            populateNationalAddress();
        </script>

        <script>
            $(document).ready(function () {
                $(document).on('keypress', function (e) {
                    if (e.which === 13 || e.keyCode === 13) {
                        e.preventDefault();
                        return false;
                    }
                });
            });
            $(document).ready(function () {

 // Define all session times in 24-hour format (Source Timezone is Mecca, UTC+3)
    const sessionTimes = {
        'morning':  { start: '09:00', end: '12:00' },
        'evening1': { start: '15:00', end: '18:00' },
        'evening2': { start: '19:00', end: '22:00' },
        'evening3': { start: '23:00', end: '02:00' },
        'evening4': { start: '02:00', end: '05:00' }
    };

    /**
     * Converts a time string from Mecca (UTC+3) to the user's local time.
     */
    function convertMeccaTimeToLocal(timeString24hr) {
        try {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            const isoString = `${year}-${month}-${day}T${timeString24hr}:00+03:00`;
            const meccaTime = new Date(isoString);

            if (isNaN(meccaTime.getTime())) return '...';

            return meccaTime.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' });
        } catch (e) {
            console.error("Error converting time:", e);
            return '...';
        }
    }

    /**
     * Gets the user's GMT offset and formats it as a string (e.g., "GMT-5").
     */
    function getGmtString() {
        const offset = -new Date().getTimezoneOffset() / 60;
        return `GMT${offset >= 0 ? '+' : ''}${offset}`;
    }

    // --- Main Logic: Check timezone and update UI ---
    const userOffsetMinutes = new Date().getTimezoneOffset();
    const isUserInMeccaTimezone = (userOffsetMinutes === -180); // -180 minutes is UTC+3

    if (!isUserInMeccaTimezone) {
        // 1. Update the main heading to show the user's GMT
        if ($('html').attr('dir') === 'rtl') {
            $('#local-gmt-display').text(`| توقيتك المحلي: ${getGmtString()}`).removeClass('d-none');
        } else {
            $('#local-gmt-display').text(`| Your Local Time: ${getGmtString()}`).removeClass('d-none');
        }
        // 2. Loop through session cards and add local time
        for (const key in sessionTimes) {
            const card = $(`.session-card[data-session-key="${key}"]`);
            if (card.length) {
                // Show the local time wrapper
                card.find('.local-time-wrapper').removeClass('d-none');

                // Convert and display local times
                const times = sessionTimes[key];
                const localStartTime = convertMeccaTimeToLocal(times.start);
                const localEndTime = convertMeccaTimeToLocal(times.end);

                const localTimeElement = card.find('.local-time-text-under');
                localTimeElement.text(`${localStartTime} - ${localEndTime}`);
            }
        }
    }
    // If user is in Mecca timezone, the script does nothing, showing only Mecca time.

    // --- End Session Time Conversion ---

                // ---Initialize Select2 and Flatpickr ---
                $('.js-select2').select2({
                    theme: "bootstrap-5",
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                });

                $(".flatpickr-date").flatpickr({
                    enableTime: false,
                    dateFormat: "Y-m-d",
                });

                // Clock based on user locale

                // --- New UI Stepper Logic ---
                const formSteps = $('#msform .form-step');
                const nextBtn = $('.next');
                const prevBtn = $('.previous');
                const submitMsFormBtn = $('#submit-main-form-btn');

                const stepperItems = $('#stepper .stepper-item');
                const stepperProgressBar = $('#stepperProgressBar');
                const faqStepTabs = $('#faqTabs .nav-link');
                let currentFormStep = 0;

                function clearFieldValidation(field) {
                    const fieldGroup = field.closest('.form-group, .col-md-6, .col-lg-3, .col-lg-4, .col-12, .mb-3, .mb-4, .radio-card-group');
                    const errorAlertContainer = fieldGroup.find('.error-msg-alert').first();

                    field.removeClass('is-invalid is-valid');
                    if (errorAlertContainer.length) {
                        errorAlertContainer.empty().hide();
                    }

                    if (field.is('input[type="radio"]')) {
                        const groupName = field.attr('name');
                        const radioGroupContainer = field.closest('.radio-card-group');
                        radioGroupContainer.find(`input[name="${groupName}"]`).removeClass('is-invalid is-valid');
                        radioGroupContainer.find('.error-msg-alert').empty().hide();
                    }
                }

                function validateField(field) {
                    let fieldValid = true;
                    let isRequired = field.is('[required]');
                    let errorMsg = '{{ __("This field is required.") }}';
                    const fieldGroup = field.closest('.form-group, .col-md-6, .col-lg-3, .col-lg-4, .col-12, .mb-3, .mb-4, .radio-card-group');
                    const errorAlertContainer = fieldGroup.find('.error-msg-alert').first();

                    clearFieldValidation(field);

                    const value = field.val() ? (typeof field.val() === 'string' ? field.val().trim() : field.val()) : "";

                    if (field.attr('id') === 'birthdate') {
                        if (!$('#birthdate-alert').hasClass('d-none')) {
                            fieldValid = false;
                            errorMsg = $('#birthdate-alert').text();
                        } else if (isRequired && !value) {
                            fieldValid = false;
                        }
                    } else if (field.is('input[type="radio"]')) {
                        const groupName = field.attr('name');
                        const radioGroupContainer = field.closest('.radio-card-group');
                        const allRadiosInGroup = radioGroupContainer.find(`input[name="${groupName}"]`);
                        const isGroupRequired = radioGroupContainer.find(`input[name="${groupName}"][required]`).length > 0;
                        const anythingChecked = radioGroupContainer.find(`input[name="${groupName}"]:checked`).length > 0;

                        if (isGroupRequired && !anythingChecked) {
                            fieldValid = false;
                            allRadiosInGroup.addClass('is-invalid');
                            allRadiosInGroup.closest('.radio-card').addClass('is-invalid');
                        } else {
                            allRadiosInGroup.removeClass('is-invalid');
                            allRadiosInGroup.closest('.radio-card').removeClass('is-invalid');
                            if (isGroupRequired && anythingChecked) {
                                allRadiosInGroup.filter(':checked').addClass('is-valid');
                                allRadiosInGroup.filter(':checked').closest('.radio-card').addClass('is-valid');
                            }
                        }
                    } else if (field.is('input[type="checkbox"]')) {
                        if (isRequired && !field.is(':checked')) {
                            fieldValid = false;
                        }
                    } else if (field.is('select')) {
                        if (isRequired && (value === null || value === "" || value === "null")) {
                            fieldValid = false;
                        }
                    } else {
                        if (isRequired && !value) {
                            fieldValid = false;
                        } else if (value) {
                            if (field.attr('type') === 'email') {
                                const emailFilter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                                if (!emailFilter.test(value)) {
                                    fieldValid = false;
                                    errorMsg = '{{ __("Please provide a valid email address") }}';
                                }
                            }
                            if (field.attr('name') && field.attr('name').startsWith('confirm_')) {
                                const mainEmailName = field.attr('name').replace('confirm_', '');
                                const mainEmailField = field.closest('.form-step').find(`input[name="${mainEmailName}"]:visible`);
                                if (mainEmailField.length && value !== mainEmailField.val()) {
                                    fieldValid = false;
                                    errorMsg = '{{ __("Emails do not match") }}';
                                }
                            }
                        }
                    }

                    if (!fieldValid) {
                        field.addClass('is-invalid');
                        if (errorAlertContainer.length) {
                            // Check if the message contains HTML tags
                            const containsHTML = /<[a-z][\s\S]*>/i.test(errorMsg);
                            if (containsHTML) {
                                errorAlertContainer.html(errorMsg).show();
                            } else {
                                errorAlertContainer.text(errorMsg).show();
                            }
                        }
                    } else if (isRequired && !field.is('input[type="radio"]')) {
                        field.addClass('is-valid');
                        if (errorAlertContainer.length) {
                            errorAlertContainer.empty().hide();
                        }
                    } else if (!isRequired && !field.is('input[type="radio"]')) {
                        field.removeClass('is-invalid is-valid');
                        if (errorAlertContainer.length) errorAlertContainer.empty().hide();
                    }

                    return fieldValid;
                }

                function validateFavoriteTime(field) {
                    let fieldValid = true;
                    let errorMsg = '{{ __("You must choose the appropriate time") }}';
                    const radioGroupContainer = field.closest('#favorite_times');
                    const allRadiosInGroup = radioGroupContainer.find('input[name="favorite_time"]');
                    const isAnyChecked = radioGroupContainer.find('input[name="favorite_time"]:checked').length > 0;

                    const errorAlertContainer = radioGroupContainer.closest('.mb-4').find('.error-msg-alert');

                    allRadiosInGroup.removeClass('is-invalid is-valid');
                    allRadiosInGroup.closest('.session-card').removeClass('is-invalid is-valid');
                    if (errorAlertContainer.length) {
                        errorAlertContainer.empty().hide();
                    }

                    if (!isAnyChecked) {
                        fieldValid = false;
                        allRadiosInGroup.addClass('is-invalid');
                        allRadiosInGroup.closest('.session-card').addClass('is-invalid');
                        if (errorAlertContainer.length) {
                            // Check if the message contains HTML tags
                            const containsHTML = /<[a-z][\s\S]*>/i.test(errorMsg);
                            if (containsHTML) {
                                errorAlertContainer.html(errorMsg).show();
                            } else {
                                errorAlertContainer.text(errorMsg).show();
                            }
                        }
                    } else {
                        allRadiosInGroup.filter(':checked').addClass('is-valid');
                        allRadiosInGroup.filter(':checked').closest('.session-card').addClass('is-valid');
                    }
                    return fieldValid;
                }

                function validateStepInputs(currentStepElement) {
                    let isStepValid = true;
                    currentStepElement.find('.is-invalid').removeClass('is-invalid');
                    currentStepElement.find('.is-valid').removeClass('is-valid');
                    currentStepElement.find('.error-msg-alert').empty().hide();
                    currentStepElement.find('.session-card.is-invalid').removeClass('is-invalid');
                    currentStepElement.find('.session-card.is-valid').removeClass('is-valid');

                    // Validate all required inputs except favorite_time
                    currentStepElement.find('input:visible:not([type=search]):not([type=button]):not([name="favorite_time"]), select:visible, textarea:visible').filter('[required]').each(function () {
                        if (!validateField($(this))) {
                            isStepValid = false;
                        }
                    });

                    // Validate favorite_time radio group separately
                    const favoriteTimeRadios = currentStepElement.find('input[name="favorite_time"]');
                    if (favoriteTimeRadios.length && favoriteTimeRadios.filter('[required]').length > 0) {
                        // console.log("Validating favorite_time group...");
                        if (!validateFavoriteTime(favoriteTimeRadios.first())) {
                            // console.log("favorite_time validation FAILED");
                            isStepValid = false;
                        } else {
                            // console.log("favorite_time validation PASSED");
                        }
                    }


                    // Validate birthdate field
                    const birthdateField = currentStepElement.find('#birthdate:visible');
                    if (birthdateField.length && !$('#birthdate-alert').hasClass('d-none')) {
                        isStepValid = false;
                        birthdateField.addClass('is-invalid');
                        const birthdateErrorMsg = $('#birthdate-alert').text();
                        const containsHTML = /<[a-z][\s\S]*>/i.test(birthdateErrorMsg);
                        if (containsHTML) {
                            birthdateField.closest('.col-md-6').find('.error-msg-alert').html(birthdateErrorMsg).show();
                        } else {
                            birthdateField.closest('.col-md-6').find('.error-msg-alert').text(birthdateErrorMsg).show();
                        }
                    }

                    // Scroll to first invalid field or alert
                    if (!isStepValid) {
                        const firstInvalidOrAlert = currentStepElement.find('.is-invalid, .alert-danger:not(.d-none):visible').first();
                        if (firstInvalidOrAlert.length) {
                            const offset = $(window).height() * 1.4;
                            const elementTop = firstInvalidOrAlert.offset().top;
                            const scrollToPosition = elementTop - offset;
                            $('html, body').animate({scrollTop: scrollToPosition > 0 ? scrollToPosition : 0}, 300);
                        }
                    }
                    return isStepValid;
                }

                function attachReactiveValidationListeners(stepElement) {
                    stepElement.find('input:not([type=search]):not([type=button]), select, textarea').each(function () {
                        const field = $(this);
                        field.off('.reactiveVal');

                        let eventTypes = '';
                        if (field.is('input[type=text], input[type=email], input[type=number], textarea, .flatpickr-date')) {
                            eventTypes = 'input.reactiveVal blur.reactiveVal';
                        } else if (field.is('input[type=radio], input[type=checkbox], input[type=file], select')) {
                            eventTypes = 'change.reactiveVal blur.reactiveVal';
                        }

                        if (eventTypes) {
                            field.on(eventTypes, function () {
                                validateField($(this));

                                if ($(this).attr('type') === 'email' && !$(this).attr('name').startsWith('confirm_')) {
                                    const confirmEmailName = 'confirm_' + $(this).attr('name');
                                    const confirmEmailField = $(this).closest('.form-step').find(`input[name="${confirmEmailName}"]:visible`);
                                    if (confirmEmailField.length && confirmEmailField.val()) {
                                        validateField(confirmEmailField);
                                    }
                                }
                            });
                        }
                    });
                }

                function updateUIForStep(stepIndex) {
                    formSteps.removeClass('active fadeIn');
                    const currentActiveStepElement = formSteps.eq(stepIndex);
                    currentActiveStepElement.addClass('active fadeIn');

                    formSteps.find('input, select, textarea').off('.reactiveVal');
                    attachReactiveValidationListeners(currentActiveStepElement);

                    stepperItems.each(function (idx) {
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

                    stepperProgressBar.css('width', progressPercentage + '%');
                    stepperProgressBar.toggleClass('completed', stepIndex === formSteps.length - 1);

                    const faqPanel = $('#faqPanel'); // The actual panel inside the container
                    const registrationSummaryCard = $('#registration_summary_card');
                    if (stepIndex === 0) {
                        registrationSummaryCard.addClass('d-none');
                        // faqPanel.removeClass('d-none');

                        // faqPanel.addClass('isSticky');
                    } else if (stepIndex === 1) {
                        // faqPanel.removeClass('d-none');
                        if (currentFormStep > stepIndex) {
                            registrationSummaryCard.removeClass('d-none');
                            // registrationSummaryCard.addClass('isSticky');
                        } else {
                            // faqPanel.addClass('isSticky');
                        }
                    } else if (stepIndex === 2) {
                        registrationSummaryCard.removeClass('d-none');
                        // registrationSummaryCard.addClass('isSticky');
                        // faqPanel.addClass('d-none');
                    }
                    if (stepIndex === 0) {
                        faqPanel.addClass('isSticky');
                        prevBtn.addClass('d-none');
                        nextBtn.removeClass('d-none');
                        submitMsFormBtn.addClass('d-none');
                        // $('#registration_summary_card').addClass('d-none');
                        $('#checkout_payment_card').addClass('d-none');
                        $('#pay-button-full-free').addClass('d-none');
                    } else if (stepIndex === formSteps.length - 1) {
                        prevBtn.removeClass('d-none');

                        nextBtn.addClass('d-none');
                        const totalPriceText = $('#total_price_summary').text().replace(/[^0-9.-]+/g, "");
                        const currentTotal = parseFloat(totalPriceText);
                        const isFree = currentTotal === 0;
                        // $('#registration_summary_card').removeClass('d-none');
                        if ($('#checkout_gateway').is(':checked') && !isFree) {
                            if ($('#agree-terms').is(':checked')) {
                                $('#checkout_payment_card').removeClass('d-none');
                            }
                            submitMsFormBtn.addClass('d-none');
                            $('#pay-button-full-free').addClass('d-none');
                        } else if (isFree) {
                            $('#checkout_payment_card').addClass('d-none');
                            submitMsFormBtn.addClass('d-none');
                            $('#pay-button-full-free').removeClass('d-none').prop('disabled', false);
                        } else {
                            $('#checkout_payment_card').addClass('d-none');
                            submitMsFormBtn.removeClass('d-none');
                            $('#pay-button-full-free').addClass('d-none');
                        }
                    } else {
                        prevBtn.removeClass('d-none');
                        nextBtn.removeClass('d-none');
                        submitMsFormBtn.addClass('d-none');
                        $('#checkout_payment_card').addClass('d-none');
                        $('#pay-button-full-free').addClass('d-none');

                    }

                    faqStepTabs.removeClass('active').eq(stepIndex).addClass('active');
                    if ($('#faqPanelContainerDesktop').hasClass('show') || $(window).width() >= 992) {
                        const targetTabContentID = faqStepTabs.eq(stepIndex).attr('data-bs-target');
                        $('#faqTabContent .tab-pane').removeClass('show active');
                        $(targetTabContentID).addClass('show active');
                    }

                    // Only scroll when moving from step 0 to 1 or 1 to 2, but NOT on initial page load
                    if ($('.stepper-main-container').length && ((currentFormStep === 0 && stepIndex === 1) || (currentFormStep === 1 && stepIndex === 2))) {
                        $('#mainFormContainer')[0].scrollIntoView({behavior: 'smooth', block: 'start'});
                    }

                    // Show the #save button only in the second step (stepIndex === 1)
                    if (stepIndex === 1) {
                        $('#save').removeClass('d-none');
                    } else {
                        $('#save').addClass('d-none');
                    }
                    currentFormStep = stepIndex;
                }

                updateUIForStep(0);
                $('#apply-coupon-section').addClass('d-none');
                $('#checkout_payment_card').addClass('d-none');
                $('#agree-terms').change(function () {
                    if ($(this).is(':checked')) {
                        $('#apply-coupon-section').removeClass('d-none');
                        $('#checkout_payment_card').removeClass('d-none');
                    } else {
                        $('#apply-coupon-section').addClass('d-none');
                        $('#checkout_payment_card').addClass('d-none');
                    }
                });

                nextBtn.click(function () {
                    const currentFs = formSteps.eq(currentFormStep);
                    if (validateStepInputs(currentFs)) {
                        updateUIForStep(currentFormStep + 1);
                    }
                });

                prevBtn.click(function () {
                    updateUIForStep(currentFormStep - 1);
                });

                $("#favorite_times .session-card").click(function (e) {
                    if (e.target.tagName === "LABEL" || e.target.tagName === "INPUT") {
                    } else {
                        $(this).find('input[type="radio"]').prop("checked", true).trigger("change");
                    }
                });

                $('input[name="favorite_time"]').change(function () {
                    $("#favorite_times .session-card").removeClass("selected");
                    if ($(this).is(":checked")) {
                        $(this).closest(".session-card").addClass("selected");
                        validateFavoriteTime($(this));
                    }
                });

                $('.radio-card-group .radio-card').click(function (e) {
                    if (e.target.tagName === "LABEL" || e.target.tagName === "INPUT") {
                    } else {
                        const radioInput = $(this).find('input[type="radio"]');
                        if (radioInput.length) {
                            radioInput.prop("checked", true).trigger("change");
                        }
                    }
                });

                $('.radio-card-group input[type="radio"]').change(function () {
                    const groupName = $(this).attr('name');
                    $(`input[name="${groupName}"]`).closest('.radio-card').removeClass('selected');
                    if ($(this).is(":checked")) {
                        $(this).closest(".radio-card").addClass("selected");
                        validateField($(this));
                    }
                });

                const faqPanelMobileContainer = $('#faqPanelContainerMobile');
                const faqPanelBackdrop = $('#faqPanelBackdropMobile');
                const originalFaqPanel = $('#faqPanel'); // The single source of truth

                // 1. Clone and prepare the mobile FAQ panel
                if (originalFaqPanel.length && faqPanelMobileContainer.length) {
                    const clonedPanel = originalFaqPanel.clone();
                    const suffix = '_mobile';

                    // A map to track old IDs and their new counterparts
                    const idMap = {};

                    // First, update all IDs within the clone and populate the map
                    clonedPanel.find('[id]').each(function () {
                        const oldId = $(this).attr('id');
                        const newId = oldId + suffix;
                        idMap['#' + oldId] = '#' + newId; // Store with '#' for easy replacement
                        $(this).attr('id', newId);
                    });

                    // Next, update all attributes that reference those IDs
                    clonedPanel.find('[data-bs-target], [aria-controls], [aria-labelledby]').each(function () {
                        const $el = $(this);
                        ['data-bs-target', 'aria-controls', 'aria-labelledby'].forEach(attr => {
                            const oldTarget = $el.attr(attr);
                            // If the attribute exists and is found in our map, update it
                            if (oldTarget && idMap[oldTarget]) {
                                $el.attr(attr, idMap[oldTarget]);
                            }
                        });
                    });

                    // Put the fixed clone into the mobile container
                    faqPanelMobileContainer.html(clonedPanel);

                    // 2. Initialize Bootstrap tabs on the newly created buttons inside the mobile panel
                    faqPanelMobileContainer.find('[data-bs-toggle="pill"]').each(function () {
                        // This creates a new Tab instance, attaching the necessary click listeners
                        new bootstrap.Tab(this);
                    });
                }


                // 3. Corrected open/close logic for the mobile panel
                function openMobileFaq() {
                    // The logic should toggle a 'show' class on the MOBILE container
                    faqPanelMobileContainer.parent().addClass('show'); // Target the parent container to match CSS
                    faqPanelBackdrop.addClass('show');
                    $('body').addClass('overflow-hidden');
                }

                function closeMobileFaq() {
                    faqPanelMobileContainer.parent().removeClass('show');
                    faqPanelBackdrop.removeClass('show');
                    $('body').removeClass('overflow-hidden');
                }

                // Attach event handlers
                // The toggle button is commented out in your HTML, but this will work if you re-enable it.
                $('#mobileFaqToggleBtn').on('click', function () {
                    if (faqPanelMobileContainer.parent().hasClass('show')) {
                        closeMobileFaq();
                    } else {
                        openMobileFaq();
                    }
                });

                faqPanelBackdrop.on('click', closeMobileFaq);

                // Update the "View FAQs" button to use the correct function
                $('#mainFormContainer').on('click', '.view-faq-btn', function () {
                    if ($(window).width() < 992) {
                        openMobileFaq(); // Use the corrected function
                    }
                    // The rest of your existing logic for this button is fine
                    $('#faqPanel').addClass('attention-border');
                    setTimeout(function () {
                        $('#faqPanel').removeClass('attention-border');
                    }, 1500);

                    let targetFaqTab = faqStepTabs.eq(currentFormStep);
                    if ($(this).closest('.form-step').is('#step1Content')) targetFaqTab = $('#faq-step1-tab');
                    else if ($(this).closest('.form-step').is('#step2Content')) targetFaqTab = $('#faq-step2-tab');
                    else if ($(this).closest('.form-step').is('#step3Content')) targetFaqTab = $('#faq-step3-tab');

                    const tabTrigger = new bootstrap.Tab(targetFaqTab[0]);
                    tabTrigger.show();
                });

                $('body').on('input', '.faq-panel #faqSearch', function () {
                    const $currentInput = $(this);
                    const $currentPanel = $currentInput.closest('.faq-panel');
                    const query = $currentInput.val().toLowerCase().trim();
                    const clearBtn = $currentInput.siblings('#clearSearchBtn');

                    const faqBody = $currentPanel.find('.faq-body');
                    const originalTabContent = faqBody.find('.tab-content');
                    const searchResultsContainer = faqBody.find('#searchResultsContainer');
                    const faqTabsNav = $currentPanel.find('#faqTabs');

                    if (query) {
                        clearBtn.removeClass('d-none');
                        let resultsHtml = '';
                        let count = 0;

                        // Search within the originalTabContent of the current panel
                        originalTabContent.find('.faq-item').each(function () {
                            const $currentItem = $(this);
                            const questionText = $currentItem.find('.faq-question').clone().children().remove().end().text().toLowerCase().trim();
                            const answerText = $currentItem.find('.faq-answer').clone().children().remove().end().text().toLowerCase().trim();

                            if (questionText.includes(query) || answerText.includes(query)) {
                                const clonedItem = $currentItem.clone();
                                clonedItem.find('.faq-answer').show();
                                clonedItem.find('.faq-question i').removeClass('fa-chevron-up').addClass('fa-chevron-down'); // Reset icon
                                resultsHtml += clonedItem.prop('outerHTML');
                                count++;
                            }
                        });

                        if (count > 0) {
                            searchResultsContainer.html(resultsHtml);
                            searchResultsContainer.find('.faq-question').off('click').on('click', function () {
                                window.toggleFaqAnswer(this);
                            });
                        } else {
                            searchResultsContainer.html(`<p class="text-muted text-center p-3">{{__('No results found.')}}</p>`);
                        }
                        searchResultsContainer.removeClass('d-none');
                        originalTabContent.addClass('d-none'); // Hide original tabs
                        faqTabsNav.addClass('d-none'); // Hide tab navigation

                    } else { // Empty query
                        clearBtn.addClass('d-none');
                        searchResultsContainer.addClass('d-none').empty(); // Hide and clear results
                        originalTabContent.removeClass('d-none'); // Show original tabs
                        faqTabsNav.removeClass('d-none'); // Show tab navigation
                    }
                });

                $('body').on('click', '#clearSearchBtn', function () {
                    const faqPanel = $(this).closest('.faq-panel');
                    faqPanel.find('#faqSearch').val('').trigger('input');
                });
                window.toggleFaqAnswer = function (element) {
                    const $element = $(element);
                    const answer = $element.next(".faq-answer");
                    const icon = $element.find("i.fas");
                    answer.slideToggle(200);
                    icon.toggleClass("fa-chevron-down fa-chevron-up");
                };

                const policyModal = new bootstrap.Modal(document.getElementById('policyModal'));
                const policyModalLabel = $('#policyModalLabel');
                const policyModalBody = $('#policyModalBody');
                $('.policy-btn').on('click', function () {
                    const policyType = $(this).data('policytype');
                    let title, contentKey;
                    if (policyType === 'terms') {
                        title = "{{ __('Terms And Conditions') }}";
                        contentKey = 'Terms And Conditions Text';
                    } else if (policyType === 'refund') {
                        title = "{{ __('Refund Policy') }}";
                        contentKey = 'Refund Policy Text';
                    } else if (policyType === 'privacy') {
                        title = "{{ __('Privacy Policy') }}";
                        contentKey = 'Privacy Policy Text';
                    }
                    const translations = {
                        'Terms And Conditions Text': `{!! ${'termsAndConditionsText_' . app()->getLocale()} ?? '-' !!}`,
                        'Refund Policy Text': `{!! ${'refundPolicyText_' . app()->getLocale()} ?? '-' !!}`,
                        'Privacy Policy Text': `{!! ${'privacyPolicyText_' . app()->getLocale()} ?? '-' !!}`
                    };
                    policyModalLabel.text(title);
                    policyModalBody.html(translations[contentKey] || 'Content not found.');
                });
                $('#std-number').prop('disabled', true);
                $('#std-number-search').prop('disabled', true);

                // Enable/disable search based on gender selection
                $('#std-section').change(function () {
                    const genderSelected = $(this).val() !== 'null';
                    $('#std-number').prop('disabled', !genderSelected);
                    $('#std-number-search').prop('disabled', !genderSelected);
                });
                $('#std-number-search').click(function (e) {
                    const spinner = $(this).find('i');
                    spinner.removeClass('fa-search').addClass('fa-spinner fa-spin');
                    $.ajax({
                        type: "GET", dataType: "json",
                        url: '{{ route('registration.new-students.getStudentInfo') }}',
                        data: {
                            std_number: $('#std-number').val(),
                            std_section: $('#std-section').val(),
                            form_type: 'new_students'
                        },
                        success: function (data) {
                            spinner.removeClass('fa-spinner fa-spin').addClass('fa-search');
                            $('#std-name').val(data.name).removeClass('is-invalid').addClass('is-valid');
                            $('#std-name-section .alert-danger').addClass('d-none'); // Hide specific alert
                            clearFieldValidation($('#std-name')); // Clear error message from .error-msg-alert
                            // document.getElementById('checkout_gateway').setAttribute('data-course-amount', data.amount);

                            if (data.student) {
                                $('#nationality_studied').val(data.student.nationality_id).trigger('change');
                                $('#country_residence_studied').val(data.student.country_id).trigger('change');
                                $('#city_studied').val(data.student.city);
                                $('#postal_code_studied').val(data.student.postal_code);
                                $('#address_studied').val(data.student.address);
                                $('#id_number_studied').val(data.student.id_number);
                            }
                        },
                        error: function (data) {
                            spinner.removeClass('fa-spinner fa-spin').addClass('fa-search');

                            // Check if the message contains HTML tags
                            const errorMsg = data.responseJSON.msg || 'Error fetching student.';
                            const containsHTML = /<[a-z][\s\S]*>/i.test(errorMsg);

                            // For placeholder, we need to strip HTML tags and use plain text
                            const plainTextMsg = errorMsg.replace(/<[^>]*>/g, '').trim();
                            $('#std-name').val('').attr("placeholder", plainTextMsg || '!').addClass('is-invalid').removeClass('is-valid');

                            if (containsHTML) {
                                $('#std-name').closest('.col-12').find('.error-msg-alert').html(errorMsg).show();
                            } else {
                                $('#std-name').closest('.col-12').find('.error-msg-alert').text(errorMsg).show();
                            }
                        }
                    });
                });

                $('input[name="payment_method"]').change(function () {
                    if (currentFormStep === formSteps.length - 1) {
                        updateUIForStep(currentFormStep);
                    }
                });
                if (currentFormStep === formSteps.length - 1) {
                    updateUIForStep(currentFormStep);
                }

                function clearAllValidationStatesInStep(stepElement) {
                    stepElement.find('.is-invalid').removeClass('is-invalid');
                    stepElement.find('.is-valid').removeClass('is-valid');
                    stepElement.find('.error-msg-alert').empty().hide();
                }

                function setRequiredForTab(tabContentSelector, isRequired) {
                    const container = $(tabContentSelector);
                    container.find('input:not([type=search]):not([type=button]), select, textarea').each(function () {
                        const $field = $(this);
                        let shouldBeRequired = isRequired;

                        if ($field.attr('name') === 'certificate_file' && !$('#certificate-passing-yes').is(':checked')) {
                            shouldBeRequired = false;
                        }
                        if ($field.attr('name') === 'memorized_parts_count' && !$('#memorized-parts-yes').is(':checked')) {
                            shouldBeRequired = false;
                        }
                        if ($field.attr('name') === 'hear_about_textbox' && !$('#hearAbtOther').is(':checked')) {
                            shouldBeRequired = false;
                        }

                        $field.prop('required', shouldBeRequired);
                        if (!shouldBeRequired) clearFieldValidation($field);
                    });

                    container.find('.radio-card-group').each(function () {
                        const $radioInputs = $(this).find('input[type=radio]');
                        if (isRequired && $radioInputs.length > 0) {
                            $radioInputs.first().prop('required', true);
                            $radioInputs.not(':first').prop('required', false);
                        } else {
                            $radioInputs.prop('required', false);
                            if (!isRequired) clearFieldValidation($radioInputs.first());
                        }
                    });
                    if (tabContentSelector === '#newStudentContent') {
                        $('#student_id_file').prop('required', isRequired);
                        if (!isRequired) clearFieldValidation($('#student_id_file'));
                    }
                }

                function updateCommonContactFieldNames(isReturning) {
                    const step2Content = $('#step2Content');
                    const contactInfoCard = step2Content.find('.custom-card:has(i.fa-address-book)'); // Selector for the contact info card
                    const fieldsToModify = [
                        // Selects for country codes
                        {selector: 'select[id="father_whatsApp_select"]', baseName: 'father_whatsApp'},
                        {selector: 'select[id="mother_whatsApp_select"]', baseName: 'mother_whatsApp'},
                        // Inputs for numbers
                        {selector: 'input[id="father_whatsApp_number_input"]', baseName: 'father_whatsApp_number'},
                        {selector: 'input[id="mother_whatsApp_number_input"]', baseName: 'mother_whatsApp_number'},
                        {selector: 'input[name$="father_email"]:not([name^="confirm_"])', baseName: 'father_email'},
                        {selector: 'input[name$="confirm_father_email"]', baseName: 'confirm_father_email'},
                        {selector: 'input[name$="mother_email"]:not([name^="confirm_"])', baseName: 'mother_email'},
                        {selector: 'input[name$="confirm_mother_email"]', baseName: 'confirm_mother_email'},
                        // Preferred language select
                        {selector: 'select[id="preferred_language_common"]', baseName: 'preferred_language'}
                    ];

                    fieldsToModify.forEach(fieldInfo => {
                        // Find elements within the specific contactInfoCard to avoid unintended changes
                        contactInfoCard.find(fieldInfo.selector).each(function () {
                            const $field = $(this);
                            // Ensure we are getting the original base name if it was already modified
                            let currentName = $field.attr('name');
                            let baseNameToUse = fieldInfo.baseName;
                            if (currentName && currentName.includes('_studied')) {
                                baseNameToUse = currentName.replace('_studied', '');
                            }


                            if (isReturning) {
                                if (!currentName || !currentName.endsWith('_studied')) {
                                    $field.attr('name', baseNameToUse + '_studied');
                                }
                            } else {
                                if (currentName && currentName.endsWith('_studied')) {
                                    $field.attr('name', baseNameToUse);
                                }
                            }
                        });
                    });
                }

                $('input[name="study_before"]').change(function () {
                    const isReturning = $(this).val() === 'yes';
                    const step2Content = $('#step2Content');

                    clearAllValidationStatesInStep(step2Content);

                    $('#new_student_additional_info_card').toggleClass('d-none', isReturning);

                    if (isReturning) {
                        $('#returning-student-tab').tab('show');
                        // Hide action buttons to prevent user from proceeding
                        $('.next').addClass('d-none');
                        $('#save').addClass('d-none');
                        $('#favorite_times_section').addClass('d-none');
                        $('#contact_information_card').addClass('d-none');
                        $('#guardian_commitment_card_step2').addClass('d-none');

                        // Clear requirements for both tabs, as this path is a dead end
                        setRequiredForTab('#returningStudentContent', false);
                        setRequiredForTab('#newStudentContent', false);
                    } else {
                        $('#new-student-tab').tab('show');
                        // Show action buttons for the new student path
                        $('.next').removeClass('d-none');
                        $('#save').removeClass('d-none');
                        $('#favorite_times_section').removeClass('d-none');
                        $('#contact_information_card').removeClass('d-none');
                        $('#guardian_commitment_card_step2').removeClass('d-none');

                        // Set requirements correctly for the new student path
                        setRequiredForTab('#returningStudentContent', false);
                        setRequiredForTab('#newStudentContent', true);

                        // update names and re-apply requirements for common fields
                        updateCommonContactFieldNames(isReturning);
                        const contactInfoCard = step2Content.find('.custom-card:has(i.fa-address-book)');
                        contactInfoCard.find('select[name*="father_whatsApp"]').prop('required', true);
                        contactInfoCard.find('input[name*="father_whatsApp_number"]').prop('required', true);
                        contactInfoCard.find('select[name*="mother_whatsApp"]').prop('required', true);
                        contactInfoCard.find('input[name*="mother_whatsApp_number"]').prop('required', true);
                        contactInfoCard.find('input[name*="father_email"]:not([name*="confirm_"])').prop('required', true);
                        contactInfoCard.find('input[name*="confirm_father_email"]').prop('required', true);
                        contactInfoCard.find('input[name*="mother_email"]:not([name*="confirm_"])').prop('required', true);
                        contactInfoCard.find('input[name*="confirm_mother_email"]').prop('required', true);
                        contactInfoCard.find('select[name*="preferred_language"]').prop('required', true);
                    }

                    step2Content.find('.js-select2').select2({theme: "bootstrap-5"});
                    validateField($(this));
                });

                if ($('input[name="study_before"]:checked').length) {
                    $('input[name="study_before"]:checked').trigger('change');
                }

                $('input[name="hear_about_option"]').change(function () {
                    const isOther = $(this).val() === 'other' && $(this).is(':checked');
                    $('#hear_about_textbox').toggleClass('d-none', !isOther).prop('required', isOther);
                    if (isOther) {
                        $('#hidden_hear_about').val('');
                    } else {
                        $('#hidden_hear_about').val($(this).val());
                    }
                    if (!isOther) clearFieldValidation($('#hear_about_textbox'));
                    validateField($(this));
                });
                $('#hear_about_textbox').on('input', function () {
                    if ($('#hearAbtOther').is(':checked')) {
                        $('#hidden_hear_about').val($(this).val());
                    }
                });

                $('input[name="certificate_passing"]').change(function () {
                    const showUpload = $(this).val() === 'yes' && $(this).is(':checked');
                    $('#certificate_file_upload_section').toggleClass('d-none', !showUpload);
                    $('#certificate_file').prop('required', showUpload);
                    if (!showUpload) clearFieldValidation($('#certificate_file'));
                    validateField($(this));
                });

                $('input[name="memorized_parts"]').change(function () {
                    const showCount = $(this).val() === 'yes' && $(this).is(':checked');
                    $('#memorized_parts_count_section').toggleClass('d-none', !showCount);
                    $('#memorized_parts_count').prop('required', showCount);
                    if (!showCount) clearFieldValidation($('#memorized_parts_count'));
                    validateField($(this));
                });

                $('#birthdate').change(function (e) {
                    const birthdateStr = $(this).val();
                    const birthdateAlert = $('#birthdate-alert');
                    if (!birthdateStr) {
                        birthdateAlert.addClass('d-none');
                        return;
                    }
                    const birthdateObj = new Date(birthdateStr);
                    let minBirthdateFor5YO = new Date();
                    minBirthdateFor5YO.setFullYear(minBirthdateFor5YO.getFullYear() - 5);
                    minBirthdateFor5YO.setHours(0, 0, 0, 0);

                    if (birthdateObj > minBirthdateFor5YO) {
                        birthdateAlert.removeClass('d-none');
                    } else {
                        birthdateAlert.addClass('d-none');
                    }
                    validateField($(this));
                });

                if (navigator.cookieEnabled == false) {
                    $('#support-cookies').removeClass('d-none');
                } else {
                    $('#support-cookies').addClass('d-none');
                }

                $('#apply_coupon_btn_action').click(function (e) {
                    const spinner = $(this).find('.fa-spinner');
                    spinner.removeClass('d-none');
                    $('#hidden_apply_coupon').val($('#apply_coupon_field').val());
                    let is_study_before = $('input[name="study_before"]:checked').val();
                    let father_email_val = "";
                    if (is_study_before === 'yes') {
                        father_email_val = $('#returningStudentContent input.father_email_common').val();
                    } else {
                        father_email_val = $('#newStudentContent input.father_email_common').val();
                    }
                    if (!father_email_val && $('#step2Content').find('input.father_email_common:visible').length > 0) {
                        father_email_val = $('#step2Content').find('input.father_email_common:visible').first().val();
                    }

                    document.getElementById('checkout_gateway').setAttribute('data-course-amount',
                        document.getElementById('checkout_gateway').getAttribute('data-base-course-amount'));
                    $('#total_price_summary').text('$' + (Math.round(document.getElementById('checkout_gateway').getAttribute('data-course-amount') * 100) / 100).toFixed(2));

                    $.ajax({
                        type: "GET", dataType: "json", url: '{{ route('registration.new-students.applyCoupon') }}',
                        data: {
                            std_number: $('#std-number').val(),
                            code: $('#apply_coupon_field').val(),
                            study_before: is_study_before,
                            email: father_email_val,
                            branch: 'all'
                        },
                        success: function (data) {
                            document.getElementById('checkout_gateway').setAttribute('data-course-amount', data.price_after_discount);

                            spinner.addClass('d-none');
                            $('#coupon-description').html("{{ __('resubscribe.discount total is') }} $" + data.discount + ". {{ __('resubscribe.and price after discount is') }} $" + data.price_after_discount + ". ").removeClass('text-danger').addClass('text-success');
                            $('#discount_summary_row').removeClass('d-none');
                            $('#discount_amount_summary').text('-$' + data.discount.toFixed(2));
                            $('#total_price_summary').text('$' + data.price_after_discount.toFixed(2));
                            if (typeof window.updateCheckoutAmount === 'function') {
                                window.updateCheckoutAmount(data.price_after_discount);
                            }
                            if (currentFormStep === formSteps.length - 1) {
                                updateUIForStep(currentFormStep);
                            }
                        },
                        error: function (data) {
                            spinner.addClass('d-none');
                            if($('#apply_coupon_field').val().length > 1){
                                $('#coupon-description').html(data.responseJSON.msg || 'Error').addClass('text-danger').removeClass('text-success');
                            }else{
                                $('#coupon-description').html('');
                            }
                            $('#discount_summary_row').addClass('d-none');
                            const originalTotal = parseFloat("{{ $course->price}}");
                            $('#total_price_summary').text('$' + originalTotal.toFixed(2));
                            if (typeof window.updateCheckoutAmount === 'function') {
                                window.updateCheckoutAmount(originalTotal);
                            }
                            if (currentFormStep === formSteps.length - 1) {
                                updateUIForStep(currentFormStep);
                            }
                        }
                    });
                });

                $('#msform').on('submit', function (e) {
                    // Submission spinner logic handled by button click handlers
                });

                $('#pay-button-full-free, #submit-main-form-btn').on('click', function (e) {
                    e.preventDefault();
                    const clickedButton = $(this);
                    if (formSteps.eq(currentFormStep).is('#step3Content')) {
                        if (!validateStepInputs(formSteps.eq(currentFormStep))) {
                            return;
                        }
                    } else {
                        return;
                    }

                    clickedButton.find('.fa-spinner').removeClass('d-none');
                    clickedButton.prop('disabled', true);
                    $('#msform').trigger('submit');
                });

            });
        </script>
        <script>
            window.$zoho = window.$zoho || {};
            $zoho.salesiq = $zoho.salesiq || {ready: function () {}}
        </script>
        <script id="zsiqscript" src="https://salesiq.zohopublic.com/widget?wc=siq9b89e3709d06ed58079dd2fdd41da40c1dc3d804d6a42c014f16c9b36ef93f0d" defer></script>
    </body>
    </html>
