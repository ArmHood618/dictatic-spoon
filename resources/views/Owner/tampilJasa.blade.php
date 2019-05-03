@extends('layouts.owner')
@section('content')
      <!-- Table - Start -->
      <table class="table table-bordered" style="width: 100%;">
      @if(count($data))
          <thead class="thead-dark text-center">
            <tr>
                <td class="col" style="width: 20%;">ID</td>
                <td class="col" style="width: 25%;">Jenis</td>
                <td class="col" style="width: 25%;">Harga</td>
                <td class="col" style="width: 30%;">Aksi</td>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $jasa)
            <tr>
                <th scope="row">{{ $jasa->id }}</th>
                <td>{{ $jasa->jenis }}</td>
                <td>{{ $jasa->harga }}</td>
                <td><a class="btn btn-secondary" href="{{ route('owner.jasa.edit', $jasa->id) }}">Ubah</a>
                {!! Form::open(['method' => 'Delete','route'
                                => ['owner.jasa.destroy', $jasa->id],'style'=>'display:inline', 'id' => 'deleteForm']) !!}
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
      <a class="btn btn-outline-dark my-2 my-sm-0" href="{{ route('owner.jasa.create') }}"><i class="fas fa-plus"></i><span> Tambah Jasa</span></a>
    </div>
    
  </div>
  
@endsection