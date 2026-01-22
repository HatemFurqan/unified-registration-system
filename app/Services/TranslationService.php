<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class TranslationService
{
    /**
     * الحصول على جميع الترجمات
     * 
     * @param string $code - رمز اللغة
     * @param string|null $branch - نوع الفرع
     * @return array
     */
    public function getTranslations(string $code, ?string $branch = null): array
    {
        return openJSONFile($code, $branch);
    }

    /**
     * حفظ الترجمات
     * 
     * @param string $code - رمز اللغة
     * @param array $data - البيانات
     * @return void
     */
    public function saveTranslations(string $code, array $data): void
    {
        saveJSONFile($code, $data);
    }

    /**
     * الحصول على ترجمة محددة
     * 
     * @param string $key - مفتاح الترجمة
     * @param string $code - رمز اللغة
     * @param mixed $default - القيمة الافتراضية
     * @return string
     */
    public function getTranslation(string $key, string $code = 'ar', $default = null): string
    {
        $translations = $this->getTranslations($code);
        return $translations[$key] ?? $default ?? $key;
    }

    /**
     * تحديث ترجمة محددة
     * 
     * @param string $key - مفتاح الترجمة
     * @param string $value - القيمة الجديدة
     * @param string $code - رمز اللغة
     * @return void
     */
    public function updateTranslation(string $key, string $value, string $code = 'ar'): void
    {
        $translations = $this->getTranslations($code);
        $translations[$key] = $value;
        $this->saveTranslations($code, $translations);
    }
}
