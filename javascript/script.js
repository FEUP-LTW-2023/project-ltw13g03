const selects = document.querySelectorAll('section#form-manage-users select');

selects.forEach(select => {
  select.addEventListener('change', async (event) => {
    const selectedOption = event.target.value
    console.log(`Selected option value: ${selectedOption}`)
    const id = event.target.parentElement.parentElement.getAttribute('data-id')
    const isAdmin = selectedOption == "admin" ? 1 : 0
    const isAgent = isAdmin || selectedOption == "agent" ? 1 : 0
    await fetch('../api/update_role.php?username=' + id + '&isAgent=' + isAgent + '&isAdmin=' + isAdmin)
  });
});