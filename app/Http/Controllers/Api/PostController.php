<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index(Request $request) {
        // dd('tornare tutti i post in formato json');
        // $posts = Post::all();
        // dd($request->all());
        $posts = Post::paginate(9);

        // $url = url('storage/' . $posts[0]->cover);
	    // dd($url);

        // Sovrascrivo l'attributo cover di ogni post con un url assoluto solo se $post->cover esiste                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
        foreach($posts as $post) {
            if($post->cover){
                $post->cover = url('storage/' . $post->cover);
            }
        }

        // dd($posts); //ottengo una collection di tutti i post

        // return response()->json($posts);

        $response_array = [
			'success' => true,		//chiave success per verificare che tutto sia andato a buon fine
			'results' => $posts
		];

		return response()->json($response_array);
    }

    public function show($slug) {
		// dd($slug);
		$post = Post::where('slug', '=', $slug)->with(['category', 'tags'])->first();
		// dd($post);

        if($post->cover) {
            $post->cover = url('storage/' . $post->cover);
        }

        if($post) {
            return response()->json([
                'success' => true,
                'results' => $post
            ]);
        } else {
            return response()->json([
                'success' => false,
                'results' => []
            ]);
        }
    }
}
