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
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
