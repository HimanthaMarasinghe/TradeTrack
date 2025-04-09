export default class ApiFetcherMod {
    constructor(config) {
        //Mandatory fields
        this.api = config.api;
        this.cardTemplate = config.cardTemplate;

        //Optional fields
        this.dataArr = config.dataArr; //Used to save fetched data if want to use later
        this.offsetIncrement = config.offsetIncrement || 10;
        this.getVariables = config.getVariables || { search: "" };
        this.updateGetVariables = config.updateGetVariables || this.defaultUpdateGetVariables;
        this.searchBar = document.getElementById(config.searchBarId || 'searchBar');
        this.elementsList = document.getElementById(config.elementsListId || 'elements-Scroll-Div');
        this.scrollDiv = document.getElementById(config.scrollDivId || config.elementsListId || `elements-Scroll-Div`);
        this.filterElements = document.querySelectorAll(config.filterClass || '.filter-js');
        this.clickEvent = config.clickEvent || null;
        this.noDataText = config.noDataText || "No data available";

        //Non-configurable fields
        this.offset = 0;
        this.loadComplete = false;
        this.isLoading = false;
        this.debounceTimeout = null;
        this.cardHeight = 0;

        // Initialize event listeners
        this.init();
    }

    defaultUpdateGetVariables() {
        if (this.searchBar && this.getVariables) {
            this.getVariables.search = this.searchBar.value;
        }
    }
    

    async loadData() {
        this.updateGetVariables();

        if (this.isLoading) return;

        if (this.loadComplete) {
            this.elementsList.removeEventListener('scroll', this.loadDataOnScroll);
            return;
        }

        this.isLoading = true;
        try {
            const apiLink = `${LINKROOT}/${this.api}/${this.offset}?${Object.entries(this.getVariables)
                .map(([key, value]) => `${encodeURIComponent(key)}=${encodeURIComponent(value)}`)
                .join("&")}`;

            console.log(apiLink);
            const response = await fetch(apiLink);
            if (!response.ok) throw new Error("Failed to fetch data. Api : " + apiLink);

            const data = await response.json();
            console.log(data);

            if (!data) {
                if (this.offset === 0) {
                    if (this.elementsList.tagName === 'TBODY')
                        this.elementsList.innerHTML = `<tr class="Item"><td colspan="100%" class="faded-text center-al">${this.noDataText}</td></tr>`;
                    else
                        this.elementsList.innerHTML = `<h2 class="grid-center center-al faded-text m-t-20">${this.noDataText}</h2>`;
                };
                this.loadComplete = true;
                return;
            }

            if (!Array.isArray(data)) throw new Error("Invalid data received from the server");

            if (data.length < this.offsetIncrement) {
                this.loadComplete = true; // No more products available
            }

            if (this.dataArr && Array.isArray(this.dataArr)) this.dataArr.push(...data);

            this.renderData(data);
        } catch (error) {
            console.error("Error loading :", error);
            this.loadComplete = true;
        } finally {
            console.log("LoadComplete" ,this.loadComplete);
            this.offset += this.offsetIncrement;
            this.isLoading = false;
        }
    }

    renderData(data) {
        data.forEach((dataset) => {
            const card = this.cardTemplate(dataset);
            this.elementsList.insertAdjacentHTML("beforeend", card);
            if (this.clickEvent) {
                const cardElement = this.elementsList.lastElementChild;
                cardElement.addEventListener('click', () => this.clickEvent(dataset));
            }
        });
    }

    // Function to ensure the initial load fills the viewport
    /**
     * This function is called when page is loaded or search input is changed.
     * First it loads a dataset and renders the cards. Then it update the cardHeight variable.
     * Then it loads more data until the viewport is filled with cards or no more data is available.
     */
    async initialLoad() {
        await this.loadData();
        if (!this.loadComplete) {
            this.cardHeight = this.elementsList.children[0]?.clientHeight || 0;
        }
        while (this.scrollDiv.scrollHeight <= this.scrollDiv.clientHeight + this.cardHeight && !this.loadComplete) {
            await this.loadData();
        }
    }

    async loadDataOnScroll() {
        if (
            this.scrollDiv.scrollTop + this.cardHeight + this.scrollDiv.clientHeight >=
            this.scrollDiv.scrollHeight
        ) {
            await this.loadData();
        }
    }

    loadDataWithSearchOrFilter() {
        this.loadComplete = false;
        this.offset = 0;
        if (this.dataArr && Array.isArray(this.dataArr)) this.dataArr.length = 0;

        this.elementsList.innerHTML = ""; // Clear the product list
        this.initialLoad(); // Load products based on the search input
        this.elementsList.addEventListener('scroll', () => this.loadDataOnScroll()); // Re-add the scroll listener
    }

    addEventListeners() {
        // Search bar listener
        this.searchBar?.addEventListener('input', () => {
            clearTimeout(this.debounceTimeout);

            this.debounceTimeout = setTimeout(() => this.loadDataWithSearchOrFilter(), 500);
        });

        // Infinite scroll listener
        this.scrollDiv.addEventListener('scroll', () => this.loadDataOnScroll());

        // Filter listeners
        this.filterElements?.forEach((filter) => {
            filter.addEventListener('change', () => this.loadDataWithSearchOrFilter());
        });
    }

    waitForPageshow() {
        return new Promise((resolve, reject) => {
            // Check if pageshow has already been triggered
            if (document.readyState === "complete") {
                resolve();
            } else {
                // If not triggered, wait for the pageshow event
                window.addEventListener('pageshow', resolve, { once: true });
            }
        });
    }

    init() {
        console.log("init triggered");
        this.addEventListeners();
        this.waitForPageshow().then(() => {
            console.log("pageshow event finished, loading data...");
            this.initialLoad();
        }).catch(() => {
            console.error("pageshow event failed or wasn't triggered.");
        });
    }
}
