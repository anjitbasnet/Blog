@extends('user/app')

@section('bg-image',Storage::disk('local')->url($post->image))

@section('title',$post->title)

@section('sub-heading',$post->subtitle)

@section('main-content')

<article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <small>Created at {{ $post->created_at->diffForHumans() }}</small>

          @foreach($post->categories as $category)
             
              <small class="float-right" style="margin-right: 20px">
               <a href="{{ route('category',$category->slug) }}"> {{ $category->name }}  </a>
              </small>
         
          @endforeach
         
          {!! htmlspecialchars_decode($post->body)  !!}

          <!-- Tag Clouds -->
          <h3>Tags Cloud</h3>

           @foreach($post->tags as $tag)
             <a href="{{ route('tag',$tag->slug) }}">
              <small class="pull-right" style="margin-left: 10px; border-radius: 5px; border:1px solid gray; padding: 5px">
               {{$tag->name}}
             </small>
            </a>
          @endforeach
        </div>
      </div>
    </div>
  </article>

  <hr>

@endsection