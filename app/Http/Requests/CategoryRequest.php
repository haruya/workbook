<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CategoryRequest extends Request {

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
			'name' => 'required|max:64',
		];
	}
	
	public function messages()
	{
		return [
			'name.required' => 'カテゴリー名は入力必須です。',
			'name.max' => 'カテゴリー名は64文字以内で入力してください。',
		];
	}
}
