<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Http\Requests\PostsRequest;
use App\Photo;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(3);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::lists('name', 'id')->all();
        return view('admin.posts.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;


        if ($photo = $request->file('photo_id')) {
            $name = time() . $photo->getClientOriginalName();
            $photo->move('images', $name);
            $imagem = Photo::create(['file'=>$name]);
            $input['photo_id'] = $imagem->id;
        }

        Post::create($input);
        Session::flash('created', 'Post criado.');
        return redirect(route('admin.posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $category = Category::lists('name', 'id');
        return view('admin.posts.edit', compact('post', 'category'));
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
        $input = $request->all();

        if ($photo = $request->file('photo_id')) {
            $name = time() . $photo->getClientOriginalName();
            $photo->move('images', $name);
            $imagem = Photo::create(['file'=>$name]);
            $input['photo_id'] = $imagem->id;
        }

        /**
         * Fazendo o UPDATE somente se for quem criou o post
         */
        Auth::user()->posts()->whereId($id)->first()->update($input);
        Session::flash('updated', 'Post atualizado.');
        return redirect(route('admin.posts.index'));
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
        if ($post->photo_id) {
            unlink(public_path().$post->photo->file);
            $post->photo->delete();
        }
        $post->delete();
        Session::flash('deleted', 'Post deletado.');
        return redirect(route('admin.posts.index'));
    }

    public function post($id)
    {
        $post = Post::findBySlugOrFail($id);
        return view('post', compact('post'));
    }
}
