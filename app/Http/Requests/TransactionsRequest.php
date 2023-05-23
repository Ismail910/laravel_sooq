<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => "required|exists:users,id",
            'amount' => "required|numeric|not_in:0",
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.required' => "يجب اختيار المستخدم",
            'user_id.exists' => "يجب اختيار مستخدم موجود بالفعل علي النظام",

            'amount.required' => "يجب ادخال القيمة المراد اضافتها للحساب",
            'amount.numeric' => "يجب إدخال قيمة صالحة",
            'amount.not_in' => "يجب إدخال قيمة لا تساوي الصفر",
        ];
    }
}
