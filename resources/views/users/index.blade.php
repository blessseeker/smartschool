@extends('layouts.app')

@section('content')
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last ">
                        <h3>{{ Auth::user()->school->school_name }} Users List</h3>
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
                @yield('card')
            </section>
        </div>
@endsection
