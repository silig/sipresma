@extends('layouts.master')

@section('title')
    <title>SIPRESMA</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item ">User</li>
                  <li class="breadcrumb-item active">Edit</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
          <hr>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('users.set_role', $user->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                        @card
                            @slot('title')
                            @endslot
                            
                            @if (session('success'))
                                @alert(['type' => 'success'])
                                    {{ session('success') }}
                                @endalert
                            @endif
                            
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>NIM</th>
                                            <td>:</td>
                                            <td>{{ $user->NIM }}</td>
                                        </tr>
                                        <tr>
                                            <th>Username</th>
                                            <td>:</td>
                                            <td>{{ $user->username }}</td>
                                        </tr>
                                        <tr>
                                            <th>Role</th>
                                            <td>:</td>
                                            <td>
                                                @foreach ($roles as $row)
                                                <input type="radio" name="role" 
                                                    {{ $user->hasRole($row) ? 'checked':'' }}
                                                    value="{{ $row }}"> {{  $row }} <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            @slot('footer')
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm float-right">
                                        Set Role
                                    </button>
                                </div>
                            @endslot
                        @endcard
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
