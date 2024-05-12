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
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard.muralDeApoio.index')}}">Sessão Mural de comunicação</a></li>
                                    <li class="breadcrumb-item active">Editar Sessão Mural de comunicação</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Editar Sessão Mural de comunicação</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                {!! Form::model($muralDeApoio, ['route' => ['admin.dashboard.muralDeApoio.update', $muralDeApoio->id], 'class'=>'parsley-examples', 'method' => 'PUT', 'files' => true]) !!}
                    @include('Admin.cruds.muralDeApoio.form')
                    @can('mural de comunicacao.editar')
                    {!! Form::button('Salvar', ['class'=>'btn btn-primary waves-effect waves-light float-end me-3 width-lg', 'type' => 'submit']) !!}
                    @endcan
                    <a href="{{route('admin.dashboard.muralDeApoio.index')}}" class="btn btn-secondary waves-effect waves-light float-end me-3 width-lg">Voltar</a>
                {!! Form::close() !!}

                <div class="row mb-3 col-12">
                    <div class="row col-12 d-flex align-content-center justify-content-between flex-row pe-0 mt-3">
                        <div class="page-title-box col-lg-6">
                            <h4 class="page-title">Feeds</h4>
                        </div>
                        @can('mural de comunicacao.criar')
                            <div class="pe-0 col-lg-6">                              
                                <a href="{{route('admin.dashboard.muralDeComunicacaoFeed.create')}}" class="btn btn-success float-end">Adicionar novo <i class="mdi mdi-plus"></i></a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="row pe-3">
                    <table data-toggle="table" data-page-size="5" data-pagination="false" class="table-bordered table-sortable">

                        <thead class="table-light">
                        <tr>
                            <th></th>
                            <th class="bs-checkbox">
                                <label><input name="btnSelectAll" value="btnDeleteListLink" type="checkbox"></label>
                            </th>
                            <th class="text-center">Nome</th>
                            <th class="text-center">Função</th>
                            <th class="text-center">Imagem</th>
                           <th class="text-center">Status</th>
                           <th class="text-center">Ações</th>
                        </tr>
                        </thead>

                        <tbody data-route="{{route('admin.dashboard.muralDeComunicacaoFeed.sorting')}}">
                            @foreach ($muralDeComunicacaoFeeds as $key => $muralDeComunicacaoFeed)
                                <tr data-code="{{$muralDeComunicacaoFeed->id}}">
                                    <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                    <td class="bs-checkbox">
                                        <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$muralDeComunicacaoFeed->id}}"></label>
                                    </td>
                                    <td>{{$muralDeComunicacaoFeed->title}}</td>
                                    <td>{{$muralDeComunicacaoFeed->categoria}}</td>
                                    <td class="table-user text-center">
                                        @if ($muralDeComunicacaoFeed->path_image)
                                            <img src="{{ asset('storage/'.$muralDeComunicacaoFeed->path_image) }}" name="path_image" alt="table-user" class="me-2 rounded-circle">
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @switch($muralDeComunicacaoFeed->active)
                                            @case(0) <span class="badge bg-danger">Inativo</span> @break
                                            @case(1) <span class="badge bg-success">Ativo</span> @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="row d-flex justify-content-center">  
                                            <a href="{{route('admin.dashboard.muralDeComunicacaoFeed.edit',['muralDeComunicacaoFeed' => $muralDeComunicacaoFeed->mural_de_comunicacao_id])}}" class="btn-icon mdi mdi-square-edit-outline col-3"></a>

                                            <form action="{{route('admin.dashboard.muralDeComunicacaoFeed.destroy',['muralDeComunicacaoFeed' => $muralDeComunicacaoFeed->mural_de_comunicacao_id])}}" class="col-3" method="POST">
                                                @method('DELETE') @csrf
                                                <button type="button" class="btn-icon btSubmitDeleteItem"><i class="mdi mdi-trash-can"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    @include('Admin.components.links.resourcesCreateEdit')
@endsection
