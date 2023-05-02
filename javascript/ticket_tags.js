async function addTagTicket(event){
  const ticketId = event.target.parentElement.parentElement.parentElement.getAttribute('data-id')
  const selectedOption = event.target.parentElement.querySelector('input')
  
  const response = await fetch('../api/add_hashtag.php?ticketId=' + ticketId + '&hashtag=' + selectedOption.value)
  const hashtags = await response.json()

  const ul = document.querySelector('#ticket #tags > ul');

  if (hashtags !== null) {

    while (ul.firstChild) {
      ul.removeChild(ul.firstChild);
    }

    hashtags.forEach((element) => {
      const newLi = document.createElement('li');
      newLi.textContent = element;
      newLi.classList.add('tag')
      ul.appendChild(newLi);
    });
  }

  selectedOption.value = ""
}

function ticket_tags() {
  const selectTags = document.querySelector('#ticket #tags > input');
  const addTags = document.querySelector('#ticket #tags > img');

  if (selectTags && addTags){

    document.body.addEventListener('click', async function (event) {
      if (event.target.tagName === 'LI') {
        const ticketId = event.target.parentElement.parentElement.parentElement.parentElement.getAttribute('data-id')
        const selectedOption = event.target.innerHTML

        const ul = document.querySelector('#ticket #tags > ul');
        
        const response = await fetch('../api/remove_hashtag.php?ticketId=' + ticketId + '&hashtag=' + selectedOption)
        const hashtags = await response.json()

        if (hashtags !== null) {
          while (ul.firstChild) {
            ul.removeChild(ul.firstChild);
          }

          hashtags.forEach((element) => {
            const newLi = document.createElement('li');
            newLi.textContent = element;
            newLi.classList.add('tag')
            ul.appendChild(newLi);
          });
        }
      }
    });

    addTags.addEventListener('click', (event) => {
      addTagTicket(event)
    })

    selectTags.addEventListener('keydown', (event) => {
      if (event.key === 'Enter'){
        addTagTicket(event)
      }
    })
  }
}

ticket_tags()