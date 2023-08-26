<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use DateTime;

class FiveMinDifference implements Rule
{
    protected $otherValue;
    protected $operator;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($otherValue)
    {
        $this->otherValue = $otherValue;
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
        $time1 = DateTime::createFromFormat('H:i', $value);
        $time2 = DateTime::createFromFormat('H:i', $this->otherValue);

        if (!$time1 || !$time2) {
            return false; // Unable to parse times
        }

        $interval = $time1->diff($time2);
        $minutesDifference = $interval->i + ($interval->h * 60);

        return $minutesDifference > 5;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '開始時刻と終了時刻が５分以内に設定されています。';
    }
}
