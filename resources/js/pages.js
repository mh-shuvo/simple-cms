/**
 * @author MD. Mehedi Hasan
 * This page is responsible to handle functionalities of the content page features.
 * */

// Set the base url form the metadata
const BASE_PATH = (document.querySelector("meta[name=path]")).getAttribute('content')

// Get all elements with the .deletePage class
const deletePageElements = document.querySelectorAll('.deletePage');

// Attach the event listener to each element
deletePageElements.forEach(function (element) {
    element.addEventListener('click', function (event) {
        event.preventDefault();

        // Confirmation from the user
        if (!confirm("Are you sure you want to delete this page?")) {
            return;
        }

        // Get the page unique slug from the data-key attribute of the clicked element
        const slug = element.getAttribute('data-key');

        // Select the delete form
        const form = document.querySelector('#deletePageForm');

        // Set the form action path
        form.setAttribute('action', `${BASE_PATH}/pages/${slug}/delete`);

        // Submit the form
        form.submit();
    });
});
