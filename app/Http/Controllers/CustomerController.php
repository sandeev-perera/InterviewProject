<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Integer;

class CustomerController extends Controller
{
    public function showCustomerDashboard(){
        $CustomerID = Auth::user()->id;
        $posts = Post::where('user_id', $CustomerID)->paginate(12);
        return view('customer.CustomerDashboard', compact('posts'));
    }
}
