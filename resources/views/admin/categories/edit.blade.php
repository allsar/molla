@extends('admin.index')
@section('title','categories')
@section('content')
    {{--    <section id="basic-vertical-layouts">--}}
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Category Edit</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('categories.update',['id'=>$categories->id])}}"  method="post" class="form form-vertical"  >
                        @method('PUT')
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" id="name" class="form-control" value="{{$categories->name}}" name="name" placeholder="Name" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="slug">Slug</label>
                                    <input type="text" id="slug" class="form-control" value="{{$categories->slug}}" name="slug" placeholder="Slug" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="description">Description</label>
                                    <input type="text" id="description" class="form-control" value="{{$categories->description}}" name="description" placeholder="Description" />
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--    </section>--}}
@endsection

