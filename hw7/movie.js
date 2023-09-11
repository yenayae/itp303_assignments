function createRow(track) {
    var listItem = document.createElement('li');
    var divImage = document.createElement('div');
    var imgPoster = document.createElement('img');
    var divInfo = document.createElement('div');
        var divTitle = document.createElement('div');
        var divRelease = document.createElement('div');
        var divRating = document.createElement('div');



    divTitle.innerHTML = "<strong>Title: </strong>" + track.title;
    divRelease.innerHTML = "<strong>Release Date: </strong>" + track.release_date;
    divRating.innerHTML = "<strong>Rating: </strong>" + track.vote_average;

    if (track.poster_path === null) {
        console.log("null image")
        imgPoster.src = "img/no-poster.jpg"
        imgPoster.alt = track.title + " poster not provided"
    }
    else {
    imgPoster.src = "https://image.tmdb.org/t/p/w500/" + track.poster_path;
    imgPoster.alt = track.title + " poster"
    }
    
    console.log(imgPoster.src);

    listItem.classList.add("col-12", "col-sm-12", "col-lg-6","list-group-item", "d-flex", "movie-item")
    divImage.classList.add("image-place")
    divInfo.classList.add("movie-info")
    imgPoster.classList.add("movie-poster")


document.querySelector("#movie-list").appendChild(listItem);
    listItem.appendChild(divImage);
    listItem.appendChild(divInfo);
    
    divImage.appendChild(imgPoster);

    divInfo.appendChild(divTitle);
    divInfo.appendChild(divRelease);
    divInfo.appendChild(divRating);

}



document.querySelector('#search-form').onsubmit = function(){
    const term = document.querySelector('#search-term').value.trim();
    const limit = document.querySelector('#search-limit').value.trim();



}