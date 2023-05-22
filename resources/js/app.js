import './bootstrap';
import './index';
import SearchCustomer from './searchCustomer';
import GetCustomerInfo from './getCustomerInfo';

if(document.getElementById('reapp')){
    // Initiate search customer class function
    new SearchCustomer()
}

if(document.getElementById('newapp')){
    // Initiate new application on click class function
    const newApp = new GetCustomerInfo()
    newApp.newApplication()
}