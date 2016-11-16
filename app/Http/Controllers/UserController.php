<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    // Register User
    public function postRegister(Request $request)
    {
        // Validate the data
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'name' => 'required|min:1|max:50',
            'password' => 'required|min:5|max:25'
        ]);

        // Get the request variables
        $email = $request['email'];
        $name = $request['name'];
        $password = bcrypt($request['password']);

        // Create the user
        $user = new User();
        $user->email = $email;
        $user->name = $name;
        $user->password = $password;
        $user->save();

        // Authenticate the user and go to the dashboard
        Auth::login($user);
        return redirect()->route('dashboard');
    }

    // Log User In
    public function postLogIn(Request $request)
    {
        // Validate the data
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        // Login the User
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'] ])){
            return redirect()->route('dashboard');
        }
        return redirect()->back();
    }

    // Log User Out
    public function getLogOut()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}