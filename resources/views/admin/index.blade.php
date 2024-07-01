@extends('layouts.main')
@section('content')
<main class="">
    <h1 class="text-center" style="margin-bottom: 23px">DATA PENGGUNA</h1>
    <div class="container">
      <div
        class="col-md-12 search-table-col "
        style="padding-top: 0px; margin-top: 0px"
      >
        <div
          class="table-responsive table table-hover table-bordered results"
          style="margin-bottom: 0px"
        >
          <table class="table table-hover table-bordered">
            <thead class="bill-header cs">
              <tr>
                <th id="trs-hd-1" class="col-lg-1">NO&nbsp;</th>
                <th id="trs-hd-2" class="col-lg-2">Username</th>
                <th id="trs-hd-3" class="col-lg-1">Role</th>
                <th id="trs-hd-4" class="col-lg-2" style="text-align: center">Foto</th>
                <th id="trs-hd-6" class="col-lg-1" style="text-align: center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $item)

                  <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->username }}</td>
                  <td>{{ $item->role }}</td>
                  <td align="center">
                    @if($user->image === null)
                        <img
                        alt="profile"
                        class="avatar-img rounded-2 w-25"
                        src="../img/person-outline-filled.svg"
                        >
                    @else
                        <img
                      alt="Profile"
                      class="avatar-img rounded-2 w-25"
                      src="{{ asset('storage/profilepicture/'.$item->image) }}"
                        >
                    @endif
                    </td >
                  <td align="center">
                      {{-- <form action="{{ route('user.delete', ['id'=> $item->id]) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit">HAPUS&nbsp;</button>
                      </form> --}}
                      <button class="btn btn-danger" type="submit" onclick="alert('Under construction !!! Berhasil Menghapus')">HAPUS&nbsp;</button>
                  </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          {{ $users->links() }}
        </div>
      </div>
    </div>
  </main>
@endsection
