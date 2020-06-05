@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end mb-2">

<a href="{{ route('post.create') }}" class="btn btn-success btn-md">Add Post</a>

</div>

<div class="card card-default">

  <div class="card-header">Posts</div>

  <div class="card-body">


    @if($posts->count() > 0)
      <table class="table">

        <thead>
          <th>Title</th>
          <th>Image</th>
          <th></th>
          <th></th>
        </thead>

        <tbody>
          @foreach($posts as $post)
            <tr>
              <td>{{ $post->title }}</td>

              <td>
                <img src="{{ asset( $post->image ) }}" style="width:60px height:60px">
              </td>

              @if(!$post->trashed())
              <td>
                <a href=" {{ route('post.edit',$post->id) }}" class="btn btn-info btn-sm">Edit</a>
              </td>
              @endif

              <td>
                <form action="{{ route('post.destroy',$post->id) }}" method="POST">
                  @csrf

                  @method('DELETE')

                  <div class="form-group">

                    <button class="btn btn-danger btn-sm" type="submit">
                      {{ $post->trashed()? 'Delete' : 'Trash' }}
                    </button>

                  </div>

                </form>
              </td>
            </tr>
          @endforeach
        </tbody>

      </table>
    @else
      <h3 class="text-center">No Posts yet.</h3>
    @endif

  </div>

</div>

@endsection
