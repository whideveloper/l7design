<div class="row col-12">
    <div class="col-12 col-lg-12">
        <div class="card card-body">
            <div class="row">
                <div class="mb-3 col-lg-12">
                    {!! Form::label(null, 'Título', ['class'=>'form-label']) !!}
                    {!! Form::text('title', null, ['class'=>'form-control', 'id'=>'validationCustom01']) !!}
                </div>
            </div>
        </div> <!-- end card-body-->
    </div> <!-- end card-->
    <div class="row col-lg-12">
        <div class="col-12 col-lg-12">
            <div class="card card-body">
                <div class="row">
                    <div class="mb-3 col-lg-12">
                        {!! Form::label('path_image', 'Imagem desktop', ['class'=>'form-label']) !!}
                        {!! Form::file('path_image', [
                            'data-plugins'=>'dropify',
                            'data-height'=>'160',
                            'data-max-file-size-preview'=>'2M',
                            'accept'=>'image/*',
                            'data-default-file'=> isset($objective)?$objective->path_image<>''?url('storage/'.$objective->path_image):'':'',
                        ]) !!}
                    </div>
                    {{-- <span class="alert alert-warning" role="alert">OBS: Dimensões do objective: 1440 x 684</span> --}}
                </div>
                <div class="mb-3 form-check">
                    {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
                    {!! Form::label('active', 'Ativar?', ['class'=>'form-check-label']) !!}
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>
</div>
<!-- end row -->
