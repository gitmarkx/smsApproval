if(document.getElementById('btnStatusLog')){
    document.getElementById('btnStatusLog').addEventListener('click', () => {
        let modal = document.getElementById('statusLog')
        modal.classList.add('modal-overlay--visible')
    })
    
    document.querySelector('.modal-overlay-bg').addEventListener('click', function(e) {
        e.target.offsetParent.classList.remove('modal-overlay--visible')
    })
}

if(document.getElementById('formDeleteApp')){
    document.getElementById('formDeleteApp').addEventListener('submit', function(e) {
        e.preventDefault()
        if(confirm('Are you sure you want to delete this application?')){
            this.submit();
        }
    })
}

if(document.getElementById('formCancelApp')){
    document.getElementById('formCancelApp').addEventListener('submit', function(e) {
        e.preventDefault()
        if(confirm('Are you sure you want to cancel this application?')){
            this.submit();
        }
    })
}