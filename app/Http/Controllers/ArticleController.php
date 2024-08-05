<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::where('deleted_at', null)->get();
        $data = [
            'articles' => $articles,
        ];

        return view('admin/article/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/article/form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = $request->id_post;

        if($id == null){
            $this->insert($request);
        }else{
            $this->update($id, $request);
        }

        return redirect()->route('article');
    }

    /**
     * Display the specified resource.
     */
    public function insert(Request $request)
    {
        $title = $request->title;
        $body = $request->body;
        
        $file = $request->image;
        $fileName = $title . '.' . $file->extension();
        $file->move(public_path('images/articles/'), $fileName);

        $data = [
            'title' => $title,
            'body' => $body,
            'image' => $fileName,
        ];

        $proses = Article::create($data);

        if ($proses) {
            session()->flash('alert', '<div class="alert alert-success alert-dismissible fade show alert-sm" role="alert">
                                            Data berhasil disimpan!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>');
        } else {
            session()->flash('alert', '<div class="alert alert-danger alert-dismissible fade show alert-sm" role="alert">
                                            Data gagal disimpan!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $satu = Article::where('id_post', $id)->first();
        $data = [
            'satu' => $satu,
        ];

        return view('admin/article/form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, $request)
    {
        $title = $request->title;
        $body = $request->body;

        $file = $request->image;
        if($file != null){
            $oldFile = $request->oldFile;
            unlink(public_path('images/articles/').$oldFile);

            $fileName = $title . '.' . $file->extension();
            $file->move(public_path('images/articles'), $fileName);
            $data['image'] = $fileName;
        }

        $data = [
            'title' => $title,
            'body' => $body
        ];

        $proses = Article::where('id_post', $id)->update($data);

        if ($proses) {
            session()->flash('alert', '<div class="alert alert-success alert-dismissible fade show alert-sm" role="alert">
                                            Data berhasil dirubah!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>');
        } else {
            session()->flash('alert', '<div class="alert alert-danger alert-dismissible fade show alert-sm" role="alert">
                                            Data gagal dirubah!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $image = Article::where('id_post', $id)->first();
        $filePath = public_path('images/articles' . $image->image);
        if(file_exists($filePath)){
            unlink($filePath);
        }

        $data = [
            'deleted_at' => date("Y-m-d H:i:s"),
        ];

        $proses = Article::where('id_post', $id)->update($data);

        if ($proses) {
            session()->flash('alert', '<div class="alert alert-success alert-dismissible fade show alert-sm" role="alert">
                                            Data berhasil dihapus!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>');
        } else {
            session()->flash('alert', '<div class="alert alert-danger alert-dismissible fade show alert-sm" role="alert">
                                            Data gagal dihapus!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>');
        }

        return redirect()->route('article');
    }
}
