<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReportRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'description'   => 'required|max:255',
                    'post_id'       => 'required|exists:posts,id|numeric'
                ];

            default:
                return [];
        }
    }


    /**
     * Get the error messages for the password confirmation.
     *
     * @return array
     */
    public function messages()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'description.required'  => trans('frontend.report.validation.required'),
                    'description.max'       => trans('frontend.report.validation.max'),
                ];

            default:
                return [];
        }
    }
}
