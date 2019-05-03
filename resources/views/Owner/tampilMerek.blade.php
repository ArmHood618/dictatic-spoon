@extends('layouts.owner')
@section('content')
      <!-- Table - Start -->
      <table class="table table-bordered" style="width: 100%;">
      @if(count($data))
          <thead class="thead-dark text-center">
            <tr>
                <td class="col" style="width: 30%;">ID</td>
                <td class="col" style="width: 30%;">Merek</td>
                <td class="col" style="width: 40%;">Aksi</td>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $merek)
            <tr>
                <th scope="row">{{ $merek->id }}</th>
                <td>{{ $merek->merek }}</td>
                <td><a class="btn btn-secondary" href="{{ route('owner.merek.edit', $merek->id) }}">Ubah</a>
                {!! Form::open(['method' => 'Delete','route'
                                => ['owner.merek.destroy', $merek->id],'style'=>'display:inline', 'id' => 'deleteForm']) !!}
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
      <a class="btn btn-outline-dark my-2 my-sm-0" href="{{ route('owner.merek.create') }}"><i class="fas fa-plus"></i><span> Tambah Merek</span></a>
    </div>
    
  </div>
  
@endsection