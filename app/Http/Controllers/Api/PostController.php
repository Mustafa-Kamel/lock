<?php

namespace App\Http\Controllers\Api;

use App\Post;
use App\Http\Controllers\Controller;
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
        return response()->json(Post::all(), 200);
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
        
        if(auth()->user()->posts()->create($data))
            return response()->json(['message' => 'Post has been added successfully.', 'status' => 1], 200);

        return response()->json(['message' => 'Sorry, an error has been occured, we were not able to add the post.', 'status' => 0], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json($post, 200);
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
        if($post->save())
            return response()->json(['message' => 'The post has been updated successfully.', 'status' => 1], 200);
        
        return response()->json(['message' => 'Sorry, an error has been occurred, we were not able to update the post.', 'status' => 0], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(file_exists($post->img)){
            @unlink(public_path('img').'/'.$post->img);
        }
        if($post->delete())
            return response()->json(['message' => 'The post has been deleted successfully.', 'status' => 1], 200);
        
        return response()->json(['message' => 'Sorry, an error has been occured, we were not able to delete the post.', 'status' => 0], 500);
    }
}
