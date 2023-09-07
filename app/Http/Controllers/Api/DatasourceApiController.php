<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DatasourceApiController extends Controller
{
    /**
     * The function retrieves provinces data based on the provided ID or returns all provinces if no ID
     * is provided.
     * 
     * @param Request request The `` parameter is an instance of the `Illuminate\Http\Request`
     * class. It represents an HTTP request made to the server and contains information such as the
     * request method, headers, query parameters, and request body.
     * 
     * @return JsonResponse a JSON response. The response includes the query parameters, status code
     * and message, and the data fetched from the Province model.
     */
    public function provinces(Request $request): JsonResponse
    {
        $id = $request->get('id', null);
        if (empty($id) || is_null($id)) {
            $data = Province::all();
            $status = Response::HTTP_OK;
            $message = 'Data Fetched Successfully';
        } else {
            $data = Province::find($id);
            if ($data) {
                $status = Response::HTTP_OK;
                $message = 'Data Fetched Successfully';

            } else {
                $status = Response::HTTP_NOT_FOUND;
                $message = 'Data Not Found';
            }
        }
        return response()->json([
            'query'  => $request->all(),
            'status' => [
                'code'    => $status,
                'message' => $message
            ],
            'data' => $data
        ], $status);
    }

    /**
     * The function retrieves cities based on an optional ID parameter and returns a JSON response with
     * the query, status code, and data.
     * 
     * @param Request request The  parameter is an instance of the Request class, which
     * represents an HTTP request. It contains information about the request such as the request
     * method, headers, query parameters, and request body.
     * 
     * @return JsonResponse a JSON response. The response includes the query parameters from the
     * request, the status code, and the data.
     */
    public function cities(Request $request): JsonResponse
    {
        $id = $request->get('id', null);
        if (empty($id) || is_null($id)) {
            $data = City::all();
            $status = Response::HTTP_OK;
        } else {
            $data = City::find($id);
            if ($data) {
                $status = Response::HTTP_OK;
            } else {
                $status = Response::HTTP_NOT_FOUND;
            }
        }
        return response()->json([
            'query'  => $request->all(),
            'status' => [
                'code' => $status
            ],
            'data' => $data
        ], $status);
    }
}
