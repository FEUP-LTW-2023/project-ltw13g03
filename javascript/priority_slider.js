function updateSlider(e) {
    const slider = e.currentTarget
    console.log(slider)

    switch (slider.value) {
        case "0":
            slider.id = 'low_priority'
            break;
        case "1":
            slider.id = 'medium_priority'
            break;
        case "2":
            slider.id = 'high_priority'
            break;
    }

}

document.querySelector('section.create_ticket form #ticket_priority input').addEventListener('input', updateSlider)
