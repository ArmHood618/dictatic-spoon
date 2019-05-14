@extends('layouts.owner')
@section('content')
      <!-- Table - Start -->
      <table class="table table-bordered" style="width: 100%;">
      @if(count($data))
          <thead class="thead-dark text-center">
            <tr>
                <td class="col" style="width: 5%;">ID</td>
                <td class="col" style="width: 10%;">Nama</td>
                <td class="col" style="width: 10%;">Tipe</td>
                <td class="col" style="width: 10%;">Letak</td>
                <td class="col" style="width: 10%;">Ruang</td>
                <td class="col" style="width: 10%;">Stok</td>
                <td class="col" style="width: 10%;">Stok Minimal</td>
                <td class="col" style="width: 10%;">Harga Beli</td>
                <td class="col" style="width: 10%;">Harga Jual</td>
                <td class="col" style="width: 15%;">Aksi</td>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $spr)
            <tr>
                <th scope="row">{{ $spr->id }}</th>
                <td>{{ $spr->nama }}</td>
                <td>{{ $spr->tipe }}</td>
                <td>{{ $spr->letak->letak }}</td>
                <td>{{ $spr->ruang->ruang }}</td>
                <td>{{ $spr->stok }}</td>
                <td>{{ $spr->stok_min }}</td>
                <td>{{ $spr->harga_beli }}</td>
                <td>{{ $spr->harga_jual }}</td>
                <td><a class="btn btn-secondary" href="{{ route('owner.sparepart.edit', $spr->id) }}">Ubah</a>
                {!! Form::open(['method' => 'Delete','route'
                                => ['owner.sparepart.destroy', $spr->id],'style'=>'display:inline', 'id' => 'deleteForm']) !!}
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
      <a class="btn btn-outline-dark my-2 my-sm-0" href="{{ route('owner.sparepart.create') }}"><i class="fas fa-plus"></i><span> Tambah Sparepart</span></a>
    </div>
    
  </div>
  <script>
    document.querySelectorAll('.btn-delete').forEach(function(element) {
      element.onclick = deleteData
    })
  </script>
@endsection