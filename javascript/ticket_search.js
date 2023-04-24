const searchBox = document.querySelector('#searchticket')

if (searchBox) {
    searchBox.addEventListener('input', async function() {
        const response = await fetch('../api/search_tickets.php?search=' + this.value)
        const tickets = await response.json()

        const section = document.querySelector('#tickets')
        const previews = document.querySelectorAll('.ticketpreview')
        
        for (const preview of previews)
            preview.outerHTML = '';

        for (const ticket of tickets) {
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
    })
}