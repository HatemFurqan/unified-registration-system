<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Thank you') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <style>
        * { margin: 0; padding: 0 }
        html { height: 100% }
        p { color: grey }
        .btn-primary { background-color: #25408F !important; border-color: #25408F !important; }
        #heading { text-transform: uppercase; color: #25408F; font-weight: normal }
        #msform { text-align: center; position: relative; margin-top: 20px; font-family: 'Cairo', sans-serif; }
        #msform fieldset { background: white; border: 0 none; border-radius: 0.5rem; box-sizing: border-box; width: 100%; margin: 0; padding-bottom: 20px; position: relative }
        .form-card { text-align: left }
        #msform fieldset:not(:first-of-type) { display: none }
        .fs-title { font-size: 25px; color: #25408F; margin-bottom: 15px; font-weight: normal; text-align: left }
        .card { z-index: 0; border: none; position: relative }
        #msform .action-button { width: 100px; background: #25408F; font-weight: bold; color: white; border: 0 none; border-radius: 0px; cursor: pointer; padding: 10px 5px; margin: 10px 0px 10px 5px; float: right }
        #msform .action-button:hover, #msform .action-button:focus { background-color: #311B92 }
    </style>
</head>
<body>
<div class="container-fluid">
    @include('partials.front-navbar')
    <div class="row justify-content-center">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2 id="heading">{{ __('Thank you') }}</h2>
                <form id="msform">
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="fs-title text-center">{{ __('Thank you') }}</h2>
                                </div>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success text-center" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger text-center" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                        <a href="{{ route('registration.regular.index') }}" class="next action-button w-100">{{ __('Back to subscribe') }}</a>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
