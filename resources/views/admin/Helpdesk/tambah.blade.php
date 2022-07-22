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
                    <h5>Helpdesk</h5>
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


            // function startup() {
                const el = document.querySelector('canvas');
                el.addEventListener('touchstart', handleStart);
                el.addEventListener('touchend', handleEnd);
                el.addEventListener('touchcancel', handleCancel);
                el.addEventListener('touchmove', handleMove);
                log('Initialized.');
            // }

            // document.addEventListener("DOMContentLoaded", startup);

            const ongoingTouches = [];

            function handleStart(evt) {
                evt.preventDefault();
                log('touchstart.');
                const el = document.getElementById('canvas');
                const ctx = el.getContext('2d');
                const touches = evt.changedTouches;

                for (let i = 0; i < touches.length; i++) {
                    log(`touchstart: ${i}.`);
                    ongoingTouches.push(copyTouch(touches[i]));
                    const color = colorForTouch(touches[i]);
                    log(`color of touch with id ${touches[i].identifier} = ${color}`);
                    ctx.beginPath();
                    ctx.arc(touches[i].pageX, touches[i].pageY, 4, 0, 2 * Math.PI, false); // a circle at the start
                    ctx.fillStyle = color;
                    ctx.fill();
                }
            }

            function handleMove(evt) {
                evt.preventDefault();
                const el = document.getElementById('canvas');
                const ctx = el.getContext('2d');
                const touches = evt.changedTouches;

                for (let i = 0; i < touches.length; i++) {
                    const color = colorForTouch(touches[i]);
                    const idx = ongoingTouchIndexById(touches[i].identifier);

                    if (idx >= 0) {
                        log(`continuing touch ${idx}`);
                        ctx.beginPath();
                        log(`ctx.moveTo( ${ongoingTouches[idx].pageX}, ${ongoingTouches[idx].pageY} );`);
                        ctx.moveTo(ongoingTouches[idx].pageX, ongoingTouches[idx].pageY);
                        log(`ctx.lineTo( ${touches[i].pageX}, ${touches[i].pageY} );`);
                        ctx.lineTo(touches[i].pageX, touches[i].pageY);
                        ctx.lineWidth = 4;
                        ctx.strokeStyle = color;
                        ctx.stroke();

                        ongoingTouches.splice(idx, 1, copyTouch(touches[i])); // swap in the new touch record
                    } else {
                        log('can\'t figure out which touch to continue');
                    }
                }
            }

            function handleEnd(evt) {
                evt.preventDefault();
                log("touchend");
                const el = document.getElementById('canvas');
                const ctx = el.getContext('2d');
                const touches = evt.changedTouches;

                for (let i = 0; i < touches.length; i++) {
                    const color = colorForTouch(touches[i]);
                    let idx = ongoingTouchIndexById(touches[i].identifier);

                    if (idx >= 0) {
                        ctx.lineWidth = 4;
                        ctx.fillStyle = color;
                        ctx.beginPath();
                        ctx.moveTo(ongoingTouches[idx].pageX, ongoingTouches[idx].pageY);
                        ctx.lineTo(touches[i].pageX, touches[i].pageY);
                        ctx.fillRect(touches[i].pageX - 4, touches[i].pageY - 4, 8, 8); // and a square at the end
                        ongoingTouches.splice(idx, 1); // remove it; we're done
                    } else {
                        log('can\'t figure out which touch to end');
                    }
                }
            }

            function handleCancel(evt) {
                evt.preventDefault();
                log('touchcancel.');
                const touches = evt.changedTouches;

                for (let i = 0; i < touches.length; i++) {
                    let idx = ongoingTouchIndexById(touches[i].identifier);
                    ongoingTouches.splice(idx, 1); // remove it; we're done
                }
            }

            function colorForTouch(touch) {
                let r = touch.identifier % 16;
                let g = Math.floor(touch.identifier / 3) % 16;
                let b = Math.floor(touch.identifier / 7) % 16;
                r = r.toString(16); // make it a hex digit
                g = g.toString(16); // make it a hex digit
                b = b.toString(16); // make it a hex digit
                const color = "#" + r + g + b;
                return color;
            }

            function copyTouch({
                identifier,
                pageX,
                pageY
            }) {
                return {
                    identifier,
                    pageX,
                    pageY
                };
            }

            function ongoingTouchIndexById(idToFind) {
                for (let i = 0; i < ongoingTouches.length; i++) {
                    const id = ongoingTouches[i].identifier;

                    if (id == idToFind) {
                        return i;
                    }
                }
                return -1; // not found
            }

            function log(msg) {
                const container = document.getElementById('log');
                container.textContent = `${msg} \n${container.textContent}`;
            }
        </script>
    @endpush
</x-app-layout>
