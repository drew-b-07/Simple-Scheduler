// Smooth scrolling for navigation links
document.querySelectorAll('header nav a').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        if (this.hash !== "") {
            e.preventDefault();
            const target = document.querySelector(this.hash);
            target.scrollIntoView({
                behavior: "smooth",
                block: "start"
            });
        }
    });
});

// Form validation
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function (e) {
        const inputs = this.querySelectorAll('input, select');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
                input.style.border = "2px solid red";
            } else {
                input.style.border = "1px solid #ccc";
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert("Please fill in all required fields.");
        }
    });
});

// Dynamic header color change on scroll
window.addEventListener('scroll', () => {
    const header = document.querySelector('header');
    if (window.scrollY > 50) {
        header.style.backgroundColor = '#4682b4'; // Darker blue
    } else {
        header.style.backgroundColor = '#87cefa'; // Original light blue
    }
});
