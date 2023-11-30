
function toggleItems(header) {
    const arrow = header.querySelector('.arrow');
    const isExpanded = header.classList.toggle('expanded');

    if (isExpanded) {
        arrow.classList.remove('down');
        arrow.classList.add('up');
    } else {
        arrow.classList.remove('up');
        arrow.classList.add('down');
    }
}