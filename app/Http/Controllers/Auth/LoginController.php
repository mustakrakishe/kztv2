<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Which field shoud be attemped.
     *
     * @var array
     */
    protected $identifiable = [
        'name',
        'email',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Extending methods

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $errors = $this->validateLogin($request);
        if($errors){
            return [
                'status' => 0,
                'errors' => $errors,
            ];
        }
        
        if(!$this->attemptLogin($request)){
            return [
                'status' => 0,
                'errors' => [
                    'name' => [trans('auth.failed')],
                    'password' => [trans('auth.failed')],
                ],
            ];
        }

        $request->session()->regenerate();

        return ['status' => 1];
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateLogin(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $user = User::where([
            'name' => $request->name,
            'password' => $request->password,
        ])->first();

        if($user->doesntExist()){
            return false;
        }

        Auth::login($user, $request->remember);

        return true;
    }
}
