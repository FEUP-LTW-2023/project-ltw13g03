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
                filter_tags()
            }
        });

        addTags.addEventListener('click', (event) => {
            addTagSearch(event)
            filter_tags()
        })

        selectTags.addEventListener('keydown', (event) => {
            if (event.key === 'Enter'){
                event.preventDefault()
                addTagSearch(event)
                filter_tags()
            }
        })
    }
}

async function filter_tags(){
    const input = document.querySelector('#tickets #searchticket').value
    const selectedTags = Array.from(document.querySelector('#tickets #tags > ul').childNodes).map((tag) => tag.textContent)
    const response = await fetch('../api/search_tickets.php?search=' + input)
    const tickets = await response.json()

    const section = document.querySelector('#tickets')
    const previews = document.querySelectorAll('.ticketpreview')
    
    for (const preview of previews)
        preview.outerHTML = '';

    for (const ticket of tickets) {
        const ticket_hashtags = ticket['hashtags']
        
        let tags_match = true
                
        selectedTags.forEach((tag) => {
            if (!ticket_hashtags.includes(tag))
                tags_match = false
        })

        if (!tags_match) continue
        
        const link = document.createElement('a')
        link.classList.add('ticketpreview')
        link.href = '../pages/ticket.php?id=' + ticket.ticketId

        const title = document.createElement('h3')
        title.textContent = ticket.title

        const description = document.createElement('p')
        const encoder = new TextEncoder()                   //all of this because php counts bytes
        const bytes = encoder.encode(ticket.body)
        if (bytes.length > 200){
            const decoder = new TextDecoder()
            const str = decoder.decode(bytes.subarray(0, 200))
            description.textContent = str + '...'
        }
        else description.textContent = ticket.body

        const status = document.createElement('div')
        status.id = 'status'
        status.textContent = 'Status: ' + ticket.status

        const date = document.createElement('time')
        date.datetime = ticket.date
        date.textContent = 'Date: ' + ticket.date.date.substring(0, 10)

        link.appendChild(title)
        link.appendChild(description)
        link.appendChild(status)
        link.appendChild(date)

        section.appendChild(link)
    }
}

function search_tickets(){
    const searchBox = document.querySelector('#searchticket')

    search_tags()

    if (searchBox) {
        searchBox.addEventListener('input', filter_tags)
    }
}

search_tickets()