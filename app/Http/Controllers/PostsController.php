<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use function Pest\Laravel\post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function showAllPosts()
    {
        $posts = Post::query()
            ->select(['id', 'title', 'image_path', 'category', 'user_id'])
            ->with(['user:id,name'])
            ->latest()
            ->paginate(12)
            ->withQueryString();
        return view('welcome', compact('posts'));
    }

    public function showPostsByCategory($category)
    {
        $posts = Post::query()
            ->where('category', $category)
            ->select(['id', 'title', 'image_path', 'category', 'user_id'])
            ->with(['user:id,name'])
            ->latest()
            ->paginate(12)
            ->withQueryString();
        return view('category', compact("posts"));
    }

    public function showSinglePost(Post $post)
    {

    }


    public function showAddPost()
    {
        return view('customer.addPost');
    }


    //helper method to check the validations
    private function validationRules($isUpdateRequest = false)
    {

        $validation_rules = [
            'title' => 'required|string|max:40',
            'category' => [
                'required',
                'string',
                'max:20',
                Rule::in(['Educational', 'Authentic', 'General']),
            ],
            'year' => 'required|integer|min:1500|max:' . now()->year,
            'description' => 'string|required|max:10000'
        ];
        if ($isUpdateRequest) {
            $validation_rules["photo"] = 'nullable|image|mimes:png,jpeg,jpg|max:3072';
        } else {
            $validation_rules["photo"] = 'required|image|mimes:png,jpeg,jpg|max:3072';

        }
        return $validation_rules;
    }




    //user friendly validation messages.
    private function validationMessages()
    {
        return [
            'title.required' => "The title is Required",
            'year.max' => "The year cannot be more than " . now()->year,
            'category.in' => "Please select a valid category",
            'photo.required' => 'Photo is required.',
            'photo.image' => 'Photo must be an image.',
            'photo.mimes' => 'Photo must be a PNG, JPEG, or JPG file.',
            'photo.max' => 'Photo size cannot exceed 3MB.'
        ];
    }


    public function create()
    {

    }



    public function store(Request $request)
    {
        $data = $request->validate($this->validationRules(), $this->validationMessages());
        if ($request->hasFile('photo')) {
            $image = $request->file("photo");
            $imagepath = $this->getfilepath($image, "Images");
            $data['photo'] = $imagepath;
        }

        Log::info($data);
        Log::info(Auth::user()->id);
        try {
            Post::create([
                "title" => $data["title"],
                "user_id" => Auth::user()->id,
                "image_path" => $data["photo"],
                "category" => $data["category"],
                "painted_year" => $data['year'],
                "description" => $data['description']
            ]);
            $this->storeFile($image, 'Images', $imagepath);
            return $this->redirectWithSuccess('customer.dashboard', "Your post successfully uploaded");
        } catch (Exception $e) {
            return $this->redirectWithError('show.addPost', "Something went wrong");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->loadMissing(['user:id,name']);
        return view('post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (Auth::user()->role === "Admin" || $post->user_id == Auth::user()->id) {
            return view('Genaral.updatePost', compact('post'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate($this->validationRules(isUpdateRequest: true), $this->validationMessages());
        try {

            $newPath = null;
            if ($request->hasFile('photo')) {
                // Delete old image if exist
                if ($post->image_path && Storage::disk('public')->exists($post->image_path)) {
                    Storage::disk('public')->delete($post->image_path);
                }
                $newPath = $request->file('photo')->store('uploads/Images', 'public');
            }
            // Store new image
            $post->update([
                "title" => $data["title"],
                "user_id" => $post->user->id,
                "category" => $data["category"],
                "painted_year" => $data['year'],
                "description" => $data['description'],
                "image_path" => $newPath ?? $post->image_path,
            ]);

            if (Auth::user()->role === "Customer") {
                return $this->redirectWithSuccess('customer.dashboard', "Your post successfully updated");
            } else {
                return $this->redirectWithSuccess('admin.dashboard', "Post successfully updated");
            }
        } catch (Exception $e) {
            Log::info('update request error occured ' . $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        Log::info("delete method starts");
        Log::info($post);

        $isAdmin = Auth::user()->role === "Admin" ? true : false;
        $deleted = $post->delete();

        if ($deleted)
            if ($isAdmin) {
                //Send email
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Post deleted successfully. Email Sent');
            }
        return redirect()->route('customer.dashboard')
            ->with('success', 'Post deleted successfully.');
    }
}
