@extends('layouts.owner')
@section('content')
      <!-- Table - Start -->
      <table class="table table-bordered" style="width: 100%;">
      @if(count($data))
          <thead class="thead-dark text-center">
            <tr>
                <td class="col" style="width: 20%;">ID</td>
                <td class="col" style="width: 20%;">Nama</td>
                <td class="col" style="width: 20%;">Alamat</td>
                <td class="col" style="width: 20%;">Nomor Telepon</td>
                <td class="col" style="width: 20%;">Aksi</td>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $supplier)
            <tr>
                <th scope="row">{{ $supplier->id }}</th>
                <td>{{ $supplier->nama }}</td>
                <td>{{ $supplier->alamat }}</td>
                <td>{{ $supplier->no_telp }}</td>
                <td><a class="btn btn-secondary" href="{{ route('owner.supplier.edit', $supplier->id) }}">Ubah</a>
                {!! Form::open(['method' => 'Delete','route'
                                => ['owner.supplier.destroy', $supplier->id],'style'=>'display:inline', 'id' => 'deleteForm']) !!}
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
      <a class="btn btn-outline-dark my-2 my-sm-0" href="{{ route('owner.supplier.create') }}"><i class="fas fa-plus"></i><span> Tambah Supplier</span></a>
    </div>
    
  </div>
  <script>
    document.querySelectorAll('.btn-delete').forEach(function(element) {
      element.onclick = deleteData
    })
  </script>
@endsection