<?php

namespace App\Livewire\Admin\Website\Concerns;

use App\Actions\UploadMediaAction;
use App\Models\Setting;

trait AuthorizesWebsiteAdmin
{
    public function authorizeWebsite(): void
    {
        $this->authorize('viewAny', Setting::class);
    }

    protected function storeUpload(UploadMediaAction $upload, mixed $file, ?string $current, string $folder): ?string
    {
        if (! $file) {
            return $current;
        }

        $upload->delete($current);

        return $upload->execute($file, $folder);
    }
}
