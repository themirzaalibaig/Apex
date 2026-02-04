<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use App\Models\Upload;
use App\Models\MediaUsage;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('media:migrate-images {--dry-run}', function () {
    $dryRun = (bool) $this->option('dry-run');
    $createdUploads = 0;
    $createdUsages = 0;

    $this->info($dryRun ? 'Running dry-run migration...' : 'Migrating images to uploads/media_usages...');

    Image::orderBy('id')->chunkById(100, function ($images) use (&$createdUploads, &$createdUsages, $dryRun) {
        foreach ($images as $image) {
            $path = (string) $image->image;
            $isExternal = filter_var($path, FILTER_VALIDATE_URL) !== false;

            $fileName = $path !== '' ? basename(parse_url($path, PHP_URL_PATH) ?? $path) : 'image';
            $publicId = $isExternal
                ? 'ext_' . substr(sha1($path), 0, 16)
                : pathinfo($fileName, PATHINFO_FILENAME);

            $url = $isExternal
                ? $path
                : Storage::disk('public')->url(ltrim($path, '/'));

            $keywords = $image->keywords;
            if (is_string($keywords)) {
                $keywords = array_values(array_filter(array_map('trim', explode(',', $keywords))));
            } elseif (!is_array($keywords)) {
                $keywords = [];
            }

            if (!$dryRun) {
                $upload = Upload::create([
                    'file_name' => $fileName,
                    'public_id' => $publicId,
                    'url' => $url,
                    'resource_type' => 'image',
                    'seo_alt_text' => $image->alt,
                    'seo_meta_title' => $image->title,
                    'seo_meta_description' => $image->caption,
                    'seo_meta_keywords' => $keywords,
                    'is_active' => ($image->status ?? 'active') === 'active',
                    'is_deleted' => false,
                ]);

                MediaUsage::create([
                    'upload_id' => $upload->id,
                    'ref_type' => $image->imageable_type,
                    'ref_id' => $image->imageable_id,
                    'type' => $image->type ?? $image->alt ?? 'default',
                    'is_deleted' => false,
                ]);
            }

            $createdUploads++;
            $createdUsages++;
        }
    });

    $this->info("Uploads created: {$createdUploads}");
    $this->info("Media usages created: {$createdUsages}");
})->purpose('Migrate legacy images table into uploads/media_usages');
