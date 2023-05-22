document.getElementById('btnStatusLog').addEventListener('click', () => {
    let modal = document.getElementById('statusLog')
    modal.classList.add('search-overlay--visible')
})

document.querySelector('.search-wrap-bg').addEventListener('click', function(e) {
    e.target.offsetParent.classList.remove('search-overlay--visible')
})
