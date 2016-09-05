<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted'             => 'Trường :attribute phải được chấp nhận.',
    'active_url'           => 'Trường :attribute không phải là một URL hợp lệ.',
    'after'                => 'Trường :attribute phải là một ngày sau ngày :date.',
    'alpha'                => 'Trường :attribute chỉ có thể chứa các chữ cái.',
    'alpha_dash'           => 'Trường :attribute chỉ có thể chứa chữ cái, số và dấu gạch ngang.',
    'alpha_num'            => 'Trường :attribute chỉ có thể chứa chữ cái và số.',
    'array'                => 'Kiểu dữ liệu của trường :attribute phải là dạng mảng.',
    'before'               => 'Trường :attribute phải là một ngày trước ngày :date.',
    'between'              => [
        'numeric' => 'Trường :attribute phải nằm trong khoảng :min - :max.',
        'file'    => 'Dung lượng tập tin trong trường :attribute phải từ :min - :max kB.',
        'string'  => 'Trường :attribute phải từ :min - :max ký tự.',
        'array'   => 'Trường :attribute phải có từ :min - :max phần tử.',
    ],
    'boolean'              => 'Trường :attribute phải là true hoặc false.',
    'confirmed'            => 'Giá trị xác nhận trong trường :attribute không khớp.',
    'date'                 => 'Trường :attribute không phải là định dạng của ngày-tháng.',
    'date_format'          => 'Trường :attribute không giống với định dạng :format.',
    'different'            => 'Trường :attribute và :other phải khác nhau.',
    'digits'               => 'Độ dài của trường :attribute phải gồm :digits chữ số.',
    'digits_between'       => 'Độ dài của trường :attribute phải nằm trong khoảng :min and :max chữ số.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'Trường :attribute phải là một địa chỉ email hợp lệ.',
    'exists'               => 'Giá trị đã chọn trong trường :attribute không hợp lệ.',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'Trường :attribute không được bỏ trống.',
    'image'                => 'Các tập tin trong trường :attribute phải là định dạng hình ảnh.',
    'in'                   => 'Giá trị đã chọn trong trường :attribute không hợp lệ.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'Trường :attribute phải là một số nguyên.',
    'ip'                   => 'Trường :attribute phải là một địa chỉa IP.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'Trường :attribute không được lớn hơn :max.',
        'file'    => 'Dung lượng tập tin trong trường :attribute không được lớn hơn :max kB.',
        'string'  => 'Trường :attribute không được lớn hơn :max ký tự.',
        'array'   => 'Trường :attribute không được lớn hơn :max phần tử.',
    ],
    'mimes'                => 'Trường :attribute phải là một tập tin có định dạng: :values.',
    'min'                  => [
        'numeric' => 'Trường :attribute phải tối thiểu là :min.',
        'file'    => 'Dung lượng tập tin trong trường :attribute phải tối thiểu :min kB.',
        'string'  => 'Trường :attribute phải có tối thiểu :min ký tự.',
        'array'   => 'Trường :attribute phải có tối thiểu :min phần tử.',
    ],
    'not_in'               => 'Giá trị đã chọn trong trường :attribute không hợp lệ.',
    'numeric'              => 'Trường :attribute phải là một số.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'Định dạng trường :attribute không hợp lệ.',
    'required'             => 'Trường :attribute không được bỏ trống.',
    'required_if'          => 'Trường :attribute không được bỏ trống khi trường :other là :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'Trường :attribute không được bỏ trống khi trường :values có giá trị.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'Trường :attribute không được bỏ trống khi trường :values không có giá trị.',
    'required_without_all' => 'Trường :attribute không được bỏ trống khi tất cả :values không có giá trị.',
    'same'                 => 'Trường :attribute và :other phải giống nhau.',
    'size'                 => [
        'numeric' => 'Trường :attribute phải bằng :size.',
        'file'    => 'Dung lượng tập tin trong trường :attribute phải bằng :size kB.',
        'string'  => 'Trường :attribute phải chứa :size ký tự.',
        'array'   => 'Trường :attribute phải chứa :size phần tử.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'Trường :attribute phải là một múi giờ hợp lệ.',
    'unique'               => 'Trường :attribute đã có trong CSDL.',
    'url'                  => 'Trường :attribute không giống với định dạng một URL.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom'               => [
        'category_id'   => [
            'required'  => 'Vui lòng chọn Chuyên mục.',
            'numeric'   => 'Không tìm thấy Chuyên mục.',
            'exists'    => 'Không tìm thấy Chuyên mục.',
        ],
        'city_id'           => [
            'required'  => 'Vui lòng chọn Thành phố.',
            'numeric'   => 'Không tìm thấy Thành phố.',
            'exists'    => 'Không tìm thấy Thành phố.',

        ],
        'address'           => [
            'required'  => 'Không được để trống Địa chỉ.',
            'string'    => 'Địa chỉ sai định dạng.',
            'max'       => 'Địa chỉ dài quá :max ký tự',

        ],
        'lat'               => [
            'numeric'   => 'Không định vị được địa chỉ trên bản đồ.',
            'min'       => 'Địa chỉ không đúng.',
            'max'       => 'Địa chỉ không đúng.',

        ],
        'lng'               => [
            'numeric'   => 'Không định vị được địa chỉ trên bản đồ.',
            'min'       => 'Địa chỉ không đúng.',
            'max'       => 'Địa chỉ không đúng.',

        ],
        'phone_number'       => [
            'required'  => 'Số điện thoại không được bỏ trống.',
            'max'       => 'Số điện thoại dài quá :max ký tự',
            'regex'     => 'Số điện thoại có vẻ không đúng, vui lòng thử lại.',

        ],
        'type'              => [
            'required'  => 'Loại tin không xác định!',
        ],
        'title'  => [
            'required'  => 'Tiêu đề không được bỏ trống.',
            'max'       => 'Tiêu đề không được dài quá :max ký tự',
        ],
        'content'           => [
            'required'  => 'Bài đăng phải có nội dung!',
            'max'       => 'Nội dung dài quá :max ký tự.',

        ],
        'cost'              => [
            'required'  => 'Giá cả không được bỏ trống.',
            'numeric'   => 'Giá không đúng định dạng.',
        ],
        'time_begin'        => [
            'required'  => 'Khung giờ (giờ bắt đầu) không được bỏ trống',
            'date_format'   => 'Khung giờ sai định dạng. VD định dạng đúng: 2:30 PM',
        ],
        'time_end'          => [
            'required'  => 'Khung giờ (giờ kết thúc) không được bỏ trống',
            'after'     => 'Giờ kết thúc phải nhỏ hơn giờ bắt đầu!',
            'date_format'   => 'Khung giờ sai định dạng. VD định dạng đúng: 2:30 PM',
        ],
        'start_date'        => [
            'required'  => 'Ngày bắt đầu không được bỏ trống',
            'after'     => 'Ngày bắt đầu không được ở quá khứ.',
            'date_format'   => 'Ngày bắt đầu sai định dạng.',
        ],
        'end_date'          => [
            'after'     => 'Ngày kết thúc phải ở sau sau ngày bắt đầu.',
            'date_format'   => 'Ngày kết thúc sai định dạng.',
        ],
        'photos'            => [
            'required'  => 'Tin không có ảnh thực tế sẽ không được duyệt.',
        ],
        'photos.*'           => [
            'required'  => 'Tin không có ảnh thực tế sẽ không được duyệt.',
            'image'     => 'File tải lên không phải là file ảnh.',
        ],
        'mon'  => [
            'required_without_all'  => 'Phải chọn ít nhất một ngày trong tuần.',
        ],
        'tue'  => [
            'required_without_all'  => 'Phải chọn ít nhất một ngày trong tuần.',
        ],
        'wed'  => [
            'required_without_all'  => 'Phải chọn ít nhất một ngày trong tuần.',
        ],
        'thur'  => [
            'required_without_all'  => 'Phải chọn ít nhất một ngày trong tuần.',
        ],
        'fri'  => [
            'required_without_all'  => 'Phải chọn ít nhất một ngày trong tuần.',
        ],
        'sat'  => [
            'required_without_all'  => 'Phải chọn ít nhất một ngày trong tuần.',
        ],
        'sun'  => [
            'required_without_all'  => 'Phải chọn ít nhất một ngày trong tuần.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes'           => [
        //
    ],

];
