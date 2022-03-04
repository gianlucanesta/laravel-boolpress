<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index() {
        // dd('tornare tutti i post in formato json');
        $posts = Post::all();

        // dd($posts); //ottengo una collection di tutti i post

        // return response()->json($posts);

        $response_array = [
			'success' => true,		//chiave success per verificare che tutto sia andato a buon fine
			'results' => $posts
		];

		return response()->json($response_array);
    }
}
