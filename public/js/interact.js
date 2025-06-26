function toggleOptionsMenu() {
        const menu = document.getElementById('options-menu');
        if (menu) {
            menu.classList.toggle('hidden');
            menu.classList.toggle('visible');
        }
    }

function toggleSortingMenu() {
    const menu = document.querySelector('.sorting-menu');
    if (menu) {
        if (menu.style.display == 'flex') {
        menu.style.display = 'none';
        }
        else {
            menu.style.display = 'flex';
        }
    }
    
}
    
document.addEventListener('DOMContentLoaded', () => {
    const profilePicture = document.getElementById('profile-picture-link');
    if (profilePicture) {
        profilePicture.addEventListener('click', toggleOptionsMenu);
    }
    const menuBtn = document.querySelector('.sorting-menu-button');
    if (menuBtn) {
        menuBtn.addEventListener('click', toggleSortingMenu);
    }
});
