<?php

namespace App\Http\Requests;

use App\Domain\Repositories\User\UserReadRepository;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'username' => 'required',
            'password' => 'required',
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
            'password.required' => 'Пароль не может быть пустым',
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
            $message = 'Вход в систему с указанными данными невозможен';


            if ($data['username'] != null && $data['password'] != null) {
                if (!$this->readRepository->existsByUsername($data['username'])) {
                    $validator->errors()->add('username', $message);
                    return;
                }

                $user = $this->readRepository->fetchByUsername($data['username']);

                if (!password_verify($data['password'], $user->getPasswordHash())) {
                    $validator->errors()->add('username', $message);
                }
            }
        });
    }
}
