<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index(){
        $posts = Post::paginate(20);

        return view('admin.post.list', compact('posts'));
    }
    

    public function create(){
        $categories = Category::all();
        return view('admin.post.create', compact('categories'));
    }

    public function store(Request $request){
        $this->validate($request, 
        [
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        $slug = Str::slug($request->title);
        $checkSlug = Post::where('slug', $slug)->first();
        if($checkSlug){
            $slug = $checkSlug->slug . "_" . Str::random(2);
        }

        if($request->hasFile('image')){
            $file = $request->file('image');
            $name_file = $file->getClientOriginalName();

            $extension = $file->getClientOriginalExtension();

            if(strcasecmp($extension, 'jpg')===0 || strcasecmp($extension, 'png')===0 || strcasecmp($extension, 'jepg')===0){
                $image = Str::random(5) . "_" . $name_file;
                if(file_exists('image/post/'.$image)){
                    $image = Str::random(5) . "_" . $name_file;
                }

                $file->move('image/post', $image);
            }
        }

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'view_counts' => 0,
            'user_id' => 1,
            'new_post' => $request->new_post ? 1 : 0,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'highlight_post' => $request->highlight_post ? 1 : 0,
        ]);

        return redirect()->route('admin.post.index')->with('success', 'Create Successfully!');
    }

    public function edit($id){
        $post = Post::find($id);
        $categories = Category::all();

        return view('admin.post.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id){
        $this->validate($request, 
        [
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        $slug = Str::slug($request->title);
        $checkSlug = Post::where('slug', $slug)->first();
        if($checkSlug){
            $slug = $checkSlug->slug.Str::random(2);
        }

        if($request->hasFile('image')){
            $file = $request->file('image');
            $name_file = $file->getClientOriginalName();

            $extension = $file->getClientOriginalExtension();

            if(strcasecmp($extension, 'jpg')===0 || strcasecmp($extension, 'png')===0 || strcasecmp($extension, 'jepg')===0){
                $image = Str::random(5)."-".$name_file;
                if(file_exists('image/post/'.$image)){
                    $image = Str::random(5)."-".$name_file;
                }

                $file->move('image/post', $image);
            }
        }

        $post = Post::find($id);
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => isset($image) ? $image : $post->image,
            'new_post' => $request->new_post ? 1 : 0,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'highlight_post' => $request->highlight_post ? 1 : 0,
        ]);

        return redirect()->route('admin.post.index')->with('success', 'Update successfully!');
    }

    public function delete($id){
        Post::find($id)->delete();
        return redirect()->route('admin.post.index')->with('success', 'Delete successfully!');
    }
}
