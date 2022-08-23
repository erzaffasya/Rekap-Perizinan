<x-app-layout>
    <div class="container-fluid">
        <div class="row col-lg-6 pb-4">
            <form action="{{ route('filterPertanahan') }}" method="get">
                {{-- @csrf --}}
                <div class="card mt-4" id="password">
                    <div class="card-header">
                        <h5>FILTER DATA</h5>
                        <hr>
                    </div>
                    <div class="card-body pt-0">
                        <label class="form-label">Tanggal Awal</label>
                        <div class="form-group">
                            <input class="form-control" name="tanggal_awal" type="date"
                                @if (request()->tanggal_awal) value="{{ request()->tanggal_awal }}" @else value="2022-01-01" @endif
                                id="example-datetime-local-input" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                        <label class="form-label">Tanggal Akhir</label>
                        <div class="form-group">
                            <input class="form-control" name="tanggal_akhir" type="date"
                                value="{{ request()->tanggal_akhir }}" id="example-datetime-local-input"
                                onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                        <h5 class="mt-5">Pastikan data sudah benar</h5>
                        <p class="text-muted mb-2">
                            Sarat pencarian ada dibawah ini:
                        </p>
                        <ul class="text-muted ps-4 mb-0 float-start">
                            <li>
                                <span class="text-sm">Input Tanggal Awal</span>
                            </li>
                            <li>
                                <span class="text-sm">Input Tanggal Akhir</span>
                            </li>
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
                                <h5 class="mb-0">Tabel Data </h5>
                                <p class="text-sm mb-0">
                                    Kumpulan Data Seksi.
                                </p>
                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">
                                    <a href="{{ route('Pertanahan.create') }}"
                                        class="btn bg-gradient-primary btn-sm mb-0" target="_blank">+&nbsp; Tambah
                                        Data</a>
                                    <button type="button" class="btn btn-outline-primary btn-sm mb-0"
                                        data-bs-toggle="modal" data-bs-target="#import">
                                        Import
                                    </button>
                                    <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog mt-lg-10">
                                            <div class="modal-content">
                                                <form action="{{ route('importPertanahan') }}" method="post"
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
                                    {{-- <a href="{{ route('exportPermohonan') }}"
                                        class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv"
                                        type="button" name="button">Export</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <table class="table table-flush" id="products-list">
                                <thead class="thead-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Izin</th>
                                        <th>Januari</th>
                                        <th>Februari</th>
                                        <th>Maret</th>
                                        <th>April</th>
                                        <th>Mei</th>
                                        <th>Juni</th>
                                        <th>Juli</th>
                                        <th>Agustus</th>
                                        <th>September</th>
                                        <th>Oktober</th>
                                        <th>November</th>
                                        <th>Desember</th>
                                        <th>Total</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="100px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($data))
                                        @foreach ($data as $item)
                                            <tr>
                                                <td class="text-sm">{{ $loop->iteration }}</td>
                                                <td class="text-sm">
                                                    <a
                                                        href="{{ url('detailData') }}/filterPertanahan?tanggal_awal={{request()->tanggal_awal}}&tanggal_akhir={{request()->tanggal_akhir}}&seksi={{ $item['id'] }}">
                                                        {{ $item['nama_seksi'] }}
                                                    </a>
                                                </td>
                                                <td class="text-sm">
                                                    <a
                                                        href="{{ url('detailData') }}/filterPertanahan?tanggal_awal={{request()->tanggal_awal}}&tanggal_akhir={{request()->tanggal_akhir}}&bulan=January&seksi={{ $item['id'] }}">
                                                        {{ $item['January'] ?? 0 }}
                                                    </a>
                                                </td>
                                                <td class="text-sm">
                                                    <a
                                                        href="{{ url('detailData') }}/filterPertanahan?tanggal_awal={{request()->tanggal_awal}}&tanggal_akhir={{request()->tanggal_akhir}}&bulan=February&seksi={{ $item['id'] }}">
                                                        {{ $item['February'] ?? 0 }}
                                                    </a>
                                                </td>
                                                <td class="text-sm">
                                                    <a
                                                        href="{{ url('detailData') }}/filterPertanahan?tanggal_awal={{request()->tanggal_awal}}&tanggal_akhir={{request()->tanggal_akhir}}&bulan=March&seksi={{ $item['id'] }}">
                                                        {{ $item['March'] ?? 0 }}
                                                    </a>
                                                </td>
                                                <td class="text-sm">
                                                    <a
                                                        href="{{ url('detailData') }}/filterPertanahan?tanggal_awal={{request()->tanggal_awal}}&tanggal_akhir={{request()->tanggal_akhir}}&bulan=April&seksi={{ $item['id'] }}">
                                                        {{ $item['April'] ?? 0 }}
                                                    </a>
                                                </td>
                                                <td class="text-sm">
                                                    <a
                                                        href="{{ url('detailData') }}/filterPertanahan?tanggal_awal={{request()->tanggal_awal}}&tanggal_akhir={{request()->tanggal_akhir}}&bulan=May&seksi={{ $item['id'] }}">
                                                        {{ $item['May'] ?? 0 }}
                                                    </a>
                                                </td>
                                                <td class="text-sm">
                                                    <a
                                                        href="{{ url('detailData') }}/filterPertanahan?tanggal_awal={{request()->tanggal_awal}}&tanggal_akhir={{request()->tanggal_akhir}}&bulan=June&seksi={{ $item['id'] }}">
                                                        {{ $item['June'] ?? 0 }}
                                                    </a>
                                                </td>
                                                <td class="text-sm">
                                                    <a
                                                        href="{{ url('detailData') }}/filterPertanahan?tanggal_awal={{request()->tanggal_awal}}&tanggal_akhir={{request()->tanggal_akhir}}&bulan=July&seksi={{ $item['id'] }}">
                                                        {{ $item['July'] ?? 0 }}
                                                    </a>
                                                </td>
                                                <td class="text-sm">
                                                    <a
                                                        href="{{ url('detailData') }}/filterPertanahan?tanggal_awal={{request()->tanggal_awal}}&tanggal_akhir={{request()->tanggal_akhir}}&bulan=August&seksi={{ $item['id'] }}">
                                                        {{ $item['August'] ?? 0 }}
                                                    </a>
                                                </td>
                                                <td class="text-sm">
                                                    <a
                                                        href="{{ url('detailData') }}/filterPertanahan?tanggal_awal={{request()->tanggal_awal}}&tanggal_akhir={{request()->tanggal_akhir}}&bulan=September&seksi={{ $item['id'] }}">
                                                        {{ $item['September'] ?? 0 }}
                                                    </a>
                                                </td>
                                                <td class="text-sm">
                                                    <a
                                                        href="{{ url('detailData') }}/filterPertanahan?tanggal_awal={{request()->tanggal_awal}}&tanggal_akhir={{request()->tanggal_akhir}}&bulan=October&seksi={{ $item['id'] }}">
                                                        {{ $item['October'] ?? 0 }}
                                                    </a>
                                                </td>
                                                <td class="text-sm">
                                                    <a
                                                        href="{{ url('detailData') }}/filterPertanahan?tanggal_awal={{request()->tanggal_awal}}&tanggal_akhir={{request()->tanggal_akhir}}&bulan=November&seksi={{ $item['id'] }}">
                                                        {{ $item['November'] ?? 0 }}
                                                    </a>
                                                </td>
                                                <td class="text-sm">
                                                    <a
                                                        href="{{ url('detailData') }}/filterPertanahan?tanggal_awal={{request()->tanggal_awal}}&tanggal_akhir={{request()->tanggal_akhir}}&bulan=December&seksi={{ $item['id'] }}">
                                                        {{ $item['December'] ?? 0 }}
                                                    </a>
                                                </td>
                                                <td class="text-sm">
                                                    {{ ($item['January'] ?? 0) +
                                                        ($item['February'] ?? 0) +
                                                        ($item['March'] ?? 0) +
                                                        ($item['April'] ?? 0) +
                                                        ($item['May'] ?? 0) +
                                                        ($item['June'] ?? 0) +
                                                        ($item['July'] ?? 0) +
                                                        ($item['August'] ?? 0) +
                                                        ($item['September'] ?? 0) +
                                                        ($item['October'] ?? 0) +
                                                        ($item['November'] ?? 0) +
                                                        ($item['December'] ?? 0) }}
                                                </td>
                                                <td class="align-middle text-center ">
                                                    <a href="{{ url('detailData') }}/filterPertanahan?tanggal_awal={{request()->tanggal_awal}}&tanggal_akhir={{request()->tanggal_akhir}}&seksi={{ $item['id'] }}"
                                                        data-bs-toggle="tooltip"
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
