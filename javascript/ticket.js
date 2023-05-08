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
  ticket_update_changes()
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

    ticket_update_changes()
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

      ticket_update_status(ticketId, 'Open');
      ticket_update_changes()
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
      ticket_update_changes()
    })
  }
}

function ticket_changes() {
  const dropdownButton = document.querySelector('#toggle_show_changes');

  if (dropdownButton) {
    dropdownButton.addEventListener('click', function() {
      const menuContent = this.nextElementSibling;
      if (!menuContent.classList.contains("show")) {
        menuContent.classList.add("show");
        menuContent.classList.remove("hide");
      } else {
        menuContent.classList.add("hide");
        menuContent.classList.remove("show");
      }
    });
  }
}

async function ticket_update_changes() {
  const changes_menu = document.querySelector('#ticket #changes_menu')

  if (changes_menu) {
    const ticketId = document.querySelector('#ticket').getAttribute('data-id')

    const response = await fetch('../api/get_ticket_changes.php?ticketId=' + ticketId)
    const changes = await response.json()

    const ol = changes_menu.querySelector('#ticket_changes ol')

    while (ol.firstChild){
      ol.removeChild(ol.firstChild)
    }

    let change_count = 0

    changes.forEach((change) => {
      const li = document.createElement('li')
      const time = document.createElement('time')
      time.dateTime = change['date']
      time.textContent = change['date']

      li.appendChild(time)

      li.innerHTML += ` <strong>${change["userId"]}</strong>`

      if (change['field'] === 'Hashtag') {
        if (change['old'] === '') {
          li.innerHTML += ` added the tag <strong>${change['new']}</strong>`
        } else if (change['new'] === '') {
          li.innerHTML += ` removed the tag <strong>${change['old']}</strong>`
        }
      } else if (change['field'] === 'Agent') {
        if (change['old'] === '') {
          li.innerHTML += ` assigned the ticket to <strong>${change['new']}</strong>`
        } else {
          li.innerHTML += ` reassigned the ticket from <strong>${change['old']}</strong>
                            to <strong>${change['new']}</strong>`
        }
      } else if (change['field'] === 'Department') {
        if (change['old'] === '') {
          li.innerHTML += ` changed the department to <strong>${change['new']}</strong>`
        } else {
          li.innerHTML += ` changed the department from <strong>${change['old']}</strong>
                            to <strong>${change['new']}</strong>`
        }
      } else if (change['field'] === 'Status') {
        li.innerHTML += ' closed the ticket &#128274;'
      }

      ol.appendChild(li)
      change_count++
    })

    const toggle = changes_menu.querySelector('#toggle_show_changes #change_count')
    toggle.textContent = change_count
  }
}

function ticket() {
  ticket_tags()
  ticket_department()
  ticket_agent()
  ticket_changes()

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

      ticket_update_changes()
    })
  }
}

ticket()
