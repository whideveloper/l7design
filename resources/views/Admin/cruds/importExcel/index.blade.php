@extends('Admin.core.admin')
@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Quadro geral por UBS</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Quadro geral por UBS</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">                                
                                <div class="row mb-0">
                                    
                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                        @can('quadro geral ubs.importar')
                                            <div class="mt-0">
                                                <span class="alert alert-warning mt-2" role="alert">OBS: Só é permitido importar arquivo nos formatos xls,xlsx</span>
                                            </div>
                                            <a data-bs-toggle="modal" data-bs-target="#modal-import" class="btn ms-2 btn-primary float-end">Importar Dados CNES <i class="mdi mdi-plus"></i></a>                                        
                                            <div id="modal-import" class="modal fade" tabindex="-1" file="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog" style="max-width: 800px;">
                                                    <div class="modal-content">
                                                        <div class="modal-header p-3 pt-2 pb-2">
                                                            <h4 class="page-title">Importar</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body p-3 pt-0 pb-3">
                                                            <form action="{{ route('admin.dashboard.importExcel') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="file" name="file" required>
                                                                <button type="submit" class="btn btn-primary float-end">Importar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        @endcan
                                    </div>
                                   
                                </div>
                            </div>
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div>
                <!-- end row -->
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    @include('Admin.components.links.resourcesIndex')
@endsection
