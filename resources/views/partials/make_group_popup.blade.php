@if (Auth::check())
    <div class="post_body make_group pop_up" hidden="">
        <form>
            <label>
                <div class="form-group">
                    <label for="text">Tell us your thought</label>
                    <textarea class="form-control" id="text" rows="3"></textarea>
                </div>
            </label>
            <button class="form_button" type="submit">
                Make Group
            </button>
        </form>
    </div>

    <!-- TODO add images  -->
@endif
