const selects = document.querySelectorAll('section#form-manage-users select');

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