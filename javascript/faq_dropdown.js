function activateDropdown() {
    const questionHeaders = document.querySelectorAll(".faq-header");

    for (const questionHeader of questionHeaders) {
        questionHeader.addEventListener("click", function() {
            const answer = this.nextElementSibling
            answer.classList.toggle("show")
        })
    }
    /*
    const questionAnswers = document.querySelectorAll(".faq-answer");

    document.addEventListener("click", function(event) {
        for(const questionAnswer of questionAnswers) {
            if (event.target !== questionAnswer && questionAnswer.classList.contains('show')) {
                questionAnswer.classList.remove('show');
            }
        }
    })
     */
}

activateDropdown()

