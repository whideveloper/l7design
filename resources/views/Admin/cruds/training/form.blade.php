
<div class="row col-12">
    <div class="col-12 col-lg-12">
        <div class="card card-body">
            <div class="row" style="text-align: left">
                <div class="mb-3 col-lg-12">
                    {!! Form::label(null, 'Nome do botão', ['class'=>'form-label']) !!}
                    {!! Form::text('btn_title', null, ['class'=>'form-control', 'id'=>'validationCustom02']) !!}
                </div> 
                <div class="mb-3 col-lg-12">
                    {!! Form::label(null, 'Link Youtube', ['class'=>'form-label']) !!}
                    {!! Form::text('link_youtube', null, ['class'=>'form-control embedLinkYoutube', 'id'=>'validationCustom02']) !!}
                </div>
    
                {{-- <div class="mb-3 col-lg-12">
                    {!! Form::label(null, 'Link Vímeo', ['class'=>'form-label']) !!}
                    {!! Form::text('link_vimeo', null, ['class'=>'form-control', 'id'=>'linkVimeoEmbed']) !!}
                </div>                            --}}
            </div>
            
            <div class="mb-3 form-check" style="text-align: left">
                {!! Form::checkbox('active', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
                {!! Form::label('active', 'Ativar?', ['class'=>'form-check-label']) !!}
            </div>
        </div> <!-- end card-body-->
    </div> <!-- end card-->
    <div class="row col-lg-12">
        <div class="col-12 col-lg-12">
            <div class="card card-body">
                <div class="row" style="text-align: left">
                    <div class="mb-3 col-lg-12">
                        {!! Form::label('path_file', 'Arquivo', ['class'=>'form-label']) !!}
                        {!! Form::file('path_file', [
                            'data-plugins'=>'dropify',
                            'data-height'=>'160',
                            'data-max-file-size-preview'=>'2M',
                            'accept'=>'/*',
                            'data-default-file'=> isset($training)?$training->path_file<>''?url('storage/'.$training->path_file):'':'',
                        ]) !!}
                    </div>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>

</div>
<!-- end row -->
