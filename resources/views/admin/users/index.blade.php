@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master Data /</span> Users</h4>

        <div class="card">
            <h5 class="card-header">Users Table</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>

                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($users as $user)
                            <tr>
                                <td width="25%">
                                    <div class="users-list">
                                        <div class="avatar avatar-xs pull-up" data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom" data-bs-placement="top" title="{{ $user->name }}">
                                            <img src="/assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                                            <strong class="text-sm td-name">{{ Str::limit($user->name, 25) }}</strong>
                                        </div>
                                    </div>

                                </td>
                                <td>{{ $user->email }}</td>

                                <td><span class="badge bg-label-primary me-1">Active</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-trash me-1"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>



    </div>
@endsection
