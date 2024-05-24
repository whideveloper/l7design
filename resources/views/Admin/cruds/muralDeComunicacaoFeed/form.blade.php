<div class="card card-body">
    <div class="row" style="text-align: left">
        <div class="mb-3 col-lg-6">
            {!! Form::label(null, 'Título', ['class'=>'form-label']) !!}
            {!! Form::text('title', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
        </div>    

        <div class="mb-3 col-lg-6">
            {!! Form::label(null, 'Data', ['class'=>'form-label']) !!}
            <div class="input__date">
                <input type="date" name="publish_date" value="{{isset($muralDeComunicacaoFeed->publish_date)?$muralDeComunicacaoFeed->publish_date:''}}">
            </div>
        </div>

        <div class="mb-3 col-lg-6">
            {!! Form::label('heard', 'Categoria Clube Benefício', ['class'=>'form-label']) !!}

            {!! Form::select('mural_category_id', $muralDeComunicacaoCategory, isset($title)?$title:null, [
                'class'=>'form-select',
                'id'=>'heard',
                'placeholder' => 'Selecione a categoria'
            ]) !!}
        </div>  
            
        <div class="mb-3 col-lg-6">
            {!! Form::label(null, 'Título do botão', ['class'=>'form-label']) !!}
            {!! Form::text('btn_title', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
        </div>   

        <div class="mb-3 col-lg-12">
            {!! Form::label(null, 'Link', ['class'=>'form-label']) !!}
            {!! Form::text('link', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
        </div> 
        
        <div class="mb-3 col-12">
            {!! Form::label('message', 'Breve Descrição', ['class'=>'form-label']) !!}
            {!! Form::textarea('description', null, [
                'class'=>'form-control',
                'id'=>'message',
                'required'=>'required',
                'data-parsley-trigger'=>'keyup',
                'data-parsley-minlength'=>'20',
                'data-parsley-maxlength'=>'100',
                'data-parsley-minlength-message'=>'Vamos lá! Você precisa inserir um texto de pelo menos 20 caracteres.',
                'data-parsley-validation-threshold'=>'10',
            ]) !!}
        </div>

        <div class="mb-3 col-lg-12">
            <h4 class="header-title">Texto</h4>
            <!-- Editor Quill.js -->
            <div id="snow-editor" style="height: 300px;">
                {!! isset($muralDeComunicacaoFeed) ? $muralDeComunicacaoFeed->text : '' !!}
            </div>

            <!-- Campo escondido para armazenar o conteúdo do editor -->
            <input type="hidden" name="text">

        </div> <!-- end card-body-->
    </div>
    <div class="mb-3 form-check" style="text-align: left">
        {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
        {!! Form::label('active', 'Ativar?', ['class'=>'form-check-label']) !!}
    </div>
</div> <!-- end card-body-->
<div class="card card-body">
    <div class="row" style="text-align: left">
        <div class="mb-3 col-lg-12">
            {!! Form::label('path_image', 'Imagem', ['class'=>'form-label']) !!}
            {!! Form::file('path_image', [
                'data-plugins'=>'dropify',
                'data-height'=>'160',
                'data-max-file-size-preview'=>'2M',
                'accept'=>'image/*',
                'data-default-file'=> isset($muralDeComunicacaoFeed)?$muralDeComunicacaoFeed->path_image<>''?url('storage/'.$muralDeComunicacaoFeed->path_image):'':'',
            ]) !!}
        </div>
    </div>
</div> <!-- end card-body-->





