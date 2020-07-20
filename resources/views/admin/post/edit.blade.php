@extends('admin.layouts.app')


@section('headSection')

<link rel="stylesheet" href="/admin/bower_components/select2/dist/css/select2.min.css">


@endsection

@section('main-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Posts
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Posts</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
        
          <!-- /.box -->

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Titles</h3>
            </div>

          @include('includes.message')
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('post.update',$post->id) }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}

              {{ method_field('PATCH')}}

              <!-- PUT AND PATCH METHOD IS SAME -->

              <!-- {{ method_field('PUT')}} -->

              <div class="box-body">

                <div class="col-lg-6">

                   <div class="form-group">
                  <label for="title">Post Title</label>
                  <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ $post->title}}">
                </div>

                <div class="form-group">
                  <label for="subtitle">Post SubTitle</label>
                  <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="SubTitle" value="{{ $post->subtitle }}">
                </div>

                <div class="form-group">
                  <label for="slug">Post Slug</label>
                  <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug"  value="{{ $post->slug }}">
                </div>

                <div class="form-group">
                  <label for="posted_by">Posted By</label>
                  <input type="text" class="form-control" name="posted_by" id="posted_by" placeholder="Posted By" value="{{$post->posted_by}}">
                </div>
                  
                </div>
               
               <div class="col-lg-6">
                  <br>
                  <div class="form-group">
                    <div class="pull-right">
                      <label for="image">File Input</label>
                      <input type="file" name="image" id="image" value="{{$post->imageName}}" >
                    </div>
                    <div class="checkbox pull-left">

                      @can('posts.publish',Auth::user())
                  <label>
                    <input type="checkbox" name="status" value="1" @if($post->status == 1)
                    {{'checked'}}
                    @endif
                    > Publish
                  </label>

                  @endcan
                 </div>
                </div>
                
                <br> 
                <br>
                <div class="form-group">
                <label>Select Category</label>
                <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" tabindex="-1" aria-hidden="true" name="categories[]">

                  @foreach ($categories as $category)
                  <option value="{{ $category->id }}"

                    @foreach ($post->categories as $postCategory)

                      @if ($postCategory->id == $category->id)

                          selected
                      @endif

                    @endforeach

                    >{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Select Tags</label>
                <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" tabindex="-1" aria-hidden="true" name="tags[]">
                  @foreach ($tags as $tag)
                  <option value="{{ $tag->id }}"

                    @foreach ($post->tags as $postTag)

                      @if ($postTag->id == $tag->id)

                          selected
                      @endif

                    @endforeach

                    >{{ $tag->name }}</option>
                  @endforeach
                </select>
              </div>

              </div>

                </div>

            <div class="box">
            <div class="box-header">
              <h3 class="box-title">Write Post Body Here
                <small>Simple and fast</small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
            
                <textarea id="editor1" name="body" 
                          style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $post->body }}</textarea>
              
            </div>
          </div>
                
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-warning" href="{{ route('post.index') }}">Back</a>
              </div>
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

@section('footerSection')
<!-- CK Editor -->

<script src="/admin/bower_components/ckeditor/ckeditor.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script> 

<script src="/admin/bower_components/select2/dist/js/select2.full.min.js"></script>


<script>
  $(document).ready(function () {
    $(".select2").select2();
   
  });

 
</script>

@endsection
