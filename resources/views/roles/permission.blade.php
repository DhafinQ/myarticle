@extends('layouts.app')
@section('title')
    MyArticle | Permission
@endsection
@section('content')
    <div class="pt-3"></div>
    <div class="row pt-5">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Permission</h4>
                    </div>

                </div>
                @can('permission_create')
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
                                    @can('permission_delete')
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
                                    @if (Gate::check('permission_update') || Gate::check('permission_read'))
                                    <th class="text-center" width="15%">Actions</th> 
                                    @endif
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Slug</th>
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
    @include('script.permission-script')
@endsection

{{-- Modal Show --}}
<div class="modal fade" data-backdrop="static" id="form-modal-show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Permission Details</h5>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">
                       <table class="table table-responsive">
                            <tr>
                                <td>ID</td>
                                <td><b id="id-permission"></b></td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td><b id="permission-name"></b></td>
                            </tr>
                            <tr>
                                <td>Slug</td>
                                <td><b id="permission-slug"></b></td>
                            </tr>
                            <tr>
                                <td>Log Info</td>
                                <td><b id="permission-log"></b></td>
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
                <h5 class="modal-title">Add permission</h5>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <div><span class="text-danger" id="permission_error"></span></div>
                            <label for="permission">Permission Name<span class="text-danger">*</span></label>
                            <input type="text" name="permission" class="form-control" id="permission" placeholder="">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <div><span class="text-danger" id="slug_error"></span></div>
                            <label for="slug">Slug<span class="text-danger">*</span></label>
                            <input type="text" name="slug" class="form-control" id="slug" placeholder="">
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
                <h5 class="modal-title">Edit permission</h5>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <div><span class="text-danger" id="update_permission_error"></span></div>
                            <label for="permission">Permission Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="update_permission" placeholder="">
                            <small class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <div><span class="text-danger" id="update_slug_error"></span></div>
                            <label for="slug">Slug<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="update_slug" placeholder="">
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
