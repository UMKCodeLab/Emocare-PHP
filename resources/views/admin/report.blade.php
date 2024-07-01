@extends('layouts.main')
@section('content')
<main>
    <h1 class="text-center" style="margin-bottom: 23px">DATA REPORT</h1>
    <div class="container">
      <div
        class="col-md-12 search-table-col"
        style="padding-top: 0px; margin-top: 0px"
      >
      @if (session()->has('loginError'))
                <div class="alert alert-danger" role="alert">
                    {{session('loginError')  }}

                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{session('success')  }}

                </div>
            @endif
        <div
          class="table-responsive table table-hover table-bordered results"
          style="margin-bottom: 0px"
        >
          <table class="table table-hover table-bordered ">
            <thead class="bill-header cs">
              <tr>
                <th id="trs-hd-1" class="col-lg-1">NO&nbsp;</th>
                <th id="trs-hd-2" class="col-lg-2">Username</th>
                <th id="trs-hd-3" class="col-lg-2">Role (pembuat)</th>
                <th id="trs-hd-4" class="col-lg-2">Pelapor</th>
                <th id="trs-hd-5" class="col-lg-2">Post</th>
                <th id="trs-hd-6" class="col-lg-2">Kategori</th>
                <th id="trs-hd-6" class="col-lg-2">Pesan</th>
                <th id="trs-hd-7" class="col-lg-2">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($posting as $report)
                  <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $report->forum->user->username }}</td>
                  <td>{{ $report->forum->user->role }}</td>
                  <td>{{ $report->user->username }}</</td>
                  <td>{{ $report->forum->isi }}&nbsp;</td>
                  <td>{{ $report->kategory }}</td>
                  <td>{{ $report->pesan }}</td>
                  <td>
                      {{-- <form action="{{ route('forum.delete', ['id'=>$report->forum_id]) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit">HAPUS&nbsp;</button>
                      </form> --}}
                      <button class="btn btn-danger" type="submit" onclick="alert('Berhasil Menghapus')">HAPUS&nbsp;</button>
                  </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          {{ $posting->links() }}
        </div>
      </div>
    </div>
  </main>
@endsection
