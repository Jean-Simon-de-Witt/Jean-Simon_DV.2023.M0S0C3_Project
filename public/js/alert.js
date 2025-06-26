function showAlert(listingId) {
    fetch('/partials/alert/delete/' + listingId)
    .then(response => response.text())
    .then(html => {
        const container = document.getElementById('alert-container');
        container.innerHTML = html;
        container.style.display = 'flex';

        const cancelBtn = container.querySelector('.cancel-button');
        if (cancelBtn) {
            cancelBtn.addEventListener('click', closeAlert);
        }
    });
}

function closeAlert() {
    const container = document.getElementById('alert-container');
    container.innerHTML = '';
    container.style.display = 'none';
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.delete-link').forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            const listingId = this.closest('.listing')?.dataset?.id;
            if (listingId) showAlert(listingId);
        });
    });
});