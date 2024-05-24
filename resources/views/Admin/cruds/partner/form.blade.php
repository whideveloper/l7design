<div class="card card-body">
    <div class="row">
        <div class="mb-3 col-lg-6">
            {!! Form::label(null, 'Título', ['class'=>'form-label']) !!}
            {!! Form::text('title', null, ['class'=>'form-control', 'id'=>'validationCustom01']) !!}
        </div>
        <div class="mb-3 col-lg-6">
            {!! Form::label(null, 'Link', ['class'=>'form-label']) !!}
            {!! Form::text('link', null, ['class'=>'form-control', 'id'=>'validationCustom01']) !!}
        </div>
    </div>

    <div class="mb-3 col-lg-12">
        {!! Form::label('path_image', 'Imagem desktop', ['class'=>'form-label']) !!}
        {!! Form::file('path_image', [
            'data-plugins'=>'dropify',
            'data-height'=>'160',
            'data-max-file-size-preview'=>'2M',
            'accept'=>'image/*',
            'data-default-file'=> isset($partner)?$partner->path_image<>''?url('storage/'.$partner->path_image):'':'',
        ]) !!}
    </div>

    <div class="mb-3 form-check">
        {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
        {!! Form::label('active', 'Ativar?', ['class'=>'form-check-label']) !!}
    </div>
</div> <!-- end card-body-->