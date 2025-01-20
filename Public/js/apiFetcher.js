/*
To use this script, you need to have another script that defines the following variables and functions:
    1. api : The API endpoint to fetch data from
    2. offsetIncrement : The number of items to fetch per request
    3. getVariables : An object containing the variables to send with the request
    4. cardTemplate : A function that returns the HTML template for a card
    5. updateGetVariables : A function that updates the getVariables object with the search input
    6. dataArr : A const array to store the fetched data. If this is not defined, the fetched data will not be stored. This will be usefull when showing a popup.
Also, in the view file, folowing elements should be present:
    1. A div with id 'elements-Scroll-Div' to append the fetched data
    2. An input field with id 'searchBar' to search the data
    3. If there are any filters, they should have a class 'filter-js'
*/

let offset = 0;
let loadComplete = false;
let isLoading = false;
let debounceTimeout;
let cardHeight = 0;
const searchBar = document.getElementById('searchBar');
const elementsList = document.getElementById('elements-Scroll-Div');
const filterElements = document.querySelectorAll('.filter-js');

/** Function to load products from the API */
async function loadData() {
    updateGetVariables();    

    if (isLoading) return;

    if (loadComplete){
        elementsList.removeEventListener('scroll', loadDataOnScroll);
        return;
    } 

    isLoading = true;
    try {
        const apiLink = LINKROOT+"/"+api+"/"+offset+"?"+Object.entries(getVariables)
        .map(([key, value]) => `${encodeURIComponent(key)}=${encodeURIComponent(value)}`)
        .join("&");
        
        console.log(apiLink);
        const response = await fetch(apiLink);
        if (!response.ok) throw new Error("Failed to fetch data. Api : "+apiLink);

        const data = await response.json();
        console.log(data);

        if(!data){
            loadComplete = true;
            return;
        }
        
        if(!Array.isArray(data)) throw new Error("Invalid data received from the server");

        if (data.length < offsetIncrement) {
            loadComplete = true; // No more products available
        }

        if (typeof dataArr !== 'undefined' && Array.isArray(dataArr))
            dataArr.push(...data);
        
        renderData(data);
    } catch (error) {
        console.error("Error loading :", error);
        loadComplete = true;
    } finally {
        offset += offsetIncrement;
        isLoading = false;
    }
}

function renderData(data) {
    data.forEach(dataset => {
        const card = cardTemplate(dataset);
        elementsList.innerHTML += card;
    });
}


// Function to ensure the initial load fills the viewport
/**
 * This function is called when page is loaded or search input is changed.
 * First it loads a dataset and renders the cards. Then it update the cardHeight variable.
 * Then it loads more data until the viewport is filled with cards or no more data is available.
 */
async function initialLoad() {
    await loadData();
    if(!loadComplete){
        cardHeight = elementsList.children[0].clientHeight || 0;
    }
    while (elementsList.scrollHeight <= elementsList.clientHeight + cardHeight && !loadComplete) {
        await loadData();
    }
}

function loadDataWithSearchOrFilter() {
    loadComplete = false;
    offset = 0;
    if (typeof dataArr !== 'undefined' && Array.isArray(dataArr))
        dataArr.length = 0;

    elementsList.innerHTML = ""; // Clear the product list
    initialLoad(); // Load products based on the search input
    elementsList.addEventListener('scroll', loadDataOnScroll); // Re-add the scroll listener
}

async function loadDataOnScroll() {
    if (elementsList.scrollTop + cardHeight + elementsList.clientHeight >= elementsList.scrollHeight - 1) {
        await loadData(); // Load more products
    }
}

// Handle search input changes
searchBar.addEventListener('input', () => {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(loadDataWithSearchOrFilter, 500);
});

// Infinite scroll listener
elementsList.addEventListener('scroll', loadDataOnScroll);

filterElements.forEach(filter => {
    filter.addEventListener('change', loadDataWithSearchOrFilter);
});

// Initial load
//Using pageshow event to ensure the initial load is called when the page is loaded or when the page is NAVIGATED BACK to.
window.addEventListener('pageshow', initialLoad);