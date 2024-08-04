@extends('admin.html')

@section('content')
    <div>
        <div class="pagetitle">
            <h1>Servives</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
                <li class="breadcrumb-item active">Service</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Add New Services</h5>
                                <a href="{{ route('service') }}" class="btn btn-warning btn-sm"><i class="bi bi-arrow-left"></i> back</a>
                            </div>                            

                            <form class="row g-3" method="post" action="{{ route('service_submit') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-12">
                                    <label for="service" class="form-label">Service Name</label>
                                    <input type="hidden" name="id_service" value="{{ @$satu['id_service'] }}">
                                    <input type="text" name="service" class="form-control form-control-sm" placeholder="service..." id="service" value="{{ @$satu['title'] }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea style="height: 100px" name="description" type="text" class="form-control form-control-sm" placeholder="repair..." id="description">{{ @$satu['description'] }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label for="point" class="form-label">Point</label>
                                    <div id="output_point">
                                        <?php
                                        $points = @$satu['body'];
                                        $arr_point = explode(';', $points);
                                        if(count($arr_point) > 0){
                                            foreach ($arr_point as $key=>$value) {
                                                if($key == 0){
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control form-control-sm" placeholder="problem..." name="points[]" value="<?= $value?>">
                                                                <button class="btn btn-primary btn-sm" type="button" onclick="add_point()"><i class="bi bi-plus"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                <?php } else{ ?>

                                                    <div class="row mt-2 row-point">
                                                        <div class="col-lg-6">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control form-control-sm" placeholder="problem..." name="points[]" value="<?= $value?>">
                                                                <button class="btn btn-danger btn-sm" type="button" onclick="hapus_point(this)"><i class="bi bi-x"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }
                                            }

                                        }else{ ?>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="input-group">
                                                    <input type="text" class="form-control form-control-sm" placeholder="problem..." name="points[]">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button" onclick="add_point()"><i class="bi bi-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    </div>
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
        function add_point() {
            var html = '<div class="row mt-2 row-point">'+
            '<div class="col-lg-6">'+
            '<div class="input-group">'+
            '<input type="text" class="form-control form-control-sm" placeholder="problem..." name="points[]">'+
            '<button class="btn btn-danger btn-sm" type="button" onclick="hapus_point(this)"><i class="bi bi-x"></i></button>'+
            '</div>'+
            '</div>'+
            '</div>';
            $('#output_point').append(html);

        }

        function hapus_point(element) {
            $(element).closest('.row-point').remove();
        }
    </script>
@endSection