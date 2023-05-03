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

function ticket_agent(){
  const selectAgent = document.querySelector('#ticket #agent > select')
  if (selectAgent) {
    selectAgent.addEventListener('change', async function(event) {
      const ticketId = event.target.parentElement.parentElement.parentElement.getAttribute('data-id')

      await fetch('../api/update_ticket_agent.php?ticketId=' + ticketId + '&agent=' + selectAgent.value)
    })
  }
}

function ticket() {
  ticket_tags()
  ticket_department()
  ticket_agent()
}

ticket()