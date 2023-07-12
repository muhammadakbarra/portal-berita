<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('detail');
    }
    public function detail($id)
    {
        $news = News::find($id);
        return view('detail', ['news' => $news]);
    }
    // public function balasan($id)
    // {
    //     $comment = Comment::find($id);
    //     return view('detail', ['comment' => $comment]);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all();
        return view('news.tampil', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        return view('news.tambah', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|integer',
            'thumbnail' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);
        $ImageName = time() . '.' .
            $request->thumbnail->extension();
        $request->thumbnail->move(public_path('uploads'), $ImageName);

        $news = new News;
        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->category_id = $request->input('category_id');
        $news->thumbnail = $ImageName;
        $news->save();

        return redirect('/news')->with('success', 'Data Berita berhasil Ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::find($id);
        return view('news.detail', ['news' => $news]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Categories::all();
        $news = News::find($id);
        return view('news.edit', ['news' => $news, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|integer',
            'thumbnail' => 'mimes:jpg,jpeg,png|max:2048',
        ]);
        $news = News::find($id);
        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->category_id = $request->input('category_id');
        if ($request->has('thumbnail')) {
            if ($news->thumbnail != null) {
                $path = "uploads/";
                File::delete($path . $news->thumbnail);
            }
            $ImageName = time() . '.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('uploads'), $ImageName);
            $news->thumbnail = $ImageName;
        }
        $news->save();
        return redirect('/news')->with('success', 'Data Berita berhasil DiUpdate');
    }

    public function destroy($id)
    {
        $news = News::find($id);
        $path = "uploads/";
        File::delete($path . $news->thumbnail);
        $news->delete();
        return redirect('/news')->with('success', 'Data Berita
    berhasil Didelete');
    }
}
