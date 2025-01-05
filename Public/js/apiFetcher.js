//To use this script, you need to have another script that defines the following variables and functions:
// 1. api : The API endpoint to fetch data from
// 2. offsetIncrement : The number of items to fetch per request
// 3. getVariables : An object containing the variables to send with the request
// 4. cardTemplate : A function that returns the HTML template for a card
// 5. updateGetVariables : A function that updates the getVariables object with the search input
// 6. dataArr : A const array to store the fetched data. If this is not defined, the fetched data will not be stored

let offset = 0;
let loadComplete = false;
let isLoading = false;
let debounceTimeout;
const searchBar = document.getElementById('searchBar');
const elementsList = document.getElementById('elements-Scroll-Div');

// Function to load products from the API
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
async function initialLoad() {
    while (elementsList.scrollHeight <= elementsList.clientHeight && !loadComplete) {
        await loadData();
        offset += offsetIncrement;
    }
}

// Handle search input changes
searchBar.addEventListener('input', () => {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => {
        loadComplete = false;
        offset = 0;
        if (typeof dataArr !== 'undefined' && Array.isArray(dataArr))
            dataArr.length = 0;

        elementsList.innerHTML = ""; // Clear the product list
        initialLoad(); // Load products based on the search input
        elementsList.addEventListener('scroll', loadDataOnScroll); // Re-add the scroll listener
    }, 500);
});

// Infinite scroll listener
elementsList.addEventListener('scroll', loadDataOnScroll);

function loadDataOnScroll() {
    if (elementsList.scrollTop + elementsList.clientHeight >= elementsList.scrollHeight - 1) {
        loadData(searchBar.value); // Load more products
        offset += 10;
    }
}

// Initial load
initialLoad();