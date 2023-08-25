@extends('admin.index')
@section('title','categories')
@section('content')
{{--    <section id="basic-vertical-layouts">--}}
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Category Create</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('categories.store')}}"  method="post" class="form form-vertical"  >
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Name" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="slug">Slug</label>
                                        <input type="text" id="slug" class="form-control" name="slug" placeholder="Slug" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="description">Description</label>
                                        <input type="text" id="description" class="form-control" name="description" placeholder="Description" />
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
