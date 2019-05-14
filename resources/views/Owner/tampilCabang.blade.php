@extends('layouts.owner')
@section('content')
      <!-- Table - Start -->
      <table class="table table-bordered" style="width: 100%;">
      @if(count($data))
          <thead class="thead-dark text-center">
            <tr>
                <td class="col" style="width: 10%;">ID</td>
                <td class="col" style="width: 15%;">Daerah</td>
                <td class="col" style="width: 20%;">Alamat</td>
                <td class="col" style="width: 20%;">Kota</td>
                <td class="col" style="width: 15%;">Kode Pos</td>
                <td class="col" style="width: 20%;">Aksi</td>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $cabang)
            <tr>
                <th scope="row">{{ $cabang->id }}</th>
                <td>{{ $cabang->daerah }}</td>
                <td>{{ $cabang->alamat }}</td>
                <td>{{ $cabang->kota }}</td>
                <td>{{ $cabang->kode_pos }}</td>
                <td><a class="btn btn-secondary" href="{{ route('owner.cabang.edit', $cabang->id) }}">Ubah</a>
                {!! Form::open(['method' => 'Delete','route'
                                => ['owner.cabang.destroy', $cabang->id],'style'=>'display:inline', 'id' => 'deleteForm']) !!}
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
      <a class="btn btn-outline-dark my-2 my-sm-0" href="{{ route('owner.cabang.create') }}"><i class="fas fa-plus"></i><span> Tambah Cabang</span></a>
    </div>
    
  </div>
  <script>
    document.querySelectorAll('.btn-delete').forEach(function(element) {
      element.onclick = deleteData
    })
  </script>
@endsection