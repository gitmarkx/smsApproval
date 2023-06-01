if(document.getElementById('btnStatusLog')){
    document.getElementById('btnStatusLog').addEventListener('click', () => {
        let modal = document.getElementById('statusLog')
        modal.classList.add('modal-overlay--visible')
    })
    
    document.querySelector('.modal-overlay-bg').addEventListener('click', function(e) {
        e.target.offsetParent.classList.remove('modal-overlay--visible')
    })
}

if(document.querySelector('.formDeleteApp')){
    document.querySelectorAll('.formDeleteApp').forEach((ele) => {
        ele.addEventListener('submit', function(e) {
            e.preventDefault()
            if(confirm('Are you sure you want to delete this application?')){
                this.submit();
            }
        })
    })
}

if(document.querySelector('.formCancelApp')){
    document.querySelectorAll('.formCancelApp').forEach((ele) => {
        ele.addEventListener('submit', function(e) {
            e.preventDefault()
            if(confirm('Are you sure you want to cancel this application?')){
                this.submit();
            }
        })
    })
}

if(document.getElementById('b-form-app')){
    document.getElementById('b-form-app').addEventListener('submit', function(e){
        e.preventDefault()
        const btnEvent =  e.submitter.name
        let clickEvent = document.getElementById('clickEvent')
        
        if(confirm('Are you sure you want to '+ btnEvent.toLowerCase() +' this application?')){
            clickEvent.value = btnEvent.charAt(0).toUpperCase() + btnEvent.slice(1).toLowerCase()
            this.submit();
        }
    })
}