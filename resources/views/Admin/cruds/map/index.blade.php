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
                                    <li class="breadcrumb-item active">Mapa</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Mapa</h4>
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
                                        @can('mapa.remover')
                                            <button id="btSubmitDelete" data-route="{{route('admin.dashboard.map.destroySelected')}}" type="button" class="btn btn-danger" style="display: none;">Deletar selecionados</button>             
                                        @endcan
                                    </div>
                                    
                                    <div class="col-6">
                                        <a data-bs-toggle="modal" data-bs-target="#modal-import" class="btn ms-2 btn-primary float-end">Importar Excel <i class="mdi mdi-plus"></i></a>                                        
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
                                                            <button type="submit">Importar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                        @can('mapa.criar')
                                            <a href="{{route('admin.dashboard.map.create')}}" class="btn btn-success float-end">Adicionar novo <i class="mdi mdi-plus"></i></a>                                        
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
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th>Status</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody data-route="{{route('admin.dashboard.map.sorting')}}">
                                        @foreach($maps as $key => $map)
                                            <tr data-code="{{$map->id}}">
                                                <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                                <td class="bs-checkbox">
                                                    <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$map->id}}"></label>
                                                </td>
                                                <td>{{$map->title}}</td>
                                                <td>{{$map->latitude}}</td>
                                                <td>{{$map->longitude}}</td>

                                                <td class="text-center">
                                                    @switch($map->active)
                                                        @case(0) <span class="badge bg-danger">Inativo</span> @break
                                                        @case(1) <span class="badge bg-success">Ativo</span> @break
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        @can('mapa.editar')
                                                        <div class="col-4">
                                                            <a href="{{route('admin.dashboard.map.edit',['map' => $map->id])}}" class="btn-icon mdi mdi-square-edit-outline"></a>
                                                        </div>
                                                        @endcan
                                                        @can('mapa.remover')
                                                        <form action="{{route('admin.dashboard.map.destroy',['map' => $map->id])}}" class="col-4" method="POST">
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
