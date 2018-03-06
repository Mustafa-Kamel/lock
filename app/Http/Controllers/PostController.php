<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $rules = [
        'category_id'   => 'required|integer',
        'title'         => 'required|string|min:3|max:255',
        'img'           => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        'slug'          => 'sometimes|nullable|alpha_dash|unique:posts|max:255',
        'body'          => 'required|string'
    ];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(4);
        return view('blog.index', compact('posts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\User
     * @return \Illuminate\Http\Response
     */
    public function userPosts(\App\User $user)
    {
        $posts = $user->posts()->latest()->paginate(4);
        return view('blog.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id', 'title')->get();
        return view('blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->rules);

        $data = request(['category_id', 'title', 'body']);
        $data['slug'] = Post::uniqueSlug();
        if($request['img']){
            $imageName = time().'-'.$request->img->getClientOriginalName();
            $request->img->move(public_path('img'), $imageName);
            $data['img'] = $imageName;
        }
        
        if(auth()->user()->posts()->create($data)){
            $message = ['message' => 'The post has been added successfully.', 'status' => 1, 'alert' => 'success'];
            return redirect()->route('post.index')->with('message', $message);
        }
        $message = ['message' => 'Sorry, an error has been occured, we were not able to add the post.', 'status' => 0, 'alert' => 'danger'];
        return redirect()->route('post.create')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('blog.post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('blog.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = $this->rules;
        $rules['category_id'] = 'sometimes|integer';
        $rules['slug'] = 'sometimes|nullable|alpha_dash|max:255';
        $request->validate($rules);

        $post->fill(['title' => $request->title, 'body' => $request->body]);

        if($request->category_id)
            $post->fill(['category_id' => $request->category_id]);

        if($request->slug){
            $post->fill(['slug' => Post::uniqueSlug()]);
        }

        if($request->img){
            $imageName = time().'-'.$request->img->getClientOriginalName();
            $request->img->move(public_path('img'), $imageName);
            if(file_exists(public_path('img').'/'.$post->img)){
                @unlink(public_path('img').'/'.$post->img);
            }
            $post->fill(['img' => $imageName]);
        }
        if($post->save()){
            $message = ['message' => 'The post has been updated successfully.', 'status' => 1, 'alert' => 'success'];
            return redirect()->route('post.index')->with('message', $message);
        }
        $message = ['message' => 'Sorry, an error has been occurred, we were not able to update the post.', 'status' => 0, 'alert' => 'danger'];
        return redirect()->route('post.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {dd($post);
        if(file_exists($post->img)){
            @unlink(public_path('img').'/'.$post->img);
        }
        if($post->delete()){
            $message = ['message' => 'The post has been deleted successfully.', 'status' => 1, 'alert' => 'success'];
            return redirect()->route('post.index')->with('message', $message);
        }
        $message = ['message' => 'Sorry, an error has been occured, we were not able to delete the post.', 'status' => 0, 'alert' => 'danger'];
        return redirect()->back()->with('message', $message);
    }
}
