async function addTagSearch(event){
    const selectedOption = event.target.parentElement.querySelector('input')
    const options = event.target.parentElement.querySelectorAll('#tickets datalist option')

    const ul = document.querySelector('#tags > ul');

    options.forEach((option) => {
        if (option.textContent == selectedOption.value){
            const newLi = document.createElement('li')
            newLi.textContent = selectedOption.value
            newLi.classList.add('tag')
            ul.appendChild(newLi)
        }
    })

    selectedOption.value = ""
}

function search_tags() {
    const selectTags = document.querySelector('#tickets #tags > input');
    const addTags = document.querySelector('#tickets #tags > img');

    if (selectTags && addTags){

        document.body.addEventListener('click', async function (event) {
            if (event.target.tagName === 'LI') {
                const selectedOption = event.target.innerHTML

                const ul = document.querySelector('#tickets #tags > ul');
                
                ul.childNodes.forEach((li) => {
                    if (li.textContent == selectedOption)
                        ul.removeChild(li)
                })
            }
        });

        addTags.addEventListener('click', (event) => {
            addTagSearch(event)
        })

        selectTags.addEventListener('keydown', (event) => {
            if (event.key === 'Enter'){
            event.preventDefault()
            addTagSearch(event)
            }
        })
    }
}

search_tags()