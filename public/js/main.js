// UI Elements
const prodCards = document.querySelectorAll('a.prod-card')


// EventListeners
prodCards.forEach(card => {
    card.addEventListener('mouseenter', () => {
        card.querySelector('p.card-price').style.display = 'none'
        const newEl = document.createElement('p')
        newEl.className = 'text-gray-800 underline'
        newEl.innerText = 'Read More'
        card.append(newEl)
    })
    card.addEventListener('mouseleave', () => {
        card.querySelector('p.underline').remove()
        card.querySelector('p.card-price').style.display = 'block'
    })
})
