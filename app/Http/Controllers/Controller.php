<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\Validator;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Return generic json response with the given data.
     *
     * @param $data
     * @param int $statusCode
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respond($data, $statusCode = 200, $headers = [])
    {
        return response($data, $statusCode, $headers);
    }

    /**
     * Respond with success.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondSuccess()
    {
        return $this->respond(null, 204);
    }

    /**
     * Respond with created.
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondCreated($data)
    {
        return $this->respond($data, 201);
    }

    /**
     * Paginate and filter a collection of items
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $offset
     * @param  Collection $collection
     * @return Collection
     */
    protected function paginate(Collection $collection, $offset = 0)
    {
        if (sizeof($collection)) {
            $offset = app('request')->get('offset', $offset);
            $limit = app('request')->get('limit', $collection->first()->getPerPage());

            if (app('request')->has('offset')) {
                $collection = $collection->slice($offset, $limit)->values();
            }
        }
        return $collection;
    }
}
