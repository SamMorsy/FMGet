    function fmg_formentry_dropdownfilterOptions(inputElement) {
        const dropdownContainer = inputElement.closest('.fmg_formentry_dropdown');
        const dropdownMenu = dropdownContainer.querySelector('.fmg_formentry_dropdown-menu');
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

    function fmg_formentry_dropdownshow(inputElement) {
        const dropdownContainer = inputElement.closest('.fmg_formentry_dropdown');
        const dropdownMenu = dropdownContainer.querySelector('.fmg_formentry_dropdown-menu');
        dropdownMenu.classList.add('active');
    }

    function fmg_formentry_dropdownhide(inputElement) {
        const dropdownContainer = inputElement.closest('.fmg_formentry_dropdown');
        const dropdownMenu = dropdownContainer.querySelector('.fmg_formentry_dropdown-menu');
        setTimeout(() => {
            dropdownMenu.classList.remove('active');
        }, 200);
    }

    function fmg_formentry_dropdownselectOption(event) {
        const dropdownContainer = event.currentTarget.closest('.fmg_formentry_dropdown');
        const inputElement = dropdownContainer.querySelector('input');

        if (event.target.tagName === 'DIV') {
            inputElement.value = event.target.textContent;
            event.currentTarget.classList.remove('active');
        }
    }
