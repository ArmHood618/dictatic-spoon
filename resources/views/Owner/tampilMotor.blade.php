@extends('layouts.owner')
@section('content')
      <!-- Table - Start -->
      <table class="table table-bordered" style="width: 100%;">
      @if(count($data))
          <thead class="thead-dark text-center">
            <tr>
                <td class="col" style="width: 25%;">ID</td>
                <td class="col" style="width: 25%;">Merek</td>
                <td class="col" style="width: 25%;">Tipe</td>
                <td class="col" style="width: 25%;">Aksi</td>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $motor)
            <tr>
                <th scope="row">{{ $motor->id }}</th>
                <td>{{ $motor->merek->merek }}</td>
                <td>{{ $motor->tipe }}</td>
                <td><a class="btn btn-secondary" href="{{ route('owner.motor.edit', $motor->id) }}">Ubah</a>
                {!! Form::open(['method' => 'Delete','route'
                                => ['owner.motor.destroy', $motor->id],'style'=>'display:inline', 'id' => 'deleteForm']) !!}
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
      <a class="btn btn-outline-dark my-2 my-sm-0" href="{{ route('owner.motor.create') }}"><i class="fas fa-plus"></i><span> Tambah Motor</span></a>
    </div>
    
  </div>
  <script>
    document.querySelectorAll('.btn-delete').forEach(function(element) {
      element.onclick = deleteData
    })
  </script>
@endsection