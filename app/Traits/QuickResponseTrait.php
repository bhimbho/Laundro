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

    public function makeSuccessResponse () {
        return response()->json(
            ['message' => 'Operation Successful'],
            201
        );
    }

    public function makeDeletedResponse () {
        return response()->json(
            ['message' => 'Deletion Successful'],
            201
        );
    }

    public function makeUpdatedResponse () {
        return response()->json(
            ['message' => 'Record Updated'],
            201
        );
    }

    public function makeCustomErrorResponse ($text) {
        return response()->json(
            ['message' => $text],
            201
        );
    }

    public function makeFailedResponse ($text) {
        return response()->json(
            ['message' => $text],
            404
        );
    }
}