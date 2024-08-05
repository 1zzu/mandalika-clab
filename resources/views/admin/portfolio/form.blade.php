@extends('admin.html')

@section('content')
    <div>
        <div class="pagetitle">
            <h1>Portfolios</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
                <li class="breadcrumb-item active">Portfolio</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Add New Article</h5>
                                <a href="{{ route('portfolio') }}" class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> back</a>
                            </div>                            

                            <form class="row g-3" method="post" action="{{ route('portfolio_submit') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-12">
                                    <label for="service" class="form-label">Title</label>
                                    <input type="hidden" name="id_portfolio" value="{{ @$satu['id_portofolio'] }}">
                                    <input type="text" name="title" class="form-control form-control-sm" placeholder="title..." id="service" value="{{ @$satu['title'] }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="description" class="form-label">Category Services</label>
                                    <select class="form-select form-select-sm" aria-label="Default select" name="service_id">
                                        @foreach($services as $k=>$v)
                                        <option value="{{ $v->id_service }}">{{ $v->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea style="height: 100px" name="description" type="text" class="form-control form-control-sm" placeholder="description..." id="description">{{ @$satu['description'] }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label for="problem" class="form-label">Problem</label>
                                    <input type="text" name="problem" class="form-control form-control-sm" placeholder="problem..." id="problem" value="{{ @$satu['problem'] }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="damage" class="form-label">Damage</label>
                                    <input type="text" name="damage" class="form-control form-control-sm" placeholder="damage..." id="damage" value="{{ @$satu['damage'] }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="result" class="form-label">Result</label>
                                    <input type="text" name="result" class="form-control form-control-sm" placeholder="result..." id="result" value="{{ @$satu['result'] }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" name="location" class="form-control form-control-sm" placeholder="location..." id="location" value="{{ @$satu['location'] }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="hidden" name="oldFile" value="{{ @$satu->image }}">
                                    <input type="file" name="image" class="form-control form-control-sm" id="image">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">Save <i class="bi bi-save"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endSection

@section('js')
    <script>
        // function add_point() {
        //     var html = '<div class="row mt-2 row-point">'+
        //     '<div class="col-lg-6">'+
        //     '<div class="input-group">'+
        //     '<input type="text" class="form-control form-control-sm" placeholder="problem..." name="points[]">'+
        //     '<button class="btn btn-danger btn-sm" type="button" onclick="hapus_point(this)"><i class="bi bi-x"></i></button>'+
        //     '</div>'+
        //     '</div>'+
        //     '</div>';
        //     $('#output_point').append(html);

        // }

        // function hapus_point(element) {
        //     $(element).closest('.row-point').remove();
        // }
    </script>
@endSection