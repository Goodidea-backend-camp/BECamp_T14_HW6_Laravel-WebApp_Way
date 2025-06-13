<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (!Auth::check()) {
            abort(403, '請先登入在進行操作');
        }

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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'description' => 'required|string',
            'menu' => 'required|array',
            'menu.*.name' => 'required|string|max:255',
            'menu.*.price' => 'required|numeric|min:0',
            'menu.*.property' => 'required|string|in:S,M,L,份',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '店家名稱為必填。',
            'phone.required' => '電話為必填。',
            'address.required' => '地址為必填。',
            'description.required' => '店家描述為必填。',
            'menu.required' => '菜單項目不能是空的。',
            'menu.*.name.required' => '餐點名稱為必填。',
            'menu.*.price.required' => '餐點價格為必填。',
            'menu.*.price.numeric' => '餐點價格必須是數字。',
            'menu.*.price.min' => '餐點價格不能為負數。',
            'menu.*.property.required' => '餐點屬性為必填。',
            'menu.*.property.in' => '餐點屬性只能是 S, M, L 或 份。',
        ];
    }
}
