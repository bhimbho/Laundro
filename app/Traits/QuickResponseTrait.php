<?php
namespace App\Traits;

trait QuickResponseTrait {
    use Tokenizer;
    /**
     * @return json
     * @param Collection|String|Array $data
     * @param int|null $status
     * @param [] $header 
     * @param string|null $options 
     */
    public function makeJsonResponse ($data, $status = null, $headers = [], $options = null) {
        return response()->json(
            $data,
            $status,
            $headers,
            $options
        );
    }
}