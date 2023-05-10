function activateButton() {
    const updateButton = document.querySelector('.userprofile button');
    const form = document.querySelector('.userprofile form');

    if(updateButton != null && form != null) {
        updateButton.addEventListener('click', (event) => {
            event.preventDefault();

            const formData = new FormData(form);

            fetch('../database/update_user_info.php', {
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
}

activateButton()