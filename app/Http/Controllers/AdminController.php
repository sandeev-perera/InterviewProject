<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function showAdminDashboard(){
        $posts = Post::count();
        $users = User::where('role', "customer" )->count();
        return view('admin.Admindashboard', compact('users', 'posts'));
    }

    public function showProductsPage(Request $request){
        $search = trim($request->input('search'));
        $posts = Post::query()
            ->select(['id','title','image_path','category','user_id'])
            ->with(['user:id,name'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('title', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();    

    return view('admin.ManageProducts', compact('posts', 'search'));
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
    return view('admin.ManageUsers', compact('painters'));  
    }
}
