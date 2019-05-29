@extends('layouts.home')
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
              <tr>
                  <th scope="row">{{ $transaksi->jenis_transaksi }}-{{ $transaksi->tanggal }}-{{ $transaksi->id }}</th>
                  <td>{{ $transaksi->nama }}</td>
                  <td>{{ $transaksi->no_plat }}</td>
                  <td><a class="btn btn-secondary" href="{{ route('detail_transaksi', $transaksi->id) }}">Detail</a></td>
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