@if (Auth::check())
    <div class="pop_up" hidden id="popup_show_profile_edit">
        <form style="width:100%;" method='post' action={{ route('editProfile', $user->username) }} enctype="multipart/form-data">

            <!-- Start popup body -->
            {{csrf_field()}}
            <div class="d-flex justify-content-between align-items-top">
                <h3 class="h3 mb-3 font-weight-normal">Edit Profile</h3>
                <a href="#" class="btn btn-danger close_popup_btn"><strong>X</strong></a>
            </div>

            <label for="user_name" class="">Username</label>
            <input type="text" id="user_name" value="{{ $user->username }}" data-name="{{ $user->username }}"
                data-id="{{ $user->id }}" class="form-control mb-3" placeholder="Username">

            <label for="user_email" class=" mt-2">Email address</label>
            <input type="email" id="user_email" class="form-control mb-3" value="{{ $user->email }}"
                placeholder="Email" required>

            <label for="user_bdate" class=" mt-2">Birthdate</label>
            <input type="date" id="user_bdate" class="form-control mb-3" value="{{ $user->birthdate }}" required>

            <label for="user_bio" class="">Bio</label>
            <textarea rows="8" id="user_bio" class="form-control mb-3" placeholder="Bio" style="resize: none;">{{ $user->bio }}</textarea>

            <label for="profile_edit_tags" class="">Topics of Interest</label>
            <input type="text" id="profile_edit_tags" class="form-control mb-3" placeholder="Space separeted tags"
                name="tags">

            <label for="profile_pic" class="">Profile Picture</label>
            <input type="file" class="form-control" id="profile_pic" name="photo" />

            <label for="profile_visibility" class=" me-3">Profile Public Visibility</label>
            <input class="form-check-input" id="profile_visibility" type="checkbox" role="switch"
                id="flexSwitchCheckChecked" @if ($user->visibility) checked @endif>

            <!-- TODO: EDIT ALSO USER INTERESTS -->
            <!-- TODO: Falta se quer mudar de passe(cuidado com a hash)-->

            <button class="btn btn-lg btn-primary mt-4 w-100" id="edit_profile_button" type="submit">Save
                Changes</button>

            <button class="btn btn-lg btn-outline-danger mt-4 w-100" id="delete_profile_button" type="submit">Delete
                Account</button>
            <!-- End popup body -->

        </form>
    </div>
@endif
