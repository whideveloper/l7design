
<div class="row col-12">
    <div class="col-12 col-lg-12">
        <div class="card card-body">
            <div class="row" style="text-align: left;">
                <input type="hidden" name="material_id" value="{{$material->id}}">
                <div class="mb-3 col-lg-12">
                    {!! Form::label(null, 'Título', ['class'=>'form-label']) !!}
                    {!! Form::text('title', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
                </div>
                <div class="mb-3">
                    {!! Form::label('message', 'Descrição', ['class'=>'form-label']) !!}
                    {!! Form::textarea('description', null, [
                        'class'=>'form-control',
                        'id'=>'message',
                        'required'=>'required',
                        'data-parsley-trigger'=>'keyup',
                        'data-parsley-minlength'=>'20',
                        'data-parsley-maxlength'=>'500',
                        'data-parsley-minlength-message'=>'Vamos lá! Você precisa inserir um texto de pelo menos 20 caracteres.',
                        'data-parsley-validation-threshold'=>'10',
                    ]) !!}
                </div>               
                <div class="mb-3 col-lg-12">
                    {!! Form::label('path_file', 'Arquivo', ['class'=>'form-label']) !!}
                    {!! Form::file('path_file', [
                        'data-plugins'=>'dropify',
                        'data-height'=>'160',
                        'data-max-file-size-preview'=>'2M',
                        'accept'=>'*',
                        'data-default-file'=> isset($materialDocument)?$materialDocument->path_file<>''?url('storage/'.$materialDocument->path_file):'':'',
                    ]) !!}
                </div>                
            </div>
            <div class="mb-3 form-check" style="text-align: left;">
                {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
                {!! Form::label('active', 'Ativar?', ['class'=>'form-check-label']) !!}
            </div>            
        </div> <!-- end card-body-->
    </div> <!-- end card-->
</div>
<!-- end row -->
