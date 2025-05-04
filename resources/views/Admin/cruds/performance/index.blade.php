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
                                    <li class="breadcrumb-item active">Título Sessão Desempenho</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Título Sessão Desempenho</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">                                
                                <div class="row mb-3">
                                    @if ($performance == null)                                        
                                        <div class="col-12"> 
                                            <a href="{{route('admin.dashboard.performance.create')}}" class="btn btn-success float-end">Adicionar novo <i class="mdi mdi-plus"></i></a>                                        
                                        </div>
                                    @endif                                   
                                </div>
                                <table data-toggle="table" data-page-size="5" data-pagination="false" class="table-bordered table-sortable">
                                    <thead class="table-light">
                                        <tr>
                                            <th></th>
                                            <th class="bs-checkbox">
                                                <label><input name="btnSelectAll" type="checkbox"></label>
                                            </th>
                                            <th>Título</th>
                                            <th>Descrição</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($performance) && $performance !== null)                                            
                                            <tr>
                                                <td><span class="btnDrag mdi mdi-drag-horizontal font-22"></span></td>
                                                <td class="bs-checkbox">
                                                    <label><input data-index="" name="btnSelectItem" class="btnSelectItem" type="checkbox" value=""></label>
                                                </td>
                                                <td>{{$performance->title}}</td>
                                                <td>{!!substr(strip_tags($performance->description), 0, 80)!!}...</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <a href="{{route('admin.dashboard.performance.edit',['sectionTitlePerformance' => $performance->id])}}" class="btn-icon mdi mdi-square-edit-outline"></a>
                                                        </div>
                                                        <form action="{{route('admin.dashboard.performance.destroy',['sectionTitlePerformance' => $performance->id])}}" class="col-4" method="POST">
                                                            @method('DELETE') @csrf
                                                            <button type="button" class="btn-icon btSubmitDeleteItem"><i class="mdi mdi-trash-can"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
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
