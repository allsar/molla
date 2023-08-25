@extends('layouts.app')
@section('title','categories')
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
                    <button id="addCategoryBTN" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">ADD
                    </button>
                </div>
                <button></button>
                <!--Search Form -->
                <div class="card-body mt-2">
                    <form class="dt_adv_search" method="POST">
                        <div class="row g-1 mb-md-1">
                            <div class="col-md-4">
                                <label class="form-label">Name:</label>
                                <input type="text" class="form-control dt-input dt-full-name" data-column="1"
                                       placeholder="Alaric Beslier" data-column-index="0"/>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Email:</label>
                                <input type="text" class="form-control dt-input" data-column="2"
                                       placeholder="demo@example.com" data-column-index="1"/>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Post:</label>
                                <input type="text" class="form-control dt-input" data-column="3"
                                       placeholder="Web designer" data-column-index="2"/>
                            </div>
                        </div>
                        <div class="row g-1">
                            <div class="col-md-4">
                                <label class="form-label">City:</label>
                                <input type="text" class="form-control dt-input" data-column="4" placeholder="Balky"
                                       data-column-index="3"/>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Date:</label>
                                <div class="mb-0">
                                    <input type="text" class="form-control dt-date flatpickr-range dt-input"
                                           data-column="5" placeholder="StartDate to EndDate" data-column-index="4"
                                           name="dt_date"/>
                                    <input type="hidden" class="form-control dt-date start_date dt-input"
                                           data-column="5" data-column-index="4" name="value_from_start_date"/>
                                    <input type="hidden" class="form-control dt-date end_date dt-input"
                                           name="value_from_end_date" data-column="5" data-column-index="4"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Salary:</label>
                                <input type="text" class="form-control dt-input" data-column="6" placeholder="10000"
                                       data-column-index="5"/>
                            </div>
                        </div>
                    </form>
                </div>
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
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 mx-50 pb-5">
                    <form class="form form-vertical" method="post" action="{{route('categories.store')}}" id="categoryForm">
                        {{csrf_field()}}
                        <div class="row" id="categoryFormBody">
                            <input type="hidden" value="1" name="method">
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
    <div class="modal fade" id="updateCategoryModal" tabindex="-1" aria-labelledby="updateCategoryModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 mx-50 pb-5">
                    <form class="form form-vertical"  method="post" action="{{route('categories.store')}}" id="categoryForm">
                        {{csrf_field()}}
                        <input type="hidden" name="parent_id" value="{{request()->get('parent_id')}}">
                        <div class="row" id="updateCategoryFormBody">

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
                url: '{{route('categories.data')}}',
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
                                btn+= '<button class="btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#updateCategoryModal" data-type="" data-id="'+val.id +'">Edit</button>'
                               return btn
                            }
                        }

                    ],

                }
            },
        });
        $(document).off('click','.edit-btn').on('click', '.edit-btn',function () {
            let id = $(this).data('id')
            $.ajax({
                url: '{{route('category.get-update')}}/' + id,
                method: 'GET',
                success: function (data) {
                    if (data.success) {
                        $('#updateCategoryFormBody').html(data.content);
                    }
                    else{
                        alert(data.message)
                    }
                },
                error: function (data) {

                }
            })
        })


    </script>
@endsection



