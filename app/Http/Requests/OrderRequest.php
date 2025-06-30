<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (!Auth::check()) {
            abort(403, '請先登入再進行操作');
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
            '_token' => 'required|string',
            'order_id' => 'required|integer',
            'store_id' => 'required|integer',
            'orders' => 'required|array',
            'orders.*.number' => 'required|integer',
            'orders.*.is_paid' => 'required|in:0,1',
            'orders.*.product_name' => 'required|string',
            'orders.*.total_price' => 'required|numeric',
            'orders.*.id' => 'required|string',
            'orders.*.description' => 'nullable|string',
            'orders.*.product_property' => 'nullable|string',
        ];
    }
}
