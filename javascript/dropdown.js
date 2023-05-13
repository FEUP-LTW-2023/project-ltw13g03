function activateDropdowns() {
    /* FAQ DROPDOWN */
    const questionHeaders = document.querySelectorAll(".faq-header");
    if(questionHeaders != null) {
        for (const questionHeader of questionHeaders) {
            questionHeader.addEventListener("click", function() {
                const answer = this.nextElementSibling
                answer.classList.toggle("show")
            })
        }
    }

    /* PROFILE DROPDOWN */
    const userProfile = document.querySelector('.profile-dropdown');
    const dropdown = document.querySelector('.profile-dropdown-content');

    if(userProfile != null && dropdown != null) {
        userProfile.addEventListener('click', () => {
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', (event) => {
            const isClickInside = userProfile.contains(event.target);
            if (!isClickInside) {
                dropdown.style.display = 'none';
            }
        });
    }

    const faqId = window.location.hash.slice(1);
    if (faqId) {
        const faq = document.querySelector(`.question[data-faq-id="${faqId}"]`);
        if (faq) {
            faq.querySelector('.faq-header').click();
            faq.scrollIntoView();
        }
    }
}

activateDropdowns()

