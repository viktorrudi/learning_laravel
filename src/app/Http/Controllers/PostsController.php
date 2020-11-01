<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Http\Response;
use DB;
use Illuminate\Validation\ValidationException;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int|null $id
     * @return JsonResponse
     */
    public function index(int $id = null)
    {
        if(count(Post::all()) < 1) {
            return response()->json(['message' => 'No posts are created yet'], 404);
        }

        if(!is_null($id)) {
            return self::find($id);
        }

        return response()->json(
            count(Post::all()) > 0
                ? Post::orderBy('created_at', 'asc')->get()
                : ['message' => 'No posts created yet'],
            200
        );
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function find(int $id) {
        if(Post::where('id', $id)->exists()) {
            return response()->json(Post::find($id), 200);
        } else {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }

    public function token() {
        return csrf_token();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return response()->json(["message" => "post created"], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        if (Post::where('id', $id)->exists()) {
            $post = Post::find($id);
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();

            return response()->json([
                'message' => 'Post updated',
                'post' => $post
            ], 200);
        } else {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(int $id)
    {
        if(Post::where('id', $id)->exists()) {
            $post = Post::find($id);
            $post->delete();

            return response()->json([
                'message' => 'Post deleted'
            ], 200);
        } else {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }
}
