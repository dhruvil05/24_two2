<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){

        return view('pages.posts.post_list');
    }

    public function create(){
        return view('pages.posts.post_create');
    }

    public function getAllPosts(){
        $posts = Post::all();

        return response()->json(['posts'=>$posts]);
    }

    public function store(Request $request){

        $validated = $request->validate([
            'title'=>'required',
            'description'=>'required',
            'editorBody'=>'required',
        ]);

        if($validated){
            
            $post = new Post();
            $post->user_id = auth()->id();
            $post->title = $request->title;
            $post->description = $request->description;
            $post->content = $request->editorBody;

            if(!$post->save()){
                return response()->json(['error'=>'Something went wrong, please, try again.']);
            }
            return response()->json(['success'=>'Post Has Been Saved Successfully.']);
        }
         
    }

    public function getEditPostData($id){

        $post = Post::where('id', $id)->get();

        return view('pages.posts.post_edit')->with(['post'=>$post]);
    }

    public function edit(Request $request){

        $validated = $request->validate([
            'title'=>'required',
            'description'=>'required',
            'editorBody'=>'required',
        ]);

        if($validated){

            $post = Post::find($request->editId);
            
            $post->user_id = auth()->id();
            $post->title = $request->title;
            $post->description = $request->description;
            $post->content = $request->editorBody;
            
            if(!$post->save()){
                return response()->json(['error'=>'Something went wrong, please, try again.']);
            }
            return response()->json(['success'=>'Post Has Been Updated Successfully.']);
        }
    }

    public function delete($id){
        $post = Post::find($id);

        if(!$post->delete()){
            return response()->json(['error'=>'Something went wrong, please, try again.']);
        }
        return response()->json(['success'=>'Post Has Been Successfully Deleted.']);

    }
}
