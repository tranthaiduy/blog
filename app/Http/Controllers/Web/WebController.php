<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Contact;

class WebController extends Controller
{
    public function home(){
        $highlight = Post::where('highlight_post', 1)->take(3)->get();
        $new = Post::where('new_post', 1)->take(10)->get();

        return view('web.home', compact('highlight', 'new'));
    }

    public function post($slug){
        $post = Post::where('slug', $slug)->first();
        $post->update([
            'view_counts' => $post->view_counts ++
        ]);
        $relate = Post::where('category_id', $post->category_id)->take(2)->inRandomOrder()->get();
        $highlight = Post::where('highlight_post', 1)->take(2)->get();
        return view('web.post', compact('post', 'relate', 'highlight'));
    }

    public function comment(Request $request, $id){
        Comment::create([
            'content' => $request->content,
            'user_id'  => Auth::id(),
            'post_id' => $id,
        ]);

        return redirect()->back();
    }

    public function category(){
        $posts = Post::paginate(10);
        $categories = Category::all();

        return view('web.category', compact('posts', 'categories'));
    }

    public function categorySlug($slug){
        $category = Category::where('slug', $slug)->first();

        $posts = Post::where('category_id', $category->id)->paginate(10);
        $categories = Category::all();

        return view('web.category', compact('posts', 'categories'));
    }

    public function contact(){
        return view('web.contact');
    }

    public function sendContact(Request $request){
        Contact::create($request->all());
        return redirect()->route('web.contact')->with('success', 'Sent Contact Successfully!');
    }
}
