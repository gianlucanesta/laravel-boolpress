<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            //Posts Foreign Key
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')
                ->references();
                ->on('posts');
    
            //Tags Foreign Key
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')
                    ->references();
                    ->on('tags');
            
            //Better Indexing Performances
            $table->primary(['post_id', 'tag_id']); 
            });
        }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
