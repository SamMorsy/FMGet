/**
 * Show a temporary message on the right side of the page.
 *
 * @param {string} message - The message text.
 * @param {string} message_type - The message styling type.
 * @returns {void}
 */
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

/**
 * Filter the dropdown menu.
 *
 * @param {Element} inputElement - The options list DOM element.
 * @returns {void}
 */
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

/**
 * Shows the dropdown menu for a field.
 *
 * @param {Element} inputElement - The options list DOM element.
 * @returns {void}
 */
function fmg_dropdownshow(inputElement) {
    const parentBlock = inputElement.closest('.fmg-ui-block');
    const dropdownContainer = inputElement.closest('.fmg-ui-field-container.menu');
    const dropdownMenu = dropdownContainer.querySelector('.fmg-ui-field-options');
    dropdownMenu.classList.add('active');

    // Remove any previous event listener before adding a new one
    document.removeEventListener('click', handleOutsideClick);

    // Define the event handler function
    function handleOutsideClick(event) {
        if (!parentBlock.contains(event.target)) {
            dropdownMenu.classList.remove('active');
            document.removeEventListener('click', handleOutsideClick);
        }
    }

    // Add the event listener to detect clicks outside
    setTimeout(() => {
        document.addEventListener('click', handleOutsideClick);
    }, 0);
}


/**
 * Hides the dropdown menu for a field.
 *
 * @param {Element} inputElement - The options list DOM element.
 * @param {event} event - The event object.
 * @returns {void}
 */
function fmg_dropdownhide(inputElement, event) {
    const dropdownContainer = inputElement.closest('.fmg-ui-field-container.menu');
    const dropdownMenu = dropdownContainer.querySelector('.fmg-ui-field-options');

    // Check if relatedTarget is inside the dropdown OR if the event target is inside the dropdown options
    if (event.relatedTarget && dropdownContainer.contains(event.relatedTarget)) {
        return; // Do nothing if focus moves within the container
    }

    if (dropdownMenu.contains(event.target)) {
        return; // Do nothing if the click happened inside the dropdown menu
    }

    // Hide dropdown if click happened outside
    dropdownMenu.classList.remove('active');
}

/**
 * Stores the selected option from the dropdown menu in the input field.
 *
 * @param {event} event - The event object.
 * @returns {void}
 */
function fmg_dropdownselectOption(event) {
    const dropdownContainer = event.currentTarget.closest('.fmg-ui-field-container.menu');
    const inputElement = dropdownContainer.querySelector('input');

    if (event.target.tagName === 'DIV') {
        inputElement.value = event.target.textContent;
        event.currentTarget.classList.remove('active');
    }
}

/**
 * Stores the hidden value for a selected option from the dropdown menu in the input field.
 *
 * @param {event} event - The event object.
 * @returns {void}
 */
function fmg_dropdownselectOptionValue(event) {
    const dropdownContainer = event.currentTarget.closest('.fmg-ui-field-container.menu');
    const inputElement = dropdownContainer.querySelector('.fmg-ui-field');
    const valueElement = dropdownContainer.querySelector('input[type="hidden"]');

    if (event.target.tagName === 'DIV') {
        inputElement.value = event.target.textContent;
        valueElement.value = event.target.getAttribute('data-secvalue');
        event.currentTarget.classList.remove('active');
    }
}

/**
 * Shows / hides a group of blocks of items on the page.
 *
 * @param {Element} button - The button DOM element.
 * @param {string} show_text - The text to show when the group are hidden.
 * @param {string} hide_text - The text to show when the group are displayed.
 * @returns {void}
 */
function fmg_toggleGroup(button, show_text, hide_text) {
    let details = button.nextElementSibling;
    let toggleText = button.querySelector(".fmg-ui-group-toggle-text");
    let toggleArrow = button.querySelector(".fmg-ui-group-arrow");

    if (details.style.maxHeight) {
        details.style.maxHeight = null;
        toggleText.textContent = show_text;
        toggleArrow.innerHTML = "&#129095;";
    } else {
        details.style.maxHeight = details.scrollHeight + "px";
        toggleText.textContent = hide_text;
        toggleArrow.innerHTML = "&#129093;";
    }
}

/**
 * redirect to a given link.
 *
 * @param {string} target_link - The full link to be redirected to.
 * @returns {void}
 */
function fmg_goToLink(target_link) {
    window.location.href = target_link;
}