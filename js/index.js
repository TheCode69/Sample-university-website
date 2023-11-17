document.addEventListener('DOMContentLoaded', function () {
    const dropdowns = document.querySelectorAll('.dropdown');
    const subDropdowns = document.querySelectorAll('.sub-dropdown');

    function toggleDropdown(event) {
        event.preventDefault();
        const dropdownContent = this.querySelector('.dropdown-content');
        dropdownContent.classList.toggle('active');
    }

    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', toggleDropdown);
    });

    subDropdowns.forEach(subDropdown => {
        subDropdown.addEventListener('click', toggleDropdown);
    });

    document.addEventListener('click', function (event) {
        if (!event.target.closest('.dropdown') && !event.target.closest('.sub-dropdown')) {
            dropdowns.forEach(dropdown => {
                const dropdownContent = dropdown.querySelector('.dropdown-content');
                dropdownContent.classList.remove('active');
            });

            subDropdowns.forEach(subDropdown => {
                const subDropdownContent = subDropdown.querySelector('.sub-dropdown-content');
                subDropdownContent.classList.remove('active');
            });
        }
    });
});
