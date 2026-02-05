<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>مجموعة الفرقان للتعليم وتقنية المعلومات</title>
    
    <!-- Bootstrap 5 CSS RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    
    <!-- Google Fonts - Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}">
    
    <link rel="stylesheet" href="{{ asset('css/wizard.css') }}">
</head>
<body>
    <!-- Background Decoration -->
    <div class="bg-decoration">
        <div class="bg-circle bg-circle-1"></div>
        <div class="bg-circle bg-circle-2"></div>
        <div class="bg-circle bg-circle-3"></div>
    </div>

    <!-- Main Wizard Container -->
    <div class="wizard-container">
        <!-- Logos -->
        <div class="wizard-logo">
            <img src="https://eservices.fg2020.com/assets/images/nlogo.png" alt="مجموعة الفرقان للتعليم وتقنية المعلومات">
            <img src="http://furqanshop.com/new-students/images/logo.jpg" alt="مجموعة الفرقان للتعليم وتقنية المعلومات">
        </div>

        <!-- Progress Bar -->
        <div class="wizard-progress" id="wizardProgress">
            <div class="progress-bar-wrapper">
                <div class="progress-bar-fill" id="progressFill"></div>
            </div>
        </div>

        <!-- Wizard Slides Container -->
        <div class="wizard-slides" id="wizardSlides">
            
            <!-- الشاشة الافتراضية الأولى - Slide 1 -->
            <div class="wizard-slide active" data-slide="1">
                <div class="slide-content">
                    <div class="slide-icon welcome-icon">
                        <i class="fas fa-mosque"></i>
                    </div>
                    <h1 class="slide-title">مجموعة الفرقان ترحب بك</h1>
                    <p class="slide-subtitle">ابحث عن مسار تعليمي لـ :</p>
                    
                    <div class="options-container">
                        <button class="option-btn" data-next="2" data-answer="self">
                            <span class="option-icon"><i class="fas fa-user"></i></span>
                            <span class="option-text">لنفسي</span>
                            <span class="option-arrow"><i class="fas fa-chevron-left"></i></span>
                        </button>
                        <button class="option-btn" data-next="2" data-answer="children">
                            <span class="option-icon"><i class="fas fa-child"></i></span>
                            <span class="option-text">لأبنائي</span>
                            <span class="option-arrow"><i class="fas fa-chevron-left"></i></span>
                        </button>
                        <button class="option-btn" data-next="10" data-answer="family">
                            <span class="option-icon"><i class="fas fa-users"></i></span>
                            <span class="option-text">لأسرتي</span>
                            <span class="option-arrow"><i class="fas fa-chevron-left"></i></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- شاشة 2 - Slide 2 -->
            <div class="wizard-slide" data-slide="2">
                <div class="slide-content">
                    <div class="slide-icon">
                        <i class="fas fa-route"></i>
                    </div>
                    <h1 class="slide-title">تعرَّف على نظام الفرقان الأنسب لك</h1>
                    <p class="slide-subtitle">حدد المسار الذي ترغب فيه :</p>
                    
                    <div class="options-container">
                        <button class="option-btn option-external" data-external="https://nooraniya.furqangroup.com" data-answer="nooraniya">
                            <span class="option-icon"><i class="fas fa-book-quran"></i></span>
                            <span class="option-text">القاعدة النورانية</span>
                            <span class="option-external-icon"><i class="fas fa-external-link-alt"></i></span>
                        </button>
                        <button class="option-btn option-external" data-external="https://tilawah.furqangroup.com" data-answer="tilawah">
                            <span class="option-icon"><i class="fas fa-microphone-alt"></i></span>
                            <span class="option-text">تصحيح التلاوة</span>
                            <span class="option-external-icon"><i class="fas fa-external-link-alt"></i></span>
                        </button>
                        <button class="option-btn" data-next="8" data-answer="memorization">
                            <span class="option-icon"><i class="fas fa-brain"></i></span>
                            <span class="option-text">حفظ القرأن الكريم</span>
                            <span class="option-arrow"><i class="fas fa-chevron-left"></i></span>
                        </button>
                    </div>
                    
                    <div class="help-link-container">
                        <button class="help-link" data-next="3">
                            <i class="fas fa-question-circle"></i>
                            <span>اضغط هنا للمساعدة فى تحديد المسار المناسب لك</span>
                        </button>
                    </div>
                </div>
                <button class="back-btn" data-prev="1">
                    <i class="fas fa-arrow-right"></i>
                    <span>رجوع</span>
                </button>
            </div>

            <!-- شاشة 3 - Slide 3 -->
            <div class="wizard-slide" data-slide="3">
                <div class="slide-content">
                    <div class="slide-icon help-icon">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h1 class="slide-title">مساعدة فى اختيار المسار</h1>
                    <p class="slide-subtitle section-label">مستوى اللغة العربية</p>
                    
                    <!-- Sub-question container -->
                    <div class="sub-questions-container">
                        <!-- س1 -->
                        <div class="sub-question active" data-subq="1">
                            <p class="question-text">هل تتحدث اللغة العربية بطلاقة؟</p>
                            <div class="options-container options-horizontal">
                                <button class="option-btn option-small" data-subq-next="2" data-answer="arabic_yes">
                                    <span class="option-text">نعم</span>
                                </button>
                                <button class="option-btn option-small" data-subq-next="2" data-answer="arabic_no">
                                    <span class="option-text">لا</span>
                                </button>
                            </div>
                        </div>
                        
                        <!-- س2 -->
                        <div class="sub-question" data-subq="2">
                            <p class="question-text">كيف تقيم مستواك فى قرأة القرأن الكريم؟</p>
                            <div class="options-container">
                                <button class="option-btn option-small" data-subq-next="3" data-answer="level_advanced">
                                    <span class="option-text">متقدم</span>
                                </button>
                                <button class="option-btn option-small" data-next="4" data-answer="level_acceptable">
                                    <span class="option-text">مقبول</span>
                                </button>
                                <button class="option-btn option-small" data-next="4" data-answer="level_beginner">
                                    <span class="option-text">مبتدئ</span>
                                </button>
                            </div>
                        </div>
                        
                        <!-- س3 -->
                        <div class="sub-question" data-subq="3">
                            <p class="question-text">هل ترغب فى ان تكون معلماً للقاعدة النورانية؟</p>
                            <div class="options-container options-horizontal">
                                <button class="option-btn option-small option-external" data-external="https://teacher.furqangroup.com" data-answer="teacher_yes">
                                    <span class="option-text">نعم</span>
                                </button>
                                <button class="option-btn option-small" data-next="5" data-answer="teacher_no">
                                    <span class="option-text">لا</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="back-btn" data-prev="2">
                    <i class="fas fa-arrow-right"></i>
                    <span>رجوع</span>
                </button>
            </div>

            <!-- شاشة 4 - Slide 4 -->
            <div class="wizard-slide" data-slide="4">
                <div class="slide-content">
                    <div class="slide-icon recommendation-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h1 class="slide-title">بناءا على اختياراتكم نرشح لكم، دورة القاعدة النورانية</h1>
                    
                    <p class="question-text">كيف ترغب فى الحصول على دورة القاعدة النورانية؟</p>
                    
                    <div class="options-container">
                        <button class="option-btn option-detailed option-external" data-external="https://nooraniya-intensive.furqangroup.com" data-answer="nooraniya_intensive">
                            <span class="option-icon"><i class="fas fa-bolt"></i></span>
                            <div class="option-content">
                                <span class="option-text">مكثفة 10 ايام</span>
                                <span class="option-desc">الخيار الافضل لمن للا يستطيع القرأة باحكام التجويد</span>
                            </div>
                        </button>
                        <button class="option-btn option-detailed option-external" data-external="https://nooraniya-classes.furqangroup.com" data-answer="nooraniya_classes">
                            <span class="option-icon"><i class="fas fa-chalkboard-teacher"></i></span>
                            <div class="option-content">
                                <span class="option-text">فصول تعليمية 5 ايام فى الاسبوع</span>
                                <span class="option-desc">الخيار الافضل لمن لديه فكرة مسبقة عن احكام التجويد</span>
                            </div>
                        </button>
                    </div>
                </div>
                <button class="back-btn" data-prev="3">
                    <i class="fas fa-arrow-right"></i>
                    <span>رجوع</span>
                </button>
            </div>

            <!-- شاشة 5 - Slide 5 -->
            <div class="wizard-slide" data-slide="5">
                <div class="slide-content">
                    <div class="slide-icon">
                        <i class="fas fa-clipboard-question"></i>
                    </div>
                    <h1 class="slide-title">المساعدة</h1>
                    <p class="question-text">كم تحفظ من القران الكريم؟</p>
                    
                    <div class="options-container">
                        <button class="option-btn" data-next="6" data-answer="memorize_full">
                            <span class="option-text">احفظ القران الكريم كاملاً حفظاً متقناً</span>
                            <span class="option-arrow"><i class="fas fa-chevron-left"></i></span>
                        </button>
                        <button class="option-btn" data-next="8" data-answer="memorize_less_3">
                            <span class="option-text">احفظ اقل من 3 أجزاء</span>
                            <span class="option-arrow"><i class="fas fa-chevron-left"></i></span>
                        </button>
                        <button class="option-btn" data-next="8" data-answer="memorize_short">
                            <span class="option-text">احفظ قصار السور / لا احفظ</span>
                            <span class="option-arrow"><i class="fas fa-chevron-left"></i></span>
                        </button>
                        <button class="option-btn" data-next="7" data-answer="no_memorize">
                            <span class="option-text">لا ارغب في الحفظ</span>
                            <span class="option-arrow"><i class="fas fa-chevron-left"></i></span>
                        </button>
                    </div>
                </div>
                <button class="back-btn" data-prev="3">
                    <i class="fas fa-arrow-right"></i>
                    <span>رجوع</span>
                </button>
            </div>

            <!-- شاشة 6 - Slide 6 -->
            <div class="wizard-slide" data-slide="6">
                <div class="slide-content">
                    <div class="slide-icon success-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <h1 class="slide-title">تعرَّف على المسار الأنسب لك</h1>
                    <p class="slide-subtitle">حدد المسار الذي ترغب فيه:</p>
                    
                    <div class="options-container">
                        <button class="option-btn option-detailed option-external" data-external="https://tamkeen.furqangroup.com" data-answer="path_tamkeen">
                            <span class="option-icon"><i class="fas fa-gem"></i></span>
                            <div class="option-content">
                                <span class="option-text">مسار التمكين</span>
                            </div>
                            <a href="#" class="info-link" onclick="event.stopPropagation(); showInfo('tamkeen');">
                                <i class="fas fa-info-circle"></i>
                                <span>للمزيد من المعلومات حول مسار التمكين اضغط هنا</span>
                            </a>
                        </button>
                        <button class="option-btn option-detailed option-external" data-external="https://tilawah-correction.furqangroup.com" data-answer="path_tilawah_correction">
                            <span class="option-icon"><i class="fas fa-microphone-alt"></i></span>
                            <div class="option-content">
                                <span class="option-text">مسار تصحيح التلاوة</span>
                            </div>
                            <a href="#" class="info-link" onclick="event.stopPropagation(); showInfo('tilawah');">
                                <i class="fas fa-info-circle"></i>
                                <span>للمزيد من المعلومات حول تصحيح التلاوة اضغط هنا</span>
                            </a>
                        </button>
                    </div>
                </div>
                <button class="back-btn" data-prev="5">
                    <i class="fas fa-arrow-right"></i>
                    <span>رجوع</span>
                </button>
            </div>

            <!-- شاشة 7 - Slide 7 -->
            <div class="wizard-slide" data-slide="7">
                <div class="slide-content">
                    <div class="slide-icon">
                        <i class="fas fa-road"></i>
                    </div>
                    <h1 class="slide-title">تعرف على المسار الأنسب لك</h1>
                    <p class="slide-subtitle">حدد المسار الذي ترغب فيه:</p>
                    
                    <div class="options-container">
                        <button class="option-btn option-detailed option-external" data-external="https://tilawah.furqangroup.com" data-answer="path_tilawah">
                            <span class="option-icon"><i class="fas fa-microphone-alt"></i></span>
                            <div class="option-content">
                                <span class="option-text">مسار التلاوة</span>
                            </div>
                            <a href="#" class="info-link" onclick="event.stopPropagation(); showInfo('tilawah_path');">
                                <i class="fas fa-info-circle"></i>
                                <span>للمزيد من المعلومات حول مستوى التلاوة اضغط هنا</span>
                            </a>
                        </button>
                        <button class="option-btn option-detailed option-external" data-external="{{ route('registration.daily-wird.index') }}" data-answer="path_daily_wird">
                            <span class="option-icon"><i class="fas fa-book-reader"></i></span>
                            <div class="option-content">
                                <span class="option-text">مسار الورد اليومي</span>
                            </div>
                            <a href="#" class="info-link" onclick="event.stopPropagation(); showInfo('daily_wird');">
                                <i class="fas fa-info-circle"></i>
                                <span>للمزيد من المعلومات حول مسار الورد اليومي اضغط هنا</span>
                            </a>
                        </button>
                    </div>
                </div>
                <button class="back-btn" data-prev="5">
                    <i class="fas fa-arrow-right"></i>
                    <span>رجوع</span>
                </button>
            </div>

            <!-- شاشة 8 - Slide 8 -->
            <div class="wizard-slide" data-slide="8">
                <div class="slide-content">
                    <div class="slide-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h1 class="slide-title">تعرف على نظام الفرقان الأنسب لك</h1>
                    <p class="slide-subtitle">حدد نوع الفصل الذي ترغب في الالتحاق به في مسار الحفظ</p>
                    
                    <div class="options-container">
                        <button class="option-btn option-detailed option-external" data-external="{{ route('registration.regular.index') }}" data-answer="system_regular">
                            <span class="option-icon"><i class="fas fa-users"></i></span>
                            <div class="option-content">
                                <span class="option-text">للاشتراك في نظام الحفظ العام اضغط هنا</span>
                            </div>
                            <a href="#" class="info-link" onclick="event.stopPropagation(); showInfo('regular_system');">
                                <i class="fas fa-info-circle"></i>
                                <span>للتعرف على نظام الحفظ العام اضغط هنا</span>
                            </a>
                        </button>
                        <button class="option-btn option-detailed option-external" data-external="{{ route('registration.new-students.index') }}" data-answer="system_quad">
                            <span class="option-icon"><i class="fas fa-user-friends"></i></span>
                            <div class="option-content">
                                <span class="option-text">للاشتراك في نظام الحفظ الرباعي اضغط هنا</span>
                            </div>
                            <a href="#" class="info-link" onclick="event.stopPropagation(); showInfo('quad_system');">
                                <i class="fas fa-info-circle"></i>
                                <span>للتعرف على نظام الحفظ الرباعي اضغط هنا</span>
                            </a>
                        </button>
                        <button class="option-btn option-detailed option-external" data-external="{{ route('registration.one-to-one.index') }}" data-answer="system_individual">
                            <span class="option-icon"><i class="fas fa-user"></i></span>
                            <div class="option-content">
                                <span class="option-text">للاشتراك في نظام الحفظ الفردي اضغط هنا</span>
                            </div>
                            <a href="#" class="info-link" onclick="event.stopPropagation(); showInfo('individual_system');">
                                <i class="fas fa-info-circle"></i>
                                <span>للتعرف على نظام الحفظ الفردي اضغط هنا</span>
                            </a>
                        </button>
                    </div>
                    
                    <div class="other-paths-link">
                        <button class="help-link" data-next="2">
                            <i class="fas fa-th-list"></i>
                            <span>للتعرف على المسارات الأخرى المتاحة اضغط هنا</span>
                        </button>
                    </div>
                </div>
                <button class="back-btn" data-prev="2">
                    <i class="fas fa-arrow-right"></i>
                    <span>رجوع</span>
                </button>
            </div>

            <!-- شاشة 10 - Slide 10 -->
            <div class="wizard-slide" data-slide="10">
                <div class="slide-content">
                    <div class="slide-icon family-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h1 class="slide-title">تعرَّف على نظام الفرقان الأنسب لك</h1>
                    <p class="slide-subtitle">حدد افراد الاسرة الراغبين فى الالتحاق:</p>
                    
                    <div class="family-selection-container">
                        <!-- الاب -->
                        <div class="family-member-row">
                            <div class="member-info">
                                <span class="member-icon"><i class="fas fa-male"></i></span>
                                <span class="member-name">الاب</span>
                            </div>
                            <div class="member-path">
                                <select class="path-select" id="father_path">
                                    <option value="">اختيار المسار المطلوب</option>
                                    <option value="nooraniya">القاعدة النورانية</option>
                                    <option value="tilawah">تصحيح التلاوة</option>
                                    <option value="memorization">حفظ القرأن الكريم</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- الام -->
                        <div class="family-member-row">
                            <div class="member-info">
                                <span class="member-icon"><i class="fas fa-female"></i></span>
                                <span class="member-name">الام</span>
                            </div>
                            <div class="member-path">
                                <select class="path-select" id="mother_path">
                                    <option value="">اختيار المسار المطلوب</option>
                                    <option value="nooraniya">القاعدة النورانية</option>
                                    <option value="tilawah">تصحيح التلاوة</option>
                                    <option value="memorization">حفظ القرأن الكريم</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Children Container -->
                        <div id="childrenContainer">
                        </div>
                        
                        <!-- Add Child Button -->
                        <button class="add-child-btn" id="addChildBtn">
                            <i class="fas fa-plus-circle"></i>
                            <span>إضافة ابن/ابنة</span>
                        </button>
                    </div>
                    
                    <div class="family-submit-container">
                        <button class="submit-family-btn" id="submitFamilyBtn">
                            <span>متابعة</span>
                            <i class="fas fa-arrow-left"></i>
                        </button>
                    </div>
                </div>
                <button class="back-btn" data-prev="1">
                    <i class="fas fa-arrow-right"></i>
                    <span>رجوع</span>
                </button>
            </div>

        </div>

        <!-- Footer -->
        <div class="wizard-footer">
            <p>© {{ date('Y') }} مجموعة الفرقان للتعليم وتقنية المعلومات</p>
        </div>
    </div>

    <!-- Info Modal -->
    <div class="info-modal" id="infoModal">
        <div class="info-modal-content">
            <button class="info-modal-close" onclick="closeInfo()">
                <i class="fas fa-times"></i>
            </button>
            <div class="info-modal-body" id="infoModalBody">
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/wizard.js') }}"></script>
</body>
</html>
