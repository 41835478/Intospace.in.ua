<div class="row">
    <div class="col-lg-8">
        <div class="form-group">
            <label for="inputVideo">Title</label>
            <input id="inputVideo" type="text"  value="{!! $video->title or Input::old('title') !!}" class="form-control" name="title">
        </div>
    </div>
</div>
<div class="row">
    <div>
        <input type="submit" value="Save" class="btn btn-block btn-success" >
    </div>
</div>
