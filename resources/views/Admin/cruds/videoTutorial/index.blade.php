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
                                    <li class="breadcrumb-item active">Vídeo Tutorial</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Vídeo Tutorial</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Parte 1 - Apresentando a Tela de Login</h4>
                                        <!-- 21:9 aspect ratio -->
                                        <div class="ratio ratio-16x9">
                                            <video controls>
                                                <source src="{{asset('Admin/assets/videos-tutorial/login-part-1.mp4')}}" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Parte 2 - Home</h4>
                                        <!-- 21:9 aspect ratio -->
                                        <div class="ratio ratio-16x9">
                                            <video controls>
                                                <source src="{{asset('Admin/assets/videos-tutorial/home.mp4')}}" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Parte 3 - Especialidades</h4>
                                        <!-- 21:9 aspect ratio -->
                                        <div class="ratio ratio-16x9">
                                            <video controls>
                                                <source src="{{asset('Admin/assets/videos-tutorial/especialidade.mp4')}}" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Parte 4 - Material de Apoio</h4>
                                        <!-- 21:9 aspect ratio -->
                                        <div class="ratio ratio-16x9">
                                            <video controls>
                                                <source src="{{asset('Admin/assets/videos-tutorial/material-de-apoio.mp4')}}" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Parte 5 - Mural de Comunicação</h4>
                                        <!-- 21:9 aspect ratio -->
                                        <div class="ratio ratio-16x9">
                                            <video controls>
                                                <source src="{{asset('Admin/assets/videos-tutorial/mural-de-comunicacao.mp4')}}" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Parte 6 - SAV's</h4>
                                        <!-- 21:9 aspect ratio -->
                                        <div class="ratio ratio-16x9">
                                            <video controls>
                                                <source src="{{asset('Admin/assets/videos-tutorial/savs.mp4')}}" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Parte 7 - Desempenho</h4>
                                        <!-- 21:9 aspect ratio -->
                                        <div class="ratio ratio-16x9">
                                            <video controls>
                                                <source src="{{asset('Admin/assets/videos-tutorial/desempenho.mp4')}}" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Parte 8 - Galeria</h4>
                                        <!-- 21:9 aspect ratio -->
                                        <div class="ratio ratio-16x9">
                                            <video controls>
                                                <source src="{{asset('Admin/assets/videos-tutorial/galeria.mp4')}}" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Parte 9 - Contato</h4>
                                        <!-- 21:9 aspect ratio -->
                                        <div class="ratio ratio-16x9">
                                            <video controls>
                                                <source src="{{asset('Admin/assets/videos-tutorial/contato.mp4')}}" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Parte 10 - Outros</h4>
                                        <!-- 21:9 aspect ratio -->
                                        <div class="ratio ratio-16x9">
                                            <video controls>
                                                <source src="{{asset('Admin/assets/videos-tutorial/outros.mp4')}}" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Parte 11 - Final</h4>
                                        <!-- 21:9 aspect ratio -->
                                        
                                        <div class="ratio ratio-16x9">
                                            <video controls>
                                                <source src="{{asset('Admin/assets/videos-tutorial/final.mp4')}}" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div> <!-- end col-->
                </div>
                <!-- end row -->
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    @include('Admin.components.links.resourcesIndex')
@endsection
