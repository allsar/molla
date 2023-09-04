@extends('layouts.app')
@section('title','Manufacture')
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
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addManufactureModal">ADD
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
    <div class="modal fade" id="addManufactureModal" tabindex="-1" aria-labelledby="addManufactureModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 mx-50 pb-5">
                    <form class="form form-vertical" method="post" action="{{route('manufacture.store')}}" id="modalForm">
                        {{csrf_field()}}
                        <div class="row" id="manufactureFormBody">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" id="name" class="form-control" name="name" placeholder="name"/>
                                </div>
                                <div class="form-group">
                                    <textarea name="description" class="form-text form-control" id="description" cols="30" rows="10" placeholder="description"></textarea>
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
                url: '{{route('manufacture.data')}}',
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

                                btn+= '<button class="btn btn-primary edit-btn" data-bs-toggle="modal" data-name="'+val.name +'"  data-description="'+val.description+'" data-bs-target="#addManufactureModal" data-type="" data-id="'+val.id +'">Edit</button>'
                                btn+= '<button class="btn btn-danger delete-btn"  data-id="'+val.id +'">Delete</button>'
                                return btn
                            }
                        }

                    ]
                }
            },
        });
        $(document).off('click', '.edit-btn').on('click', '.edit-btn', function (){
            let id = $(this).data('id');
            let name = $(this).data('name');
            let description = $(this).data('description');
            $('#modalForm').attr('action', '{{route('manufacture.update')}}/'+id);
            $('#modalForm').append('<input type="hidden" name="_method" value="PUT">');
            $('#modalForm').append('<input type="hidden" name="id" value="'+id+'">');
            $('#name').val(name);
            $('#description').val(description);
        })
        $(document).off('click', '.delete-btn').on('click', '.delete-btn', function (){
            let id = $(this).data('id');
            $.ajax({
                type: 'delete',
                data: { id: id },
                url: '{{route('manufacture.delete')}}/'+id,
                success: function (response) {
                    alert('ok')
                },
                error: function (data) {
                }
            });
        })
    </script>
@endsection
