<?php

namespace App\Http\Controllers;

use App\Exceptions\BadRequest;
use App\Models\House;
use Illuminate\Http\Request;
use Validator;

class SearchController extends Controller
{
    private static function optInt($value): ?int
    {
        if (is_null($value)) {
            return null;
        }

        return intval($value);
    }

    public function search(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'       => 'string|nullable',
                'price_from' => 'integer|nullable',
                'price_to'   => 'integer|nullable',
                'bedrooms'   => 'integer|nullable',
                'bathrooms'  => 'integer|nullable',
                'storeys'    => 'integer|nullable',
                'garages'    => 'integer|nullable',
            ]
        );

        try {
            if ($validator->fails()) {
                throw new BadRequest('validation failed');
            }

            $filter = House::whereRaw('1=1');

            if (($house_name = $request->get('name'))) {
                $filter->where('name', 'like', "%{$house_name}%");
            }
            if (($price_from = self::optInt($request->get('price_from'))) !== null) {
                $filter->where('price', '>=', $price_from);
            }
            if (($price_to = self::optInt($request->get('price_to'))) !== null) {
                $filter->where('price', '<=', $price_to);
            }
            if (($bedrooms = self::optInt($request->get('bedrooms'))) !== null) {
                $filter->where('bedrooms', $bedrooms);
            }
            if (($bathrooms = self::optInt($request->get('bathrooms'))) !== null) {
                $filter->where('bathrooms', $bathrooms);
            }
            if (($storeys = self::optInt($request->get('storeys'))) !== null) {
                $filter->where('storeys', $storeys);
            }
            if (($garages = self::optInt($request->get('garages'))) !== null) {
                $filter->where('garages', $garages);
            }

            return response()->json($filter->get()->toArray());
        } catch (BadRequest $bad_request) {
            return response()->json($validator->errors()->all(), 400);
        }
    }
}
