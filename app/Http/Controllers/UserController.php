<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()  // displays all user with orders
        {
        	$id=auth()->guard('user')->user()->id;    
        	return view()->with(User::find($id)->with(['orders'])->get());
        }

         public function showLoginForm()
    		{
        		return view('auth.login');
    		}

            public function showDashboard()
            {
                return view('dashboard.index');
            }
 
        public function login(Request $request)  // authenticates the user
        {
            $status = 401;
            $response = ['error' => 'Unauthorised'];
 
            if (Auth::attempt($request->only(['email', 'password']))) {
                return view('dashboard.index');
            }
 
            return redirect()->back();
        }
 
        public function register(Request $request)  //create user account
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'c_password' => 'required|same:password',
            ]);
 
            if ($validator->fails()) {
                return redirect()->back()->withErrors();
            }
 
            $data = $request->only(['name', 'email', 'password']);
            $data['password'] = bcrypt($data['password']);
 
            $user = User::create($data);
            $user->is_admin = 0;
 
            return response()->json([
                'user' => $user,
                'token' => $user->createToken('chomosuke')->accessToken,
            ]);
        }
        public function showRegistrationForm()
    	{
        		return view('auth.register');
    	}
 
        public function show(User $user)  // fetch details of users
        {
            return response()->json($user);
        }
 
        public function showOrders(User $user)  // fetch the orders of the users
        {
            return response()->json($user->orders()->with(['product'])->get());
        }
}
