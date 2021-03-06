<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostsRequest extends Request {

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
			'title' => 'required|max:64',
			'content' => 'required'
		];
	}

	// エラー文言の設定
	public function messages()
	{
		return [
			'title.required' => 'タイトルは入力必須です。',
			'title.max' => 'タイトルは64文字以内で入力してください。',
			'content.required' => '内容は入力必須です。',
		];
	}

}
