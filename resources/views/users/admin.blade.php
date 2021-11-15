@extends('users.index')
<div class="modal fade text-left" id="addNewUserModal" tabindex="-1"
    role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
        role="document">
        <div class="modal-content">
            <form action="{{route('users.store')}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add New User </h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <label>Email: </label>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email Address"
                            class="form-control">
                    </div>
                    <label>Full Name: </label>
                    <div class="form-group">
                        <input type="text" name="full_name" placeholder="Full Name"
                            class="form-control">
                    </div>
                    <label>Role: </label>
                    <div class="form-group">
                        <select name="role" id="role" class="form-control">
                            <option value="TEACHER">Teacher</option>
                            <option value="STUDENT">Student</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary"
                        data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Send Invitation</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
    @section('card')
                <div class="card">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
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
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                        <?php $i = 0; ?>
                                    @foreach ($users as $user)
                                        <?php 
                                            $i++;
                                            if ($user->role == 'ADMIN') {
                                                $full_name = $user->school_admin->full_name;
                                            } else if ($user->role == 'TEACHER')  {
                                                $full_name = $user->teacher->full_name;
                                            } else if ($user->role == 'STUDENT')  {
                                                $full_name = $user->student->full_name;
                                            }
                                            
                                        ?>
                                <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $full_name }}</td>
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
                                                    <form action="{{route('users.update', [$user->id])}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel33">Edit User </h4>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
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
                                                                <input type="text" name="full_name" placeholder="Full Name"
                                                                    class="form-control" value="{{$full_name}}">
                                                            </div>
                                                            <label>Role: </label>
                                                            <div class="form-group">
                                                                <input name="role" id="role" class="form-control" value="{{ $user->role }}" readonly>
                                                            </div>
                                                            <label>Password: </label>
                                                            <div class="form-group">
                                                                <input type="password" name="password" placeholder="Password"
                                                                    class="form-control" value="">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Cancel</span>
                                                            </button>
                                                            <button type="submit" class="btn btn-primary ml-1">
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
                                                        <form action="{{route('users.destroy', [$user->id])}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="DELETE">
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
                                                                <button type="submit" class="btn btn-danger ml-1">
                                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Yes</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endsection