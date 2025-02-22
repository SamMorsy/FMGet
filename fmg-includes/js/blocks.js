function fmg_showMessage(message, message_type) {
    let message_box = document.createElement("div");
    message_box.classList.add("fmg-ui-message");
    message_box.classList.add(message_type);
    message_box.innerHTML = message;
    document.body.appendChild(message_box);

    let timeout = setTimeout(() => {
        message_box.classList.add("fade-out");
        setTimeout(() => message_box.remove(), 1000);
    }, 5000);

    message_box.addEventListener("mouseenter", () => clearTimeout(timeout));
    message_box.addEventListener("mouseleave", () => {
        timeout = setTimeout(() => {
            message_box.classList.add("fade-out");
            setTimeout(() => message_box.remove(), 1000);
        }, 5000);
    });
}

function fmg_dropdownfilterOptions(inputElement) {
    const dropdownContainer = inputElement.closest('.fmg-ui-field-container.menu');
    const dropdownMenu = dropdownContainer.querySelector('.fmg-ui-field-options');
    const filterValue = inputElement.value.toLowerCase();
    const options = dropdownMenu.querySelectorAll('div');

    options.forEach(option => {
        if (option.textContent.toLowerCase().includes(filterValue)) {
            option.style.display = '';
        } else {
            option.style.display = 'none';
        }
    });
}

function fmg_dropdownshow(inputElement) {
    const dropdownContainer = inputElement.closest('.fmg-ui-field-container.menu');
    const dropdownMenu = dropdownContainer.querySelector('.fmg-ui-field-options');
    dropdownMenu.classList.add('active');
}

function fmg_dropdownhide(inputElement) {
    const dropdownContainer = inputElement.closest('.fmg-ui-field-container.menu');
    const dropdownMenu = dropdownContainer.querySelector('.fmg-ui-field-options');
    setTimeout(() => {
        dropdownMenu.classList.remove('active');
    }, 200);
}

function fmg_dropdownselectOption(event) {
    const dropdownContainer = event.currentTarget.closest('.fmg-ui-field-container.menu');
    const inputElement = dropdownContainer.querySelector('input');

    if (event.target.tagName === 'DIV') {
        inputElement.value = event.target.textContent;
        event.currentTarget.classList.remove('active');
    }
}

function fmg_toggleGroup(button, show_text, hide_text) {
    let details = button.nextElementSibling;
    let toggleText = button.querySelector(".fmg-ui-group-toggle-text");
    let toggleArrow = button.querySelector(".fmg-ui-group-arrow");
    
    if (details.style.maxHeight) {
        details.style.maxHeight = null;
        toggleText.textContent = "Show details";
        toggleArrow.innerHTML = "&#129095;";
    } else {
        details.style.maxHeight = details.scrollHeight + "px";
        toggleText.textContent = "Show less";
        toggleArrow.innerHTML = "&#129093;";
    }
}