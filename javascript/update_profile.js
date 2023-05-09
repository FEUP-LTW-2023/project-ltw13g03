const inpFile = document.getElementById("profile-input")
const profPicPreview = document.querySelector("div#photo > img")

inpFile.addEventListener("change", function() {
    const file = this.files[0]
    if (file) {
        const reader = new FileReader()
        reader.addEventListener("load", function() {
            profPicPreview.setAttribute("src", this.result)
        });

        reader.readAsDataURL(file)
    }
})


function activateButton() {
    const updateButton = document.querySelector('.userprofile button');
    const form = document.querySelector('.userprofile form');

    if(updateButton == null) {
        console.log('hi');
    }
    if(form == null) {
        console.log('hello');
    }

    updateButton.addEventListener('click', (event) => {
        event.preventDefault();

        const formData = new FormData(form);

        fetch('../actions/update_user_info.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => console.error(error));
    });
}

//activateButton()