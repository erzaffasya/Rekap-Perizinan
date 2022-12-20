<x-app-layout>
    <div class="container-fluid">
        <div class="row col-lg-6 pb-4">
            <form action="{{ route('cariTahunPermohonan') }}" method="get">
                {{-- @csrf --}}
                <div class="card mt-4" id="password">
                    <div class="card-header">
                        <h5>Laporan Helpdesk</h5>
                        <hr>
                    </div>
                    <div class="card-body pt-0">
                        <label class="form-label">Tahun</label>
                        <div class="form-group">
                            <select class="form-control" name="tahun" id="choices-gender">
                                {{-- @foreach ($User as $item) --}}
                                <option value="" disabled selected>--PILIH--</option>
                                {{-- @foreach ($Tahun as $item)
                                    <option value="{{ $item->year }}">{{ $item->year }}</option>
                                @endforeach --}}
                                {{-- @endforeach --}}
                            </select>
                        </div>
                        <h5 class="mt-5">Pastikan data sudah benar</h5>
                        <p class="text-muted mb-2">
                            Sarat pencarian ada dibawah ini:
                        </p>
                        <ul class="text-muted ps-4 mb-0 float-start">
                            <li>
                                <span class="text-sm">Input Tahun Laporan</span>
                            </li>
                            {{-- <li>
                            <span class="text-sm">Input Divisi Mahasiswa</span>
                        </li> --}}
                        </ul>
                        <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Cek
                            Laporan</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12 mb-lg-0 mb-4">
            <div class="card mt-4">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Data Helpdesk</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body  px-0 pt-0 pb-2 table-responsive">

                    <table id="datatable-search" class="table align-items-center mb-0">

                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    width="100px">No.</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Nama</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Nomor HP</th>
                                    <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Email</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Kategori</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Keterangan</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    width="100px">Tanggal</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Tanda Tangan</th>
                                    <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($Helpdesk as $i)
                                <tr>
                                    <td class="align-middle text-center">
                                        <span
                                            class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $i->nama }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $i->no_hp }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $i->email }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $i->kategori->nama_kategori }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $i->keterangan }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $i->created_at->Format('D, d M Y') }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs font-weight-bold mb-0">
                                            <img height="80px" src="{{ asset('storage/ttd/' . $i->ttd) }}">
                                        </p>
                                    </td>
                                    <td>
                                        <div class="col-12 text-end">
                                            
                                            <form id="form-delete" action="{{ route('Helpdesk.destroy', $i->id) }}"
                                                method="POST" style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm bg-gradient-danger mb-0 show_confirm"
                                                    style="padding: 10px 24px"><i class="fas fa-trash"></i>&nbsp;
                                                    Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @push('scripts')
            <script>
                const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
                    searchable: true,
                    // fixedHeight: true
                });
                $('.show_confirm').click(function(event) {
                    var form = $(this).closest("form");
                    var name = $(this).data("name");
                    event.preventDefault();
                    swal({
                            title: `Hapus Data?`,
                            text: "Jika data terhapus, data akan hilang selamanya!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                form.submit();
                            }
                        });
                });
            </script>
        @endpush
    </div>
</x-app-layout>
