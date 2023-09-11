function createPost() {
//create elements
    let postDiv = document.createElement('div');
        let infoDiv = document.createElement('div');
            let userDiv = document.createElement('div');
                let pfpDiv = document.createElement('div');
                    let pfpImg = document.createElement('img');
                let usernameDiv = document.createElement('div');
        let postImg = document.createElement('img');
        let postContentDiv = document.createElement('div');
            let reactionsDiv = document.createElement('div');
                let heartEmpty = document.createElement('img');
                let heartFilled = document.createElement('img');
                let comment = document.createElement('img');
        let textContentDiv = document.createElement('div');
            let numLikes = document.createElement('p');
            let description = document.createElement('p');
            let deleteDiv = document.createElement('div');
                let deleteButton = document.createElement('button');

//arrange order
    document.querySelector("#p-stream").appendChild(postDiv);
        postDiv.appendChild(infoDiv);
            infoDiv.appendChild(userDiv);
                userDiv.appendChild(pfpDiv);
                    pfpDiv.appendChild(pfpImg);
                userDiv.appendChild(usernameDiv);
        postDiv.appendChild(postImg);
        postDiv.appendChild(postContentDiv);
            postContentDiv.appendChild(reactionsDiv)
                reactionsDiv.appendChild(heartEmpty);
                reactionsDiv.appendChild(heartFilled);
                reactionsDiv.appendChild(comment);
        postDiv.appendChild(textContentDiv);
            textContentDiv.appendChild(numLikes);
            textContentDiv.appendChild(description);
            textContentDiv.appendChild(deleteDiv);
                deleteDiv.appendChild(deleteButton);

//add classes
    postDiv.classList.add("post");
    infoDiv.classList.add("info");
    userDiv.classList.add("user");
    pfpDiv.classList.add("profile-pic");
    usernameDiv.classList.add("username");
    postImg.classList.add("post-image");
    postContentDiv.classList.add("post-content");
    reactionsDiv.classList.add("reactions");
    heartEmpty.classList.add("post-icon");
    heartFilled.classList.add("post-icon");
    heartFilled.classList.add("hidden");
    comment.classList.add("post-icon", "comment-png");
    textContentDiv.classList.add("text-content");
    numLikes.classList.add("likes");
    description.classList.add("description");
    deleteDiv.classList.add("delete");
    deleteButton.classList.add("delete-button");


//innerHMTL
    pfpImg.setAttribute("src", "img/gray-empty-cat-img.jpg");
    pfpImg.setAttribute("alt", "profile picture");
    usernameDiv.innerHTML = "Anonymous";
    postImg.setAttribute("src", "img/concept-art/c6/186_Sky.jpeg");
    postImg.setAttribute("alt", "post image");
    heartEmpty.setAttribute("src", "img/icon-png/like.png");
    heartEmpty.setAttribute("alt", "like button empty");
    heartFilled.setAttribute("src", "img/icon-png/like-filled.png");
    heartFilled.setAttribute("alt", "like button filled");
    comment.setAttribute("src", "img/icon-png/comment.png" );
    comment.setAttribute("alt", "comment button");
    numLikes.innerHTML = "NUM like(s)";
    description.innerHTML = "POST CAPTION";
    deleteButton.innerHTML = "delete";


}

function toggleLike(id) {
    document.querySelector("#h").classList.toggle("hidden");
    document.querySelector(".hf").classList.toggle("hidden");

}

