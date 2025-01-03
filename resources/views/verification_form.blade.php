<style>
.verification-code {
    margin-left: auto;
    margin-right: auto;
    max-width: 75%;
    display: flex;
    justify-content: space-between;
}

.verification-code input {
    font-size: 2.5em;
    max-width: 1em;
    border-top: none;
    border-left: none;
    border-right: none;
}

@media (min-width: 768px) {
    .verification-code input {
        font-size: 5em;
    }
}
</style>

<div class="position-relative" style="min-height: 75vh">
    <div class="position-absolute top-50 start-50 translate-middle w-100">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center">Account Verification</h2>
                <p class="text-center">We have sent you a code to verify your account, please check your email for verification code.</p>
                <form action="/verification" method="POST">
                    @csrf <!-- {{ csrf_field() }} -->
                    <input type="text" name="user_verification_id" hidden>
                    <div class="verification-code">
                        <input type="text" class="text-center text-uppercase" name="verification_code[]" maxlength="1" required>
                        <input type="text" class="text-center text-uppercase" name="verification_code[]" maxlength="1" required>
                        <input type="text" class="text-center text-uppercase" name="verification_code[]" maxlength="1" required>
                        <input type="text" class="text-center text-uppercase" name="verification_code[]" maxlength="1" required>
                        <input type="text" class="text-center text-uppercase" name="verification_code[]" maxlength="1" required>
                        <input type="text" class="text-center text-uppercase" name="verification_code[]" maxlength="1" required>
                    </div>
                    <button type="submit" class="btn btn-lg btn-tunetrack mt-4 w-100">Verify</button>
                </form>
                @if ($errors->any())
                <ul class="list-group my-2">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
                <p class="text-center pt-3">Did not recieve verification code? <a href="/verification/re-send">click here</a> to send new one.</p>
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