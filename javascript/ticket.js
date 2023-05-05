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

async function ticket_remove_tag(event) {
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
}

function ticket_tags() {
  const selectTags = document.querySelector('#ticket #tags > input');
  const addTags = document.querySelector('#ticket #tags > img');

  if (selectTags && addTags){

    document.body.addEventListener('click', ticket_remove_tag);

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

function ticket_department() {
  const selectDepartment = document.querySelector('#ticket #department > select')

  if (selectDepartment) {
    selectDepartment.addEventListener('change', async function (event) {
      const ticketId = event.target.parentElement.parentElement.parentElement.getAttribute('data-id')

      await fetch('../api/update_ticket_department.php?ticketId=' + ticketId + '&department=' + selectDepartment.value)

      //when department changes, need to change the available agents
      const assignAgent = document.querySelector('#ticket #agent > select')
      assignAgent.innerHTML = ''

      const hintText = document.createElement('option')
      hintText.textContent = 'assign an agent'
      hintText.disabled = true
      hintText.selected = true
      
      assignAgent.appendChild(hintText)

      const response = await fetch('../api/get_department_agents.php?department=' + selectDepartment.value);
      const department_agents = await response.json()

      department_agents.forEach((element) => {
        const agent = document.createElement('option')
        agent.textContent = element['username']
        assignAgent.appendChild(agent)
      })
    })
  }
}

async function ticket_update_status(ticketId, new_status){
  await fetch('../api/update_ticket_status.php?ticketId=' + ticketId + '&status=' + new_status)

  const status = document.querySelector('#ticket #status')
  status.textContent = new_status
}

function ticket_agent(){
  const selectAgent = document.querySelector('#ticket #agent > select')
  if (selectAgent) {
    selectAgent.addEventListener('change', async function(event) {
      const ticketId = event.target.parentElement.parentElement.parentElement.getAttribute('data-id')

      await fetch('../api/update_ticket_agent.php?ticketId=' + ticketId + '&agent=' + selectAgent.value)

      ticket_update_status(ticketId, 'Assigned');
    })
  }
}

function ticket() {
  ticket_tags()
  ticket_department()
  ticket_agent()

  const closeButton = document.querySelector('#ticket #close_ticket')

  if (closeButton) {
    closeButton.addEventListener('click', function (event) {
      event.target.innerHTML = ''
      ticket_update_status(event.target.parentElement.parentElement.getAttribute('data-id'), 'Closed')

      const selectDepartment = document.querySelector('#ticket #department > select')
      if (selectDepartment) {
        selectDepartment.querySelectorAll('option').forEach((option) => {
          if (!option.selected)
            selectDepartment.removeChild(option)
        })
      }

      const selectAgent = document.querySelector('#ticket #agent > select')
      if (selectAgent) {
        selectAgent.querySelectorAll('option').forEach((option) => {
          if (!option.selected)
            selectAgent.removeChild(option)
        })
      }

      const tags = document.querySelector('#ticket #tags')
      const tag_input = tags.querySelector('input')
      const tag_add = tags.querySelector('img')

      tags.removeChild(tag_input)
      tags.removeChild(tag_add)

      document.body.removeEventListener('click', ticket_remove_tag)

      const comment_form = document.querySelector('#ticket #comments form')
      comment_form.outerHTML = ''
    })
  }
}

ticket()