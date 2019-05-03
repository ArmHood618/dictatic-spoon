@extends('layouts.owner')
@section('content')
      <!-- Table - Start -->
      <table class="table table-bordered" style="width: 100%;">
      @if(count($data))
          <thead class="thead-dark text-center">
            <tr>
                <td class="col" style="width: 20%;">ID</td>
                <td class="col" style="width: 20%;">Nama</td>
                <td class="col" style="width: 20%;">Supplier</td>
                <td class="col" style="width: 20%;">Nomor Telepon</td>
                <td class="col" style="width: 20%;">Aksi</td>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $sales)
            <tr>
                <th scope="row">{{ $sales->id }}</th>
                <td>{{ $sales->nama }}</td>
                <td>{{ $sales->supplier->nama }}</td>
                <td>{{ $sales->no_telp }}</td>
                <td><a class="btn btn-secondary" href="{{ route('owner.sales.edit', $sales->id) }}">Ubah</a>
                {!! Form::open(['method' => 'Delete','route'
                                => ['owner.sales.destroy', $sales->id],'style'=>'display:inline', 'id' => 'deleteForm']) !!}
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
      <a class="btn btn-outline-dark my-2 my-sm-0" href="{{ route('owner.sales.create') }}"><i class="fas fa-plus"></i><span> Tambah Sales</span></a>
    </div>
    
  </div>
  
@endsection