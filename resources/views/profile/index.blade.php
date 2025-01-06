<div class="container">
    <h4>USER INFORMATION</h4>
    <div class="acc-content">
        <div class="d-flex justify-content-center">
            <div class="img-container overflow-hidden rounded-circle" style="width: 5rem; height: 5rem;">
                <img src="{{ asset('assets/images/users/' . session('id') . '/' . $profile->image) }}"
                    alt="Profile Picture" class="img-fluid" id="profileImage">
            </div>
            <div class="my-auto ms-2">
                <input id="profile_picture" type="file" name="profile_picture" accept="image/*">
            </div>
        </div>

        <div class="acc-detail">
            <form id="userForm" class="mx-y" enctype="multipart/form-data">
                @csrf
                <div class="textbox-title mb-3">
                    <label class="form-label fw-bold" for="fullname">Full Name</label>
                    <input class="form-control" id="fullname" type="text" name="fullname" placeholder="Full Name"
                        value="{{ $profile->fullname }}" required>
                </div>
                <div class="textbox-title mb-3">
                    <label class="form-label fw-bold" for="address">Address</label>
                    <input class="form-control" id="address" type="text" name="address" placeholder="Address"
                        value="{{ $profile->address }}" required>
                </div>
                <div class="textbox-title mb-3">
                    <label class="form-label fw-bold" for="phone_number">Phone Number</label>
                    <input class="form-control" id="phone_number" type="text" name="phone_number"
                        placeholder="Phone Number" value="{{ $profile->phone_number }}" required>
                </div>
                <div class="textbox-title mb-3">
                    <label class="form-label fw-bold" for="email">Email</label>
                    <input class="form-control" type="email" placeholder="Email" value="{{ $profile->email }}"
                        disabled>
                </div>
                <div class="button-container text-end">
                    <button type="button" class="btn btn-primary" onclick="saveUser()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function saveUser() {
        const formData = new FormData(document.getElementById('userForm'));
        const profilePicture = document.getElementById('profile_picture').files[0];
        if (profilePicture) {
            formData.append('profile_picture', profilePicture);
        }

        fetch('{{ url('profile/update') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);

                // Update the profile picture dynamically
                if (data.profile.image) {
                    document.getElementById('profileImage').src =
                        {{ asset('assets/images/users/' . session('id')) }} / +data.profile.image;
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
