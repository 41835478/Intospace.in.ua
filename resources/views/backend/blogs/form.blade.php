<div class="row">
    <div class="col-lg-9">
        <div class="form-group">
            {!! Form::label('inputTitle', 'Title:') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('inputContent', 'Text:') !!}
            {!! Form::textarea('content', null, ['class' => 'form-control ckeditor', 'id' => 'ckeditor']) !!}
            <script>
                $('.ckeditor').ckeditor(); // if class is prefered.
            </script>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            {!! Form::label('inputPublished_at', 'Published at:') !!}
            {!! Form::input('datetime', 'published_at', isset($blog->published_at) ? $blog->published_at : Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        </div>
        <br>
        <div class="row">
            {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
</div>
    <script>
        CKEDITOR.replace( 'ckeditor', {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files'
        });
    </script>
