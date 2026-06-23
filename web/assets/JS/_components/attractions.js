/**
 * processAttractionsFilterBar
 */
const processAttractionsFilterBar = function() {
    // Define elements
    const filterBar = document.getElementById('attractionFilterBar');

    // Apply filters
    if (filterBar) {
        const attractionSubmit = document.getElementById('attractionSearchSubmitButton');
        const attractionSubmitInput = attractionSubmit.getElementsByTagName('input');

        let filter = filterBar.querySelector('#types');
        let selectBoxFilters = document.querySelectorAll('.attraction-filter-item');
        let viewButtons = filterBar.querySelectorAll('input[name="map"]');

        // Apply the filter by redirecting to the attractions page with the area and types params
        if (filter) {
            let area = filter.dataset.area;

            // Handle selecting from select element
            filter.addEventListener('change', function() {
                // Disable submit
                attractionSubmit.classList.add('disabled');
                attractionSubmitInput[0].disabled = true;
                // Redirect
                document.location.href = `/attractions/area?area=${area}&types=${filter.value}`;
            });

            // Handle selecting from selectBox element
            if (selectBoxFilters) {
                selectBoxFilters.forEach(function(element){
                    element.addEventListener('click', function() {
                       let link = element.querySelector('a');
                       if (link) {
                           // Disable submit
                           attractionSubmit.classList.add('disabled');
                           attractionSubmitInput[0].disabled = true;
                           // Redirect
                           document.location.href = `/attractions/area?area=${area}&types=${link.rel}`;
                       }
                    });
                });
            }
        }

        // If view buttons are present, handle toggle between grid and map view
        if (viewButtons) {
            viewButtons.forEach(function(viewButton){
                viewButton.addEventListener('click', function() {
                    let mapContainer = document.getElementById('mapContainer');
                    let gridContainer = document.getElementById('gridContainer')

                    // If map view is selected
                    if (viewButton.value == '1') {
                        // Show the map hide the grid
                        mapContainer.classList.remove('hidden');
                        gridContainer.classList.add('hidden');

                        // Drop cookie to store if the view maps button was selected
                        document.cookie = "showAttractionsMap=1; expires=Fri, 1 Jan 2038 12:00:00 UTC; path=/";
                    } else {
                        // Show the grid hide the map
                        mapContainer.classList.add('hidden');
                        gridContainer.classList.remove('hidden');

                        // Drop cookie to store if the view maps button was not selected
                        document.cookie = "showAttractionsMap=0; expires=Fri, 1 Jan 2038 12:00:00 UTC; path=/";
                    }
                })
            });
        }
    }
}
/**
 * processAttractionsSearchBar
 */
const processAttractionsSearchBar = function() {
    const attractionForm = document.getElementById('attractions-form');
    const attractionSubmit = document.getElementById('attractionSearchSubmitButton');
    const attractionSearch = document.getElementById('searchTerm');
    const attractionSubmitInput = attractionSubmit.getElementsByTagName('input');

    if (attractionForm) {
        // Loaded so enable the submit button
        attractionSubmit.classList.remove('disabled');
        attractionSubmitInput[0].disabled = false;

        // Prevent submit until checks confirmed
        attractionForm.addEventListener("submit", function(e) {
            e.preventDefault();

            if (!attractionSearch.value) {
                // Popup or error message
            } else {
                attractionForm.submit();
            }
        }, true);
    }
}

/**
 * When the content of the page is loaded (not images/css) process filter bar
 */
document.addEventListener("DOMContentLoaded", function(){
    processAttractionsFilterBar();
    processAttractionsSearchBar();
});