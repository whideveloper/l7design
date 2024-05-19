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
                                    <li class="breadcrumb-item active">Categoria mural de comunicação</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Categoria mural de comunicação</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">                                
                                <div class="row mb-3">
                                    <div class="col-6">
                                        @can('mural de comunicacao.remover')
                                            <button id="btSubmitDelete" data-route="{{route('admin.dashboard.muralDeComunicacaoCategory.destroySelected')}}" type="button" class="btn btn-danger" style="display: none;">Deletar selecionados</button>             
                                        @endcan
                                    </div>
                                    
                                    <div class="col-6">
                                        @can('mural de comunicacao.criar')
                                            <a href="{{route('admin.dashboard.muralDeComunicacaoCategory.create')}}" class="btn btn-success float-end">Adicionar novo <i class="mdi mdi-plus"></i></a>                                              
                                        @endcan
                                    </div>
                                   
                                </div>
                                <table data-toggle="table" data-page-size="5" data-pagination="false" class="table-bordered table-sortable">
                                    <thead class="table-light">
                                        <tr>
                                            <th></th>
                                            <th class="bs-checkbox">
                                                <label><input name="btnSelectAll" type="checkbox"></label>
                                            </th>
                                            <th>Título</th>
                                            <th>Status</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody data-route="{{route('admin.dashboard.muralDeComunicacaoCategory.sorting')}}">
                                        @foreach($muralDeComunicacaoCategories as $key => $muralDeComunicacaoCategory)
                                            <tr data-code="{{$muralDeComunicacaoCategory->id}}">
                                                <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                                <td class="bs-checkbox">
                                                    <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$muralDeComunicacaoCategory->id}}"></label>
                                                </td>
                                                <td>{{$muralDeComunicacaoCategory->title}}</td>

                                                <td class="text-center">
                                                    @switch($muralDeComunicacaoCategory->active)
                                                        @case(0) <span class="badge bg-danger">Inativo</span> @break
                                                        @case(1) <span class="badge bg-success">Ativo</span> @break
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        @can('mural de comunicacao.editar')
                                                        <div class="col-4">
                                                            <a href="{{route('admin.dashboard.muralDeComunicacaoCategory.edit',['muralDeComunicacaoCategory' => $muralDeComunicacaoCategory->id])}}" class="btn-icon mdi mdi-square-edit-outline"></a>
                                                        </div>
                                                        @endcan
                                                        @can('mural de comunicacao.remover')
                                                        <form action="{{route('admin.dashboard.muralDeComunicacaoCategory.destroy',['muralDeComunicacaoCategory' => $muralDeComunicacaoCategory->id])}}" class="col-4" method="POST">
                                                            @method('DELETE') @csrf
                                                            <button type="button" class="btn-icon btSubmitDeleteItem"><i class="mdi mdi-trash-can"></i></button>
                                                        </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>                                 
                                </table>
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
