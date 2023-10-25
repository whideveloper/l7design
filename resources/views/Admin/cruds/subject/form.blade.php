
<div class="row col-12">
    <div class="col-12 col-lg-6">
        <div class="card card-body">
            <input type="hidden" name="user_id" value="{{$user}}">
            <div class="mb-3 col-lg-12">
                {!! Form::label(null, 'Nome', ['class'=>'form-label']) !!}
                {!! Form::text('name', null, ['class'=>'form-control', 'id'=>'validationCustom01']) !!}
            </div>
            <div class="mb-3 col-lg-12">
                {!! Form::label(null, 'Descrição', ['class'=>'form-label']) !!}
                {!! Form::text('description', null, ['class'=>'form-control', 'id'=>'validationCustom02', 'required'=>'required']) !!}
            </div>
            <div class="mb-3">
                {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
                {!! Form::label('active', 'Matéria Ativo?', ['class'=>'form-check-label']) !!}
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
                    'data-default-file'=> isset($subject)?$subject->path_image<>''?url('storage/'.$subject->path_image):'':'',
                ]) !!}
            </div>
        </div>
    </div>
</div>

<!-- end row -->
