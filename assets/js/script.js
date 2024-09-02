let saludo = false;
let ultimoIndiceOferta = -1;
let tourPackages = [];

// Cargar los datos del archivo JSON
function cargarTourPackages() {
    fetch('data/tourPackages.json')
        .then(response => response.json())
        .then(data => {
            tourPackages = data;
            initialize();
        })
        .catch(error => console.error('Error al cargar los paquetes turísticos:', error));
}

function initialize() {
    showMensajeBienvenida();
    setTimeout(() => {
        checkOfertaEspecial();
        setInterval(() => {
            document.querySelectorAll('.notificacion[data-id]').forEach(notificacion => notificacion.remove());
            checkOfertaEspecial();
        }, 10000);
    }, 10000);
}

function search(event) {
    event.preventDefault(); // Previene el envío del formulario para validación

    const destinationInput = document.getElementById('destination');
    const travelDateInput = document.getElementById('travel-date');

    const searchValue = destinationInput.value.trim().toLowerCase();
    const travelDate = travelDateInput.value;

    // Validacion solo por destino en caso de que el usuario no tenga fecha exacta de viaje
    if (!searchValue) {
            alert('Por favor, complete el campo de destino.');
            destinationInput.focus();

        return;
    }

    // Filtrar los paquetes
    const filteredPackages = tourPackages.filter(pkg => {
        const countryMatch = pkg.country.toLowerCase().includes(searchValue);
        const destinationMatch = pkg.destination.toLowerCase().includes(searchValue);
        const dateMatches = !travelDate || pkg.date === travelDate;

        return (countryMatch || destinationMatch) && dateMatches;
    });

    // Actualizar resultados
    updateResults(filteredPackages);
}

function updateResults(packages) {
    const resultsContainer = document.querySelector('#results-container .row');
    resultsContainer.innerHTML = packages.length === 0
        ? '<p>No se encontraron paquetes.</p>'
        : packages.map(pkg => `
            <div class="col">
                <div class="card h-100 ${pkg.offer ? 'offer' : ''}">
                    <img src="${pkg.image}" class="card-img-top" alt="${pkg.destination} en ${pkg.country}">
                    <div class="card-body">
                        <h5 class="card-title">${pkg.destination}</h5>
                        <p class="card-text">Fecha: ${pkg.date}</p>
                        <p class="card-text">Precio: $${pkg.price.toLocaleString()}</p>
                        ${pkg.offer ? '<p class="text-danger"><strong>¡Oferta Especial!</strong></p>' : ''}
                    </div>
                </div>
            </div>
        `).join('');
}

function showNotificacion(message, uniqueId = '') {
    if (uniqueId && document.querySelector(`.notificacion[data-id="${uniqueId}"]`)) return;

    const notificacion = document.createElement('div');
    notificacion.className = 'notificacion';
    notificacion.innerText = message;
    if (uniqueId) notificacion.dataset.id = uniqueId;
    document.body.appendChild(notificacion);

    setTimeout(() => notificacion.remove(), 5000);
}

function showMensajeBienvenida() {
    if (!saludo) {
        showNotificacion('Hola, ¡bienvenid@ a nuestra agencia de viajes!');
        saludo = true;
    }
}

function checkOfertaEspecial() {
    const ofertaPackages = tourPackages.filter(pkg => pkg.offer);
    if (ofertaPackages.length > 0) {
        ultimoIndiceOferta = (ultimoIndiceOferta + 1) % ofertaPackages.length;
        const pkg = ofertaPackages[ultimoIndiceOferta];
        showNotificacion(`¡Oferta Especial en ${pkg.destination}! Precio: $${pkg.price.toLocaleString()}`, pkg.destination);
    }
}


//semana 5 botones de incrementar y decrementar viaja x chile
function changeQuantity(button, delta) {
    var input = button.parentElement.querySelector('.quantity-input');
    var currentValue = parseInt(input.value);
    var newValue = currentValue + delta;
    if (newValue >= 1) {
        input.value = newValue;
    }
}


// Configurar el manejador del formulario
document.addEventListener('DOMContentLoaded', () => {
    cargarTourPackages();
    document.getElementById('.search-container').addEventListener('submit', search);
});


