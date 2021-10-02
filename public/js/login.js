// UI Elements
const loginDiv = document.querySelector('#loginDiv')
const loginNavBtn = document.querySelector('#loginNavBtn')
const closeLogin = document.querySelector('#closeLogin')
const regiterBtn = document.querySelector('#registerBtn')
const loginBtn = document.querySelector('#loginBtn')

// EventListeners
loginNavBtn.addEventListener('click', (e) => {
    e.preventDefault();
    if (loginDiv.classList.contains('hidden')) {
        loginDiv.classList.remove('hidden')
    }
})

closeLogin.addEventListener('click', () => {
    loginDiv.classList.add('hidden')
})

loginDiv.addEventListener('click', (e) => {
    if (!e.target.closest('#loginChild')) {
        loginDiv.classList.add('hidden')
    }
})

registerBtn.addEventListener('click', (e) => {
    const parent = e.target.closest('#login-wrap')
    parent.classList.remove('block')
    parent.classList.add('u--fadeIn')
    setTimeout(() => {
        parent.classList.remove('u--fadeIn')
        parent.classList.add('hidden')
        parent.nextElementSibling.classList.remove('hidden')
        parent.nextElementSibling.classList.add('block')
    }, 350)
})

loginBtn.addEventListener('click', (e) => {
    const parent = e.target.closest('#register-wrap')
    parent.classList.remove('block')
    parent.classList.add('u--fadeIn')
    setTimeout(() => {
        parent.classList.remove('u--fadeIn')
        parent.classList.add('hidden')
        parent.previousElementSibling.classList.remove('hidden')
        parent.previousElementSibling.classList.add('block')
    }, 350)
})
