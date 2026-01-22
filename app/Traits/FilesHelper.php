<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FilesHelper
{
    private $fileName;

    /**
     * رفع ملفات متعددة
     * 
     * @param array $files
     * @param string $location
     * @return array
     */
    protected function uploadMultiFiles(array $files, string $location): array
    {
        $uploadedFiles = [];
        foreach ($files as $key => $file) {
            $uploadedFiles[$key]['url'] = $this->fileUpload($file, $location);
            $uploadedFiles[$key]['name'] = $this->fileName;
        }

        return $uploadedFiles;
    }

    /**
     * رفع ملف واحد
     * 
     * @param object|null $file
     * @param string $location
     * @param string|null $disk
     * @param bool $returnFullUrl
     * @return string|null
     */
    protected function fileUpload(?object $file, string $location, ?string $disk = null, bool $returnFullUrl = false): ?string
    {
        if (!is_file($file)) {
            return null;
        }

        $fileOriginalExtension = $file->getClientOriginalExtension();
        $fileUniqueName = $this->uniqueName($fileOriginalExtension);
        $upload = $file->storeAs($location, $fileUniqueName, $disk);

        if ($returnFullUrl) {
            return Storage::url($upload);
        }
        return $upload;
    }

    /**
     * إنشاء اسم فريد للملف
     * 
     * @param string $extension
     * @return string
     */
    private function uniqueName(string $extension): string
    {
        $this->fileName = time() . '_' . Str::random(6) . '.' . $extension;
        return $this->fileName;
    }
}
