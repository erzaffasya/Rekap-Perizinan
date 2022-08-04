<x-app-layout>
    <div class="col-md-12 mb-lg-0 mb-4">
        <div class="card mt-4">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-4 d-flex align-items-center">
                        <h6 class="mb-0">IMTN</h6>
                    </div>
                    <div class="col-4 text-end">
                        <button type="button" class="btn btn-sm bg-gradient-primary mb-0" data-bs-toggle="modal"
                            data-bs-target="#tambahSektor"><i class="fas fa-plus"></i>&nbsp; Sektor</button>
                    </div>
                    <div class="col-4 text-end">
                        <button type="button" class="btn btn-sm bg-gradient-primary mb-0" data-bs-toggle="modal"
                            data-bs-target="#tambahImport"><i class="fas fa-plus"></i>&nbsp; Import</button>
                    </div>
                </div>
            </div>
            <div class="card-body  px-0 pt-0 pb-2 table-responsive">

                <table id="datatable-search" class="table align-items-center mb-0">

                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                width="100px">No.</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Nama Sektor</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Deskripsi</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                width="100px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($IMTN as $i)
                            <tr>
                                <td class="align-middle text-center">
                                    <span
                                        class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $i->no_surat }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $i->alamat }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $i->nama_pemohon }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $i->kecamatan }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $i->tanggal }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $i->tujuan_opd }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $i->keterangan }}</p>
                                </td>
                                <td>
                                    <div class="col-12 text-end">
                                        <button type="button" class="btn btn-sm bg-gradient-warning mb-0"
                                            data-bs-toggle="modal" data-bs-target="#editSektor-{{ $i->id }}"
                                            style="padding: 10px 24px"><i class="fas fa-Sektor"></i>&nbsp;
                                            Edit</button>
                                        <form id="form-delete" action="{{ route('IMTN.destroy', $i->id) }}" method="POST"
                                            style="display: inline">
                                            @csrf
                                            @method("DELETE")
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

    <div class="col-md-4">
        <div class="modal fade" id="tambahSektor" tabindex="-1" role="dialog" aria-labelledby="tambahSektorTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Izin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('IMTN.store')}}">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1">Nama Sektor</label>
                                <input type="text" class="form-control" name="nama_sektor" >
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1">Deskripsi</label>
                                <input type="text" class="form-control" name="deskripsi">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn bg-gradient-primary">Submit!</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="modal fade" id="tambahImport" tabindex="-1" role="dialog" aria-labelledby="tambahImportTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Izin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('importIMTN')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1">Import</label>
                                <input type="file" class="form-control" name="file" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn bg-gradient-primary">Submit!</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($IMTN as $i)
        <div class="col-md-4">
            <div class="modal fade" id="editSektor-{{ $i->id }}" tabindex="-1" role="dialog"
                aria-labelledby="tambahSektorTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Sektor</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('IMTN.update', $i->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ $i->id }}">
                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1">Nama Sektor</label>
                                    <input type="text" class="form-control" name="nama_sektor" value="{{ $i->nama_sektor }}">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlSelect1">Deskripsi</label>
                                    <input type="text" class="form-control" name="deskripsi" value="{{ $i->deskripsi }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn bg-gradient-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn bg-gradient-primary">Submit!</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @push('scripts')
        <script>
            const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
                searchable: true,
                fixedHeight: true
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
</x-app-layout>
