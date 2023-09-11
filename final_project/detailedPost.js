function addComment (username, comment) {
    //create elements
    let commentDt = document.createElement('dt');
        let divPic = document.createElement('div');
            let pfp = document.createElement('img');
        let divComment = document.createElement('div');
            let divUser = document.createElement('div');
            let divContent = document.createElement('div');

    //arrange items
    document.querySelector("#comment-list").appendChild(commentDt);
        commentDt.appendChild(divPic);
            divPic.appendChild(pfp);
        commentDt.appendChild(divComment);
            divComment.appendChild(divUser);
            divComment.appendChild(divContent);
    
    //add classes
    divPic.classList.add("comment-pic");
    divComment.classList.add("comment-box");
    divUser.classList.add("comment-user");
    divContent.classList.add("comment-content");

    //innerHTML
    pfp.setAttribute("src", "img/gray-empty-cat-img.jpg");
    pfp.setAttribute("alt", "user profile picture")
    divUser.innerHTML = username;
    divContent.innerHTML = comment;


}