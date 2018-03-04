<?php

namespace App\Http\Requests;

use App\Domain\Repositories\User\UserReadRepository;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUser extends FormRequest
{
    /**
     * @var UserReadRepository
     */
    private $readRepository;

    /**
     * RegisterUser constructor.
     * @param array $query
     * @param array $request
     * @param array $attributes
     * @param array $cookies
     * @param array $files
     * @param array $server
     * @param null $content
     * @param UserReadRepository $userReadRepository
     */
    public function __construct(
        array $query = array(),
        array $request = array(),
        array $attributes = array(),
        array $cookies = array(),
        array $files = array(),
        array $server = array(),
        $content = null,
        UserReadRepository $userReadRepository

    )
    {
        $this->readRepository = $userReadRepository;
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }

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
            'username' => 'required|min:8|max:255|alpha_num',
            'password' => ['required', 'confirmed', 'min:6', 'max:255', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).+$/'],
        ];
    }

    /**
     * Set custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => 'Логин не может быть пустым',
            'username.min' => 'Логин должен содержать минимум 8 символов',
            'username.max' => 'Логин должен содержать максимум 255 символов',
            'username.alpha_num' => 'Логин может содержать только латиницу и цифры',
            'password.required' => 'Пароль не может быть пустым',
            'password.confirmed' => 'Введены разные пароли',
            'password.min' => 'Пароль должен содержать минимум 6 символов',
            'password.max' => 'Пароль должен содержать максимум 255 символов',
            'password.regex' => 'Пароль должен содержать буквы в нижнем и верхнем регистрах, и цифры',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            /* @var $validator \Illuminate\Validation\Validator */
            $data = $validator->getData();

            if ($this->readRepository->existsByUsername($data['username'])) {
                $validator->errors()->add('username', 'Пользователь с таки именем уже существует');
            }
        });
    }
}
