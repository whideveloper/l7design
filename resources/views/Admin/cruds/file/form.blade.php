
<div class="row col-12">
    <div class="col-12 col-lg-6">
        <div class="card card-body">
            <input type="hidden" name="file_id" value="{{$file->id}}">

            <div class="mb-3 col-lg-12">
                {!! Form::label(null, 'Nome do curso', ['class'=>'form-label']) !!}
                {!! Form::text('title', null, ['class'=>'form-control', 'id'=>'validationCustom01']) !!}
            </div>

            <div class="mb-3 col-lg-12">
                {!! Form::label(null, 'Breve descrição', ['class'=>'form-label']) !!}
                {!! Form::text('description', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
            </div>

            <div class="mb-3">
                {!! Form::label(null, 'Data Final', ['class'=>'form-label']) !!}
                {!! Form::text('end_date', null, [
                        'class'=>'form-control',
                        'required'=>'required',
                        'data-provide'=>'datepicker',
                        'data-date-autoclose'=>'true',
                    ])!!}
            </div>

            <div class="mb-3">
                {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
                {!! Form::label('active', 'Atividade Ativa?', ['class'=>'form-check-label']) !!}
            </div>
        </div> <!-- end card-body-->
    </div> <!-- end card-->
    <div class="col-12 col-lg-6">
        <div class="card card-body">
            <div class="mb-3 col-lg-12">
                {!! Form::label('file', 'Anexar atividade', ['class'=>'form-label']) !!}
                {!! Form::file('path_image', [
                    'data-plugins'=>'dropify',
                    'data-height'=>'200',
                    'data-max-file-size-preview'=>'2M',
                    'accept'=>'image/*',
                    'data-default-file'=> isset($file)?$file->path_image<>''?url('storage/'.$file->path_image):'':'',
                ]) !!}
            </div>
        </div>

    </div>
</div>

<!-- end row -->
