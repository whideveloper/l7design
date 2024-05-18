<div class="card card-body">
    <div class="row">
        <div class="row mb-3 col-lg-12 align-bottom">
            <div class="col-lg-9">
                {!! Form::label(null, 'Vídeo assistido', ['class'=>'form-label']) !!}
                <div class="row d-flex justify-content-between align-content-center w-100">
                    <h5 class="w-auto">{{isset($lead->video_title)?$lead->video_title:''}}</h5>   
                    <h5 class="col-lg-4">Visualizações <span class="mdi mdi-eye"></span> {{$leadsCounts[$lead->id] ?? 0}}</h5>                     
                </div>
            </div>
        </div>               
    </div>
    <div class="row">
        <div class="mb-3 col-lg-6">
            {!! Form::label(null, 'Nome', ['class'=>'form-label']) !!}
            {!! Form::text('name', null, ['class'=>'form-control', 'id'=>'validationCustom01', 'required'=>'required']) !!}
        </div>
        <div class="mb-3 col-lg-6">
            {!! Form::label(null, 'Email', ['class'=>'form-label']) !!}
            {!! Form::text('email', null, ['class'=>'form-control', 'id'=>'validationCustom01', 'required'=>'required']) !!}
        </div>                
    </div>
</div> <!-- end card-body-->