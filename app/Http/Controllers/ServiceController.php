<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'services' => Service::where('deleted_at', null)->get(),
        ];

        return view('admin/service/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/service/form');
    }

    public function edit_form($id)
    {
        $satu = Service::where('id_service', $id)->first();
        $data = [
            'satu' => $satu,
        ];

        return view('admin/service/form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = $request->id_service;

        if($id == null){
            $this->insert($request);
        }else{
            $this->update($id, $request);
        }

        return redirect()->route('service');
    }

    /**
     * Show the form for inserting the specified resource.
     */
    public function insert(Request $request)
    {        
        $service = $request->service;
        $description = $request->description;
        $bodys = [];
        if(count($request->points) > 0){
            foreach($request->points as $k=>$v){
                $bodys[] = str_replace(';','',trim($v));
            }
        }
        $body = implode(';', $bodys);

        $file = $request->image;
        $fileName = $service. '.' .$file->extension();
        $file->move(public_path('images/services'), $fileName);

        $data = [
            'title' => $service,
            'description' => $description,
            'body' => $body,
            'image' => $fileName,
        ];

        $proses = Service::create($data);

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
     * Update the specified resource in storage.
     */
    public function update($id, $request)
    {        
        $service = $request->service;
        $description = $request->description;
        $bodys = [];
        if(count($request->points) > 0){
            foreach($request->points as $k=>$v){
                $bodys[] = str_replace(';','',trim($v));
            }
        }
        $body = implode(';', $bodys);

        $data = [
            'title' => $service,
            'description' => $description,
            'body' => $body,
        ];

        $file = $request->image;
        if($file != null){
            $oldFile = $request->oldFile;
            unlink(public_path('images/services/').$oldFile);

            $fileName = $service. '.' .$file->extension();
            $file->move(public_path('images/services'), $fileName);
            $data['image'] = $fileName;
        }

        $proses = Service::where('id_service', $id)->update($data);


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
        // die(dump($id));
        $image = Service::where('id_service', $id)->first();
        $filePath = public_path('images/services/' . $image->image);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $data = [
            'deleted_at' => date("Y-m-d H:i:s"),
        ];

        $proses = Service::where('id_service', $id)->update($data);

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

        return redirect()->route('service');
    }

}
