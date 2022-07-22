<x-app-layout>
    @push('css')
        {{-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> --}}

        <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
        <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
        <style>
            .kbw-signature {
                width: 250px;
                height: 250px;
            }

            #sign canvas {
                width: 100% !important;
                height: auto;
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
                        <div id="sign"></div>
                        <br /><br />
                        <button id="clear" class="btn btn-danger btn-sm">Clear</button>
                        <textarea id="signature" class="touch-enable signed" name="signed" style="display: none"></textarea>
                    </div>

                    <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Submit!</button>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
        <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
        <script type="text/javascript">
            var sign = $('#sign').signature({
                syncField: '#signature',
                syncFormat: 'PNG'
            });
            $('.touch-enable').draggable();
            $('#clear').click(function(e) {
                e.preventDefault();
                sign.signature('clear');
                $("#signature").val('');
            });
            const el = document.getElementById('signature');
            el.addEventListener('touchstart', process_touchstart, false);
            el.addEventListener('touchmove', process_touchmove, false);
            el.addEventListener('touchcancel', process_touchcancel, false);
            el.addEventListener('touchend', process_touchend, false);

            function process_touchstart(ev) {
                // Use the event's data to call out to the appropriate gesture handlers
                switch (ev.touches.length) {
                    case 1:
                        handle_one_touch(ev);
                        break;
                    case 2:
                        handle_two_touches(ev);
                        break;
                    case 3:
                        handle_three_touches(ev);
                        break;
                    default:
                        gesture_not_supported(ev);
                        break;
                }
            }
            // Create touchstart handler
            el.addEventListener('touchstart', function(ev) {
                // Iterate through the touch points that were activated
                // for this element and process each event 'target'
                for (var i = 0; i < ev.targetTouches.length; i++) {
                    process_target(ev.targetTouches[i].target);
                }
            }, false);
            // touchmove handler
            function process_touchmove(ev) {
                // Set call preventDefault()
                ev.preventDefault();
            }
        </script>
    @endpush
</x-app-layout>
