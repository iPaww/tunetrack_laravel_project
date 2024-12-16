<div class="container">
    <h4>USER INFORMATION</h4>
    <div class="acc-content">
        <div class="d-flex justify-content-center">
            {{-- TODO FIXME: This should be to user's image --}}
            <div class="img-container overflow-hidden rounded-circle" style="width: 5rem; height: 5rem;">
                <img src="{{ asset('assets/images/default/Me.jpg') }}" alt="Profile Picture" class="img-fluid" id="profileImage" >
            </div>
            <div class="my-auto ms-2">
                <input id="profile_picture" type="file" name="profile_picture" accept="image/*"
                    onchange="previewImage()">
            </div>
        </div>

        <div class="acc-detail">
            <form id="userForm" class="mx-y">
                <div class="textbox-title mb-3">
                    <label class="form-label fw-bold" for="fullname">Full Name</label>
                    <input class="form-control" id="fullname" type="text" name="fullname" placeholder="Full Name" required>
                </div>
                <div class="textbox-title mb-3">
                    <label class="form-label fw-bold" for="address">Address</label>
                    <input class="form-control" id="address" type="text" name="address" placeholder="Address" required>
                </div>
                <div class="textbox-title mb-3">
                    <label class="form-label fw-bold" for="phone_number">Phone Number</label>
                    <input class="form-control" id="phone_number" type="text" name="phone_number" placeholder="Phone Number"
                        required>
                </div>
                <div class="textbox-title mb-3">
                    <label class="form-label fw-bold" for="email">Email</label>
                    <input class="form-control" id="email" type="email" name="email" placeholder="Email" required>
                </div>
                <div class="button-container text-center">
                    <button type="button" class="btn btn-primary" onclick="saveUser()">Save</button>
                    <button type="button" class="btn btn-secondary" onclick="resetForm()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>