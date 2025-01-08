<div class="position-relative" style="min-height: 75vh">
    <div class="position-absolute top-50 start-50 translate-middle w-100">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center">Password Reset</h2>
                <p class="fs-4">You can now enter your new password.</p>
                <form action="/password-reset" method="POST">
                    @csrf <!-- {{ csrf_field() }} -->
                    <input type="hidden" name="user" value="{{ $user->id }}" />
                    <input type="hidden" name="verification_code" value="{{ $decrypted_authentication }}" />
                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" value="{{ old('password') }}" required>
                    <input class="form-control @error('confirm_password') is-invalid @enderror mt-1" type="password" name="confirm_password" placeholder="Confirm Password" required>
                    <button type="submit" class="btn btn-lg btn-tunetrack mt-4 w-100">submit</button>
                </form>
                @if ($errors->any())
                <ul class="list-group my-2">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
                @if (session()->get('data'))
                <ul class="list-group my-2">
                    @foreach (session()->get('data') as $data)
                        <li class="list-group-item list-group-item-success">{{ $data }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready( function() {
    $('.verification-code input').on('keyup', async ( e ) => {
        const input = e.target
        const input_jQ = $(input)
        if ( e.code == 'KeyV' && e.ctrlKey ) {
            const text = await navigator.clipboard.readText()
            const inputs = $('.verification-code input')
            Array(...text).forEach((char, index) => $(inputs[index]).val( char ).trigger('keyup') )
        } else if( ['Backspace', 'ArrowLeft'].includes(e.code) ) {
            const last_input = input_jQ.prev()
            if( !last_input )
                return
            last_input.focus()
        } else if( ['ArrowRight'].includes(e.code) || !!input_jQ.val() ) {
            const last_input = input_jQ.next()
            if( !last_input )
                return
            last_input.focus()
        }
    })
});
</script>