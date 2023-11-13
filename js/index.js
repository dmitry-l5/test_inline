function find_request(e, form){
    e.preventDefault();
    let form_data = new FormData(form);
    if(form_data.get('find').length < 3){
        alert("Введите не менее трёх символов");
        return;
    }
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '/find.php');
    xhr.send(form_data);
    xhr.onload = function(){
        if (xhr.status != 200) { 
            alert(`Ошибка ${xhr.status}: ${xhr.statusText}`); 
          } else {
            console.log(JSON.parse(xhr.response));
            window.posts = JSON.parse(xhr.response);
            form.dispatchEvent(new CustomEvent('post_updated', {
                bubbles: true
              } ));
           }
    };
}

function redraw_dashboard(board){
    let child_arr = Array.from(board.childNodes);
    child_arr.forEach( function(item){item.remove();});
    window.posts.forEach((item, index, arr)=>{
        let post = document.createElement('div');
        post.className = 'post';
        // post.innerHTML = item.title;
        post.innerHTML = "<div class='title'>"
        +item.post.title
        +"</div><div class='text'>"
        +item.post.body
        +"</div><div style='color:blue;padding-top:5px;'>Comments : </div>";
        let comments = document.createElement('div');
        comments.className = 'comments_holder';
        let test_comments = ['qwerty', 'asdfgh', 'zxcvbn'];
        item.comments.forEach(function(item){
            comments.innerHTML += "<div class=''>"
            +item.body
            +"</div>"
        });
        post.append(comments);
        board.append(post);
    });

};
