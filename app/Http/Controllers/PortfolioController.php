<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolios = DB::table('tb_portfolios')
                        ->join('tb_services', 'tb_portfolios.service_id', '=', 'tb_services.id_service')
                        ->select('tb_portfolios.*', 'tb_services.title as service_name')
                        ->get();

        $data = [
            'portfolios' => $portfolios,
        ];

        return view('admin/portfolio/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $service = Service::where('deleted_at', null)->get();

        $data = [
            'services' => $service,
        ];

        return view('admin/portfolio/form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = $request->id_portfolio;

        if($id == null){
            $this->insert($request);
        }else{
            $this->update($id, $request);
        }

        return redirect()->route('portfolio');
    }

    /**
     * Display the specified resource.
     */
    public function insert(Request $request)
    {
        $service_id = $request->service_id;
        $title = $request->title;
        $description = $request->description;
        $problem = $request->problem;
        $damage = $request->damage;
        $result = $request->result;
        $location = $request->location;

        $file = $request->image;
        $fileName = $file;
        $file->move(public_path('images/portfolios/'), $fileName);

        $data = [
            'service_id' => $service_id,
            'title' => $title,
            'description' => $description,
            'problem' => $problem,
            'damage' => $damage,
            'result' => $result,
            'location' => $result,
            'image' => $fileName
        ];

        $proses = Portfolio::create($data);

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

        return redirect()->route('portfolio');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   
        $service = Service::where('deleted_at', null)->get();
        $satu = Portfolio::where('id_portofolio', $id)->first();

        $data = [
            'satu' => $satu,
            'services' => $service,
        ];

        return view('admin/portfolio/form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, $request)
    {
        $service_id = $request->service_id;
        $title = $request->title;
        $description = $request->description;
        $problem = $request->problem;
        $damage = $request->damage;
        $result = $request->result;
        $location = $request->location;

        $file = $request->image;
        if($file != null){
            $oldFile = $request->oldFile;
            unlink(public_path('images/portfolios/').$oldFile);

            $fileName = $title . '.' . $file->extension();
            $file->move(public_path('images/portfolios/'), $fileName);
            $data['image'] = $fileName;
        }

        $data = [
            'service_id' => $service_id,
            'title' => $title,
            'description' => $description,
            'problem' => $problem,
            'damage' => $damage,
            'result' => $result,
            'location' => $result,
        ];

        $proses = Portfolio::where('id_portofolio', $id)->update($data);

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
        $image = Portfolio::where('id_portofolio', $id)->first();
        $filePath = public_path('images/portfolios/'.$image->image);
        if(file_exists($filePath)){
            unlink($filePath);
        }

        $data = [
            'deleted_at' => date('Y-m-d H:i:s'),
        ];

        $proses = Portfolio::where('id_portfolio', $id)->update($data);

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
    }
}
