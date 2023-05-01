const selects = document.querySelectorAll('section#form-manage-users td:nth-child(2) > select');
const selectsDepartments = document.querySelectorAll('section#form-manage-users td:nth-child(3) > .departments > select');

if (selects && selectsDepartments){

  document.body.addEventListener('click', async function (event) {
    if (event.target.tagName === 'LI') {
      const id = event.target.parentElement.parentElement.parentElement.parentElement.getAttribute('data-id')
      const selectedOption = event.target.innerHTML

      const ul = document.querySelector('section#form-manage-users tr[data-id="' + id + '"] td:nth-child(3) > .departments > ul');

      const response = await fetch('../api/remove_department.php?username=' + id + '&department=' + selectedOption)
      const client = await response.json()

      if (client !== null) {
        while (ul.firstChild) {
          ul.removeChild(ul.firstChild);
        }

        const departments = client['departments']
        departments.forEach((element) => {
          const newLi = document.createElement('li');
          newLi.textContent = element.name;
          ul.appendChild(newLi);
        });
      }
    }
  });

  selects.forEach(select => {
    select.addEventListener('change', async (event) => {
      const selectedOption = event.target.value
      const id = event.target.parentElement.parentElement.getAttribute('data-id')
      const isAdmin = selectedOption == "admin" ? 1 : 0
      const isAgent = isAdmin || selectedOption == "agent" ? 1 : 0
      const response = await fetch('../api/update_role.php?username=' + id + '&isAgent=' + isAgent + '&isAdmin=' + isAdmin)

      const client = await response.json()
      if (client !== null) {
         const select = document.querySelector('section#form-manage-users tr[data-id="' + client['username'] + '"] > td:nth-child(2) > select')
         if (client['isAdmin']) {
          select.value = 'admin'
        } else if (client['isAgent']) {
          select.value = 'agent'
        } else {
          select.value = 'client'
        }
      }
    });
  });

  selectsDepartments.forEach(select => {
    select.addEventListener('change', async (event) => {
      const id = event.target.parentElement.parentElement.parentElement.getAttribute('data-id')
      const selectedOption = event.target.value
      select.value = "unspecified"

      const response = await fetch('../api/add_department.php?username=' + id + '&department=' + selectedOption)
      const client = await response.json()

      if (client !== null) {
        const ul = document.querySelector('section#form-manage-users tr[data-id="' + id + '"] td:nth-child(3) > .departments > ul');

        while (ul.firstChild) {
          ul.removeChild(ul.firstChild);
        }

        const departments = client['departments']
        departments.forEach((element) => {
          const newLi = document.createElement('li');
          newLi.textContent = element.name;
          ul.appendChild(newLi);
        });
      }
    });
  });
}
