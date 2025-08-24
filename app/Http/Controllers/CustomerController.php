<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function showCustomerDashboard(){
        $userID = Auth::user()->id;
        $posts = Post::where('user_id', $userID)->paginate(12);
        return view('customer.CustomerDashboard', compact('posts'));
    }

    public function showCustomerProfile($id){
        $user = User::with("posts")->findOrFail($id);
        $posts = Post::where("user_id", $user->id)->paginate(12);
        return view('Genaral.ViewProfile', compact("user", 'posts'));
    }
}
