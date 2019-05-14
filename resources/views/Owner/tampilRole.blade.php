@extends('layouts.owner')
@section('content')
      <!-- Table - Start -->
      <table class="table table-bordered" style="width: 100%;">
      @if(count($data))
          <thead class="thead-dark text-center">
            <tr>
                <td class="col" style="width: 30%;">ID</td>
                <td class="col" style="width: 30%;">Keterangan</td>
                <td class="col" style="width: 40%;">Aksi</td>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $role)
            <tr>
                <th scope="row">{{ $role->id }}</th>
                <td>{{ $role->keterangan }}</td>
                <td><a class="btn btn-secondary" href="{{ route('owner.role.edit', $role->id) }}">Ubah</a>
                {!! Form::open(['method' => 'Delete','route'
                                => ['owner.role.destroy', $role->id],'style'=>'display:inline', 'id' => 'deleteForm']) !!}
                <button type="button" class="btn btn-danger btn-delete">Hapus</button>
                {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td>Not Found !!!</td>
            </tr>
            @endif
          </tbody>
      </table>
      <!-- Table - End -->
      <a class="btn btn-outline-dark my-2 my-sm-0" href="{{ route('owner.role.create') }}"><i class="fas fa-plus"></i><span> Tambah Role</span></a>
    </div>
    
  </div>
  <script>
    document.querySelectorAll('.btn-delete').forEach(function(element) {
      element.onclick = deleteData
    })
  </script>
@endsection