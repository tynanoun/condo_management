<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\Room;
use App\User;
use App\Http\Controllers\Controller;
use App\UserRole;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function showRegistrationForm()
    {
        $roles = Role::all()->where('is_active', true);
        $rooms = Room::all()->where('is_active', true);
        return view('auth.register', compact(['roles', 'rooms']));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'contact_number' => $data['contact_number'],
            'main_contact' => $data['main_contact'],
            'is_active' => true,
            'building_id' => 1,
            'room_id' => $data['room_id'],
            'image' => '',
            'created_by' => Auth::user()->getAuthIdentifier(),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->attachRole(Role::where('id', $data['role_id'])->first());

        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));

//        $customers = $this->getActiveUser();
//        return view ('admin.user.index', compact('customers'));

        return json_encode("success");
    }

    private function getActiveUser() {
        return $customers = User::All()->where('is_active', true);
    }

}
