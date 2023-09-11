//delete all button
document.querySelector("#delete-all").onclick = () => {
    document.querySelector("#cat-list").innerHTML = ''
}

//cat delete button
function catListRemove () {
    const buttons = document.querySelectorAll(".cat-delete")

    for (btn of buttons) {
        btn.onclick = function () {
            this.parentElement.parentElement.remove()
        }
    }

}

catListRemove();

//form validator
document.querySelector("#cat-form").onsubmit = function () {

    //VALIDATION START
    let validForm = true;

    //cat name validation
    const catName = document.querySelector("#cat-name").value.trim();
    // console.log(catName);
    if (/^$/.test(catName)) {
        validForm = false;
        document.querySelector("#cat-name-error").innerHTML = "Cat Name cannot be empty."

    }

    else if (!(/^[A-Z]{1}[a-z]{1,}$/.test(catName))) {
        validForm = false;
        document.querySelector("#cat-name-error").innerHTML = "Invalid Cat Name."
        document.querySelector("#cat-name").value = "";
    }

    else {
        document.querySelector("#cat-name-error").innerHTML = ""
    }



    //gender validation
    const gender = document.querySelector("#gender")

    if (gender.disabled === false && gender.value == -1) {
        validForm = false;
        document.querySelector("#gender-error").innerHTML = "Gender cannot be empty. "
    }

    else {
        document.querySelector("#gender-error").innerHTML = ""
    }
    
    
    //age validation
    const age = document.querySelector("#age")

    if (age.disabled === false && age.value == -1) {
        validForm = false;
        document.querySelector("#age-error").innerHTML = "Age cannot be empty. "
    }

    else {
        document.querySelector("#age-error").innerHTML = ""
    }
    
    //spay/neuter validation
    const spay = document.querySelector("#spay")

    if (spay.disabled === false && spay.value == -1) {
        validForm = false;
        document.querySelector("#spay-error").innerHTML = "Spayed / Neutered cannot be empty. "
    }

    else {
        document.querySelector("#spay-error").innerHTML = ""
    }

    //breed validation
    const breed = document.querySelector("#breed").value.trim();
    // console.log(breed);
    if (/^$/.test(breed)) {
        validForm = false;
        document.querySelector("#breed-error").innerHTML = "Breed cannot be empty."

    }

    else if (/!|@|#|\$|%|\^|&|\*/.test(breed)) {
        validForm = false;
        document.querySelector("#breed-error").innerHTML = "Please provide a valid description."
        document.querySelector("#breed").value = "";
    }

    else {
        document.querySelector("#breed-error").innerHTML = ""
    }

    
    //color validation

    const color = document.querySelector("#color").value.trim();
    // console.log(color);
    if (/^$/.test(color)) {
        validForm = false;
        document.querySelector("#color-error").innerHTML = "Color cannot be empty."

    }

    else if (/!|@|#|\$|%|\^|&|\*/.test(color)) {
        validForm = false;
        document.querySelector("#color-error").innerHTML = "Please provide a valid description."
        document.querySelector("#color").value = "";
    }

    else {
        document.querySelector("#color-error").innerHTML = ""
    }


    //img validation
    const pic = document.querySelector("#pic").value.trim();
    if (!/^$/.test(pic) && !/(http)?s?:?(\/\/[^"']*\.(?:png|jpg|jpeg|gif|png|svg))/.test(pic)) {
        validForm = false;
        document.querySelector("#pic-error").innerHTML = "Please provide a valid URL."
        document.querySelector("#pic").value = ""
    }

    else {
        document.querySelector("#pic-error").innerHTML = ""
    }
    //VALIDATION END

    
    //SUBMISSION START
        //variables: catName, gender, age, spay, breed, color, pic
        const okWithCats = document.querySelector("#cats")
        const okWithDogs = document.querySelector("#dogs")
        const okWithKids = document.querySelector("#kids")
        if (validForm) {
            //variables
            const li = document.createElement("li")
                const divImage = document.createElement("div")
                    const img = document.createElement("img")
                const divInfo = document.createElement("div")
                    const divName = document.createElement("div")
                    const divGender = document.createElement("div")
                    const divAge = document.createElement("div")
                    const divSpay = document.createElement("div")
                    const divBreed = document.createElement("div")
                    const divColor = document.createElement("div")
                    const divOK = document.createElement("div")
                    const deleteButton = document.createElement("button")

            //appending
            li.appendChild(divImage)
                divImage.appendChild(img)
            li.appendChild(divInfo)
                divInfo.appendChild(divName)
                divInfo.appendChild(divGender)
                divInfo.appendChild(divAge)
                divInfo.appendChild(divSpay)
                divInfo.appendChild(divBreed)
                divInfo.appendChild(divColor)
                divInfo.appendChild(divOK)
                divInfo.appendChild(deleteButton)
            document.querySelector("#cat-list").appendChild(li)

            //filling in inputs
            if (pic.length === 0) {
                img.src = "img/gray-empty-cat-img.jpg"
            }
            else {
            img.src = pic;
            }
            img.alt = catName;
            console.log(img.alt)

            divName.innerHTML = "<strong>Cat Name: </strong>" + catName
            divGender.innerHTML = "<strong>Gender: </strong>" + gender.value
            divAge.innerHTML = "<strong>Age: </strong>" + age.value
            divSpay.innerHTML = "<strong>Spayed/Neutered: </strong>" + spay.value
            divBreed.innerHTML = "<strong>Breed/Pattern: </strong>" + breed
            divColor.innerHTML = "<strong>Color Description: </strong>" + color
            divOK.innerHTML += "<strong>OK with: </strong>"
            deleteButton.innerHTML = "Delete"

            if (okWithCats.checked === false && okWithDogs.checked === false && okWithKids.checked === false) {
                divOK.innerHTML += "None"
            }
            if (okWithCats.checked) {
            divOK.innerHTML += "Cats " 
            }

            if (okWithDogs.checked) {
                divOK.innerHTML += "Dogs " 
            }

            if (okWithKids.checked) {
            divOK.innerHTML += "Kids " 
            }


            //add classes
            li.classList.add("list-group-item", "d-flex")
            divImage.classList.add("image-place")
            
            divInfo.classList.add("cat-info")
            deleteButton.classList.add("cat-delete", "btn", "btn-outline-secondary", "mb-3")

            
            catListRemove();




        }



    return false;

}


