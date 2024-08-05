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
                                <h5 class="card-title">Data Portfolio</h5>
                                <a href="{{ route('portfolio_form') }}" class="btn btn-success btn-sm">add new <i class="bi bi-plus"></i></a>
                            </div>

                            @if (session('alert'))
                                {!! session('alert') !!}
                            @endif
                            <!-- Table with stripped rows -->
                            <table class="table datatable table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Service Category</th>
                                        <th>Description</th>
                                        <th>Location</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($portfolios as $k => $v)
                                    <tr>
                                        <td class="text-center">{{ $k + 1 }}</td>
                                        <td>{{ $v->title }}</td>
                                        <td>{{ $v->service_name }}</td>
                                        <td>{{ $v->description }}</td>
                                        <td>{{ $v->location }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detail-service1">
                                                <i class="bi bi-card-image text-white"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <a class="btn btn-success btn-sm" href="portfolio/edit/{{ $v->id_portofolio }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-service" data-id="{{ $v->id_portofolio }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="hapus-service" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Jasa Servis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body p-1">
                    <!-- General Form Elements -->
                    <form action="#" method="post" id="form-delete">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-12 col-form-label">Apakah anda yakin ingin menghapus data ini?</label>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                    <!-- End General Form Elements -->
                </div>
            </div>
        </div>
    </div>
@endSection

@section('js')
    <script>
        $('#hapus-service').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var url_delete = 'portfolio/delete/'+id
            $('#form-delete').attr('action', url_delete)
        })

        $("#hapus-service").on('hide.bs.modal', function(event){
            $('#form-delete').attr('action', '#')
        })
    </script>
@endSection