if(document.getElementById('btnStatusLog')){
    document.getElementById('btnStatusLog').addEventListener('click', () => {
        let modal = document.getElementById('statusLog')
        modal.classList.add('modal-overlay--visible')
    })
    
    document.querySelector('.modal-overlay-bg').addEventListener('click', function(e) {
        e.target.offsetParent.classList.remove('modal-overlay--visible')
    })
}