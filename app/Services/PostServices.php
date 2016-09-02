<?php

namespace App\Services;

use Validator;

class PostServices
{
    /**
     * Validate the creating post's data.
     *
     * @param array $data the input data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function creatingValidator(array $data)
    {
        $rules = [
            'category_id'   => 'required|numeric|exists:categories,id',
            'city_id'       => 'required|numeric|exists:cities,id',
            'address'       => 'required|string|max:255',
            'lat'           => 'numeric|min:-90|max:90',
            'lng'           => 'numeric|min:-180|max:180',
            'phone_number'  => 'required|max:15|regex:/^\+?\d+?$/',
            'type'          => 'required',
            'title'         => 'required|max:255',
            'content'       => 'required|max:2048',
            'cost'          => 'required|numeric',
            'time_begin'    => 'required|date_format:H:i',
            'time_end'      => 'required|date_format:H:i|after:time_begin',
            'start_date'    => 'required|date_format:Y-m-d|after:yesterday',
            'end_date'      => 'date_format:Y-m-d|after:start_date',
            'photos'        => 'required',
            'photos.*'      => 'required|image',
            'mon'           => 'required_without_all:tue,wed,thur,fri,sat,sun',
            'tue'           => 'required_without_all:mon,wed,thur,fri,sat,sun',
            'wed'           => 'required_without_all:mon,tue,thur,fri,sat,sun',
            'thur'          => 'required_without_all:mon,tue,wed,fri,sat,sun',
            'fri'           => 'required_without_all:mon,tue,wed,thur,sat,sun',
            'sat'           => 'required_without_all:mon,tue,wed,thur,fri,sun',
            'sun'           => 'required_without_all:mon,tue,wed,thur,fri,sat',
        ];
        return Validator::make($data, $rules);
    }
}
