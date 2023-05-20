const activeTicketsBtn = document.getElementById('activeTicketsBtn')
const ticketStatusBtn = document.getElementById('ticketStatusBtn')
const userStatsBtn = document.getElementById('userStatsBtn')

if (activeTicketsBtn != null) activeTicketsBtn.addEventListener('click', showActiveTicketsChart);
if (ticketStatusBtn != null) ticketStatusBtn.addEventListener('click', showTicketStatusChart);
if (userStatsBtn != null) userStatsBtn.addEventListener('click', showUserStatsChart);


async function showActiveTicketsChart() {
    const response = await fetch('../api/ticket.php/', {
        method: 'get',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
    })

    const data = await response.json()
    const activeTickets = []
    console.log(data)
    Object.entries(data.activeTicketsData).forEach(([date, count]) => {
        activeTickets.push({ date, count })
    })

    renderChart(activeTickets, 'line')
    
}
  
async function showTicketStatusChart() {
    const response = await fetch('../api/ticket.php/', {
        method: 'get',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
    })

    const data = await response.json()
    const ticketStatus = []

    Object.entries(data.ticketStatusData).forEach(([label, count]) => {
        ticketStatus.push({ label, count })
    })

    renderChart(ticketStatus, 'doughnut')
}
  
async function showUserStatsChart() {
    const response = await fetch('../api/client.php/', {
        method: 'get',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
    })

    const data = await response.json()
    const userStats = []

    Object.entries(data).forEach(([label, count]) => {
        userStats.push({ label, count })
    })

    renderChart(userStats, 'doughnut')
}


function renderChart(data, type) {
    document.getElementById('chartContainer').innerHTML = ''
  
    const canvas = document.createElement('canvas')
    canvas.id = 'chart'
    document.getElementById('chartContainer').appendChild(canvas)
    
    const ctx = document.getElementById('chart').getContext('2d');

    const chartConfig = {
        type: type,
        data: {
            labels: (type === 'line') ? data.map(entry => entry.date) : data.map(item => item.label || item.date),
            datasets: [{
                label: (type === 'line') ? 'Open Tickets' : undefined,
                data: data.map(item => item.count),
                backgroundColor: ['#ff6384', '#36a2eb', '#ffce56'],
                borderColor: '#fff',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
        }
    };

    new Chart(ctx, chartConfig)
}
