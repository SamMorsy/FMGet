function fmg_form_dropdownfilterOptions(inputElement) {
    const dropdownContainer = inputElement.closest('.fmg-form-dropdown');
    const dropdownMenu = dropdownContainer.querySelector('.fmg-form-dropdown-menu');
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

function fmg_form_dropdownshow(inputElement) {
    const dropdownContainer = inputElement.closest('.fmg-form-dropdown');
    const dropdownMenu = dropdownContainer.querySelector('.fmg-form-dropdown-menu');
    dropdownMenu.classList.add('active');
}

function fmg_form_dropdownhide(inputElement) {
    const dropdownContainer = inputElement.closest('.fmg-form-dropdown');
    const dropdownMenu = dropdownContainer.querySelector('.fmg-form-dropdown-menu');
    setTimeout(() => {
        dropdownMenu.classList.remove('active');
    }, 200);
}

function fmg_form_dropdownselectOption(event) {
    const dropdownContainer = event.currentTarget.closest('.fmg-form-dropdown');
    const inputElement = dropdownContainer.querySelector('input');

    if (event.target.tagName === 'DIV') {
        inputElement.value = event.target.textContent;
        event.currentTarget.classList.remove('active');
    }
}

function fmg_form_copyfromcodebox(event) {
    const button = event.target;
    const codeBox = button.parentElement.querySelector('.fmg-form-codebox-box');
    const notification = button.parentElement.querySelector('.fmg-form-codebox-message');

    const range = document.createRange();
    const selection = window.getSelection();

    range.selectNodeContents(codeBox);
    selection.removeAllRanges();
    selection.addRange(range);

    try {
        document.execCommand('copy');
        notification.style.display = 'block';
        setTimeout(() => {
            notification.style.display = 'none';
        }, 2000);
    } catch (err) {
        alert('Failed to copy the code.');
    }

    selection.removeAllRanges();
}

const copyCodeBoxButtons = document.querySelectorAll('.fmg-form-codebox-button');
copyCodeBoxButtons.forEach(button => button.addEventListener('click', fmg_form_copyfromcodebox));