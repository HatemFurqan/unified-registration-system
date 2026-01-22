<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('استمارات التسجيل الموحدة') }} - Unified Registration System</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    
    <!-- Google Fonts - Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        
        .container {
            max-width: 1200px;
        }
        
        .page-header {
            text-align: center;
            color: white;
            margin-bottom: 50px;
        }
        
        .page-header h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .page-header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .forms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        
        .form-card {
            background: white;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--card-color);
            transition: height 0.3s ease;
        }
        
        .form-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }
        
        .form-card:hover::before {
            height: 100%;
            opacity: 0.05;
        }
        
        .form-card:hover .card-icon {
            transform: scale(1.1) rotate(5deg);
        }
        
        .card-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            background: var(--card-color);
            color: white;
            font-size: 2.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .card-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #2c3e50;
        }
        
        .card-title-en {
            font-size: 1rem;
            color: #7f8c8d;
            margin-bottom: 15px;
            font-weight: 400;
        }
        
        .card-description {
            font-size: 1rem;
            color: #5a6c7d;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        
        .card-arrow {
            display: inline-flex;
            align-items: center;
            color: var(--card-color);
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-card:hover .card-arrow {
            transform: translateX(10px);
        }
        
        [dir="rtl"] .form-card:hover .card-arrow {
            transform: translateX(-10px);
        }
        
        .card-arrow i {
            margin-left: 8px;
        }
        
        [dir="rtl"] .card-arrow i {
            margin-left: 0;
            margin-right: 8px;
        }
        
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2rem;
            }
            
            .forms-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .form-card {
                padding: 25px;
            }
        }
        
        .language-switcher {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }
        
        [dir="rtl"] .language-switcher {
            left: auto;
            right: 20px;
        }
        
        .lang-btn {
            background: rgba(255,255,255,0.9);
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            color: #667eea;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .lang-btn:hover {
            background: white;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <!-- Language Switcher -->
    <div class="language-switcher">
        @if(app()->getLocale() == 'ar')
            <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}" class="lang-btn">
                <i class="fas fa-globe"></i> English
            </a>
        @else
            <a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}" class="lang-btn">
                <i class="fas fa-globe"></i> العربية
            </a>
        @endif
    </div>
    
    <div class="container">
        <div class="page-header">
            <h1>{{ __('استمارات التسجيل الموحدة') }}</h1>
            <p>{{ __('اختر الاستمارة المناسبة لك') }}</p>
        </div>
        
        <div class="forms-grid">
            @foreach($forms as $form)
                <a href="{{ $form['route'] }}" class="form-card" style="--card-color: {{ $form['color'] }}">
                    <div class="card-icon" style="background: {{ $form['color'] }}">
                        <i class="fas {{ $form['icon'] }}"></i>
                    </div>
                    <h3 class="card-title">{{ $form['name'] }}</h3>
                    <p class="card-title-en">{{ $form['name_en'] }}</p>
                    <p class="card-description">
                        @if(app()->getLocale() == 'ar')
                            {{ $form['description'] }}
                        @else
                            {{ $form['description_en'] }}
                        @endif
                    </p>
                    <span class="card-arrow">
                        {{ __('ابدأ الآن') }}
                        @if(app()->getLocale() == 'ar')
                            <i class="fas fa-arrow-left"></i>
                        @else
                            <i class="fas fa-arrow-right"></i>
                        @endif
                    </span>
                </a>
            @endforeach
        </div>
    </div>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
