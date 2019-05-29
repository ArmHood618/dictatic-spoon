@extends('layouts.pegawai')
@section('content')
        <!-- Table - Start -->
        <table class="table table-bordered" style="width: 100%;">
          @if(count($data))
          <thead class="thead-dark text-center">
            <tr>
                <td class="col" style="width: 20%;">Kode</td>
                <td class="col" style="width: 20%;">Nama</td>
                <td class="col" style="width: 20%;">Nomor Plat</td>
                <td class="col" style="width: 20%;">Aksi</td>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $transaksi)
              @if($transaksi->isLunas === 0)
              <tr>
                  <th scope="row">{{ $transaksi->jenis_transaksi }}-{{ $transaksi->tanggal }}-{{ $transaksi->id }}</th>
                  <td>{{ $transaksi->nama }}</td>
                  <td>{{ $transaksi->no_plat }}</td>
                  <td><a class="btn btn-secondary" href="{{ route('owner.transaksi.edit', $transaksi->id) }}">Ubah</a>
                  {!! Form::open(['method' => 'Delete','route'
                                  => ['owner.transaksi.destroy', $transaksi->id],'style'=>'display:inline', 'id' => 'deleteForm']) !!}
                  <button type="button" onclick="deleteForm()" class="btn btn-danger btn-delete">Hapus</button>
                  {!! Form::close() !!}
                  <button type="button" class="btn btn-primary btnprn" onclick="frames['frame{{ $transaksi->id }}'].print()">Cetak</button>
                  <iframe src="{{ route('owner.SPK', $transaksi->id) }}" style="visibility:hidden; height:1px; width:1px;" name="frame{{ $transaksi->id }}"></iframe>
                  <a class="btn btn-success" href="{{ route('owner.transaksi.bayar', $transaksi->id) }}">Bayar</a>
                  </td>
              </tr>
              @else
              <tr>
                  <th scope="row">{{ $transaksi->jenis_transaksi }}-{{ $transaksi->tanggal }}-{{ $transaksi->id }}</th>
                  <td>{{ $transaksi->nama }}</td>
                  <td>{{ $transaksi->no_plat }}</td>
                  <td>
                  {!! Form::open(['method' => 'Delete','route'
                                  => ['owner.transaksi.destroy', $transaksi->id],'style'=>'display:inline', 'id' => 'deleteForm']) !!}
                  <button type="button" onclick="deleteForm()" class="btn btn-danger btn-delete">Hapus</button>
                  {!! Form::close() !!}
                  <button type="button" class="btn btn-primary btnprn" onclick="frames['frame{{ $transaksi->id }}'].print()">Cetak</button>
                  <iframe src="{{ route('owner.Nota', $transaksi->id) }}" style="visibility:hidden; height:1px; width:1px;" name="frame{{ $transaksi->id }}"></iframe>
                  </td>
              </tr>
              @endif
            @endforeach
            @else
            <tr>
                <td>Not Found !!!</td>
            </tr>
            @endif
          </tbody>
      </table>
      <!-- Table - End -->
      <a class="btn btn-outline-dark my-2 my-sm-0" href="{{ route('owner.transaksi.create') }}"><i class="fas fa-plus"></i><span> Tambah Transaksi</span></a>

    </div>
    
  </div>
  <script>
    function deleteForm(){
      if(confirm('Apakah anda yakin?')){
        document.getElementById('deleteForm').submit();
      }
    }
    function print(url) {
        var printWindow = window.open( url);
        printWindow.print();
        };
  </script>
@endsection