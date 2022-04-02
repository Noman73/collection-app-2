<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Otp;
class OtpValidate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $mobile;
    public function __construct($mobile)
    {
        $this->mobile=$mobile;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $result = Otp::validate('password:'.$this->mobile,$value);
        return $result->status;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'দুঃখিত !আপনার নাম্বারের সাথে কোডটি ম্যাচ করেনি।';
    }
}
