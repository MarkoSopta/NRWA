<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUsersRequest extends FormRequest
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
            'name'=>['required'],
            'role'=>['required', Rule::in(['manager','dispatcher','client'])],
            'password'=>['required']
        ];
    }
// protected function prepareForValidation(){

// $this -> merge([
//     'updated_at'=>$this->updatedAt,
//     'created_at'=>$this->createdAt

// ]);


// }

}
