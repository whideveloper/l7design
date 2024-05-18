<div class="card card-body">
    <div class="row">
        <div class="mb-3 col-lg-6">
            {!! Form::label(null, 'Nome', ['class'=>'form-label']) !!}
            {!! Form::text('name', null, ['class'=>'form-control', 'id'=>'validationCustom01']) !!}
        </div>
        <div class="mb-3 col-lg-6">
            {!! Form::label(null, 'E-mail', ['class'=>'form-label']) !!}
            {!! Form::text('email', null, ['class'=>'form-control', 'id'=>'validationCustom02', 'required'=>'required']) !!}
        </div>                 
    </div>
    <div class="mb-3 form-check">
        {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
        {!! Form::label('active', 'Ativar?', ['class'=>'form-check-label']) !!}
    </div>
</div> <!-- end card-body-->

<div class="card card-body">
    <div class="row">
        <div class="mb-3 col-lg-12">
            {!! Form::label('path_image', 'Imagem', ['class'=>'form-label']) !!}
            {!! Form::file('path_image', [
                'data-plugins'=>'dropify',
                'data-height'=>'160',
                'data-max-file-size-preview'=>'2M',
                'accept'=>'image/*',
                'data-default-file'=> isset($contactTelenordeste)?$contactTelenordeste->path_image<>''?url('storage/'.$contactTelenordeste->path_image):'':'',
            ]) !!}
        </div> 
    </div>
</div>