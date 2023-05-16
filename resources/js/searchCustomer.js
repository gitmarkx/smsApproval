import axios, { AxiosHeaders } from "axios";
import DOMPurify from "dompurify";
import GetCustomerInfo from "./getCustomerInfo";

export default class SearchCustomer{
    constructor(){
        this.injectHTML()
        this.reAppBox = document.getElementById('reapp')
        this.overlay = document.getElementById('search-overlay')
        this.overlayBg = document.querySelector('.search-wrap-bg')
        this.searchInput = document.querySelector('[name="searchInput"]')
        this.searchResults = document.querySelector('.searchResults')
        this.loaderIcon = document.querySelector(".circle-loader");
        this.typingWaitTimer;
        this.previousValue = "";
        this.event()
    }

    event(){
        this.searchInput.addEventListener("keyup", () => this.searchInputKeyPress())

        this.reAppBox.addEventListener('change', (event) => {
            if (event.target.checked) {
              this.openOverlay()
            }
        });

        this.overlayBg.addEventListener('click', (event) => {
            this.closeOverlay();
            this.reAppBox.checked = false;
        })

        document.addEventListener("keydown", (e) => {
            if(e.key == "Escape" && this.overlay.classList.contains('search-overlay--visible')){
                this.closeOverlay();
                this.reAppBox.checked = false;
            }
        })
    }

    searchInputKeyPress(){
        let value = this.searchInput.value

        if (value == "") {
            clearTimeout(this.typingWaitTimer);
            this.hideLoading();
            this.hideResultsArea();
        }

        if(value != "" && value != this.previousValue){
            clearTimeout(this.typingWaitTimer);
            this.showLoading();
            this.typingWaitTimer = setTimeout(() => {
                this.sendRequest()
            }, 500);
        }

        this.previousValue = value
    }

    async sendRequest(){
        const results = await axios(`/searchCustomer/${this.searchInput.value}`);
        this.renderResults(results.data.customers)
    }

    renderResults(results){
        if(results.length){
            this.searchResults.innerHTML = `
                <p class="my-3">(${
                    results.length > 1 ? `${results.length} customers found` : "1 customer found"
                })</p>

                <ul class="searchResultsData">
                    ${results.map((item) => {
                        return `
                            <li>
                                <a id="${item.id}" class="border-b p-2 block hover:bg-slate-100 cursor-pointer">${item.lname}, ${item.fname} ${item.mname}</a>
                            </li>
                        `
                    }).join('')}
                </ul>
            `
            let getData = new GetCustomerInfo()
            getData.getData()
            
        }else{
            this.searchResults.innerHTML = `<p class="my-3">Sorry, we could not find any results for that search.</p>`
        }
        this.hideLoading();
        this.showResultsArea();
    }

    showResultsArea() {
        this.searchResults.classList.add("searchResults--visible");
    }

    hideResultsArea() {
        this.searchResults.classList.remove("searchResults--visible");
        this.searchResults.innerHTML = ''
    }

    showLoading(){
        this.loaderIcon.classList.add("circle-loader--visible");
    }

    hideLoading() {
        this.loaderIcon.classList.remove("circle-loader--visible");
    }

    openOverlay(){
        this.overlay.classList.add('search-overlay--visible')
        setTimeout(() => this.searchInput.focus(), 50)
    }

    closeOverlay() {
        this.overlay.classList.remove("search-overlay--visible");
        this.searchInput.value = "";
    }

    injectHTML(){
        document.body.insertAdjacentHTML(
            "beforeend",
            `<div id="search-overlay" class="search-overlay">
                <div class="search-wrap-bg"></div>
                <div class="search-wrap w-full md:w-96 mx-auto p-3 md:mt-5 bg-white">
                    <input class="block w-full border border-gray-200 rounded p-2 pr-10 focus:outline-none focus:ring-1 focus:ring-violet-300" type="text" name="searchInput" value="" placeholder="Search customer name..." />
                    <div class="circle-loader"></div>
                    <div class="searchResults">
                    </div>
                </div>
            </div>`
        )
    }
}
