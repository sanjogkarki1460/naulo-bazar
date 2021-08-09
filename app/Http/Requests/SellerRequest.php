<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerRequest extends FormRequest
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
            'shop_name' =>'required| max:50',
            'shop_url'  =>'required| max:30',
            'first_name'=> 'required| max:30',
            'last_name' =>'required | max:30',
            'email'=> 'required|email|unique:users,email',
            'phone'=>'required|digits:10|numeric',
            'shop_phone'=>'required|numeric',
            'shop_pan_or_vat_no'=>'required ',
            'country' => 'required|max:30',
            'city' =>'required | max:30',
            'address' => 'required|max:250',
            'shop_address' => 'required | max:250',
            'citizenship_or_passport_no'=>'required|max:20',
            'zip_code'=>'required',
            'password'      => 'required|min:6',
            'password_confirmation' =>'required_with:password|same:password|min:6',
            'citizen_front_photo' => 'required|image|mimes:jpeg,png,jpg|max:6048',
            'citizen_back_photo' => 'required|image|mimes:jpeg,png,jpg|max:6048',
        ];
    }
}
