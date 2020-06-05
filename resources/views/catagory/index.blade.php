@extends('layouts.app')

@section('content')


<div class="d-flex justify-content-end mb-2">
  <a href="{{ route('catagory.create') }}" class="btn btn-success">Add Catagory</a>
</div>

<div class="card card-default">

  <div class="card-header">Catagories</div>

  <div class="card-body">

    @if($catagories->count() > 0)
    <table class="table">

      <thead>
        <th>Name</th>
        <th></th>
      </thead>

      <tbody>

      @foreach($catagories as $catagory)

      <tr>

        <td>{{ $catagory->name }}</td>
        <td>
                <a href="{{ route('catagory.edit',$catagory->id) }}" class="btn btn-info btn-sm">Edit</a>
                <button class="btn btn-danger btn-sm mx-2" onclick = "handleDelete({{ $catagory->id }})">Delete</button>
        </td>
      </tr>

      @endforeach

      </tbody>

    </table>

      <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">

      <form action="" method = "POST" id="deleteCatagoryId">
        @csrf
        @method('DELETE')

        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Delete Catagory</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure, you want to delete this catagory?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
            <button type="submit" class="btn btn-danger">Yes, Delete this</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  @else
    <h3 class="text-center">No catagories yet.</h3>
  @endif

  </div>

</div>

@endsection


@section('scripts')

  <script>

    function handleDelete(id)
    {

      var form = document.getElementById('deleteCatagoryId')
      form.action = '/catagory/' + id

      console.log('deleting',form)

      $('#deleteModal').modal('show')
    }


  </script>

@endsection
