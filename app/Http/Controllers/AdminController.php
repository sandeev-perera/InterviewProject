<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function showAdminDashboard(){
        $posts = Post::count();
        $users = User::where('role', "customer" )->count();
        return view('admin.Admindashboard', compact('users', 'posts'));
    }

    public function showProductsPage(){
        return view('admin.ManageProducts');
    }

    public function viewProfiles(){
        $painters = User::where('role', 'Customer')
    ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
    ->select(
        'users.id',
        'users.name',
        'users.email',
        'users.created_at',
        DB::raw('COUNT(posts.id) as posts_count')
    )
    ->groupBy('users.id','users.name','users.email','users.created_at')
    ->orderBy('posts_count', 'desc')
    ->paginate(20);   
    Log::info($painters);          
    return view('admin.ManageUsers', compact('painters'));  
    }
}
