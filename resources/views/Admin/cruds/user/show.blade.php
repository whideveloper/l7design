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
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard.user.index')}}">Usuário</a></li>
                                    <li class="breadcrumb-item active">Registros deletados</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Registros deletados</h4>
                        </div>
                    </div>
                </div>

                <div class="card card-body">
                    <form action="{{route('admin.dashboard.user.show.search')}}" method="POST" class="form-user row justify-content-end align-items-end">
                        @csrf
                        <div class="data-search col-3">
                            <h5 class="page-title" style="padding-left: 0px">Filtrar por:</h5>
                            <input type="date" name="date_search">
                        </div>
                        <div class="form-email col-4">
                            <input name="email" type="text" class="form-control" placeholder="E-mail" aria-label="E-mail" aria-describedby="button-addon2">
                        </div>
                        <div class="form-name col-5">
                            <input name="name" type="text" class="form-control" placeholder="Nome" aria-label="Nome" aria-describedby="button-addon2">
                        </div>
                        <button class="btn btn-outline-secondary me-2 mt-3" style="width:100px;" type="submit" id="button-addon2">Button</button>
                    </form>
                </div>
                <div class="row col-lg-12 d-flex justify-content-end mb-3 ms-0 btns">
                    @if (Auth::user()->hasRole('Super') || Auth::user()->hasRole('Administrador'))
                        
                        <button id="btSubmitDeleteForever" data-route="{{route('admin.dashboard.user.destroySelectedForced')}}" type="button" class="btn btn-danger me-3" style="display: none;width:170px;">Deletar registros <i class="mdi mdi-delete-restore"></i></button>

                        <button id="btSubmitRestore" data-route="{{route('admin.dashboard.user.retoreDataAll')}}" type="button" class="btn btn-primary me-3" style="display: none;width:170px;">Restaurar registros <i class="mdi mdi-restore"></i></button>
                       
                    @endif
                    @if (url()->current() == route('admin.dashboard.user.show.search'))
                        <a href="{{route('admin.dashboard.user.showDeleted')}}" class="btn btn-primary bt-restore" style="width: 110px;height: 38px;margin-top: 0px;">Limpar Filtro</a>
                    @endif
                </div>

                <!-- end page title -->
                <table data-toggle="table" data-page-size="5" data-pagination="false" class="table-bordered table-sortable">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th class="bs-checkbox">
                                <label><input name="btnSelectAll" type="checkbox"></label>
                            </th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Deletado em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody data-route="{{route('admin.dashboard.user.sorting')}}">
                        @foreach ($userDeleteds_at as $key => $user)
                            <tr data-code="{{$user->id}}">
                                <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                <td class="bs-checkbox">
                                    <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$user->id}}"></label>
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->created_at->format('d/m/Y')}}</td>
                                <td>
                                    <div class="row">
                                        @can('usuario.editar')
                                            <div class="col-4">
                                                <form action="{{route('admin.dashboard.user.retoreData',['user' => $user->id])}}" class="col-4" method="POST">
                                                    @csrf
                                                    @method('POST')

                                                    <button type="submit" class="btn-icon" title="Restaurar item"><i class="mdi mdi-restore"></i></button>
                                                </form>
                                            </div>
                                        @endcan
                                        @can('usuario.remover')
                                            <form action="{{route('admin.dashboard.user.deleteForced',['user' => $user->id])}}" class="col-4" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button" class="btn-icon btSubmitDeleteItemForever" title="Deletar permanentemente"><i class="mdi mdi-delete-forever-outline"></i></button>
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
                    {{$userDeleteds_at->links()}}
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    <script>
        var indexRoute = "{{ route('admin.dashboard.user.index') }}";
    </script>
    @include('Admin.components.links.resourcesCreateEdit')
@endsection
