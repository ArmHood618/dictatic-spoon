@extends('layouts.owner')
@section('content')
      <!-- Table - Start -->
      <table class="table table-bordered" style="width: 100%;">
      @if(count($data))
          <thead class="thead-dark text-center">
            <tr>
                <td class="col" style="width: 5%;">ID</td>
                <td class="col" style="width: 10%;">Nama</td>
                <td class="col" style="width: 10%;">Alamat</td>
                <td class="col" style="width: 10%;">Nomor Telepon</td>
                <td class="col" style="width: 10%;">Gaji</td>
                <td class="col" style="width: 10%;">Username</td>
                <td class="col" style="width: 10%;">Role</td>
                <td class="col" style="width: 10%;">Cabang</td>
                <td class="col" style="width: 20%;">Aksi</td>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $pegawai)
            <tr>
                <th scope="row">{{ $pegawai->id }}</th>
                <td>{{ $pegawai->nama }}</td>
                <td>{{ $pegawai->alamat }}</td>
                <td>{{ $pegawai->no_telp }}</td>
                <td>{{ $pegawai->gaji }}</td>
                <td>{{ $pegawai->username }}</td>
                <td>{{ $pegawai->role->keterangan }}</td>
                <td>{{ $pegawai->cabang->daerah }}</td>
                <td><a class="btn btn-secondary" href="{{ route('owner.pegawai.edit', $pegawai->id) }}">Ubah</a>
                {!! Form::open(['method' => 'DELETE', 'route'
                                => ['owner.pegawai.destroy', $pegawai->id],'style'=>'display:inline', 'id' => 'deleteForm']) !!}
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
      <a class="btn btn-outline-dark my-2 my-sm-0" href="{{ route('owner.pegawai.create') }}"><i class="fas fa-plus"></i><span> Tambah Pegawai</span></a>
    </div>
    
  </div>

  <script>
    document.querySelectorAll('.btn-delete').forEach(function(element) {
      element.onclick = deleteData
    })
  </script>
  
@endsection