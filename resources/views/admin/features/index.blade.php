@extends('layouts.app')
@section('title','Feature')
@section('content')
    @if($errors->any())
        @foreach($errors->all() as $e)
            <div class="alert alert-danger">{{$e}}</div>
        @endforeach
    @endif
    <section id="advanced-search-datatable">
        <div class="row">
            <div class="card">
                <div class="card-header border-bottom">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFeatureModal">ADD
                    </button>
                </div>
                <button></button>
                <hr class="my-0"/>
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created at</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="addFeatureModal" tabindex="-1" aria-labelledby="addFeatureModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form form-vertical feature-repeater" method="post" action="{{route('features.store')}}"
                      id="modalForm">
                    <div class="modal-body px-sm-5 mx-50 pb-5">
                        {{csrf_field()}}
                        <div class="row" data-repeater-list="features" id="featureFormBody">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>
                                        <input type="text" id="name" class="form-control" name="name"
                                               placeholder="name"/>
                                    </label>
                                </div>
                                <hr/>

                                <div data-repeater-list="features">
                                    <div data-repeater-item>
                                        <div class="row d-flex align-items-center my-1">
                                            <div class="col-md-10">
                                                <label>
                                                    <input type="text" class="form-control" name="value"
                                                           placeholder="feature value">
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
                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="row m-1">
                        <div class="col-12 text-end">
                            <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                <i data-feather="plus" class="me-25"></i>
                                <span>Add New</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updateFeatureModal" tabindex="-1" aria-labelledby="updateFeatureModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form form-vertical feature-repeater-update" method="post"
                      action="{{route('features.update')}}"
                      id="updateForm">
                    <div class="modal-body px-sm-5 mx-50 pb-5">
                        {{csrf_field()}}
                        <div class="row" data-repeater-list="features" id="">
                            <input type="hidden" name="id" id="update-id">
                            <div class="form-group">
                                <label>
                                    <input type="text" id="update-name" class="form-control" name="name"
                                           placeholder="name"/>
                                </label>
                            </div>
                            <hr/>
                            <div data-repeater-list="features" id="updateFeatureModalBody">



                                <div data-repeater-item>
                                    <div class="row d-flex align-items-center my-1">
                                        <div class="col-md-10">
                                            <label>
                                                <input type="text" class="form-control" name="value"
                                                       placeholder="feature value">
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
                            </div>


                        </div>
                    </div>
                    <div class="row m-1">
                        <div class="col-12 text-end">
                            <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                <i data-feather="plus" class="me-25"></i>
                                <span>Add New</span>
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    <script>
        let crud = new Crud({
            filter: true,
            list: {
                url: '{{route('features.data')}}',
                datatable: {

                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'description', name: 'description'},
                        {data: 'created', name: 'created_at'},
                    ],

                    columnDefs: [
                        {
                            target: 4,
                            data: null,
                            render: function (row, type, val, meta) {
                                let btn = '';

                                btn += '<button class="btn btn-primary edit-btn" data-bs-toggle="modal" data-name="' + val.name + '"  data-bs-target="#updateFeatureModal" data-type="" data-id="' + val.id + '">Edit</button>'
                                btn += '<button class="btn btn-danger delete-btn"  data-id="' + val.id + '">Delete</button>'
                                return btn
                            }
                        }

                    ]
                }
            },
        });
        $(document).off('click', '.edit-btn').on('click', '.edit-btn', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            $('#update-name').val(name)
            $('#update-id').val(id)
            $('#updateFeatureModalBody').html('')
            $('#updateForm').attr('action', '{{route('features.update')}}/' + id)
            $('#updateForm').append('<input type="hidden" name="_method" value="put">')
            $.ajax({
                type: 'get',
                data: {id: id},
                url: '{{route('features.values')}}/' + id,
                success: function (response) {
                    $('#updateFeatureModalBody').append(response.content)
                },
                error: function (data) {
                }
            });
        })
        $(document).off('click', '.delete-btn').on('click', '.delete-btn', function () {
            let id = $(this).data('id');
            $.ajax({
                type: 'delete',
                data: {id: id},
                url: '{{route('features.delete')}}/' + id,
                success: function (response) {
                    alert('ok')
                },
                error: function (data) {
                }
            });
        })
        $(function () {
            'use strict';
            $('.feature-repeater, .feature-default').repeater({
                isFirstItemUndeletable: true,
                initEmpty: true,
                show: function () {
                    $(this).slideDown();

                },
                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });
        });
        $(function () {
            'use strict';
            $('.feature-repeater-update, .feature-default').repeater({

                show: function () {
                    $(this).slideDown();

                },
                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });
        });
    </script>
@endsection

