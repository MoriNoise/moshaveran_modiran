<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
    public function getFileUrl(?string $fileName, string $defaultPath, string $disk = 'public'): string
    {
        if (!$fileName || !Storage::disk($disk)->exists($fileName)) {
            return asset($defaultPath);
        }
        return asset("storage/{$fileName}");
    }

    public function getFirstFileUrl($model, string $defaultPath, string $disk = 'public'): string
    {
        $fileName = $model?->files?->first()?->filename;
        return $this->getFileUrl($fileName, $defaultPath, $disk);
    }

    public function getSecondFileUrl($model, string $defaultPath, string $disk = 'public'): string
    {
        $fileName = $model?->files?->get(1)?->filename;
        if (!$fileName || !Storage::disk($disk)->exists($fileName)) {
            return $this->getFirstFileUrl($model, $defaultPath, $disk);
        }
        return $this->getFileUrl($fileName, $defaultPath, $disk);
    }


    public function getModelImageUrl(
        $model,
        string $defaultPath,
        int $index = 0,
        string $disk = 'public'
    ): string {
        $fileName = $model?->files?->get($index)?->filename;

        if (!$fileName && $index > 0) {
            return $this->getModelImageUrl($model, $defaultPath, 0, $disk);
        }

        return $this->getFileUrl($fileName, $defaultPath, $disk);
    }
}
