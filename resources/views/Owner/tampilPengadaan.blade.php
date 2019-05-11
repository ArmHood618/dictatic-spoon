@extends('layouts.owner')
@section('content')
    <!-- Table - Start -->
    <table class="table table-bordered" style="width: 100%;">
      @if(count($data))
          <thead class="thead-dark text-center">
            <tr>
                <td class="col" style="width: 25%;">ID</td>
                <td class="col" style="width: 25%;">Supplier</td>
                <td class="col" style="width: 25%;">Tanggal</td>
                <td class="col" style="width: 25%;">Aksi</td>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $p)
            <tr>
                <th scope="row">{{ $p->id }}</th>
                <td>{{ $p->supplier->nama }}</td>
                <td>{{ $p->tanggal }}</td>
                <td><a class="btn btn-secondary" href="{{ route('owner.pengadaan.edit', $p->id) }}">Ubah</a>
                {!! Form::open(['method' => 'Delete','route'
                                => ['owner.pengadaan.destroy', $p->id],'style'=>'display:inline', 'id' => 'deleteForm']) !!}
                <button type="button" class="btn btn-danger" onclick="deleteData()">Hapus</button>
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
      <a class="btn btn-outline-dark my-2 my-sm-0" href="{{ route('owner.pengadaan.create') }}"><i class="fas fa-plus"></i><span> Tambah Pengadaan</span></a>
    </div>
    
  </div>
@endsection