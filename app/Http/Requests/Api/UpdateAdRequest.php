<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class UpdateAdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        $additional_data = [];

        $data = [

            // Basic Info :

            'for_rent' => 'nullable|boolean',
            'category_id' => 'nullable|exists:categories,id',
            'license_number' => 'nullable',
            'price' => 'nullable|integer',
            'currency_id' => 'nullable|exists:currencies,id',
            'area' => 'nullable|integer',
            'length' => 'nullable|integer',
            'width' => 'nullable|integer',
            'advertiser_relationship_with_property' => 'nullable|in:0,1,2',
            'description' => 'nullable|string',
            'map_latitude' => 'nullable',
            'map_longitude' => 'nullable',
            'property_age' => 'nullable|integer',
            'neighborhood_id' => 'nullable|exists:neighborhoods,id',
            'files' => 'nullable|array',
            'files.description' => 'nullable|string',
            'renting_duration' => 'nullable|in:0,1,2',
        ];

        if ($request->category_id == 1) {
            $additional_data = [

                'street_width' => 'nullable|integer',
                'number_of_rooms' => 'nullable|integer',
                'number_of_living_rooms' => 'nullable|integer',
                'number_of_bathrooms' => 'nullable|integer',
                'floor_number' => 'nullable|integer',
                'furnished' => 'nullable|boolean',
                'families_or_singles' => 'nullable|in:0,1,2',
                'kitchen' => 'nullable|boolean',
                'two_entrance' => 'nullable|boolean',
                'in_villa' => 'nullable|boolean',
                'sewerage_supply' => 'nullable|boolean',
                'private_roof' => 'nullable|boolean',
                'electricity_supply' => 'nullable|boolean',
                'water_supply' => 'nullable|boolean',
                'air_conditioner' => 'nullable|boolean',
                'attachment' => 'nullable|boolean',
                'car_entrance' => 'nullable|boolean',
                'elevator' => 'nullable|boolean',
                'private_entrance' => 'nullable|boolean',

            ];
        } elseif ($request->category_id == 2) {
            $additional_data = [
                'Interface' => 'nullable|in: 
                0, 1, 2, 3,
                4, 5, 6, 7, 8, 9',
                'purpose' => 'nullable|in:0,1,2',
                'street_width' => 'nullable|integer',

                'water_supply' => 'nullable|boolean',
                'electricity_supply' => 'nullable|boolean',

                'sewerage_supply' => 'nullable|boolean',
            ];
        } elseif ($request->category_id == 3) {
            $additional_data = [

                'Interface' => 'nullable|in: 
                0, 1, 2, 3,
                4, 5, 6, 7, 8, 9',
                'street_width' => 'nullable|integer',
                'number_of_rooms' => 'nullable|integer',
                'number_of_apartments' => 'nullable|integer',
                'number_of_living_rooms' => 'nullable|integer',
                'number_of_bathrooms' => 'nullable|integer',
                'kitchen' => 'nullable|boolean',
                'furnished' => 'nullable|boolean',
                'driver_room' => 'nullable|boolean',
                'air_conditioner' => 'nullable|boolean',
                'maid_room' => 'nullable|boolean',
                'swimming_pool' => 'nullable|boolean',
                'attachment' => 'nullable|boolean',
                'car_entrance' => 'nullable|boolean',
                'elevator' => 'nullable|boolean',
                'basement' => 'nullable|boolean',
                'living_room_stairs' => 'nullable|boolean',
                'verse' => 'nullable|boolean',
                'water_supply' => 'nullable|boolean',
                'electricity_supply' => 'nullable|boolean',
                'sewerage_supply' => 'nullable|boolean',
                'duplex' => 'nullable|boolean',
                'playground' => 'nullable|boolean',
            ];
        } elseif ($request->category_id == 4) {
            $additional_data = [
                'street_width' => 'nullable|integer',

                'number_of_rooms' => 'nullable|integer',
                'number_of_living_rooms' => 'nullable|integer',
                'number_of_bathrooms' => 'nullable|integer',

                'floor_number' => 'nullable|integer',

                // additional
                'furnished' => 'nullable|boolean',
                'water_supply' => 'nullable|boolean',
                'air_conditioner' => 'nullable|boolean',
                'car_entrance' => 'nullable|boolean',
                'in_villa' => 'nullable|boolean',
                'sewerage_supply' => 'nullable|boolean',
                'electricity_supply' => 'nullable|boolean',
                'elevator' => 'nullable|boolean',
                'two_entrance' => 'nullable|boolean',
                'private_entrance' => 'nullable|boolean',
            ];
        } elseif ($request->category_id == 5) {
            $additional_data = [
                'purpose' => 'nullable|in: 0,1,2',

                'Interface' => 'nullable|in: 
                0, 1, 2, 3,
                4, 5, 6, 7, 8, 9',
                'street_width' => 'nullable|integer',
                'number_of_rooms' => 'nullable|integer',
                'number_of_apartment' => 'nullable|integer',
                'number_of_shops' => 'nullable|integer',

                // additional
                'furnished' => 'nullable|boolean',
                'private_entrance' => 'nullable|boolean',
                'sewerage_supply' => 'nullable|boolean',
                'basement' => 'nullable|boolean',
                'water_supply' => 'nullable|boolean',
                'electricity_supply' => 'nullable|boolean',
            ];
        } elseif ($request->category_id == 6) {
            $additional_data = [
                'Interface' => 'nullable|in: 
                0, 1, 2, 3,
                4, 5, 6, 7, 8, 9',
                'street_width' => 'nullable|integer',

                // additional
                'water_supply' => 'nullable|boolean',
                'electricity_supply' => 'nullable|boolean',
                'sewerage_supply' => 'nullable|boolean',
            ];
        } elseif ($request->category_id == 7) {
            $additional_data = [

                'Interface' => 'nullable|in: 
                0, 1, 2, 3,
                4, 5, 6, 7, 8, 9',

                'street_width' => 'nullable|integer',
                'number_of_rooms' => 'nullable|integer',
                'number_of_living_rooms' => 'nullable|integer',
                'number_of_bathrooms' => 'nullable|integer',

                'renting_duration' => 'nullable|in:0,1,2',

                // additional
                'kitchen' => 'nullable|boolean',
                'furnished' => 'nullable|boolean',
                'driver_room' => 'nullable|boolean',
                'maid_room' => 'nullable|boolean',
                'verse' => 'nullable|boolean',
                'attachment' => 'nullable|boolean',
                'car_entrance' => 'nullable|boolean',
                'playground' => 'nullable|boolean',
                'sewerage_supply' => 'nullable|boolean',
                'electricity_supply' => 'nullable|boolean',
                'water_supply' => 'nullable|boolean',
            ];
        } elseif ($request->category_id == 8) {
            $additional_data = [
                'Interface' => 'nullable|in: 
                0, 1, 2, 3,
                4, 5, 6, 7, 8, 9',

                'number_of_trees' => 'nullable|integer',
                'number_of_wells' => 'nullable|integer',
                'street_width' => 'nullable|integer',

                // additional
                'verse' => 'nullable|boolean',

                'water_supply' => 'nullable|boolean',
                'sewerage_supply' => 'nullable|boolean',
                'electricity_supply' => 'nullable|boolean',
                'number_of_rooms' => 'nullable|integer',
                'number_of_living_rooms' => 'nullable|integer',
                'number_of_bathrooms' => 'nullable|integer',
                'kitchen' => 'nullable|boolean',
                'amusement_park_games' => 'nullable|boolean',
                'car_entrance' => 'nullable|boolean',
                'swimming_pool' => 'nullable|boolean',
                'football_field' => 'nullable|boolean',
                'voleyball_field' => 'nullable|boolean',
                'families_or_singles' => 'nullable|in:0,1,2',

            ];
        } elseif ($request->category_id == 9) {
            $additional_data = [
                'Interface' => 'nullable|in: 
                0, 1, 2, 3,
                4, 5, 6, 7, 8, 9',

                'number_of_rooms' => 'nullable|integer',
                'number_of_living_rooms' => 'nullable|integer',
                'number_of_bathrooms' => 'nullable|integer',

                'families_or_singles' => 'nullable|in:0,1,2',
                'street_width' => 'nullable|integer',

                // additional

                'sewerage_supply' => 'nullable|boolean',
                'electricity_supply' => 'nullable|boolean',
                'water_supply' => 'nullable|boolean',
                'pool' => 'nullable|boolean',
                'football_field' => 'nullable|boolean',
                'volleyball_field' => 'nullable|boolean',
                'verse' => 'nullable|boolean',
                'amusement_park_games' => 'nullable|boolean',
                'family_area' => 'nullable|boolean',
                'car_entrance' => 'nullable|boolean',
                'kitchen' => 'nullable|boolean',
            ];
        } elseif ($request->category_id == 10) {
            $additional_data = [
                'Interface' => 'nullable|in: 
                0, 1, 2, 3,
                4, 5, 6, 7, 8, 9',

                'street_width' => 'nullable|integer',
                'furnished' => 'nullable|boolean',
                'sewerage_supply' => 'nullable|boolean',
                'electricity_supply' => 'nullable|boolean',
                'water_supply' => 'nullable|boolean',

            ];
        } elseif ($request->category_id == 11) {
            $additional_data = [
                'Interface' => 'nullable|in: 
                0, 1, 2, 3,
                4, 5, 6, 7, 8, 9',

                'street_width' => 'nullable|integer',

            ];
        } elseif ($request->category_id == 12) {
            $additional_data = [

                'renting_duration' => 'nullable|in:0, 1, 2',

                // additional
                'family_area' => 'nullable|boolean',
                'water_supply' => 'nullable|boolean',
                'electricity_supply' => 'nullable|boolean',
                'sewerage_supply' => 'nullable|boolean',

            ];
        } elseif ($request->category_id == 13) {
            $additional_data = [

                'renting_duration' => 'nullable|in:0, 1, 2',

                // additional
                'kitchen' => 'nullable|boolean',
                'furnished' => 'nullable|boolean',
                'street_width' => 'nullable|integer',
                'water_supply' => 'nullable|boolean',
                'electricity_supply' => 'nullable|boolean',
                'sewerage_supply' => 'nullable|boolean',
            ];
        } elseif ($request->category_id == 14) {
            $additional_data = [

                'street_width' => 'nullable|integer',
                'number_of_rooms' => 'nullable|integer',
                'floor_number' => 'nullable|integer',
                'number_of_living_rooms' => 'nullable|integer',
                'number_of_bathrooms' => 'nullable|integer',

                // additional
                'kitchen' => 'nullable|boolean',
                'furnished' => 'nullable|boolean',
                'attachment' => 'nullable|boolean',
                'elevator' => 'nullable|boolean',
                'private_entrance' => 'nullable|boolean',
                'two_entrance' => 'nullable|boolean',
                'in_villa' => 'nullable|boolean',
                'water_supply' => 'nullable|boolean',
                'electricity_supply' => 'nullable|boolean',
                'sewerage_supply' => 'nullable|boolean',
                'air_conditioner' => 'nullable|boolean',
                'families_or_singles' => 'nullable|in:0,1,2',
                'private_roof' => 'nullable|boolean',
            ];
        } elseif ($request->category_id == 15) {
            $additional_data = [

                'street_width' => 'nullable|integer',
                'number_of_rooms' => 'nullable|integer',
                'number_of_living_rooms' => 'nullable|integer',
                'number_of_bathrooms' => 'nullable|integer',

                // additional
                'kitchen' => 'nullable|boolean',
                'pool' => 'nullable|boolean',
                'car_entrance' => 'nullable|boolean',
                'families_or_singles' => 'nullable|in:0,1,2',
                'football_field' => 'nullable|boolean',
                'volleyball_field' => 'nullable|boolean',
                'amusement_park_games' => 'nullable|boolean',
                'family_area' => 'nullable|boolean',
                'verse' => 'nullable|boolean',
                'water_supply' => 'nullable|boolean',
                'electricity_supply' => 'nullable|boolean',
                'sewerage_supply' => 'nullable|boolean',
            ];
        } elseif ($request->category_id == 16) {
            $additional_data = [

                'street_width' => 'nullable|integer',

                'number_of_rooms' => 'nullable|integer',
                'number_of_living_rooms' => 'nullable|integer',

                'floor_number' => 'nullable|integer',

                // additional

                'families_or_singles' => 'nullable|in:0,1,2',

                'sewerage_supply' => 'nullable|boolean',

                'furnished' => 'nullable|boolean',
                'kitchen' => 'nullable|boolean',
                'private_roof' => 'nullable|boolean',
                'in_villa' => 'nullable|boolean',
                'two_entrance' => 'nullable|boolean',
                'private_entrance' => 'nullable|boolean',
                'elevator' => 'nullable|boolean',
                'electricity_supply' => 'nullable|boolean',
                'water_supply' => 'nullable|boolean',
                'air_conditioner' => 'nullable|boolean',
                'attachment' => 'nullable|boolean',
                'car_entrance' => 'nullable|boolean',
            ];
        } elseif ($request->category_id == 17) {
            $additional_data = [
                'Interface' => 'nullable|in: 
                0, 1, 2, 3,
                4, 5, 6, 7, 8, 9',
                'street_width' => 'nullable|integer',
                'number_of_rooms' => 'nullable|integer',
                'number_of_living_rooms' => 'nullable|integer',
                'number_of_bathrooms' => 'nullable|integer',

                // additional
                'kitchen' => 'nullable|boolean',
                'amusement_park_games' => 'nullable|boolean',
                'air_conditioner' => 'nullable|boolean',
                'driver_room' => 'nullable|boolean',
                'maid_room' => 'nullable|boolean',
                'swimming_pool' => 'nullable|boolean',
                'attachment' => 'nullable|boolean',
                'car_entrance' => 'nullable|boolean',
                'elevator' => 'nullable|boolean',
                'basement' => 'nullable|boolean',
                'living_room_stairs' => 'nullable|boolean',
                'verse' => 'nullable|boolean',
                'water_supply' => 'nullable|boolean',
                'electricity_supply' => 'nullable|boolean',
                'sewerage_supply' => 'nullable|boolean',
                'duplex' => 'nullable|boolean',
                'playground' => 'nullable|boolean',
                'families_or_singles' => 'nullable|in:0,1,2',
            ];
        } elseif ($request->category_id == 18) {
            $additional_data = [
                'street_width' => 'nullable|integer',
                'number_of_wells' => 'nullable|integer',
                'number_of_trees' => 'nullable|integer',
                'number_of_living_rooms' => 'nullable|integer',

                // additional
                'kitchen' => 'nullable|boolean',
                'car_entrance' => 'nullable|boolean',

                'verse' => 'nullable|boolean',
                'water_supply' => 'nullable|boolean',
                'electricity_supply' => 'nullable|boolean',
                'sewerage_supply' => 'nullable|boolean',

                'families_or_singles' => 'nullable|in:0,1,2',
            ];
        }

        return array_merge($data, $additional_data);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->returnValidationError(400, $validator));
    }
}
