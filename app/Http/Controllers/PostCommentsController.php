<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user               = Auth::user();
        $comment            = $request->all();
        $comment['author']  = $user->name;
        $comment['email']   = $user->email;
        $comment['photo']   = $user->photo->file;
        Comment::create($comment);
        Session::flash('created', 'Comentário foi criado mas precisa de aprovação');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comments = Post::findOrFail($id)->comments;
        return view('admin.comments.show', compact('comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        Comment::findOrFail($id)->update($request->all());
        if ($request->is_active) {
            Session::flash('updated', 'Post aprovado.');
        } else {
            Session::flash('updated', 'Post desaprovado.');
        }
        return redirect()->back();
    }

    /**
     * Ativa ou desativa o post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id, Request $request)
    {
        Comment::findOrFail($id)->update($request->all());
        if ($request->is_active) {
            Session::flash('updated', 'Post aprovado.');
        } else {
            Session::flash('updated', 'Post desaprovado.');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();
        Session::flash('deleted', 'Comentario deletado.');
        return redirect(route('admin.comments.index'));
    }
}
