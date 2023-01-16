<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class HotelsController extends Controller
{
    /**
     * Display all hotel data
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return Hotel::all('id','hotel_name', 'city');
    }

    /**
     * Display hotel data by Id
     *
     * @param int $id
     * @return Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $hotelData = Hotel::find($id);

        if (null === $hotelData) {
            return response()->json([
                'success'   => false,
                'message' => 'Hotel not found by id ' . $id
            ], 404);
        }

        return $hotelData;
    }

    /**
     * Store request data 
     *
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateStoreRequestData($request);

        try {
            Hotel::create($request->all());

            return response()->json([
                'success'   => true,
                'message' => 'Hotel successful created!'
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json([
                'success'   => false,
                'message' => 'An error occurred to save the request data ',
            ], 404);
        }
    }

    /**
     * Update Hotel Data
     *
     * @param int $id
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        $this->validateUpdateRequestData($request);

        if (null === $hotelData = Hotel::find($id)) {
            return response()->json([
                'success'   => false,
                'message' => 'Hotel not found by id ' . $id
            ], 404);
        }

        try {
            $hotelData->update($request->all());

            return response()->json([
                'success'   => true,
                'message' => 'Hotel successful updated!'
            ], 200);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            
            return response()->json([
                'success'   => false,
                'message' => 'An error occurred to save the request data',
            ], 404);
        }
    }

    /**
     * Delete Hotel Data
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        if (null === $hotelData = Hotel::find($id)) {
            return response()->json([
                'success'   => false,
                'message' => 'Hotel not found by id ' . $id
            ], 400);
        }
    
        try {
            $hotelData->delete();

            return response()->json([
                'success'   => true,
                'message' => 'Hotel successful deleted'
            ], 200);

            
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            
            return response()->json([
                'success'   => false,
                'message' => 'An error occurred to save the request data',
            ], 404);
        }

    }

    /**
     * Validate Store Requests
     *
     * @param Request $request
     * @return HttpResponseException
     */
    private function validateStoreRequestData(Request $request)
    {
        $rules = [
            'hotel_name' => 'required|max:250',
            'image_url' => 'required|max:250',
            'city' => 'required|max:250',
            'adress' => 'required|max:250',
            'description' => 'required',
            'stars' => 'required|min:1|max:5|numeric',
            'latitude' => 'required|max:250',
            'longitude' => 'required|max:250',
        ];

        $messages = [
            'hotel_name'=> 'hotel_name is required',
            'image_url' => 'image_url is required',
            'city' => 'city is required',
            'address' => 'address is required',
            'description' => 'description is required',
            'stars' => 'stars is required',
            'latitude' => 'latitude is required',
            'longitude' => 'longitude is required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'Validation errors',
                'data'      => $validator->errors()
            ], 400));
        }
    }

    /**
     * Validate Update Requests
     *
     * @param Request $request
     * @return HttpResponseException
     */
    private function validateUpdateRequestData(Request $request)
    {
        $rules = [
            'hotel_name' => 'string|max:250',
            'image_url' => 'string|max:250',
            'city' => 'string|max:250',
            'adress' => 'string|max:250',
            'description' => 'string',
            'stars' => 'numeric|min:1|max:5',
            'latitude' => 'string|max:250',
            'longitude' => 'string|max:250',
        ];

        $messages = [
            'hotel_name'=> 'hotel_name must by a string',
            'image_url' => 'image_url must by a string',
            'city' => 'city must by a string',
            'address' => 'address must by a string',
            'description' => 'description must by a string',
            'stars' => 'stars must be a integer between 1 and 5',
            'latitude' => 'latitude must by a string',
            'longitude' => 'longitude must by a string',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'Validation errors',
                'data'      => $validator->errors()
            ], 400));
        }
    }
}
