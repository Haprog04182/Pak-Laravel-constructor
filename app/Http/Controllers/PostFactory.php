<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Text;
use App\Models\Post;
use App\Models\Lesson;

class PostFactory extends Controller
{

    public function showRows(Request $request){
        $rows = Lesson::find($request->lesson_id)->rows;
        return $rows;
    }
    public function storePost(Request $request){
        $postData = $request->validate([
            'col' => '',
            'row_id' => '',
        ]);
        return Post::create($postData);
    }


    public function storeText(Request $request){
        $post = $this->storePost($request);

        $text = Text::create([
            'PostText' => ' ',
            'post_id' => $post->id
        ]);
        return view('posts.text', compact('text'));
    }

    public function showTexts($postId){
        $texts = Post::find($postId)->texts;
        return view('post.text', compact('text'));
    }

    public function updateText(Request $request){
        $text = Text::find($request->text_id);
        $text->fill([
            'post_id' => $request->post_id,
            'PostText' => $request->PostText,
        ]);
        $text->save();
        return back()->withInput();
    }
}
