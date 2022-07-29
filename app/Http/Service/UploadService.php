<?php
namespace App\Http\Service;

use Illuminate\Support\Facades\Storage;

class UploadService {

    protected $image;

    /**
     * Upload Image
     *
     * @param string $path
     * @param string $image
     * 
     * @return string
     */
    public function upload($path, $image) {
        return Storage::put($path, $image);
    }

    public function upload_unlink($path, $image, $prevPath) {
        Storage::delete($prevPath);
        return $this->upload($path, $image);
    }
}