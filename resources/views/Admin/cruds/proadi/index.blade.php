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
                                    <li class="breadcrumb-item active">Proadi</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Proadi</h4>
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
                                        @can('proadi.remover')
                                            <button id="btSubmitDelete" data-route="{{route('admin.dashboard.proadi.destroySelected')}}" type="button" class="btn btn-danger" style="display: none;">Deletar selecionados</button>             
                                        @endcan
                                    </div>
                                    
                                    <div class="col-6">
                                        @can('proadi.criar')
                                            @if (!$proadi)
                                                <a href="{{route('admin.dashboard.proadi.create')}}" class="btn btn-success float-end">Adicionar novo <i class="mdi mdi-plus"></i></a>
                                            @endif                                          
                                        @endcan
                                    </div>
                                   
                                </div>
                                <table data-toggle="table" data-page-size="5" data-pagination="false" class="table-bordered table-sortable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="bs-checkbox">
                                                <label><input name="btnSelectAll" type="checkbox"></label>
                                            </th>
                                            <th>Título</th>
                                            <th>Imagem</th>
                                            <th>Status</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    @if ($proadi)
                                        <tbody>
                                            <tr data-code="{{$proadi->id}}">
                                                <td class="bs-checkbox">
                                                    <label><input data-index="" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$proadi->id}}"></label>
                                                </td>
                                                <td>{{$proadi->title}}</td>
                                                <td class="table-user text-center">
                                                    @if ($proadi->path_image)
                                                        <img src="{{ asset('storage/'.$proadi->path_image) }}" name="path_image" alt="table-user" class="me-2 rounded-circle">
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    @switch($proadi->active)
                                                        @case(0) <span class="badge bg-danger">Inativo</span> @break
                                                        @case(1) <span class="badge bg-success">Ativo</span> @break
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        @can('proadi.editar')
                                                        <div class="col-4">
                                                            <a href="{{route('admin.dashboard.proadi.edit',['proadi' => $proadi->id])}}" class="btn-icon mdi mdi-square-edit-outline"></a>
                                                        </div>
                                                        @endcan
                                                        @can('proadi.remover')
                                                        <form action="{{route('admin.dashboard.proadi.destroy',['proadi' => $proadi->id])}}" class="col-4" method="POST">
                                                            @method('DELETE') @csrf
                                                            <button type="button" class="btn-icon btSubmitDeleteItem"><i class="mdi mdi-trash-can"></i></button>
                                                        </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endif

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
