<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreShopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //userモデルのisownerメソッド
        return $this->user()->isOwner();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'name' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string', 'max:1000'],
        'address' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
        'name.required'   => '店舗名は必須です',
        'name.max'        => '店舗名は255文字以内で入力してください',
        'address.required' => '住所は必須です',
        'addres.max'      => '店舗名は必須です',
        ];
    }
}
