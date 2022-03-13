<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::paginate(3);
        // dd($posts);

        $data = [
            'posts' => $posts
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();


        // $post = Post::findOrfail($id);
        // dd($post);
        
        $data = [
            'categories' => $categories,
            // 'post' => $post,
            'tags' => $tags
        ];

        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->all();

        // TEST
        // dd($form_data);

        $request->validate($this->getValidationRules());

        $new_post = new Post();
        $new_post->fill($form_data);

        // TEST
        // $new_post->slug = Str::slug($form_data['title']);
        // dd($new_post);       
        // dd($is_post_found);

        $new_post->slug = Post::getUniqueSlugFromTitle($form_data['title']);
        
        if(isset($form_data['image'])) {
            $img_path = Storage::put('post_covers', $form_data['image']);
            // dd($img_path);

            $new_post->cover = $img_path;
        }



        $new_post->save();

        //Save tags relations
		if(isset($form_data['tags']))
		{
			$new_post->tags()->sync($form_data['tags']);		
		}

        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrfail($id);
        
        // TEST
        // dd($post);
        // dd($post->category);
        // $category = $post->category;
        // dd($category->posts);

		// $tags_test = $post->tags;    // prendo la collection dei tags presenti nel post
        // dd($tags_test); 
        
        // $tags_test = $post->tags;
		// $tag = $tags_test[0];    // prendo il primo tag presente nel post
		// dd($tag->posts);        
        // END TEST


        $data = [
            'post' => $post
        ];

        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'post' => $post,
            'categories' => $categories,
            'tags'=> $tags
        ];

        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form_data = $request->all();
        $request->validate($this->getValidationRules());

        // dd($form_data);
        $post = Post::findOrFail($id);
        // dd($post);

        // Aggiorno lo slug solo se l'utente cambia il titolo 
        if($form_data['title'] != $post->title){
            $form_data['slug'] = Post::getUniqueSlugFromTitle($form_data['title']); 
        }

        if($form_data['image']) {
            //Cancello il file vecchio
            if($post->cover) {
                Storage::delete($post->cover);
            }
    
            //Faccio l'upload del nuovo file
            $img_path = Storage::put('post_covers', $form_data['image']);
    
            //Salvo nella colonna cover il path del nuovo file
            $form_data['cover'] = $img_path;
        }

        $post->update($form_data);

		if(isset($form_data['tags'])) {
            $post->tags()->sync($form_data['tags']);
        } else {
            $post->tags()->sync([]);
        }

        return redirect()->route('admin.posts.show', ['post' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post ->tags()->sync([]);

        if($post->cover) {
            Storage::delete($post->cover);
        }

        // dd($post);
        $post->delete();

        return redirect()->route('admin.posts.index');
    }

    protected function getValidationRules() {
        return [
            'title' => 'required|max:255',
            'content' => 'required|max:60000',
            'category_id' => 'exists:categories,id|nullable',
            'tags' => 'exists:tags,id',
	        'image' => 'image|max:512'
        ];
    }

}
 
