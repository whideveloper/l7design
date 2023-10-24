
<div class="row col-12">
    <div class="col-12 col-lg-6">
        <div class="card card-body">
            <div class="mb-3 col-lg-12">
                {!! Form::label(null, 'Nome', ['class'=>'form-label']) !!}
                {!! Form::text('name', null, ['class'=>'form-control', 'id'=>'validationCustom01']) !!}
            </div>
            <div class="mb-3 col-lg-12">
                {!! Form::label(null, 'Senha', ['class'=>'form-label']) !!}
                {!! Form::password('password', [
                    'class'=>'form-control',
                    'id'=>'pass2',
                    'placeholder'=>'Senha',
                ])!!}

            </div>
            <div class="mb-3 col-lg-12">
                {!! Form::label(null, 'E-mail', ['class'=>'form-label']) !!}
                {!! Form::text('email', null, ['class'=>'form-control', 'id'=>'validationCustom02', 'required'=>'required']) !!}
            </div>
            <div class="mb-3">
                {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
                {!! Form::label('active', 'Aluno Ativo?', ['class'=>'form-check-label']) !!}
            </div>
        </div> <!-- end card-body-->
    </div> <!-- end card-->
    <div class="col-12 col-lg-6">
        <div class="card card-body">
            <div class="mb-3 col-lg-12">
                {!! Form::label('file', 'Imagem', ['class'=>'form-label']) !!}
                {!! Form::file('path_image', [
                    'data-plugins'=>'dropify',
                    'data-height'=>'250',
                    'data-max-file-size-preview'=>'2M',
                    'accept'=>'image/*',
                    'data-default-file'=> isset($student)?$student->path_image<>''?url('storage/'.$student->path_image):'':'',
                ]) !!}
            </div>
        </div>
    </div>
</div>

<!-- end row -->
