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
                        <div class="page-title-box" style="background: #FFF;padding: 0 15px;border-radius: 10px;margin-top: 20px;">
                            <h4 class="page-title"><span class="mdi mdi-desktop-mac-dashboard"></span> Dashboard </h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row mt-0">
                    @if (Auth::user()->can('banners.visualizar')
                        || Auth::user()->can('como funciona.visualizar')
                        || Auth::user()->can('depoimento.visualizar')
                        || Auth::user()->can('hospital.visualizar')
                        || Auth::user()->can('localizacao.visualizar')
                        || Auth::user()->can('proadi.visualizar')
                        || Auth::user()->can('telenordeste.visualizar')
                        || Auth::user()->can('teleinterconsulta.visualizar'))
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"><i class="mdi mdi-home"></i> Home</h4>
                            </div>
                        </div>
                    @endif
                    @can('banners.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.banner.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="mdi mdi-image-multiple-outline font-24 avatar-title text-dark"></i>
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
                    @can('como funciona.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.howItWork.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="mdi mdi-lan font-24 avatar-title text-dark"></i>
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
                    @can('depoimento.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.depoiment.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="mdi mdi-message-text font-24 avatar-title text-dark"></i>
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
                    @can('hospital.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.hospital.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="mdi mdi-hospital-box-outline font-24 avatar-title text-dark"></i>
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
                    @can('localizacao.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.location.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="mdi mdi-map-marker-outline font-24 avatar-title text-dark"></i>
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
                    @can('proadi.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.proadi.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="mdi mdi-layers-triple-outline font-24 avatar-title text-dark"></i>
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
                    @can('telenordeste.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.telenordeste.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="mdi mdi-layers-outline font-24 avatar-title text-dark"></i>
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
                    @can('teleinterconsulta.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.teleinterconsulta.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="mdi mdi-layers-minus font-24 avatar-title text-dark"></i>
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
                </div>
                <div class="row mt-0">
                    @if (Auth::user()->can('especialidade.visualizar')
                        || Auth::user()->can('tutorial.visualizar')
                        || Auth::user()->can('treinamento.visualizar')
                        || Auth::user()->can('agendamento.visualizar')
                        )
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"><i class="fas fa-user-nurse"></i> Especialidades</h4>
                            </div>
                        </div>
                    @endif
                    @can('especialidade.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.especialidadeCategory.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="d-flex fas fa-sitemap font-24 avatar-title text-dark"></i>
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
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.especialidadeSession.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="d-flex fas fa-user-nurse font-24 avatar-title text-dark"></i>
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
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.tutorial.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="d-flex fas fa-project-diagram font-24 avatar-title text-dark"></i>
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
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.trainingForUse.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="d-flex fas fa-shapes font-24 avatar-title text-dark"></i>
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
                    @can('agendamento.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.agendamento.index')}}">
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
                </div>
                <div class="row mt-0">
                    @if (Auth::user()->can('protocolo.visualizar') || 
                        Auth::user()->can('material de apoio.visualizar'))
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"><i class="mdi mdi-file-document-multiple"></i> Material de apoio</h4>
                            </div>
                        </div>
                    @endif                      
                    @can('protocolo.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.protocol.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="mdi mdi-file-document font-24 avatar-title text-dark"></i>
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
                    @can('material de apoio.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.material.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="mdi mdi-file-document-multiple font-24 avatar-title text-dark"></i>
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
                </div>
                <div class="row mt-0">
                    @if (Auth::user()->can('mural de comunicacao.visualizar'))
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"><i class="mdi mdi-form-select"></i> Mural de comunicação</h4>
                            </div>
                        </div>
                    @endif                       
                    @can('mural de comunicacao.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.muralDeComunicacaoCategory.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="d-flex fas fa-sitemap font-24 avatar-title text-dark"></i>
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
                        <div class="col-md-6 col-xl-3">
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
                </div>
                <div class="row mt-0">
                    @if (Auth::user()->can('sav.visualizar') || Auth::user()->can('lead.visualizar'))
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"><i class="mdi mdi-video"></i> SAVS</h4>
                            </div>
                        </div>
                    @endif                       
                    @can('sav.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.sav.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="mdi mdi-video font-24 avatar-title text-dark"></i>
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
                    @can('lead.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.lead.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="mdi mdi-bullseye-arrow font-24 avatar-title text-dark"></i>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <h4 class="text-dark mt-1">Leads</h4>
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
                <div class="row mt-0">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title"><i class="fe-bar-chart-2"></i> Desempenho</h4>
                        </div>
                    </div>  
                    <div class="col-md-6 col-xl-3">
                        <a nofollow href="{{route('admin.dashboard.sectionTitlePerformance.index')}}">
                            <div class="widget-rounded-circle card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                <i class="mdi mdi-format-title font-24 avatar-title text-dark"></i>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="text-center">
                                                <h4 class="text-dark mt-1">Título Seção Desempenho</h4>
                                                <p class="text-muted mb-1">Gerenciar</p>
                                            </div>
                                        </div>
                                    </div> <!-- end row-->
                                </div>
                            </div> <!-- end widget-rounded-circle-->
                        </a>
                    </div> <!-- end col-->                  
                    @can('mapa.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.map.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="mdi mdi-map-outline font-24 avatar-title text-dark"></i>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <h4 class="text-dark mt-1">Mapa</h4>
                                                    <p class="text-muted mb-1">Gerenciar</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </a>
                        </div> <!-- end col-->
                    @endcan
                    @can('quadro geral ubs.importar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.importExcel.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="fe-bar-chart-2 font-24 avatar-title text-dark"></i>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <h4 class="text-dark mt-1">Quadro geral por UBS</h4>
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
                <div class="row mt-0">                    
                    @can('parceiro.visualizar')
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"><i class="fas fa-handshake"></i> Parceiros</h4>
                            </div>
                        </div>                      
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.partner.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="d-flex fas fa-handshake font-24 avatar-title text-dark"></i>
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
                </div>
                <div class="row mt-0">
                    @if (Auth::user()->can('evento.visualizar') || Auth::user()->can('galeria.visualizar'))
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"><i class="mdi mdi-calendar-month"></i> Agenda/Galeria</h4>
                            </div>
                        </div>
                    @endif                     
                    @can('evento.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.event.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="mdi mdi-calendar-month font-24 avatar-title text-dark"></i>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <h4 class="text-dark mt-1">Eventos</h4>
                                                    <p class="text-muted mb-1">Gerenciar</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </a>
                        </div> <!-- end col-->
                    @endcan
                    @can('galeria.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.gallery.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="mdi mdi-folder-multiple-image font-24 avatar-title text-dark"></i>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <h4 class="text-dark mt-1">Galeria</h4>
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
                <div class="row mt-0">
                    @if (Auth::user()->can('contato.visualizar') || Auth::user()->can('google form.visualizar'))
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"><i class="mdi mdi-clipboard-list-outline"></i> Contato</h4>
                            </div>
                        </div>
                    @endif                       

                    @can('contato.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.contactTelenordeste.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="mdi mdi-clipboard-list-outline font-24 avatar-title text-dark"></i>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <h4 class="text-dark mt-1">Contato Telenordeste</h4>
                                                    <p class="text-muted mb-1">Gerenciar</p>
                                                </div>
                                            </div>
                                        </div> <!-- end row-->
                                    </div>
                                </div> <!-- end widget-rounded-circle-->
                            </a>
                        </div> <!-- end col-->
                    @endcan
                    @can('google form.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.googleForm.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="mdi mdi-gmail font-24 avatar-title text-dark"></i>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-center">
                                                    <h4 class="text-dark mt-1">Seção formulário</h4>
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
                <div class="row mb-4 mt-4">
                    @if (Auth::user()->can('grupo.visualizar')
                        || Auth::user()->can('usuario.visualizar')
                        || Auth::user()->can('auditoria.visualizar'))
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title"><i class="mdi mdi-tools"></i> Outros</h4>
                            </div>
                        </div>
                    @endif
                    @can('grupo.visualizar')
                        <div class="col-md-6 col-xl-3">
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
                    @can('usuario.visualizar')
                        <div class="col-md-6 col-xl-3">
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
                    @can('auditoria.visualizar')
                        <div class="col-md-6 col-xl-3">
                            <a nofollow href="{{route('admin.dashboard.audit.index')}}">
                                <div class="widget-rounded-circle card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="avatar-lg rounded-circle border-secondary border shadow m-auto mb-3">
                                                    <i class="mdi mdi-file-search-outline font-24 avatar-title text-dark"></i>
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
