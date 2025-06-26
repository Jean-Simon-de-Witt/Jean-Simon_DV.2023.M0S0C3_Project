function numericValue(s) {
    let output = '';
    for (let i = 0; i < s.length; i++) {
        let currentChar = s.charAt(i);
        if (!currentChar.includes('p') && !currentChar.includes('x')) {
            output = output + currentChar;
        }
    }
    return Number(output);
}
function adjustLayout() {
    const headerHeight = window.getComputedStyle(document.getElementById('header')).getPropertyValue('height');
    const footer = document.getElementById('footer');
    const main = document.getElementById('main');
    main.style.marginTop = headerHeight;
    

    const labels = document.getElementsByClassName('label');
    const inputs = document.getElementsByClassName('input');
    
    for (let i = 0; i < labels.length; i++) {
        const currentMarginLeft = window.getComputedStyle(inputs[i]).getPropertyValue('margin-inline');
        labels[i].style.marginInline = currentMarginLeft;
    }

}
document.addEventListener('DOMContentLoaded', () => {
    adjustLayout();
});

window.addEventListener('resize', () => {
    adjustLayout();
});