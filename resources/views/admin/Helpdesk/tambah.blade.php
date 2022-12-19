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
                    <h5>Helpdesk</h5>
                    <hr>
                </div>
                <div class="card-body pt-0" id="signature-pad">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <label class="form-label">Nomor HP</label>
                    <div class="form-group">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                    </div>
                    <label class="form-label">Kategori</label>
                    <div class="form-group">
                        <select class="form-control" name="kategori_helpdesk_id" id="kategori_helpdesk_id" required>
                            @foreach ($KategoriHelpdesk->where('isActive', 1) as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="keterangan" id="keterangan" required>
                            <option>Pj. Sekretaris Daerah</option>
                            <option>Asisten Tata Pemerintahan, Setda</option>
                            <option>Asisten Perekonomian, Pembangunan dan Kesejahteraan Rakyat, Setda</option>
                            <option>Asisten Administrasi Umum, Setda</option>
                            <option>Inspektur, Itkot</option>
                            <option>Kepala Dinas Pertanahan dan Penataan Ruang, DPPR</option>
                            <option>Kepala Dinas Perhubungan, Dishub</option>
                            <option>Kepala Dinas Pekerjaan Umum, DPU</option>
                            <option>Kepala Dinas Ketenagakerjaan, Disnaker</option>
                            <option>Kepala Dinas Kependudukan dan Pencatatan Sipil , Disdukcapil</option>
                            <option>Kepala Dinas Lingkungan Hidup, DLH</option>
                            <option>Kepala Badan Pengelola Pajak Daerah dan Retribusi Daerah, BPPDRD</option>
                            <option>Kepala Badan Perencanaan Pembangunan Daerah, Penelitian dan Pengembangan, Bappeda
                                Litbang</option>
                            <option>Kepala Dinas Pendidikan dan Kebudayaan, Disdikbud</option>
                            <option>Kepala Dinas Kesehatan, Dinkes</option>
                            <option>Kepala Dinas Perumahan dan permukiman, Disperkim</option>
                            <option>Kepala Dinas Koperasi, Usaha Mikro, Kecil, Menengah dan Perindustrian, DKUMKMP
                            </option>
                            <option>Kepala Dinas Pemuda, Olah raga dan Pariwisata, DPOP</option>
                            <option>Kepala Dinas Pangan, Pertanian dan Perikanan, DP3</option>
                            <option>Kepala Dinas Komunikasi dan Informatika, Diskominfo</option>
                            <option>Kepala Dinas Perpustakaan dan Arsip, Dispustakar</option>
                            <option>Camat Balikpapan Timur, Baltim</option>
                            <option>Camat Balikpapan Barat, Balbar</option>
                            <option>Camat Balikpapan Utara, Baltara</option>
                            <option>Camat Balikpapan Selatan, Balsel</option>
                            <option>Camat Balikpapan Tengah, Balteng</option>
                            <option>Camat Balikpapan Kota, Balkot</option>
                            <option>Kepala Kantor Wilayah Direktorat Jenderal Pajak (DJP) Kalimantan Timur dan Utara
                            </option>
                            <option>Kepala Balai Besar Pengawas Obat dan Makanan</option>
                            <option>Kepala Kepolisian Resor Kota Balikpapan</option>
                            <option>Kepala Kantor Imigrasi Kelas I TPI Balikpapan</option>
                            <option>Kepala Kantor Kementerian Agama Kota Balikpapan</option>
                            <option>Kepala BPJS Ketenagakerjaan Cabang Balikpapan</option>
                            <option>Kepala BPJS Kesehatan Cabang Balikpapan</option>
                            <option>Kepala Badan Narkotika Nasional Kota Balikpapan</option>
                            <option>Ketua Pengadilan Agama Balikpapan Kelas 1A</option>
                            <option>Kepala Kantor ATR/BPN Kota Balikpapan</option>
                            <option>Kepala Kejaksaan Negeri Balikpapan</option>
                            <option>Branch Manager PT TASPEN (PERSERO) Kantor Cabang Samarinda</option>
                            <option>Manager PT Perusahaan Listrik Negara (Persero) Unit Pelaksana Pelayanan Pelanggan
                                Balikpapan</option>
                            <option>Vice President PT Pegadaian (Persero) Area Balikpapan</option>
                            <option>Kepala Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu Provinsi
                                Kalimantan Timur</option>
                            <option>Kepala Badan Pendapatan Daerah Provinsi Kalimantan Timur</option>
                            <option>Direktur Utama Perusahaan Umum Daerah Tirta Manuntung</option>
                            <option>Pimpinan PT Bank Pembangunan Daerah Kaltimtara Cabang Balikpapan</option>
                            <option>Ketua Kadin Kota Balikpapan</option>
                            <option>Ketua Hipmi Kota Balikpapan</option>
                            <option>Ketua APERSI</option>
                            <option>Ketua REI</option>
                            <option>Ketua Komunitas Semangat Muda Tuli (SEMUT) Kota Balikpapan</option>
                            <option>Ketua Gerakan untuk Kesejahteraan Tuna Rungu Indonesia (Gerkatin) DPC Kota
                                Balikpapan</option>
                            <option>Lainnya</option>
                        </select>
                    </div>
                    {{-- <label class="form-label">Asal</label>
                    <div class="form-group">
                        <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
                    </div> --}}
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
                        // alert('submit');
                    }
                });
            });
        </script>
    @endpush
</x-guest-layout>
