@extends('admin.layouts.app')

@section('main-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Text Editors
        <small>Advanced form element</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Editors</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
        
          <!-- /.box -->

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Admin</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            @include('includes.message')
            
            <form role="form" action="{{ route('user.update',$user->id) }}" method="post" enctype="multipart/form-data">

              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="box-body">

                <div class="col-lg-offset-3 col-lg-6">

                   <div class="form-group">
                  <label for="name">User Name</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="User Name" value="{{ $user->name }}">
                </div>

              
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $user->email }}">
                </div>

                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="phone" class="form-control" name="phone" id="phone" placeholder="Phone" value="{{ $user->phone }}">
                </div>

                <!-- <div class="form-group">
                    <div class="pull-right">
                      <label for="image">File Input</label>
                      <input type="file" name="image" id="image">
                    </div>
                  </div> -->

                <div class="form-group">
                  <label for="status">Status</label>
                  <div class="checkbox">
                      <label>
                        <input type="checkbox" name="status" @if($user->status == 1)
                        checked
                        @endif value="1">Status
                      </label>
                          
                  </div>
                </div>

                <div class="form-group">
                  <label>Assign Role</label>
                  <div class="row">
                    @foreach ($roles as $role)
                      <div class="col-lg-3">
                        <div class="checkbox">
                          <label><input type="checkbox" name="role[]" value="{{ $role->id }}"

                            @foreach($user->roles as $user_role)
                              @if($user_role->id == $role->id)
                              checked
                              @endif
                            @endforeach
                            >{{ $role->name }}</label>
                          
                        </div>
                        
                      </div>

                    @endforeach
                    
                  </div>
                  
                  
                </div>
                  
                <div class="form-group">

                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-warning" href="{{ route('user.index') }}">Back</a>
              </div>
            </form>

                </div>

                </div>

                
                
              <!-- /.box-body -->

              
            </form>
          </div>


          
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>



@endsection