@extends('layouts.app')
@section('title')
    MyArticle | Category
@endsection
@section('content')
    <div class="pt-3"></div>
    <div class="row pt-5">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Categories</h4>
                    </div>

                </div>
                @can('category_create')
                <div class="d-flex justify-content-end my-2 me-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form-modal-add">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                        </svg>
                        Add New
                    </button>
                </div>
                @endcan
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable2" class="table text-center">
                            <thead class="w-100">
                                <tr>
                                    @can('category_delete')
                                    <th class="text-center" width="10%">
                                        <button type="button" class="btn btn-sm btn-danger" id="del-btn" disabled>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd"
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                        </button>
                                    </th>
                                    @endcan
                                    @if (Gate::check('category_update') | Gate::check('category_read'))
                                    <th class="text-center" width="10%">Actions</th>
                                    @endif
                                    <th class="text-center">Category Name</th>
                                    <th class="text-center">Created Date</th>
                                </tr>
                            </thead>
                            <tbody id='list'>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('script.category-script')
@endsection

{{-- Modal Show --}}
<div class="modal fade" data-backdrop="static" id="form-modal-show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category Details</h5>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">
                       <table class="table table-responsive">
                            <tr>
                                <td>ID</td>
                                <td><b id="id-category"></b></td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td><b id="category-name"></b></td>
                            </tr>
                            <tr>
                                <td>Log Info</td>
                                <td><b id="category-log"></b></td>
                            </tr>
                       </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close-show" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Modal Add --}}
<div class="modal fade" data-backdrop="static" id="form-modal-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <div><span class="text-danger" id="category_error"></span></div>
                            <label for="category">Category Name<span class="text-danger">*</span></label>
                            <input type="text" name="category" class="form-control" id="category" placeholder="">
                            <small class="form-text text-danger"></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close-add" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" id="btn-save-add" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" data-backdrop="static" id="form-modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <div><span class="text-danger" id="update_category_error"></span></div>
                            <label for="category">Category Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="update_category" placeholder="">
                            <small class="form-text text-danger"></small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close-edit" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" id="btn-save-edit" class="btn btn-primary">Edit</button>
            </div>
        </div>
    </div>
</div>
