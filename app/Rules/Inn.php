<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Inn implements Rule
{
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (strlen($value) != 12 || !is_numeric($value)) {
            return false;
        }

        $value = strval($value);

        $sum1 = 0;
        foreach ([7, 2, 4, 10, 3, 5, 9, 4, 6, 8] as $i => $weight) {
            $sum1 += $weight * $value[$i];
        }

        if (($sum1 % 11 % 10) !== (int) $value[10]) {
            return false;
        }

        $sum2 = 0;
        foreach ([3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8] as $i => $weight) {
            $sum2 += $weight * $value[$i];
        }

        if (($sum2 % 11 % 10) !== (int) $value[11]) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Неправильный формат ИНН';
    }
}
