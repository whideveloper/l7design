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
                                    <li class="breadcrumb-item active">Banner</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Banner</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row d-flex justify-content-lg-start pe-2 align-items-end mb-3">
                                    <form action="{{route('admin.dashboard.banner-search')}}" method="POST" style="width:90%;padding-right:0;">
                                        @csrf
                                        <div class="d-flex align-items-end">
                                            <div class="row ps-2 me-2 col-lg-2">
                                                <label class="p-0">Data de inicial</label>
                                                <input type="date" name="start_date" class="form-control">
                                            </div>
                                            <div class="row ps-2 me-2 col-lg-2">
                                                <label class="p-0">Data de final</label>
                                                <input type="date" name="end_date" class="form-control">
                                            </div>
                                            <select name="status" class="form-select row ms-0 me-2" aria-label="Default select example" style="height:38px;width:210px;">
                                                <option selected disabled>Selecione o status</option>
                                                <option value="0">Inativo</option>
                                                <option value="1">Ativo</option>
                                            </select>   
                                            <div class="input-group w-auto" style="height:38px">
                                                <button class="btn btn-outline-primary" type="submit" id="button-addon2">Buscar</button>
                                            </div>                                        
                                        </div> 
                                    </form>
                                    @if (route('admin.dashboard.banner-search') == url()->current())
                                        <a href="{{route('admin.dashboard.banner.index')}}" class="btn btn-danger" style="height: 40px;width:120px;">Limpar busca</a>
                                    @endif
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        @can('banners.remover')
                                            <button id="btSubmitDelete" data-route="{{route('admin.dashboard.banner.destroySelected')}}" type="button" class="btn btn-danger" style="display: none;">Deletar selecionados</button>
                                        @endcan
                                    </div>
                                    <div class="col-6">
                                        @can('banners.criar')
                                        <a href="{{route('admin.dashboard.banner.create')}}" class="btn btn-success float-end">Adicionar novo <i class="mdi mdi-plus"></i></a>
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
                                            <th>Link</th>
                                            <th>Data inicial</th>
                                            <th>Data final</th>
                                            <th>Imagem</th>
                                            <th>Status</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>

                                    <tbody data-route="{{route('admin.dashboard.banner.sorting')}}">
                                        @foreach ($banners as $key => $banner)
                                            <tr data-code="{{$banner->id}}">
                                                <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                                <td class="bs-checkbox">
                                                    <label><input data-index="{{$key}}" name="btnSelectItem" class="btnSelectItem" type="checkbox" value="{{$banner->id}}"></label>
                                                </td>
                                                <td><a href="{{$banner->link}}" target="_blank" class="mdi mdi-link-box-variant font-28 text-secondary"></a></td>
                                                <td>{{Carbon\Carbon::parse($banner->start_date)->format('d/m/Y')}}</td>
                                                <td>{{Carbon\Carbon::parse($banner->end_date)->format('d/m/Y')}}</td>
                                                <td class="table-user text-center">
                                                    @if ($banner->path_image)
                                                        <img src="{{ asset('storage/'.$banner->path_image) }}" name="path_image" alt="table-user" class="me-2 rounded-circle">
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @switch($banner->active)
                                                        @case(0) <span class="badge bg-danger">Inativo</span> @break
                                                        @case(1) <span class="badge bg-success">Ativo</span> @break
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        @can('banners.editar')
                                                        <div class="col-4">
                                                           <a href="{{route('admin.dashboard.banner.edit',['banner' => $banner->id])}}" class="btn-icon mdi mdi-square-edit-outline"></a>
                                                        </div>
                                                        @endcan
                                                        @can('banners.remover')
                                                        <form action="{{route('admin.dashboard.banner.destroy',['banner' => $banner->id])}}" class="col-4" method="POST">
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
                                   {{$banners->links()}}
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
