<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header pb-0">
                        <div class="d-lg-flex">
                            <div>
                                <h5 class="mb-0">Data Permohonan </h5>
                                <p class="text-sm mb-0">
                                    Kumpulan data Permohonan tahun {{request()->tahun}}.
                                </p>
                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">
                                    <a href="{{ route('Permohonan.create') }}" class="btn bg-gradient-primary btn-sm mb-0"
                                        target="_blank">+&nbsp; Tambah Data</a>
                                    {{-- <button type="button" class="btn btn-outline-primary btn-sm mb-0"
                                        data-bs-toggle="modal" data-bs-target="#import">
                                        Import
                                    </button> --}}
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
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Permohonan as $item)
                                        <tr>
                                            <td class="text-sm">{{ $loop->iteration }}</td>
                                            <td class="text-sm">{{ $item->Perizinan->nama_izin }}</td>
                                            <td class="text-sm">{{ $item->jumlah }}</td>
                                            <td class="text-sm">{{ $item->tanggal }}</td>

                                            <td class="text-sm">
                                                <a href="{{ url('detail-Permohonan',$item->id) }}"
                                                    data-bs-toggle="tooltip" data-bs-original-title="Preview product">
                                                    <i class="fas fa-eye text-secondary"></i>
                                                </a>
                                                {{-- <a href="{{ route('Permohonan.edit', $item['nama_izin']) }}"
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
