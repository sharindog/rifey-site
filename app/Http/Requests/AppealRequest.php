<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AppealRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $cat = $this->input('category');

        $base = [
            'category'   => ['required', Rule::in(['individual','company'])],
            'topic'      => ['required', Rule::in([
                'contract','coop_offer','buy_recyclables',
                'no_collection','landfill','tariff_question',
                'billing_question','other',
            ])],
            'settlement' => ['required','string','max:120'],
            'body'       => ['required','string','max:500'],
            'email'      => ['required','email'],
            'phone'      => ['required','string','max:30'],
            'is_repeat'  => ['boolean'],
            'prev_number'=> ['nullable','string','max:30', 'required_if:is_repeat,1'],
            'files.*'    => ['sometimes','file','max:4096'],
            'consent'    => ['accepted'],
        ];

        $individual = [
            'fio' => ['required','string','max:150'],
        ];

        $company = [
            'inn'          => ['required','string','size:10,12'],
            'contact_name' => ['required','string','max:150'],
        ];

        return $cat === 'company'
            ? array_merge($base, $company)
            : array_merge($base, $individual);
    }
}
