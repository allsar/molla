@foreach($values as $key=> $item)

    <div data-repeater-item>
        <div class="row d-flex align-items-center my-1">
            <div class="col-md-10">
                <label>
                    <input type="hidden" class="form-control" name="properties[{{$key}}][id]" value="{{$item->id}}"
                           placeholder="property name" >
                    <input type="text" class="form-control" name="properties[{{$key}}][value]" value="{{$item->value}}"
                           placeholder="property value" >
                </label>
            </div>
            <div class="col-md-2">
                <button type="button" class=" btn btn-danger " data-repeater-delete>
                    Delete
                </button>
            </div>
        </div>
        <hr/>
    </div>

@endforeach
