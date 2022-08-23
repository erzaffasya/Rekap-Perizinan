<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto text-center ">
                <h1>Tambah Data</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                {{-- <div class="multisteps-form">
                    <div class="row">
                        <div class="col-12 col-lg-8 mx-auto mt-4 mb-sm-5 mb-3">
                            <div class="multisteps-form__progress">
                                <button class="multisteps-form__progress-btn js-active" type="button"
                                    title="Product Info">
                                    <span>Informasi</span>
                                </button>
                                <button class="multisteps-form__progress-btn" type="button" title="Media">
                                    Validasi</button>
                            </div>
                        </div>
                    </div> --}}
                    <!--form panels-->
                    <div class="row">
                        <div class="col-12 col-lg-5 m-auto">
                            <form  method="post" action="{{ route('Perdagangan.store') }}">
                                @csrf
                                <!--single form panel-->
                                <div class="card p-3 border-radius-xl bg-white js-active"
                                    data-animation="FadeIn">
                                    <h5 class="font-weight-bolder">Formulir Tambah Data </h5>
                                    <div class="">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-12">
                                                <label>Nama Izin </label>
                                                <select name="seksi_id" class="multisteps-form__select form-control" required>
                                                    <option selected="selected" disabled>-- PILIH --</option>
                                                  @foreach ($seksi as $item)
                                                  <option value="{{$item->id}}">{{$item->nama_seksi}}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-12">
                                                <label>Nama</label>
                                                <input class="form-control" name="nama" type="text" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-12">
                                                <label>Alamat Kantor</label>
                                                <input class="form-control" name="alamat_kantor" type="text" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-12">
                                                <label>Lokasi Usaha</label>
                                                <input class="form-control" name="lokasi_usaha" type="text" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-12">
                                                <label>NIB</label>
                                                <input class="form-control" name="nib" type="text" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-12">
                                                <label>Status Ppenanaman Modal</label>
                                                <input class="form-control" name="status_penanaman_modal" type="text" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-12">
                                                <label>KBLI</label>
                                                <input class="form-control" name="kbli" type="text" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-12">
                                                <label>Tanggal</label>
                                                <input class="form-control" name="tanggal" type="date" value="2018-11-23T10:30:00" id="example-datetime-local-input" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-12">
                                                <label>Tujuan OPD</label>
                                                <input class="form-control" name="tujuan_opd" type="text" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                            </div>
                                        </div>
                                       
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit"
                                                title="Next">Kirim</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            if (document.getElementById('edit-deschiption')) {
                var quill = new Quill('#edit-deschiption', {
                    theme: 'snow' // Specify theme in configuration
                });
            };

            if (document.querySelector('.datetimepicker')) {
                flatpickr('.datetimepicker', {
                    allowInput: true
                }); // flatpickr
            }

            if (document.getElementById('choices-category')) {
                var element = document.getElementById('choices-category');
                const example = new Choices(element, {
                    searchEnabled: false
                });
            };

            if (document.getElementById('choices-sizes')) {
                var element = document.getElementById('choices-sizes');
                const example = new Choices(element, {
                    searchEnabled: false
                });
            };

            if (document.getElementById('choices-currency')) {
                var element = document.getElementById('choices-currency');
                const example = new Choices(element, {
                    searchEnabled: false
                });
            };

            if (document.getElementById('choices-tags')) {
                var tags = document.getElementById('choices-tags');
                const examples = new Choices(tags, {
                    removeItemButton: true
                });

                examples.setChoices(
                    [{
                            value: 'One',
                            label: 'Expired',
                            disabled: true
                        },
                        {
                            value: 'Two',
                            label: 'Out of Stock',
                            selected: true
                        }
                    ],
                    'value',
                    'label',
                    false,
                );
            }
        </script>
    @endpush
</x-app-layout>
