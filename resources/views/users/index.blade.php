@extends('layouts.app')

@section('content')
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last ">
                        <h3>Users List</h3>
                        <p class="text-subtitle text-muted">The User List from your school</p>
                    </div>
                    <div class="col-12col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Users</li>
                                <li class="breadcrumb-item active" aria-current="page">List</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section>
                <div class="card">
                    <div class="card-header">Users List
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="#" class="btn btn-primary me-md-2">Add New User</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="usersTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                        <?php $i = 0; ?>
                                    @foreach ($users as $user)
                                        <?php $i++; ?>
                                        <td>{{ $i }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <button class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                                            <button class="btn btn-danger"><i class="bi bi-trash"></i></button></td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
@endsection
