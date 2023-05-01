const selectTags = document.querySelector('section#ticket aside #tags > select');

if (selectTags){

  document.body.addEventListener('click', async function (event) {
    if (event.target.tagName === 'LI') {
      const ticketId = event.target.parentElement.parentElement.parentElement.parentElement.getAttribute('data-id')
      const selectedOption = event.target.innerHTML

      const ul = document.querySelector('section#ticket aside #tags > ul');
      
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

  selectTags.addEventListener('change', async (event) => {
    const ticketId = event.target.parentElement.parentElement.parentElement.getAttribute('data-id')
    const selectedOption = event.target.value
    select.value = "unspecified"
        
    const response = await fetch('../api/add_hashtag.php?ticketId=' + ticketId + '&hashtag=' + selectedOption)
    const hashtags = await response.json()

    if (hashtags !== null) {
      const ul = document.querySelector('section#ticket aside #tags > ul');

      while (ul.firstChild) {
        ul.removeChild(ul.firstChild);
      }

      hashtags.forEach((element) => {
        const newLi = document.createElement('li');
        newLi.textContent = element.name;
        ul.appendChild(newLi);
      });
    }
  });
}
