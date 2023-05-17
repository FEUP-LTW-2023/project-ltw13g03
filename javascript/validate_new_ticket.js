function validateNewTicket(event) {
    const titleInput = document.querySelector('input[name="ticket_title"]');
    const descriptionInput = document.querySelector('textarea[name="ticket_description"]');
    const titleError = document.querySelector('input[name="ticket_title"] + .error');
    const descriptionError = document.querySelector('textarea[name="ticket_description"] + .error');

    let isValid = true;

    if (titleInput.value.trim() === '') {
        titleError.textContent = 'Please enter a title.';
        isValid = false;
    }  else if (titleInput.value.trim().length < 10) {
        titleError.textContent = 'The title must be atleast 10 characters long.';
        isValid = false;
    }
    if(descriptionInput == null) {

    } else if (descriptionInput.value.trim() === '') {
        descriptionError.textContent = 'Please enter a description.';
        isValid = false;
    }  else if (descriptionInput.value.trim().length < 10) {
        descriptionError.textContent = 'The description must be atleast 10 characters long.';
        isValid = false;
    }

    if (!isValid) {
        event.preventDefault();
    }
}

const newTicketForm = document.querySelector('section.create_ticket form');
if(newTicketForm != null) {
    newTicketForm.addEventListener('submit', validateNewTicket);
}
