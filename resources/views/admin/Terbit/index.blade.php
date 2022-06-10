<x-app-layout>
    <div class="container-fluid">
        <div class="row col-lg-6 pb-4">
            <form action="{{ route('cariTahunTerbit') }}" method="get">
                {{-- @csrf --}}
                <div class="card mt-4" id="password">
                    <div class="card-header">
                        <h5>Laporan Terbit Izin</h5>
                        <hr>
                    </div>
                    <div class="card-body pt-0">
                        <label class="form-label">Tahun</label>
                        <div class="form-group">
                            <select class="form-control" name="tahun" id="choices-gender">
                                {{-- @foreach ($User as $item) --}}
                                <option value="" disabled selected>--PILIH--</option>
                                @foreach ($Tahun as $item)
                                    <option value="{{ $item->year }}">{{ $item->year }}</option>
                                @endforeach
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
                                <h5 class="mb-0">Data Terbit Tahun {{request()->tahun}}</h5>
                                <p class="text-sm mb-0">
                                    Kumpulan data terbit.
                                </p>
                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">
                                    <a href="{{ route('Terbit.create') }}" class="btn bg-gradient-primary btn-sm mb-0"
                                        target="_blank">+&nbsp; Tambah Data</a>
                                    <button type="button" class="btn btn-outline-primary btn-sm mb-0"
                                        data-bs-toggle="modal" data-bs-target="#import">
                                        Import
                                    </button>
                                    <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog mt-lg-10">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ModalLabel">Import CSV</h5>
                                                    <i class="fas fa-upload ms-3"></i>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>You can browse your computer for a file.</p>
                                                    <input type="text" placeholder="Browse file..."
                                                        class="form-control mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="importCheck" checked="">
                                                        <label class="custom-control-label" for="importCheck">I accept
                                                            the terms and conditions</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn bg-gradient-secondary btn-sm"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button"
                                                        class="btn bg-gradient-primary btn-sm">Upload</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('exportTerbit') }}"
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($data))
                                        @foreach ($data as $item)
                                            <tr>
                                                <td class="text-sm">{{ $loop->iteration }}</td>
                                                <td class="text-sm">{{ $item['nama_izin'] }}</td>
                                                <td class="text-sm">{{ $item['January'] ?? 0 }}</td>
                                                <td class="text-sm">{{ $item['February'] ?? 0 }}</td>
                                                <td class="text-sm">{{ $item['March'] ?? 0 }}</td>
                                                <td class="text-sm">{{ $item['April'] ?? 0 }}</td>
                                                <td class="text-sm">{{ $item['May'] ?? 0 }}</td>
                                                <td class="text-sm">{{ $item['June'] ?? 0 }}</td>
                                                <td class="text-sm">{{ $item['July'] ?? 0 }}</td>
                                                <td class="text-sm">{{ $item['August'] ?? 0 }}</td>
                                                <td class="text-sm">{{ $item['September'] ?? 0 }}</td>
                                                <td class="text-sm">{{ $item['October'] ?? 0 }}</td>
                                                <td class="text-sm">{{ $item['November'] ?? 0 }}</td>
                                                <td class="text-sm">{{ $item['December'] ?? 0 }}</td>
                                                <td class="text-sm">{{ ($item['January'] ?? 0) + ($item['February'] ?? 0) + ($item['March'] ?? 0) 
                                                    + ($item['April'] ?? 0) + ($item['May'] ?? 0) + ($item['June'] ?? 0) 
                                                    + ($item['July'] ?? 0 )+ ($item['August'] ?? 0) + ($item['September'] ?? 0)
                                                    + ($item['October'] ?? 0) + ($item['November'] ?? 0) + ($item['December'] ?? 0) }}</td>
                                                <td class="text-sm">
                                                    <a href="{{ route('Terbit.show', $item['id'] . '?tahun=' . request()->tahun) }}"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-original-title="Preview product">
                                                        <i class="fas fa-eye text-secondary"></i>
                                                    </a>
                                                    {{-- <a href="{{ route('Terbit.edit', $item['nama_izin']) }}"
                                                        class="mx-3" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Edit product">
                                                        <i class="fas fa-user-edit text-secondary"></i>
                                                    </a>
                                                    <a href="javascript:;" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Delete product">
                                                        <i class="fas fa-trash text-secondary"></i>
                                                    </a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif


                                </tbody>
                                {{-- <tfoot>
                                    <tr>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>SKU</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot> --}}
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

                // document.querySelectorAll(".export").forEach(function(el) {
                //     el.addEventListener("click", function(e) {
                //         var type = el.dataset.type;

                //         var data = {
                //             type: type,
                //             filename: "soft-ui-" + type,
                //         };

                //         if (type === "csv") {
                //             data.columnDelimiter = "|";
                //         }

                //         dataTableSearch.export(data);
                //     });
                // });
            };
        </script>
    @endpush
</x-app-layout>
