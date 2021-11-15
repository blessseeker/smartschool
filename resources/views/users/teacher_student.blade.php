@extends('users.index')
    @section('card')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                <div class="card">
                    <div class="card-header">Users List
                        <ul class="nav nav-pills nav-fill">
                            <li class="nav-item active">
                              <a class="nav-link" aria-current="page" data-toggle="tab" href="#teachers-list">Teachers</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#students-list">Students</a>
                            </li>
                    </div>
                    <div class="card-body tab-content">
                        <div id="teachers-list" class="tab-pane active">
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
                                            <?php $i = 0; ?>
                                        @foreach ($users as $user)
                                            @if ($user->role == 'TEACHER')
                                                <?php $i++; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->username }}</td>
                                                    <td>{{ $user->role }}</td>
                                                    <td>
                                                        <button class="btn btn-primary"><i class="bi bi-chat"></i></button>
                                                    </td>    
                                                </tr>
                                            @endif
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="students-list" class="tab-pane">
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
                                        <?php $i = 0; ?>
                                        @foreach ($users as $user)
                                            @if ($user->role == 'STUDENT')
                                                <?php $i++; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->username }}</td>
                                                    <td>{{ $user->role }}</td>
                                                    <td>
                                                        <button class="btn btn-primary"><i class="bi bi-chat"></i></button>
                                                    </td>    
                                                </tr>
                                            @endif
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endsection