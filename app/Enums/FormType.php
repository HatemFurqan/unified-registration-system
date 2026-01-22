<?php

namespace App\Enums;

class FormType
{
    const REGULAR = 'regular';
    const NEW_STUDENTS = 'new-students';
    const STOPPED_STUDENTS = 'stopped-students';
    const ONE_TO_ONE = 'one_to_one';
    const WORKSHOPS = 'workshops';
    const DAILY_WIRD = 'daily-wird';
    const FOUNDING_DAY = 'founding-day';
    const NEW_STUDENTS_EG = 'new-students-eg';
    const STOPPED_STUDENTS_EG = 'stopped-students-eg';
    const FOUNDING_DAY_EG = 'new-students-founding-day-eg';

    /**
     * الحصول على جميع أنواع الاستمارات
     * 
     * @return array
     */
    public static function all(): array
    {
        return [
            self::REGULAR => 'منتظمين',
            self::NEW_STUDENTS => 'طلاب جدد',
            self::STOPPED_STUDENTS => 'طلاب جدد - سبقت لهم الدراسة',
            self::ONE_TO_ONE => 'فردي',
            self::WORKSHOPS => 'ورش',
            self::DAILY_WIRD => 'الورد اليومي',
            self::FOUNDING_DAY => 'يوم التأسيس',
            self::NEW_STUDENTS_EG => 'طلاب جدد مصر',
            self::STOPPED_STUDENTS_EG => 'طلاب جدد مصر - سبقت لهم الدراسة',
            self::FOUNDING_DAY_EG => 'طلاب جدد مصر - يوم التأسيس',
        ];
    }

    /**
     * التحقق من نوع الاستمارة
     * 
     * @param string $type
     * @return bool
     */
    public static function isValid(string $type): bool
    {
        return in_array($type, array_keys(self::all()));
    }
}
