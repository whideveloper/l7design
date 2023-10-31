
<div class="row col-12">
    <div class="col-12 col-lg-12">
        <div class="card card-body">
            <input type="hidden" name="course_id" value="{{$course->id}}">
            <input type="hidden" name="file_id" value="{{$file->id}}">
            <input type="hidden" name="student_id" value="3">

            <div class="card card-body">
                <div class="mb-3 col-lg-12">
                    {!! Form::label('file', 'Anexar atividade', ['class'=>'form-label']) !!}
                    {!! Form::file('path_file', [
                        'data-plugins'=>'dropify',
                        'data-height'=>'200',
                        'data-max-file-size-preview'=>'2M',
                        'accept'=>'image/*',
                        'data-default-file'=> isset($fileResponse)?$fileResponse->path_file<>''?url('storage/'.$fileResponse->path_file):'':'',
                    ]) !!}
                </div>
            </div>
            <div class="mb-3">
                {!! Form::checkbox('adjusted', '1', null, ['class'=>'form-check-input', 'id'=>'active']) !!}
                {!! Form::label('adjusted', 'Atividade corrigida?', ['class'=>'form-check-label']) !!}
            </div>
        </div> <!-- end card-body-->
    </div> <!-- end card-->
</div>

<!-- end row -->
