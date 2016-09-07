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
                    'content.required'  => 'Bình luận phải có nội dung.',
                    'content.min'       => 'Bình luận phải ít nhất :min ký tự',
                    'content.max'       => 'Bình luận tối đa chỉ :max ký tự',
                ];

            default:
                return [];
        }
    }
}
