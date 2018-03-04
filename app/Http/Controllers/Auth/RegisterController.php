<?php

namespace App\Http\Controllers\Auth;

use App\Application\Helpers\DataFilter;
use App\Domain\Services\User\RegistrationServiceInterface;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    /**
     * @var RegistrationServiceInterface
     */
    private $service;

    /**
     * RegisterController constructor.
     * @param RegistrationServiceInterface $service
     */
    public function __construct(RegistrationServiceInterface $service)
    {
        $this->service = $service;
        $this->middleware('guest')->except('logout');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.registration');
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(RegisterRequest $request)
    {
        $this->service->register([
            'username' => DataFilter::deepTrimString($request->input('username')),
            'password' => DataFilter::deepTrimString($request->input('password')),
        ]);

        return redirect('/registration-success');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function registrationSuccess()
    {
        return view('auth.registration_success');
    }
}
