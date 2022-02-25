<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug'
    ];

    public static function getUniqueSlugFromTitle($title) {
        // Assegno uno slug base al titolo
        $slug = Str::slug($title);
        $slug_base = $slug;

        // Verifico presenza del post ed eventualmente prendo il primo
        $is_post_found = Post::where('slug', '=', $slug)->first();
        $counter = 1;

        while($is_post_found) {
            $slug = $slug_base . '-' . $counter;
            // dd($slug);
            $is_post_found = Post::where('slug', '=', $slug)->first();
            $counter++;
        }

        return $slug;
    }
}
