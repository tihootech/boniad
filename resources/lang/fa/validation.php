<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ' :attribute must be accepted.',
    'active_url'           => ' :attribute is not a valid URL.',
    'after'                => ' :attribute must be a date after :date.',
    'after_or_equal'       => ' :attribute must be a date after or equal to :date.',
    'alpha'                => ' :attribute may only contain letters.',
    'alpha_dash'           => ' :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => ' :attribute may only contain letters and numbers.',
    'array'                => ' :attribute must be an array.',
    'before'               => ' :attribute must be a date before :date.',
    'before_or_equal'      => ' :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => ' :attribute باید بین :min و :max باشد.',
        'file'    => ' :attribute must be between :min and :max kilobytes.',
        'string'  => ' :attribute must be between :min and :max characters.',
        'array'   => ' :attribute must have between :min and :max items.',
    ],
    'boolean'              => ' :attribute field must be true or false.',
    'confirmed'            => ' :attribute با تایید :attribute همخوانی ندارد.',
    'date'                 => ' :attribute is not a valid date.',
    'date_format'          => ' :attribute does not match the format :format.',
    'different'            => ' :attribute and :other must be different.',
    'digits'               => ' :attribute باید :digits رقم باشد.',
    'digits_between'       => ' :attribute باید بین :min تا :max رقم باشد.',
    'dimensions'           => ' :attribute has invalid image dimensions.',
    'distinct'             => ' :attribute field has a duplicate value.',
    'email'                => ' ایمیل وارد شده صحیح نیست.',
    'exists'               => ' :attribute وارد شده صحیح نیست.',
    'file'                 => ' :attribute must be a file.',
    'filled'               => ' :attribute field must have a value.',
    'image'                => ' :attribute must be an image.',
    'in'                   => ' selected :attribute is invalid.',
    'in_array'             => ' :attribute field does not exist in :other.',
    'integer'              => ' :attribute باید عدد باشد.',
    'ip'                   => ' :attribute must be a valid IP address.',
    'ipv4'                 => ' :attribute must be a valid IPv4 address.',
    'ipv6'                 => ' :attribute must be a valid IPv6 address.',
    'json'                 => ' :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => ' :attribute باید حداکثر :max رقم باشد.',
        'file'    => ' :attribute باید حداکثر :max کلوبایت باشد.',
        'string'  => ' :attribute باید حداکثر :max کاراکتر باشد.',
        'array'   => ' :attribute باید حداکثر :max آیتم داشته باشد.',
    ],
    'mimes'                => ' :attribute باید یکی از پسوند های زیررا داشته باشد : :values.',
    'mimetypes'            => ' :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => ' :attribute باید حداقل :min رقم باشد.',
        'file'    => ' :attribute باید حداقل :min کلوبایت باشد.',
        'string'  => ' :attribute باید حداقل :min کاراکتر باشد.',
        'array'   => ' :attribute باید حداقل :min آیتم داشته باشد.',
    ],
    'not_in'               => ' :attribute انتخاب شده صحیح نیست.',
    'numeric'              => ' :attribute باید عد باشد.',
    'present'              => ' :attribute field must be present.',
    'regex'                => ' :attribute صحیح نیست.',
    'required'             => ' :attribute الزامی است.',
    'required_if'          => ' :attribute field is required when :other is :value.',
    'required_unless'      => ' :attribute field is required unless :other is in :values.',
    'required_with'        => ' :attribute field is required when :values is present.',
    'required_with_all'    => ' :attribute field is required when :values is present.',
    'required_without'     => ' هنگامی که :values وارد نشده باشد، فیلد :attribute الزامی است.',
    'required_without_all' => ' :attribute field is required when none of :values are present.',
    'same'                 => ' :attribute و :other باید یکسان باشند..',
    'size'                 => [
        'numeric' => ' :attribute must be :size.',
        'file'    => ' :attribute must be :size kilobytes.',
        'string'  => ' :attribute must be :size characters.',
        'array'   => ' :attribute must contain :size items.',
    ],
    'string'               => 'در :attribute از کاراکتر های صحیحی استفاده نشده اشت..',
    'timezone'             => ' :attribute must be a valid zone.',
    'unique'               => 'این :attribute قبلا استفاده شده است.',
    'uploaded'             => 'آپلود با خطا مواجه شد.',
    'url'                  => 'فرمت :attribute صحیح نیست.',

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

    'custom' => [
        'checked_ids' => [
            'required' => 'لطفا حداقل یکی از موارد را تیک بزنید.',
        ],
        'rate' => [
            'required' => 'لطفا با کلیک روی آیکون های مربوط به ستاره، نمره ای بین 1 تا 5 انتخاب کنید.',
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

    'attributes' => [
        'national_code' => 'کدملی',
        'full_name' => 'نام  و نام خانوادگی',
        'phone' => ' شماره تماس ',
        'telephone' => ' تلفن ثابت',
        'mobile' => ' تلفن همراه ',
        'birthday' => ' تاریخ تولد ',
        'points' => ' امتیاز ',
        'username' => ' نام کاربری ',
        'password' => ' رمز عبور ',
        'body' => ' متن ',
        'first_name' => ' نام ',
        'last_name' => ' نام خانوادگی ',
        'new_password' => ' رمز عبور جدید ',
        'amount' => 'مبلغ',
        'date' => 'تاریخ',
        'count' => 'تعداد',
        'postal_code' => 'کدپستی',
        'address' => 'آدرس',
        'email' => 'ایمیل',
        'name'=> 'نام',
        'state'=> 'استان',
        'city'=> 'شهر',
        'hood'=> 'محله',
        'current_password'=> 'رمزعبور فعلی',
        'code'=> 'کد تایید',
        'branch_name'=> 'نام بنیاد',
        'branch_id'=> 'بنیاد انتخاب شده',
        'pwd'=> 'رمزعبور',
        'resource_name'=> 'نام منبع',
        'amount'=> 'مقدار',
        'month'=> 'ماه',
        'year'=> 'سال',
    ],

];
