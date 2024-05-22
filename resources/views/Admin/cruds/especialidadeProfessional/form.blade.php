<div class="card card-body">
    <div class="row" style="text-align: left">
        <div class="mb-3 col-lg-12">
            {!! Form::label(null, 'Nome', ['class'=>'form-label']) !!}
            {!! Form::text('name', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
        </div> 

        <div class="mb-3 col-lg-6">
            {!! Form::label('heard', 'Função', ['class'=>'form-label']) !!}

            {!! Form::select('especialidade_category_id', $categoryEspecialidade, isset($title)?$title:null, [
                'class'=>'form-select',
                'id'=>'heard',
                'placeholder' => 'Selecione a categoria'
            ]) !!}
        </div>  
            
        <div class="mb-3 col-lg-6">
            {!! Form::label(null, 'CRM', ['class'=>'form-label']) !!}
            {!! Form::text('crm', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
        </div>   

        <div class="mb-3">
            {!! Form::label('message', 'Descrição', ['class'=>'form-label']) !!}
            {!! Form::textarea('description', null, [
                'class'=>'form-control',
                'id'=>'message',
                'required'=>'required',
                'data-parsley-trigger'=>'keyup',
                'data-parsley-minlength'=>'20',
                'data-parsley-maxlength'=>'100',
                'data-parsley-minlength-message'=>'Vamos lá! Você precisa inserir um texto de pelo menos 20 caracteres.',
                'data-parsley-validation-threshold'=>'10',
                'data-height' => 150
            ]) !!}
        </div>

        <div class="mb-3 col-lg-12">
            {!! Form::label('complete-editor', 'Texto', ['class'=>'form-label']) !!}
            {!! Form::textarea('text', null, [
                'class'=>'form-control CkEditorColumn',
                'id'=>'complete-editor',
                'data-height' => 200
            ]) !!}
        </div>             
    </div>
    <div class="mb-3 form-check" style="text-align: left">
        {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
        {!! Form::label('active', 'Ativar?', ['class'=>'form-check-label']) !!}
    </div>
</div> <!-- end card-body-->
    
<div class="row col-lg-12">
    <div class="col-12 col-lg-12">
        <div class="card card-body">
            <div class="row" style="text-align: left">
                <div class="mb-3 col-lg-12">
                    {!! Form::label('file', 'Imagem', ['class'=>'form-label']) !!}
                    {!! Form::file('path_image', [
                        'data-plugins'=>'dropify',
                        'data-height'=>'300',
                        'data-max-file-size-preview'=>'2M',
                        'accept'=>'image/*',
                        'data-default-file'=> isset($especialidadeProfessional)?$especialidadeProfessional->path_image<>''?url('storage/'.$especialidadeProfessional->path_image):'':'',
                    ]) !!}
                </div>
            </div>
        </div> <!-- end card-body-->
    </div> <!-- end card-->
</div>
