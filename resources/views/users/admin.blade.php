@extends('users.index')
    @section('card')
                <div class="card">
                    <div class="card-header">Users List
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a class="btn btn-primary me-md-2" data-bs-toggle="modal" data-bs-target="#addNewUserModal">Invite New User</a>
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
                                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editUserModal{{$user->id}}"><i class="bi bi-pencil"></i></button>
                                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{$user->id}}"><i class="bi bi-trash"></i></button>
                                        </td>
                                        <div class="modal fade text-left" id="editUserModal{{$user->id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel33">Edit User </h4>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <form action="#">
                                                        <div class="modal-body">
                                                            <label>Email: </label>
                                                            <div class="form-group">
                                                                <input type="email" placeholder="Email Address"
                                                                    class="form-control" value="{{$user->email}}" readonly>
                                                            </div>
                                                            <label>Username: </label>
                                                            <div class="form-group">
                                                                <input type="text" placeholder="Username"
                                                                    class="form-control" value="{{$user->username}}" readonly>
                                                            </div>
                                                            <label>Full Name: </label>
                                                            <div class="form-group">
                                                                <input type="text" placeholder="Full Name"
                                                                    class="form-control" value="">
                                                            </div>
                                                            <label>Role: </label>
                                                            <div class="form-group">
                                                                <select name="role" id="role" class="form-control">
                                                                    <option value="ADMIN" @if ($user->role === 'ADMIN')
                                                                        selected
                                                                    @endif>School Admin</option>
                                                                    <option value="TEACHER" @if ($user->role === 'TEACHER')
                                                                        selected
                                                                    @endif>Teacher</option>
                                                                    <option value="STUDENT" @if ($user->role === 'STUDENT')
                                                                        selected
                                                                    @endif>Student</option>
                                                                </select>
                                                            </div>
                                                            <label>Password: </label>
                                                            <div class="form-group">
                                                                <input type="password" placeholder="Password"
                                                                    class="form-control" value="" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <button type="button" class="btn btn-primary ml-1"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Save Changes</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-danger me-1 mb-1 d-inline-block">

                                            <!--Danger theme Modal -->
                                            <div class="modal fade text-left" id="deleteUserModal{{$user->id}}" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel120"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger">
                                                            <h5 class="modal-title white" id="myModalLabel120">
                                                                Delete User
                                                            </h5>
                                                            <button type="button" class="close"
                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this user?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Cancel</span>
                                                            </button>
                                                            <button type="button" class="btn btn-danger ml-1"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Yes</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endsection