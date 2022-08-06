<?php
namespace App\Http\Service;

use App\Models\AttireType;


class AttireTypeService {

    private $uploadService, $attireTypeService;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    /**
     * Store Fields for Attire
     *
     * @param [type] $validated
     * @return void
     */
    public function store($validated) {
        $validated['attire_image'] = $this->uploadService->upload('attires', $validated['attire_image']);
        AttireType::create($validated);
    }

    public function update($validated, $attire) {
        if (array_key_exists('attire_image', $validated)) {
            $attire->attire_image = $this->uploadService->upload_unlink('attires', $validated['attire_image'], $attire->attire_image);
        }

        $attire->title = $validated['title'];
        $attire->save();
    }

    public function getAttire($attire) {
        return AttireType::find($attire);
    }
}