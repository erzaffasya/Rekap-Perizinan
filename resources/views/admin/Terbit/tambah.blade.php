<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto text-center ">
                <h1>Tambah Terbit</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="multisteps-form">
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
                    </div>
                    <!--form panels-->
                    <div class="row">
                        <div class="col-12 col-lg-5 m-auto">
                            <form class="multisteps-form__form mb-8" method="post"
                                action="{{ route('Terbit.store') }}">
                                @csrf
                                <!--single form panel-->
                                <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                                    data-animation="FadeIn">
                                    <h5 class="font-weight-bolder">Informasi Program</h5>
                                    <div class="multisteps-form__content">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-12">
                                                <label>Nama Izin </label>
                                                <select name="perizinan_id"
                                                    class="multisteps-form__select form-control">
                                                    <option selected="selected" disabled>-- PILIH --</option>
                                                    @foreach ($Perizinan as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama_izin }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-12">
                                                <label>Jumlah Izin </label>
                                                <input class="form-control" name="jumlah" type="number"
                                                    onfocus="focused(this)" onfocusout="defocused(this)">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-12">
                                                <label>Tanggal Izin </label>
                                                <input class="form-control" name="tanggal" type="month"
                                                    value="2018-11-23T10:30:00" id="example-datetime-local-input"
                                                    onfocus="focused(this)" onfocusout="defocused(this)">
                                            </div>
                                        </div>

                                        <div class="button-row d-flex mt-4">
                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button"
                                                title="Next">Next</button>
                                        </div>
                                    </div>
                                </div>
                                <!--single form panel-->
                                <div class="card multisteps-form__panel p-3 border-radius-xl bg-white"
                                    data-animation="FadeIn">
                                    <h5 class="font-weight-bolder">Status</h5>
                                    <div class="multisteps-form__content">
                                        <div class="row mt-3">
                                            <div class="col-12 col-md-12">
                                                <div class="form-group">
                                                    <label>
                                                        Konfirmasi
                                                    </label>
                                                    <p class="form-text text-muted text-xs ms-1">
                                                        Pastikan data yang dimasukkan telah benar.
                                                    </p>
                                                    <div class="form-check form-switch ms-1">
                                                        <input class="form-check-input" name="status" type="checkbox"
                                                            id="flexSwitchCheckDefault" onclick="notify(this)"
                                                            data-type="warning"
                                                            data-content="Status Program Telah Diubah"
                                                            data-title="Warning" data-icon="ni ni-bell-55">
                                                        <label class="form-check-label"
                                                            for="flexSwitchCheckDefault"></label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn bg-gradient-secondary mb-0 js-btn-prev" type="button"
                                                title="Prev">Prev</button>
                                            <button class="btn bg-gradient-dark ms-auto mb-0" type="submit"
                                                title="Send">Kirim</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
