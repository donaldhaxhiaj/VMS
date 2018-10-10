<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class visitRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'purpose' => 'required',
            'companies' => 'required'

        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'purpose.required' => 'A purpose is required, bro',
            'companies.required' => 'Cmonnn, that is not an email address'
        ];
    }
}