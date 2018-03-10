<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Repositories\User\UserReadRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Application\Adapters\User\UserAdapter;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * @var UserReadRepository
     */
    private $userReadRepository;

    /**
     * LoginController constructor.
     * @param UserReadRepository $userReadRepository
     */
    public function __construct(UserReadRepository $userReadRepository)
    {
        $this->userReadRepository = $userReadRepository;
        $this->middleware('guest')->except('logout');
    }

    /**
     * Аутентификация пользователя по логину и паролю
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        // Если класс использует ThrottlesLogins trait, мы можем автоматически записывать
        // попытки входа в систему для этого приложения. Мы укажем это по имени пользователя и
        // IP-адресу клиента, делающий эти запросы в этом приложении.
        $this->incrementLoginAttempts($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $user = $this->userReadRepository->fetchByUsername($request->get('username'));
        $userAdapter = new UserAdapter($user);
        $userAdapter->setRememberToken($request->get('remember'));
        Auth::login($userAdapter);

        return redirect('/');
    }

    /**
     * Выход из приложения
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
