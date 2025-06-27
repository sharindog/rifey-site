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
            'phone' => ['required',
                'regex:/^\\+7\\s\\(\\d{3}\\)\\s\\d{3}-\\d{2}-\\d{2}$/'],
            'is_repeat'  => ['sometimes','boolean'],
            'prev_number'=> ['required_if:is_repeat,1', 'nullable', 'digits_between:1,11'],
            'files'   => 'nullable|array',
            'files.*' => ['file', 'mimes:txt,jpg,jpeg,png,zip,rar,doc,docx,xls,xlsx,pdf', 'max:15360'],
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

    public function attributes(): array
    {
        return [
            'topic' => 'тема обращения',
            'prev_number' => 'номер предыдущего обращения',
        ];
    }
    public function messages(): array
    {
        return [
            'topic.required' => 'Пожалуйста, выберите тему обращения.',
            'prev_number.required_if' =>
                'Пожалуйста, укажите номер предыдущего обращения.',
        ];
    }
}
