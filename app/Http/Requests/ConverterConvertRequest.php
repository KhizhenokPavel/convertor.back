<?php

namespace App\Http\Requests;

use App\Rules\ExchangeRateExist;
use Illuminate\Foundation\Http\FormRequest;

class ConverterConvertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'from' => 'required|string|exists:available_currencies,currency_code',
            'to' => 'required|string|exists:available_currencies,currency_code',
            'amount' => 'required|numeric',
            new ExchangeRateExist($this->all()),
        ];
    }
}
