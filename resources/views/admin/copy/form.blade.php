<div class="col-12">
    <input type="hidden" name="id" value="{{$model->id}}" >
    <div class="mb-1">
        <input type="text" class="form-control" name="name" placeholder="name" value="{{$model->name}}"/>
    </div>
</div>
<div class="col-12">
    <div class="mb-1">
        <input type="text" class="form-control" name="description" placeholder="description" value="{{$model->description}}"/>
    </div>
</div>
<input type="hidden" name="method" value="2">
<div class="col-12">
    <button type="submit" class="btn btn-primary me-1">Submit</button>
    <button type="reset" class="btn btn-outline-secondary">Reset</button>
</div>
