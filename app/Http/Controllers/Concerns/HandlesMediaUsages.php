<?php

namespace App\Http\Controllers\Concerns;

use App\Models\MediaUsage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

trait HandlesMediaUsages
{
    protected function syncMediaUsages(Model $model, array $items): void
    {
        $keepIds = [];
        $now = Carbon::now();

        foreach ($items as $item) {
            $uploadId = $item['upload_id'] ?? null;
            if (!$uploadId) {
                continue;
            }

            $type = $item['type'] ?? null;

            $usage = MediaUsage::updateOrCreate(
                [
                    'upload_id' => $uploadId,
                    'ref_type' => $model::class,
                    'ref_id' => $model->id,
                    'type' => $type,
                ],
                [
                    'is_deleted' => false,
                    'deleted_at' => null,
                    'updated_at' => $now,
                ]
            );

            $keepIds[] = $usage->id;
        }

        MediaUsage::where('ref_type', $model::class)
            ->where('ref_id', $model->id)
            ->whereNotIn('id', $keepIds)
            ->update([
                'is_deleted' => true,
                'deleted_at' => $now,
            ]);
    }
}
