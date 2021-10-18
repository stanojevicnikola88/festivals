<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class ImageUploaderService {

    public function imageUpload($image, $isUpdate): void
    {
        $uploadsPath = public_path('uploads');
        if($isUpdate) {
            $file_path = $uploadsPath . $image;
            if(File::exists($file_path)) {
                unlink($file_path);
            }
        }
        $image->move($uploadsPath, $image->getClientOriginalName());
    }
}
