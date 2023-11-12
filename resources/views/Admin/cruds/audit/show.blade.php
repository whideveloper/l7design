@php
    use App\Enums\ModelTypeAudit;
    use App\Models\AuditActivity;
@endphp
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
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard.audit.index')}}">Auditoria</a>
                                    </li>
                                    <li class="breadcrumb-item active">Visualizar Evento Auditoria</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Visualizar Evento Auditoria</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row col-12">
                    <div class="col-12 col-lg-12">
                        <div class="card card-body">
                            <div class="mb-2 col-lg-6">
                                <div>
                                    <h5>Usuário manipulador</h5>
                                </div>
                                @if($activitie->causer)
                                    <!-- Verifica se há um usuário associado (causer) -->
                                    <td>{{ $activitie->causer->name }}</td>
                                @else
                                    <td>Não encontrado</td>
                                @endif
                            </div>
                            <div class="mb-2 col-lg-6">
                                <div>
                                    <h5>Recurso manipulado</h5>
                                </div>
                                {{--{{ ModelTypeAudit::getLabel($activitie->subject_type) }}--}}
                                {{$modelName = AuditActivity::getModelName($activitie->subject_type)}}
                            </div>
                            <div class="mb-2">
                                <div>
                                    <h5>Ação realizada</h5>
                                </div>
                                @switch($activitie->description)
                                    @case('created') <span>Criação</span> @break
                                    @case('updated') <span>Atualização</span> @break
                                    @case('deleted') <span>Deleção</span> @break
                                @endswitch
                            </div>
                            <div class="mb-2">
                                <div>
                                    <h5>Data do evento</h5>
                                </div>
                                @switch($activitie->description)
                                    @case('created')
                                        <span>{{$activitie->created_at->format('d/m/Y H:i:s')}}</span> @break
                                    @case('updated')
                                        <span>{{$activitie->updated_at->format('d/m/Y H:i:s')}}</span> @break
                                    @case('deleted')
                                        <span>{{$activitie->created_at->format('d/m/Y H:i:s')}}</span> @break
                                @endswitch
                            </div>
                            <div class="mb-2">
                                <div>
                                    <h5>Valores Antigos</h5>
                                </div>
                                <code>
                                    {{ print_r($activitie->properties['old'] ?? [], true) }}
                                </code>
                            </div>
                            <div class="mb-2">
                                <div>
                                    <h5>Valores Novos</h5>
                                </div>
                                <code>
                                    {{ print_r($activitie->properties['attributes'] ?? [], true) }}
                                    {{--                                    {{ '<pre>' . json_encode($activitie->properties['attributes'] ?? [], JSON_PRETTY_PRINT) . '</pre>' }}--}}
                                    {{--                                    {{ json_encode($activitie->properties['attributes'] ?? [], JSON_PRETTY_PRINT) }}--}}

                                </code>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    @include('Admin.components.links.resourcesCreateEdit')
@endsection
