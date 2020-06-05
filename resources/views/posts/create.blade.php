@extends('layouts.app')

@section('content')

@if($errors->any())
  <div class="alert alert-danger">

    <ul class="list-group">

      @foreach($errors->all() as $error)
        <li class="list-group-item">{{ $error }}</li>
      @endforeach

    </ul>

  </div>
@endif

<div class="card card-default">

<div class="card-header">{{ isset($posts)?'Edit Post':'Create Post' }}</div>

<div class="card-body">

<form action="{{ isset($posts)?route('post.update',$posts->id):route('post.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  @if($posts)
    @method('PUT')
  @endif

<div class="form-group">
  <label for="title">Title</label>
  <input type="text" class="form-control" name="title" id="title" value="{{ isset($posts)? $posts->title:""}}">
</div>

  <div class="form-group">

    <label for="description">Description</label>

    <textarea name="description" id="description" cols="5" rows="4" class="form-control">{{ isset($posts)? $posts->description:"" }}</textarea>

  </div>

  <div class="form-group">

    <label for="content">Content</label>
    <input type="hidden" name="content" id="content" value=" {{ isset($posts)? $posts->content : "" }}">
    <trix-editor input="content"></trix-editor>

  </div>

  @if($posts)

    <img src="{{ asset($posts->image) }}" alt="" style="width:100%">

  @endif

  <div class="form-group">
    <label for="image">Image</label>
    <input type="file" class="form-control" id="image" name="image">
  </div>

  <div class="form-group">

    <label for="published_at">Published At</label>
    <input type="text" class="form-control" name="published_at" id="published_at" value="{{ isset($posts)? $posts->published_at: "" }}">

  </div>

  <div class="form-group">
    <button class="btn btn-success btn sm">{{ isset($posts)? "Update Post" : "Create Post" }}</button>
  </div>

</form>

</div>

</div>

@endsection


@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    flatpickr('#published_at',{
      enableTime:true
    })
</script>

@endsection

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@endsection
