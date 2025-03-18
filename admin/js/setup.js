async function copyfromcodebox(event) {
    const button = event.target;
    const codeBox = button.parentElement.querySelector('.codebox-box');
    const notification = button.parentElement.querySelector('.codebox-message');
    
    if (!navigator.clipboard) {
        alert('Clipboard API not supported');
        return;
    }
    
    try {
        await navigator.clipboard.writeText(codeBox.textContent);
        notification.style.display = 'block';
        setTimeout(() => {
            notification.style.display = 'none';
        }, 4000);
    } catch (err) {
        alert('Failed to copy the code.');
        console.error(err);
    }
}


const copyCodeBoxButtons = document.querySelectorAll('.codebox-button');
copyCodeBoxButtons.forEach(button => button.addEventListener('click', copyfromcodebox));