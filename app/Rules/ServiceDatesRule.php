<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class ServiceDatesRule implements InvokableRule
{
    public function __construct(public string $fieldname = '')
    {

    }

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if($this->fieldname) {
            if($this->fieldname === 'before_date') {
                if(!$value && !request('exact_date') && !request('after_date')) {
                    $fail(__('Only one date is allowed'));
                }
            } else if($this->fieldname === 'exact_date') {
                if(!$value && !request('before_date') && !request('after_date')) {
                    $fail(__('Only one date is allowed'));
                }
            } else if($this->fieldname === 'after_date') {
                if(!$value && !request('before_date') && !request('exact_date')) {
                    $fail(__('Only one date is allowed'));
                }
            }
        }

    }
}
