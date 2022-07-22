<x-app-layout>
    @push('css')
        {{-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> --}}

        <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
        <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
        <style>
            .kbw-signature {
                width: 100%;
                height: 200px;
            }
        </style>
    @endpush
    <div class="row col-lg-6">
        <form action="{{ route('Helpdesk.store') }}" method="post">
            @csrf
            <div class="card mt-4" id="password">
                <div class="card-header">
                    <h5>Cek Laporan Harian Mahasiswa</h5>
                    <hr>
                </div>
                <div class="card-body pt-0">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama">
                    </div>
                    <label class="form-label">Nomor HP</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="no_hp">
                    </div>
                    <label class="form-label">Kategori</label>
                    <div class="form-group">
                        <select class="form-control" name="kategori_helpdesk_id" id="choices-gender">
                            @foreach ($KategoriHelpdesk as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="form-label">Katerangan</label>
                    <div class="form-group">
                        <textarea class="form-control" name="keterangan"></textarea>
                    </div>
                    <label class="form-label">Tanda Tangan</label>
                    <div class="form-group">
                        <br />
                        <div id="sig"></div>
                        <br /><br />
                        <button id="clear" class="btn btn-danger btn-sm">Clear</button>
                        <textarea id="signature" name="signed" style="display: none"></textarea>
                    </div>
                    <h5 class="mt-5">Pastikan data sudah benar</h5>
                    <p class="text-muted mb-2">
                        Sarat pencarian ada dibawah ini:
                    </p>
                    <ul class="text-muted ps-4 mb-0 float-start">
                        <li>
                            <span class="text-sm">Input Nama Mahasiswa</span>
                        </li>
                        <li>
                            <span class="text-sm">Input Divisi Mahasiswa</span>
                        </li>
                    </ul>
                    <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Submit!</button>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
        <script type="text/javascript">
            var sig = $('#sig').signature({
                syncField: '#signature',
                syncFormat: 'PNG'
            });
            $('#clear').click(function(e) {
                e.preventDefault();
                sig.signature('clear');
                $("#signature64").val('');
            });
        </script>
    @endpush
</x-app-layout>
