//nav dropdown
window.onload = function () {
    var dropdown = document.querySelector('.hamburger-menu');
    dropdown.addEventListener('click', function (event) {
        event.stopPropagation();
        var menu = this.querySelector('.dropdown-menu');
        menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
    });

    window.addEventListener('click', function () {
        var menu = document.querySelector('.dropdown-menu');
        menu.style.display = 'none';
    });
};

//dropdown bezorgopties
document.addEventListener('DOMContentLoaded', function () {
    const bezorgopties = document.querySelector('.bezorgopties');
    const dropdown = document.querySelector('.dropdown-bezorg');
    const options = dropdown.querySelectorAll('.dropdown-bezorg p');

    // Toggle de zichtbaarheid van de dropdown bij het klikken op de h3 of i
    [bezorgopties].forEach(el => {
        el.addEventListener('click', function () {
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        });
    });

    // Vervang de tekst van de h3 door de tekst van de geklikte optie
    options.forEach(option => {
        option.addEventListener('click', function (e) {
            e.preventDefault(); // Voorkom de standaard actie van de link
            bezorgopties.textContent = this.textContent;
            dropdown.style.display = 'none'; // Verberg de dropdown
        });
    });
});

//dropdown betaalopties
document.addEventListener('DOMContentLoaded', function () {
    const bezorgopties = document.querySelector('.betaalmethode');
    const dropdown = document.querySelector('.dropdown-betaal');
    const options = dropdown.querySelectorAll('.dropdown-betaal p');

    // Toggle de zichtbaarheid van de dropdown bij het klikken op de h3 of i
    [bezorgopties].forEach(el => {
        el.addEventListener('click', function () {
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        });
    });

    // Vervang de tekst van de h3 door de tekst van de geklikte optie
    options.forEach(option => {
        option.addEventListener('click', function (e) {
            e.preventDefault(); // Voorkom de standaard actie van de link
            bezorgopties.textContent = this.textContent;
            dropdown.style.display = 'none'; // Verberg de dropdown
        });
    });
});

//Menu filter dropdown
const filterIcon = document.querySelector('.filter-icon');

filterIcon.addEventListener('click', function (event) {
    const dropdownMenu = document.querySelector('.filter-dropdown-menu');
    if (dropdownMenu.style.display === 'none') {
        dropdownMenu.style.display = 'block';
    } else {
        dropdownMenu.style.display = 'none';
    }
    event.stopPropagation();
});

document.addEventListener('click', function (event) {
    const dropdownMenu = document.querySelector('.filter-dropdown-menu');
    if (!filterIcon.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.style.display = 'none';
    }
});

//Menu filter sections
document.addEventListener('DOMContentLoaded', function () {
    // Restore checkbox states from localStorage
    const storedCheckboxes = JSON.parse(localStorage.getItem('checkedCheckboxes')) || [];
    console.log("Restored checked checkboxes from localStorage:", storedCheckboxes);

    document.querySelectorAll('.filter-dropdown-menu input[type=checkbox]').forEach(checkbox => {
        if (storedCheckboxes.includes(checkbox.value)) {
            checkbox.checked = true;
        }
    });

    // Add change event listeners to checkboxes
    document.querySelectorAll('.filter-dropdown-menu input[type=checkbox]').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const checkedValues = Array.from(document.querySelectorAll('.filter-dropdown-menu input[type=checkbox]:checked')).map(el => el.value);

            // Save the state of the checkboxes to localStorage
            localStorage.setItem('checkedCheckboxes', JSON.stringify(checkedValues));
            console.log("Saved checked checkboxes to localStorage:", checkedValues);

            let here = new URL(window.location.href);
            let key = "";

            if (checkedValues.length <= 1) {
                key = "category";
            } else if (checkedValues.length > 1) {
                key = "categories";
            }

            here.search = "";

            let values = checkedValues.join(',');

            if (values.length > 0) {
                let newSearch = `${key}=${values}`;
                here.search = '?' + newSearch;
            }

            history.pushState({}, "", here);

            // Refresh the page
            window.location.reload();
        });
    });
});

//responsive cart dropdown
document.addEventListener('DOMContentLoaded', function () {
    const button = document.querySelector('.button');
    const cart = document.querySelector('.cart');
    const arrow1 = document.querySelector('.arrow1')
    const arrow2 = document.querySelector('.arrow2')

    button.addEventListener('click', function () {
        // Toggle de zichtbaarheid van .cart
        if (cart.style.display === 'none' || cart.style.display === '') {
            cart.style.display = 'block';
            button.style.backgroundColor = '#be3245';
            button.style.color = '#fff';
            arrow1.style.color = '#fff';
            arrow2.style.color = '#fff';
            arrow1.style.transform = 'rotate(180deg) translateY(8px)'
            arrow2.style.transform = 'rotate(180deg) translateY(8px)'
        } else {
            cart.style.display = 'none';
            button.style.backgroundColor = '';
            button.style.color = '';
            arrow1.style.color = '#be3245';
            arrow2.style.color = '#be3245';
            arrow1.style.transform = ''
            arrow2.style.transform = ''
        }
    });
});