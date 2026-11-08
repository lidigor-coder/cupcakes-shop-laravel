<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ОБЯЗАТЕЛЬНО true
    }

    public function rules(): array
    {
        return [
            'cupcake_name' => 'required|string|max:255',
            'client_name'  => 'nullable|string|max:100',
            'quantity'     => 'required|integer|min:1',
            // Проверка телефона: разрешаем цифры, пробелы, плюсы, дефисы и скобки
            'client_phone' => [
                'required',
                'string',
                'regex:/^[\d\s\+\-\(\)]+$/',
                'min:7',
                'max:25'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'cupcake_name.required' => 'Не выбран кекс для заказа.',
            'client_phone.required' => 'Пожалуйста, введите номер телефона.',
            'client_phone.regex'    => 'Номер телефона содержит недопустимые символы.',
            'client_phone.min'      => 'Номер телефона слишком короткий.',
        ];
    }
}
