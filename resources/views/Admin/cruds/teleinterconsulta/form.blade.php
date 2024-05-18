<div class="card card-body">
    <div class="row">
        <div class="mb-3 col-lg-12">
            {!! Form::label(null, 'Título', ['class'=>'form-label']) !!}
            {!! Form::text('title', null, ['class'=>'form-control', 'id'=>'validationCustom01']) !!}
        </div>
        <div class="mb-3 col-lg-12">
            {!! Form::label('complete-editor', 'Texto', ['class'=>'form-label']) !!}
            {!! Form::textarea('text', null, [
                'class'=>'form-control CkEditorColumn',
                'id'=>'complete-editor',
                'data-height' => 150
            ]) !!}
        </div>
        <div class="mb-3">
            {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
            {!! Form::label('active', 'Ativo?', ['class'=>'form-check-label']) !!}
        </div>
    </div>
</div> <!-- end card-body-->

<div class="row col-lg-6">
    <div class="col-12 col-lg-12">
        <div class="card card-body">
            <div class="row">
                <div class="mb-3 col-lg-12">
                    {!! Form::label('path_image', 'Imagem', ['class'=>'form-label']) !!}
                    {!! Form::file('path_image', [
                        'data-plugins'=>'dropify',
                        'data-height'=>'200',
                        'data-max-file-size-preview'=>'2M',
                        'accept'=>'image/*',
                        'data-default-file'=> isset($teleinterconsulta)?$teleinterconsulta->path_image<>''?url('storage/'.$teleinterconsulta->path_image):'':'',
                    ]) !!}
                </div>
                {{-- <span class="alert alert-warning" role="alert">OBS: Dimensões do teleinterconsulta: 1440 x 684</span> --}}
            </div>
        </div> <!-- end card-body-->
    </div> <!-- end card-->
</div>
