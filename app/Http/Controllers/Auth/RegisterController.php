<?php

namespace App\Http\Controllers\Auth;

use App\Application\Helpers\DataFilter;
use App\Domain\Services\User\RegistrationServiceInterface;
use App\Http\Requests\RegisterUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    /**
     * @var RegistrationServiceInterface
     */
    private $service;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/registration-success';

    /**
     * RegisterController constructor.
     * @param RegistrationServiceInterface $service
     */
    public function __construct(RegistrationServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm(Request $request)
    {
        return view('auth.registration');
    }

    /**
     * @param RegisterUser $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(RegisterUser $request)
    {
     //   dd($request->er)

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
