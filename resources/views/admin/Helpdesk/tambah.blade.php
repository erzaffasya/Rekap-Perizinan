<x-app-layout>
    @push('css')
        <style>
            .wrapper {
                position: relative;
                width: 400px;
                height: 200px;
                -moz-user-select: none;
                -webkit-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            .signature-pad {
                position: absolute;
                left: 0;
                top: 0;
                width: 400px !important;
                height: 200px;
            }
        </style>
    @endpush
    <div class="row col-lg-6">
        {{-- <form action="{{ route('Helpdesk.store') }}" method="post" enctype="multipart/form-data"> --}}
        @csrf
        <div class="card mt-4" id="password">
            <div class="card-header">
                <h5>Helpdesk</h5>
                <hr>
            </div>
            <div class="card-body pt-0" id="signature-pad">
                <label class="form-label">Nama Lengkap</label>
                <div class="form-group">
                    <input type="text" class="form-control" id="nama" name="nama">
                </div>
                <label class="form-label">Nomor HP</label>
                <div class="form-group">
                    <input type="text" class="form-control" id="no_hp" name="no_hp">
                </div>
                <label class="form-label">Kategori</label>
                <div class="form-group">
                    <select class="form-control" name="kategori_helpdesk_id" id="kategori_helpdesk_id">
                        @foreach ($KategoriHelpdesk as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="form-label">Katerangan</label>
                <div class="form-group">
                    <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                </div>
                <label class="form-label">Tanda Tangan</label>
                <div class="form-group">
                    <div class="m-signature-pad">
                        <div class="m-signature-pad--body">
                            <canvas style="border: 2px dashed #ccc"></canvas>
                        </div>

                        <div class="m-signature-pad--footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-action="clear">Clear</button>
                            {{-- <button type="button" class="btn btn-sm btn-primary" data-action="save">Save</button> --}}
                        </div>
                    </div>
                </div>

                <button type="button" data-action="save"
                    class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Submit!</button>
            </div>
        </div>
        {{-- </form> --}}
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
        <script>
            $(function() {

                var wrapper = document.getElementById("signature-pad"),
                    clearButton = wrapper.querySelector("[data-action=clear]"),
                    saveButton = wrapper.querySelector("[data-action=save]"),
                    canvas = wrapper.querySelector("canvas"),
                    signaturePad;

                signaturePad = new SignaturePad(canvas, {
                    backgroundColor: "rgb(255,255,255)",
                });
                // canvas.select = function(){
                //     window.scrollTo(0, 0);
                //     document.body.scrollTop = 0;
                // };
                canvas.focus({
                    preventScroll: true
                });
                clearButton.addEventListener("click", function(event) {
                    signaturePad.clear();
                });

                saveButton.addEventListener("click", function() {
                    // event.preventDefault();

                    if (signaturePad.isEmpty()) {
                        alert("Please provide a signature first.");
                    } else {
                        var dataUrl = signaturePad.toDataURL();
                        // var image_data = dataUrl.replace(/^data:image\/(png|jpg);base64,/, "");
                        let nama = $('#nama').val();
                        let no_hp = $('#no_hp').val();
                        let kategori_helpdesk_id = $('#kategori_helpdesk_id').val();
                        let keterangan = $('#keterangan').val();
                        $.ajax({
                            url: "{{ route('Helpdesk.store') }}",
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                dataUrl: dataUrl,
                                nama: nama,
                                no_hp: no_hp,
                                kategori_helpdesk_id: kategori_helpdesk_id,
                                keterangan: keterangan
                            },
                            success: function(res) {
                                swal({
                                    title: "Berhasil!",
                                    text: "Data Telah Ditambahkan!",
                                    type: "success",
                                    icon: 'success',
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }).done(function() {
                            //
                        });
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
