@extends('Admin.core.admin')
@section('content')
    <style>
        .card{
            transition: ease all 0.4s;
        }
        .card:hover{
            box-shadow: 3px 3px 12px rgb(0 0 0 / 14%);
            transform: scale(1.01);
            transition: ease all 0.4s;
        }
        .card:hover .avatar-lg{
            border-color:  #f79623 !important;
        }
        .card:hover .avatar-title,
        .card:hover h4{
            color:  #f79623 !important;
        }

    </style>
    <div class="content-page">
        <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Dashboard</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row mt-4">
                        @can('grupo.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.group.index')}}">
                                    <div class="widget-rounded-circle card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                        <i class="mdi mdi-account-group font-24 avatar-title text-dark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="text-center">
                                                        <h4 class="text-dark mt-1">Grupos</h4>
                                                        <p class="text-muted mb-1">Gerenciar Grupos</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan

                        @can('telenordeste.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.telenordeste.index')}}">
                                    <div class="widget-rounded-circle card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                        <i class="mdi mdi-notebook font-24 avatar-title text-dark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="text-center">
                                                        <h4 class="text-dark mt-1">Telenordeste</h4>
                                                        <p class="text-muted mb-1">Gerenciar Telenordeste</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('banners.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.banner.index')}}">
                                    <div class="widget-rounded-circle card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                        <i class="mdi mdi-notebook font-24 avatar-title text-dark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="text-center">
                                                        <h4 class="text-dark mt-1">Banner</h4>
                                                        <p class="text-muted mb-1">Gerenciar Banner</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('localizacao.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.location.index')}}">
                                    <div class="widget-rounded-circle card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                        <i class="mdi mdi-notebook font-24 avatar-title text-dark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="text-center">
                                                        <h4 class="text-dark mt-1">Localização</h4>
                                                        <p class="text-muted mb-1">Gerenciar Localização</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('teleinterconsulta.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.teleinterconsulta.index')}}">
                                    <div class="widget-rounded-circle card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                        <i class="mdi mdi-notebook font-24 avatar-title text-dark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="text-center">
                                                        <h4 class="text-dark mt-1">Teleinterconsulta</h4>
                                                        <p class="text-muted mb-1">Gerenciar Teleinterconsulta</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('disciplina.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.subject.index')}}">
                                    <div class="widget-rounded-circle card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                        <i class="mdi mdi-notebook font-24 avatar-title text-dark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="text-center">
                                                        <h4 class="text-dark mt-1">Disciplinas</h4>
                                                        <p class="text-muted mb-1">Gerenciar Disciplinas</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan

                        @can('curso.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.course.index')}}">
                                    <div class="widget-rounded-circle card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                        <i class="mdi mdi-school font-24 avatar-title text-dark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="text-center">
                                                        <h4 class="text-dark mt-1">Cursos</h4>
                                                        <p class="text-muted mb-1">Gerenciar Cursos</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan

                        @can('aluno.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.student.index')}}">
                                    <div class="widget-rounded-circle card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                        <i class="mdi mdi-account-multiple font-24 avatar-title text-dark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="text-center">
                                                        <h4 class="text-dark mt-1">Alunos</h4>
                                                        <p class="text-muted mb-1">Gerenciar Alunos</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan

                        @can('usuario.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.user.index')}}">
                                    <div class="widget-rounded-circle card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                        <i class="mdi mdi-account-tie font-24 avatar-title text-dark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="text-center">
                                                        <h4 class="text-dark mt-1">Usuários</h4>
                                                        <p class="text-muted mb-1">Gerenciar Usuários</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('formulario de contato.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.contact.index')}}">
                                    <div class="widget-rounded-circle card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                        <i class="mdi mdi-form-select font-24 avatar-title text-dark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="text-center">
                                                        <h4 class="text-dark mt-1">Formulário de contato</h4>
                                                        <p class="text-muted mb-1">Gerenciar Formulário de contato</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('auditoria.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.audit.index')}}">
                                    <div class="widget-rounded-circle card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                        <i class="mdi mdi-form-select font-24 avatar-title text-dark"></i>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="text-center">
                                                        <h4 class="text-dark mt-1">Auditoria</h4>
                                                        <p class="text-muted mb-1">Gerenciar Auditoria</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                    </div>

                </div> <!-- container -->
        </div> <!-- content -->

    </div>
    @include('Admin.components.links.resourcesIndex')
@endsection
