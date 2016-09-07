<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class CommentRequest extends Request
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
                    'content' => 'required|min:10|max:512',
                    'user_id' => 'required|exists:users,id|numeric',
                    'post_id' => 'required|exists:posts,id|numeric'
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
                    'content.required'  => trans('frontend.comment.validation.required'),
                    'content.min'       => trans('frontend.comment.validation.min'),
                    'content.max'       => trans('frontend.comment.validation.max'),
                ];

            default:
                return [];
        }
    }
}
