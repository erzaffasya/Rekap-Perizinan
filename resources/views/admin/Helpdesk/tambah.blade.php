<x-guest-layout>
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
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    @endpush
    <div class="row col-lg-6 ">
        <form id="submitForm" action="" enctype="multipart/form-data">
            @csrf
            <div class="card mt-4 " id="password">
                <div class="card-header text-center">
                    <h5>Daftar Tamu</h5>
                    <hr>
                </div>
                <div class="card-body pt-0" id="signature-pad">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <label class="form-label">Nomor HP</label>
                    <div class="form-group">
                        <input type="number" class="form-control" id="no_hp" name="no_hp" required>
                    </div>
                    <label class="form-label">Kategori</label>
                    <div class="form-group">
                        <select class="form-control" name="kategori_helpdesk_id" id="kategori_helpdesk_id" required>
                            @foreach ($KategoriHelpdesk->where('isActive', 1) as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="form-label">Instansi</label>
                    <div class="form-group">
                        <select class="form-control" name="keterangan" id="keterangan" required>
                            <option selected disabled>--PILIH INSTANSI--</option>
                            <option>Wali Kota</option>
                            <option>Sekretaris Daerah</option>
                            <option>Tata Pemerintahan, Setda</option>
                            <option>Perekonomian, Pembangunan dan Kesejahteraan Rakyat, Setda</option>
                            <option>Administrasi Umum, Setda</option>
                            <option>Inspektur, Itkot</option>
                            <option>Dinas Pertanahan dan Penataan Ruang, DPPR</option>
                            <option>Dinas Perhubungan, Dishub</option>
                            <option>Dinas Pekerjaan Umum, DPU</option>
                            <option>Dinas Ketenagakerjaan, Disnaker</option>
                            <option>Dinas Kependudukan dan Pencatatan Sipil , Disdukcapil</option>
                            <option>Dinas Lingkungan Hidup, DLH</option>
                            <option>Badan Pengelola Pajak Daerah dan Retribusi Daerah, BPPDRD</option>
                            <option>Badan Perencanaan Pembangunan Daerah, Penelitian dan Pengembangan, Bappeda
                                Litbang</option>
                            <option>Dinas Pendidikan dan Kebudayaan, Disdikbud</option>
                            <option>Dinas Kesehatan, Dinkes</option>
                            <option>Dinas Perumahan dan permukiman, Disperkim</option>
                            <option>Dinas Koperasi, Usaha Mikro, Kecil, Menengah dan Perindustrian, DKUMKMP
                            </option>
                            <option>Dinas Pemuda, Olah raga dan Pariwisata, DPOP</option>
                            <option>Dinas Pangan, Pertanian dan Perikanan, DP3</option>
                            <option>Dinas Komunikasi dan Informatika, Diskominfo</option>
                            <option>Dinas Perpustakaan dan Arsip, Dispustakar</option>
                            <option>Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu Provinsi
                                Kalimantan Timur</option>
                            <option>Kecamatan Balikpapan Timur, Baltim</option>
                            <option>Kecamatan Balikpapan Barat, Balbar</option>
                            <option>Kecamatan Balikpapan Utara, Baltara</option>
                            <option>Kecamatan Balikpapan Selatan, Balsel</option>
                            <option>Kecamatan Balikpapan Tengah, Balteng</option>
                            <option>Kecamatan Balikpapan Kota, Balkot</option>
                            <option>Direktorat Jenderal Pajak (DJP) Kalimantan Timur dan Utara
                            </option>
                            <option>Balai Besar Pengawas Obat dan Makanan</option>
                            <option>Kepolisian Resor Kota Balikpapan</option>
                            <option>Imigrasi Kelas I TPI Balikpapan</option>
                            <option>Kementerian Agama Kota Balikpapan</option>
                            <option>BPJS Ketenagakerjaan Cabang Balikpapan</option>
                            <option>BPJS Kesehatan Cabang Balikpapan</option>
                            <option>Badan Narkotika Nasional Kota Balikpapan</option>
                            <option>Pengadilan Agama Balikpapan Kelas 1A</option>
                            <option>ATR/BPN Kota Balikpapan</option>
                            <option>Kejaksaan Negeri Balikpapan</option>
                            <option>PT TASPEN (PERSERO) Kantor Cabang Samarinda</option>
                            <option>PT Perusahaan Listrik Negara (Persero) Unit Pelaksana Pelayanan Pelanggan
                                Balikpapan</option>
                            <option>PT Pegadaian (Persero) Area Balikpapan</option>
                            <option>Badan Pendapatan Daerah Provinsi Kalimantan Timur</option>
                            <option>Perusahaan Umum Daerah Tirta Manuntung</option>
                            <option>PT Bank Pembangunan Daerah Kaltimtara Cabang Balikpapan</option>
                            <option>Kadin Kota Balikpapan</option>
                            <option>Hipmi Kota Balikpapan</option>
                            <option>APERSI</option>
                            <option>REI</option>
                            <option>Komunitas Semangat Muda Tuli (SEMUT) Kota Balikpapan</option>
                            <option>Gerakan untuk Kesejahteraan Tuna Rungu Indonesia (Gerkatin) DPC Kota
                                Balikpapan</option>
                            <option>Lainnya</option>
                        </select>
                    </div>
                    <label class="form-label">Instansi Lainnya</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="keterangan2" name="keterangan2">
                    </div>
                    <label class="form-label">Tanda Tangan</label>
                    <div class="form-group">
                        <div class="m-signature-pad">
                            <div class="m-signature-pad--body">
                                <canvas style="border: 2px dashed #ccc"></canvas>
                            </div>

                            <div class="m-signature-pad--footer">
                                <button type="button" class="btn btn-sm btn-secondary"
                                    data-action="clear">Clear</button>
                                {{-- <button type="button" class="btn btn-sm btn-primary" data-action="save">Save</button> --}}
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <button type="submit" data-action="save"
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

                $("#submitForm").submit(function(e) {
                    e.preventDefault();
                    console.log(signaturePad._isEmpty, 'signature')
                    if (signaturePad.isEmpty()) {
                        alert("Please provide a signature first.");
                    }
                    if (signaturePad._isEmpty != true) {
                        var dataUrl = signaturePad.toDataURL();
                        // var image_data = dataUrl.replace(/^data:image\/(png|jpg);base64,/, "");
                        let nama = $('#nama').val();
                        let no_hp = $('#no_hp').val();
                        let kategori_helpdesk_id = $('#kategori_helpdesk_id').val();
                        let keterangan = $('#keterangan').val();
                        let keterangan2 = $('#keterangan2').val();
                        $.ajax({
                            url: "{{ route('Helpdesk.store') }}",
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                "_token": $('#token').val(),
                                dataUrl: dataUrl,
                                nama: nama,
                                no_hp: no_hp,
                                kategori_helpdesk_id: kategori_helpdesk_id,
                                keterangan: keterangan,
                                keterangan2: keterangan2
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
                        // alert('submit');
                    }
                });
            });
        </script>
    @endpush
</x-guest-layout>
