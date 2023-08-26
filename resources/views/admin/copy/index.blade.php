@extends('layouts.app')
@section('title','Copy')
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
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCopyModal">ADD
                        </button>
                    </div>
                    <button></button>
                    <hr class="my-0"/>
                    <div class="card-datatable">
                        <table id="datatable" class="dt-advanced-search table">
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
        <div class="modal fade" id="addCopyModal" tabindex="-1" aria-labelledby="addCopyModalTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-sm-5 mx-50 pb-5">
                        <form class="form form-vertical" method="post" action="{{route('copy.store')}}" id="copyForm">
                            {{csrf_field()}}
                            <div class="row" id="copyFormBody">
                                <input type="hidden" name="parent_id" value="{{request()->get('parent_id') ?? 0}}">
                                <div class="col-12">
                                    <div class="mb-1">
                                        <input type="text" class="form-control" name="name" placeholder="name"/>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary me-1">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endsection
    @section('page_js')
    <script>
        let crud = new Crud({
            filter: true,
            list: {
                data: function (d) {
                    d.parent_id = '{{request()->input('parent_id', null)}}'
                },
                url: '{{route('copy.data')}}',
                datatable: {

                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'description', name: 'description'},
                        {data: 'created_at', name: 'created_at'},
                    ],

                    columnDefs: [
                        {
                            target: 4,
                            data: null,
                            render: function (row, type, val, meta) {
                                let btn = '';
                                btn += "<a href='{{url()->current()}}?parent_id=" + val.id + "' class='btn btn-primary'><i data-feather='arrow-right'></i></a>"
                                btn+= '<button class="btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#addCopyModal" data-type="" data-id="'+val.id +'">Edit</button>'
                                return btn
                            }
                        }

                    ]
                }
            },
        });
    </script>
    @endsection






