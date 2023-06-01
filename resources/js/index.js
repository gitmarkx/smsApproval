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
        const btnCancel = e.submitter.name === "Cancel";
        const btnDelete = e.submitter.name === "Delete";
        let clickEvent = document.getElementById('clickEvent')

        if(btnCancel){
            if(confirm('Are you sure you want to cancel this application?')){
                clickEvent.value = 'Cancel'
                this.submit();
            }
        }
        if(btnDelete){
            if(confirm('Are you sure you want to delete this application?')){
                clickEvent.value = 'Delete'
                this.submit();
            }
        } 
    })
}