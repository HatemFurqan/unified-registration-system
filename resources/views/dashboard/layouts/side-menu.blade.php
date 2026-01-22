<div class="main-menu menu-fixed menu-light menu-accordion  menu-shadow " data-scroll-to-active="true" >
    <div class="main-menu-content">

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <!-- الرئيسية -->
            <li class="nav-item {{ request()->routeIs('dashboard.home') ? 'active' : '' }}">
                <a href="{{ route('dashboard.home') }}" title="الرئيسية">
                    <i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">الرئيسية</span>
                </a>
            </li>

            <!-- الاشتراكات -->
            @can('عرض-الاشتراكات')
            <li class="nav-item {{ request()->routeIs('dashboard.subscribes.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.subscribes.index') }}" title="الاشتراكات">
                    <i class="la la-users"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">الاشتراكات</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.subscribes.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="la la-list"></i>
                            عرض جميع الاشتراكات
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            <!-- الكوبونات -->
            @can('عرض-الكوبونات')
            <li class="nav-item {{ request()->routeIs('dashboard.coupons.*') || request()->routeIs('dashboard.coupon-logs.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.coupons.index') }}" title="الكوبونات">
                    <i class="ft ft-percent"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">الكوبونات</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.coupons.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="ft ft-percent"></i>
                            عرض جميع الكوبونات
                        </a>
                    </li>
                    @can('اضافة-الكوبونات')
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.coupons.create') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="ft ft-plus-circle"></i>
                            اضافة كوبون جديد
                        </a>
                    </li>
                    @endcan
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.coupon-logs.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="ft ft-file-text"></i>
                            سجل الكوبونات
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            <!-- الدورات واستمارات التسجيل -->
            <li class="nav-item {{ request()->routeIs('dashboard.courses.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.courses.index') }}" title="الدورات">
                    <i class="fa fa-book"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">الدورات</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.courses.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="fa fa-book"></i>
                            جميع استمارات التسجيل
                        </a>
                    </li>
                </ul>
            </li>

            <!-- الأوقات المفضلة -->
            <li class="nav-item {{ request()->routeIs('dashboard.favorite-times.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.favorite-times.index') }}" title="الأوقات المفضلة">
                    <i class="ft ft-clock"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">الأوقات المفضلة</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.favorite-times.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="ft ft-clock"></i>
                            عرض جميع الأوقات
                        </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.favorite-times.create') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="ft ft-plus-circle"></i>
                            اضافة وقت جديد
                        </a>
                    </li>
                </ul>
            </li>

            <!-- الطلاب -->
            @canany(['استيراد-البيانات', 'تصدير-البيانات'])
            <li class="nav-item {{ request()->routeIs('dashboard.import.students.*') || request()->routeIs('dashboard.export.unsubscribed.*') ? 'active' : '' }}">
                <a href="#" title="الطلاب">
                    <i class="fa fa-user-graduate"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">الطلاب</span>
                </a>
                <ul class="menu-content">
                    @can('استيراد-البيانات')
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.import.students.show') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="fa fa-upload"></i>
                            تحديث بيانات الطلاب
                        </a>
                    </li>
                    @endcan
                    @can('تصدير-البيانات')
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.export.unsubscribed.students') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="fa fa-download"></i>
                            تصدير الطلاب غير المسجلين
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcanany

            <!-- الاستيراد والتصدير -->
            @canany(['استيراد-البيانات', 'تصدير-البيانات'])
            <li class="nav-item {{ request()->routeIs('dashboard.import.*') || request()->routeIs('dashboard.export.*') ? 'active' : '' }}">
                <a href="#" title="الاستيراد والتصدير">
                    <i class="fa fa-exchange-alt"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">الاستيراد والتصدير</span>
                </a>
                <ul class="menu-content">
                    @can('استيراد-البيانات')
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.import.students.show') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="fa fa-upload"></i>
                            استيراد الطلاب
                        </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.import.coupons.show') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="fa fa-upload"></i>
                            استيراد الكوبونات
                        </a>
                    </li>
                    @endcan
                    @can('تصدير-البيانات')
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.export.subscribes') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="fa fa-download"></i>
                            تصدير الاشتراكات
                        </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.export.unsubscribed.students') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="fa fa-download"></i>
                            تصدير الطلاب غير المسجلين
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcanany

            <!-- الإعدادات -->
            <li class="nav-item {{ request()->routeIs('dashboard.config.*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.config.createTimeTable') }}" title="الإعدادات">
                    <i class="fa fa-cog"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">الإعدادات</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.config.createTimeTable') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="fa fa-calendar"></i>
                            الجدول الزمني
                        </a>
                    </li>
                </ul>
            </li>

            <!-- النظام (المسؤولين والأدوار) -->
            @canany(['عرض-المسؤولين', 'عرض-الادوار'])
            <li class="nav-item {{ request()->routeIs('dashboard.admins.*') || request()->routeIs('dashboard.roles.*') ? 'active' : '' }}">
                <a href="#" title="النظام">
                    <i class="fa fa-shield-alt"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">النظام</span>
                </a>
                <ul class="menu-content">
                    @can('عرض-المسؤولين')
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.admins.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="ft ft-users"></i>
                            المسؤولين
                        </a>
                    </li>
                    @endcan
                    @can('عرض-الادوار')
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.roles.index') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="ft ft-lock"></i>
                            الأدوار والصلاحيات
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcanany

            <!-- الترجمة -->
            <li class="nav-item {{ request()->routeIs('dashboard.show_translate') ? 'active' : '' }}">
                <a href="#" title="الترجمة">
                    <i class="fa fa-comments"></i>
                    <span class="menu-title" data-i18n="nav.templates.main">الترجمة</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.show_translate', 'ar') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="fa fa-language"></i>
                            ترجمة النصوص العربية
                        </a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{ route('dashboard.show_translate', 'en') }}" data-i18n="nav.templates.vert.classic_menu">
                            <i class="fa fa-language"></i>
                            ترجمة النصوص الانجليزية
                        </a>
                    </li>
                </ul>
            </li>

        </ul>

    </div>
</div>
