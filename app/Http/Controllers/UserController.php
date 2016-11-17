<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    // Register User
    public function postRegister(Request $request)
    {
        // Validate the data
        $this->validate($request, [
            'registration-email' => 'required|email|unique:users',
            'registration-name' => 'required|min:1|max:50',
            'registration-password' => 'required|min:5|max:25'
        ]);


        // Get the request variables
        $email = $request['registration-email'];
        $name = $request['registration-name'];
        $password = bcrypt($request['registration-password']);

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
            'login-email' => 'required',
            'login-password' => 'required'
        ]);

        // Login the User
        if (Auth::attempt(['email' => $request['login-email'], 'password' => $request['login-password'] ])){
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

    // Show Edit Account Page
    public function getShowAccount()
    {
        return view('account', ['user' => Auth::user()]);
    }

    // Save the edits on the account
    public function postEditAccount(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|max:50'
        ]);

        $user = Auth::user();
        $user->name = $request['name'];
        $user->update();

        $image = $request->file('profile-image');
        $filename = $user->id . '_profile_img.jpg';
        if ($image) {
            Storage::disk('local')->put($filename, File::get($image));
        }
        return redirect()->route('account.edit');
    }

    // Gets the user's profile image
    public function getUserImage($filename)
    {
        $image = Storage::disk('local')->get($filename);
        return new Response($image, 200);
    }

}