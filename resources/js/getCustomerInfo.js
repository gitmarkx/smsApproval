import axios from "axios";
import SearchCustomer from "./searchCustomer";

export default class GetCustomerInfo{
    constructor(){
        this.custID = document.getElementById('customer_id');
        this.fname = document.getElementById('fname');
        this.mname = document.getElementById('mname');
        this.lname = document.getElementById('lname');
        this.contactNo = document.getElementById('contactNo');
        this.address = document.getElementById('address');
        this.overlay = document.getElementById('search-overlay')
        this.searchResults = document.querySelector('.searchResults')
        this.newApp = document.getElementById('newapp')
    }

    getData(){
        this.getDataSrc = document.querySelectorAll('.searchResultsData li')
        this.getDataSrc.forEach(ele => {
            ele.addEventListener('click', (e) => {
                e.preventDefault()
                this.customerInfo(e.target.getAttribute('id'))
            })
        })
    }

    async customerInfo(id){
        await axios.get(`/searchCustomer/${id}`)
        .then(res => {
            this.custID.value = res.data.customers[0].id
            this.fname.value = res.data.customers[0].fname
            this.mname.value = res.data.customers[0].mname
            this.lname.value = res.data.customers[0].lname
            this.contactNo.value = res.data.customers[0].contactNo
            this.address.value = res.data.customers[0].address
            this.disabledInput()
            let closeall = new SearchCustomer()
            closeall.closeOverlay()
            closeall.hideResultsArea()
        })
        .catch(err => {
            return err
        })
    }

    disabledInput(){
        this.custID.readOnly = true
        this.fname.readOnly = true
        this.mname.readOnly = true
        this.lname.readOnly = true
        this.contactNo.readOnly = true
        this.address.readOnly = true
    }

    enableInput(){
        this.custID.readOnly = false
        this.fname.readOnly = false
        this.mname.readOnly = false
        this.lname.readOnly = false
        this.contactNo.readOnly = false
        this.address.readOnly = false
        
        this.custID.value = ''
        this.fname.value = ''
        this.mname.value = ''
        this.lname.value = ''
        this.contactNo.value = ''
        this.address.value = ''
    }

    newApplication(){
        this.newApp.addEventListener('change', (event) => {
            if (event.target.checked) {
                this.enableInput()
            }
        });
    }
}