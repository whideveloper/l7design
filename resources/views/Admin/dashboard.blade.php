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
                                                        <h4 class="text-dark mt-1">Grupos de Permissão</h4>
                                                        <p class="text-muted mb-1">Gerenciar</p>
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
                                                        <p class="text-muted mb-1">Gerenciar</p>
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
                                                        <p class="text-muted mb-1">Gerenciar</p>
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
                                                        <p class="text-muted mb-1">Gerenciar</p>
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
                                                        <p class="text-muted mb-1">Gerenciar</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('parceiro.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.partner.index')}}">
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
                                                        <h4 class="text-dark mt-1">Parceiros</h4>
                                                        <p class="text-muted mb-1">Gerenciar</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('como funciona.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.howItWork.index')}}">
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
                                                        <h4 class="text-dark mt-1">Como Funciona</h4>
                                                        <p class="text-muted mb-1">Gerenciar</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('hospital.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.hospital.index')}}">
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
                                                        <h4 class="text-dark mt-1">Hospital Oswaldo Cruz</h4>
                                                        <p class="text-muted mb-1">Gerenciar</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('proadi.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.proadi.index')}}">
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
                                                        <h4 class="text-dark mt-1">Proadi</h4>
                                                        <p class="text-muted mb-1">Gerenciar</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('depoimento.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.depoiment.index')}}">
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
                                                        <h4 class="text-dark mt-1">Depoimentos</h4>
                                                        <p class="text-muted mb-1">Gerenciar</p>
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
                                                        <p class="text-muted mb-1">Gerenciar</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('especialidade.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.especialidadeCategory.index')}}">
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
                                                        <h4 class="text-dark mt-1">Categoria Especialidades</h4>
                                                        <p class="text-muted mb-1">Gerenciar</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('especialidade.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.especialidadeSession.index')}}">
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
                                                        <h4 class="text-dark mt-1">Especialidades</h4>
                                                        <p class="text-muted mb-1">Gerenciar</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('tutorial.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.tutorial.index')}}">
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
                                                        <h4 class="text-dark mt-1">Tutorial</h4>
                                                        <p class="text-muted mb-1">Gerenciar</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('treinamento.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.trainingForUse.index')}}">
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
                                                        <h4 class="text-dark mt-1">Treinamento da plataforma</h4>
                                                        <p class="text-muted mb-1">Gerenciar</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('protocolo.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.protocol.index')}}">
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
                                                        <h4 class="text-dark mt-1">Protocolo</h4>
                                                        <p class="text-muted mb-1">Gerenciar</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('material.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.material.index')}}">
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
                                                        <h4 class="text-dark mt-1">Material de apoio</h4>
                                                        <p class="text-muted mb-1">Gerenciar</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('agendamento.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.agendamento.index')}}">
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
                                                        <h4 class="text-dark mt-1">Agendamento</h4>
                                                        <p class="text-muted mb-1">Gerenciar</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('mural de comunicacao visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.muralDeComunicacaoCategory.index')}}">
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
                                                        <h4 class="text-dark mt-1">Categoria Mural de comunicação</h4>
                                                        <p class="text-muted mb-1">Gerenciar</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('mural de apoio.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.muralDeApoio.index')}}">
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
                                                        <h4 class="text-dark mt-1">Mural de comunicação</h4>
                                                        <p class="text-muted mb-1">Gerenciar</p>
                                                    </div>
                                                </div>
                                            </div> <!-- end row-->
                                        </div>
                                    </div> <!-- end widget-rounded-circle-->
                                </a>
                            </div> <!-- end col-->
                        @endcan
                        @can('sav.visualizar')
                            <div class="col-md-6 col-xl-4">
                                <a nofollow href="{{route('admin.dashboard.sav.index')}}">
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
                                                        <h4 class="text-dark mt-1">Sav</h4>
                                                        <p class="text-muted mb-1">Gerenciar</p>
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
                                                        <p class="text-muted mb-1">Gerenciar</p>
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
                                                        <p class="text-muted mb-1">Gerenciar</p>
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
