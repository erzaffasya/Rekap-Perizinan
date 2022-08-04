<x-app-layout>
    <div class="container-fluid">
        <div class="row col-lg-6 pb-4">
            <form action="{{ route('cariTahunPermohonan') }}" method="get">
                {{-- @csrf --}}
                <div class="card mt-4" id="password">
                    <div class="card-header">
                        <h5>Laporan Permohonan Izin</h5>
                        <hr>
                    </div>
                    <div class="card-body pt-0">
                        <label class="form-label">Sektor</label>
                        <div class="form-group">
                            <select class="form-control" name="sektor" id="sektor">
                                {{-- @foreach ($User as $item) --}}
                                <option value="" disabled selected>--PILIH--</option>
                                @foreach ($NSektor as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_sektor }}</option>
                                @endforeach
                                {{-- @endforeach --}}
                            </select>
                        </div>
                        <label class="form-label">Seksi</label>
                        <div class="form-group">
                            <select class="form-control" name="tahun" id="seksi">
                                {{-- @foreach ($User as $item) --}}
                                <option value="" disabled selected>--PILIH--</option>
                                {{-- @foreach ($Tahun as $item)
                                    <option value="{{ $item->year }}">{{ $item->year }}</option>
                                @endforeach --}}
                                {{-- @endforeach --}}
                            </select>
                        </div>
                        <label class="form-label">Tahun</label>
                        <div class="form-group">
                            <select class="form-control" name="tahun" id="tahun">
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

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header pb-0">
                        <div class="d-lg-flex">
                            <div>
                                <h5 class="mb-0">Data Permohonan Tahun {{ request()->tahun }} </h5>
                                <p class="text-sm mb-0">
                                    Kumpulan data permohonan.
                                </p>
                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">
                                    <a href="{{ route('Permohonan.create') }}"
                                        class="btn bg-gradient-primary btn-sm mb-0" target="_blank">+&nbsp; Tambah
                                        Data</a>
                                    <button type="button" class="btn btn-outline-primary btn-sm mb-0"
                                        data-bs-toggle="modal" data-bs-target="#import">
                                        Import
                                    </button>
                                    <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog mt-lg-10">
                                            <div class="modal-content">
                                                <form action="{{ route('importNData') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ModalLabel">Import CSV</h5>
                                                        <i class="fas fa-upload ms-3"></i>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <p>You can browse your computer for a file.</p>
                                                        <input type="file" name="file" class="form-control">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="" id="importCheck" checked="">
                                                            <label class="custom-control-label" for="importCheck">I
                                                                accept
                                                                the terms and conditions</label>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn bg-gradient-secondary btn-sm"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"
                                                            class="btn bg-gradient-primary btn-sm">Upload</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('exportPermohonan') }}"
                                        class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv"
                                        type="button" name="button">Export</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <table class="table table-flush" id="products-list">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="100px">No.</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="100px">Nama Pemohon</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="100px">Alamat Pemohon</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="100px">Tempat Kerja</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="100px">Nomor STR</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="100px">Izin Terbit</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="100px">Masa Berlaku</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="100px">Praktek Ke</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="100px">Alamat Praktik</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="100px">Seksi</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($NData))
                                        @foreach ($NData as $item)
                                            <tr>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $loop->iteration }}</span>
                                                </td>
                                                <td class="align-middle ">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $item->nama_pemohon }}</span>
                                                </td>
                                                <td class="align-middle ">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $item->alamat_pemohon }}</span>
                                                </td>
                                                <td class="align-middle ">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $item->tempat_kerja }}</span>
                                                </td>
                                                <td class="align-middle ">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $item->nomor_str }}</span>
                                                </td>
                                                <td class="align-middle ">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $item->izin_terbit }}</span>
                                                </td>
                                                <td class="align-middle ">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $item->masa_berlaku_akhir }}</span>
                                                </td>
                                                <td class="align-middle ">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $item->praktik_ke }}</span>
                                                </td>
                                                <td class="align-middle ">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $item->alamat_praktik }}</span>
                                                </td>
                                                <td class="align-middle ">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $item->seksi->nama_seksi }}</span>
                                                </td>
                                                <td class="align-middle text-center ">
                                                    <a href="" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Preview product">
                                                        <i class="fas fa-eye text-secondary"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            if (document.getElementById('products-list')) {
                const dataTableSearch = new simpleDatatables.DataTable("#products-list", {
                    searchable: true,
                    fixedHeight: false,
                    perPage: 7
                });
            };
            $('#sektor').change(function(e) {
                e.preventDefault();
                $('#seksi')
                    .find('option')
                    .remove()
                    .end();
                let id = $('#sektor').val();
                console.log(id);
                $.ajax({
                    url: 'getSeksi/' + id,
                    type: 'GET',
                    success: function(res) {
                        console.log(res);
                        // $("#seksi").append("<option>erza</option>");
                        $.each(res, function(i, item) {
                            $('#seksi')
                                .append($('<option>', {
                                    value: item.id,
                                    text: item.nama_seksi
                                }));
                        });
                    }
                })
            });
           if ('#sektor') {
            
           } else {
            
           }
        </script>
    @endpush
</x-app-layout>
