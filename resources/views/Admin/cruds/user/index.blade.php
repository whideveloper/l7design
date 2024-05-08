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
                                    <li class="breadcrumb-item active">Usuários</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Usuários</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3 justify-content-end">
                                    @can('usuario.remover')
                                        <div class="col-6">
                                            <button id="btSubmitDelete" data-route="{{route('admin.dashboard.user.destroySelected')}}" type="button" class="btn btn-danger" style="display: none;">Deletar selecionados</button>
                                        </div>
                                    @endcan
                                    <div class="row col-6 d-flex justify-content-end">
                                        <div style="width: 240px">
                                            @can('usuario.restaurar dados')
                                                @if ($userDeleteds_at)
                                                    <a href="{{route('admin.dashboard.user.showDeleted')}}" class="btn btn-primary float-end">Restaurar regitro(s) <i class="mdi mdi-delete-restore"></i></a>
                                                @endif
                                            @endcan
                                        </div>
                                        @can('usuario.criar')
                                            <div style="width: 165px">
                                                <a href="{{route('admin.dashboard.user.create')}}" class="btn btn-success float-end">Adicionar novo <i class="mdi mdi-plus"></i></a>
                                            </div>
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
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>Status</th>
                                            <th>Criado em</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>

                                    <tbody data-route="{{route('admin.dashboard.user.sorting')}}">
                                        @foreach ($users as $key => $user)
                                            <tr data-code="{{$user->id}}">
                                                <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                                <td class="bs-checkbox">
                                                    <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$user->id}}"></label>
                                                </td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>
                                                    @switch($user->active)
                                                        @case(0) <span class="badge bg-danger">Inativo</span> @break
                                                        @case(1) <span class="badge bg-success">Ativo</span> @break
                                                    @endswitch
                                                </td>
                                                <td>{{$user->created_at->format('d/m/Y H:i')}}</td>
                                                <td>
                                                    <div class="row justify-content-start">
                                                        @can(['usuario.visualizar','usuario.editar'])
                                                            <div class="col-2">
                                                                
                                                                <a href="{{route('admin.dashboard.user.edit',['user' => $user->id])}}" class="btn-icon mdi mdi-square-edit-outline"></a>
                                                                
                                                            </div>
                                                        @endcan
                                                        @can('usuario.visualizar')
                                                            <div class="col-2">
                                                                <a href="{{route('admin.dashboard.user.show', ['user' => $user->id])}}" class="btn-icon mdi mdi-eye"></a>
                                                            </div>
                                                        @endcan
                                                        @can(['usuario.visualizar','usuario.remover'])
                                                            <form action="{{route('admin.dashboard.user.destroy',['user' => $user->id])}}" class="col-2" method="POST">
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

                                {{-- PAGINATION --}}
                                <div class="mt-3 float-end">
                                    {{$users->links()}}
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
