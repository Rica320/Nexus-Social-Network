function addEventListeners() {

    let post_edit = document.querySelectorAll('.make_post_popup');
    [].forEach.call(post_edit, function (post_edit) {
        post_edit.addEventListener('click', logItem);
    });

    let group_add = document.querySelectorAll('.create_group_button');
    [].forEach.call(group_add, function (group_add) {
        group_add.addEventListener('click', makeGroupPopup);
    });


    let create_button = document.querySelector('.make_post .form_button');
    if (create_button)
        create_button.addEventListener('click', sendCreatePostRequest);

    let create_group_button = document.querySelector('.make_group .form_button');
    if (create_group_button)
        create_group_button.addEventListener('click', sendCreateGroupRequest);

    let remove_groupMember_button = document.querySelector('.leave_group_button');
    if (remove_groupMember_button)
        remove_groupMember_button.addEventListener('click', sendDeleteGroupMemberRequest);

}

function logItem(e) {
    const item = document.querySelector('.make_post');
    console.log(item);
    item.toggleAttribute('hidden');
}

function makeGroupPopup(e) {
    const item = document.querySelector('.make_group');
    console.log(item);
    item.toggleAttribute('hidden');
}

function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
    let request = new XMLHttpRequest();

    request.open(method, url, true);
    request.withCredentials = true;
    request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', handler);
    request.send(encodeForAjax(data));
}

function sendCreatePostRequest(event) {
    let name = document.querySelector('textarea[id=text]').value;
    console.log(name);

    if (name != null)
        sendAjaxRequest('post', '/api/post/', { text: name }, PostAddedHandler);

    event.preventDefault();
}

function PostAddedHandler() {
    console.log(this.status)
    if (this.status != 201) window.location = '/'; // ver dps

    // create alert notification
    console.log("post added");
    logItem(0);
    // talvez dar redirect para a pagina do post
}




function GroupAddedHandler() {
    console.log(this.status)
    if (this.status !image.png= 201) window.location = '/'; // ver dps

    // create alert notification
    console.log("group added");

    const item = document.querySelector('.make_group');
    item.toggleAttribute('hidden');
}


function sendCreateGroupRequest() {

    let name = document.querySelector('input[id=group_name]').value;
    let description = document.querySelector('textarea[id=group_description]').value;
    let visibility = true

    if (name == null || description == null || visibility == null)
        return;

    sendAjaxRequest('post', '/api/group', { name: name, description: description, visibility: visibility }, GroupAddedHandler);

}



function sendDeleteGroupMemberRequest() {

    let id = document.querySelector('.leave_group_button').getAttribute('data-idGroup');

    let res = confirm("Are you sure you want to leave this group?");

    if (!res)
        return;

    sendAjaxRequest('delete', '/api/group_member/' + id, null, () => { });
}



// Home =============================================================================

function updateFeed(feed) {

    let pathname = window.location.pathname
    if (pathname !== '/home') return;



    if (!document.querySelector('#timeline')) {
        return;
    }

    sendAjaxRequest('get', '/api/post/feed/' + feed, {}, function () {
        let received = JSON.parse(this.responseText);

        let timeline = document.querySelector('#timeline');
        timeline.innerHTML = '';
        received.forEach(function (post) {
            timeline.appendChild(createPost(post))
        })

    })
}

function createPost(post) {
    let new_post = document.createElement('article');
    new_post.classList.add('post');
    new_post.innerHTML = `
    <div class="post_head">
      <a href='/profile/${post.owner.username}'><img src="../user.png" alt="" width="50"></a>
      <a href='/profile/${post.owner.username}'>${post.owner.username}</a>
      <a href='/messages'><span class="shareicon">&lt;</span></a>
      <a href='/post/${post.id}'>&vellip;</a>
    </div>

    <div class="post_body">
        <p>${post.text}</p>
        <img src="../post.jpg" alt="" width="400">
    </div>

    <div class="post_footer">

      <p>${post.likes_count}</p>
      <a href="#"><span class="likeicon">&#128077;</span></a>

      <p>${post.comments_count}</p>
      <a href="#"><span class="commenticon">&#128172;</span></a>

      <p>${post.post_date}</p>

    </div>
  `
    return new_post;
}

function updateFeedOnLoad() {
    let feed_filters = document.querySelector('#feed_radio_viral')


    if (feed_filters) {
        feed_filters.checked = true
    }

    updateFeed('viral')
}

updateFeedOnLoad()


// =============================================================================


addEventListeners();
