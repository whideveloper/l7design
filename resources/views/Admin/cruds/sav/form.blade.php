<div class="card card-body">
    <div class="row">
        <div class="mb-3 col-lg-12">
            {!! Form::label(null, 'Título', ['class'=>'form-label']) !!}
            {!! Form::text('title', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
        </div>
        {{-- <div class="mb-3 col-lg-6">
            {!! Form::label(null, 'Próximas Savs', ['class'=>'form-label']) !!}
            <div class="input__date">
                <input type="date" name="date_sav" value="{{isset($sav->date_sav)?$sav->date_sav:''}}">
            </div>
        </div> --}}
        <div class="mb-3 col-lg-12">
            {!! Form::label('complete-editor', 'Texto', ['class'=>'form-label']) !!}
            {!! Form::textarea('text', null, [
                'class'=>'form-control CkEditorColumn',
                'id'=>'complete-editor',
                'data-height' => 250
            ]) !!}
        </div>                
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
                'data-default-file'=> isset($sav)?$sav->path_image<>''?url('storage/'.$sav->path_image):'':'',
            ]) !!}
        </div>                    
    </div>  
    <div class="mb-3 form-check">
        {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
        {!! Form::label('active', 'Ativo?', ['class'=>'form-check-label']) !!}
    </div>              
</div> <!-- end card-body-->
