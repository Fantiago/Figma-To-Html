const galleryWrapper = document.querySelector('.gallery-wrapper');
const imageSets = document.querySelectorAll('.image-set');
const totalSets = imageSets.length;
const setWidth = 600; // Ajustar a 600 para coincidir con el CSS
const transitionSpeed = 500; // Velocidad de transición en milisegundos
let currentIndex = 1; // Empieza en 1 debido al clon inicial
let intervalID;

function moveToNextSet() {
    currentIndex++;
    galleryWrapper.style.transition = `transform ${transitionSpeed}ms ease-in-out`;
    galleryWrapper.style.transform = `translateX(-${currentIndex * setWidth}px)`;

    // Si llega al último clon, espera la transición y reajusta sin animación
    if (currentIndex === totalSets - 1) {
        setTimeout(() => {
            galleryWrapper.style.transition = 'none';
            currentIndex = 1;
            galleryWrapper.style.transform = `translateX(-${currentIndex * setWidth}px)`;
            setTimeout(() => {
                galleryWrapper.style.transition = `transform ${transitionSpeed}ms ease-in-out`;
            }, 50); // Breve espera para reiniciar la transición
        }, transitionSpeed);
    }
}

function startAutoSlide() {
    intervalID = setInterval(moveToNextSet, 5000); // Cambia cada 5 segundos
}

document.addEventListener('DOMContentLoaded', () => {
    // Configura la posición inicial sin transición
    galleryWrapper.style.transform = `translateX(-${currentIndex * setWidth}px)`;
    galleryWrapper.style.transition = 'none';

    // Aplicar la transición después de una breve pausa
    setTimeout(() => {
        galleryWrapper.style.transition = `transform ${transitionSpeed}ms ease-in-out`;
        startAutoSlide();
    }, 50); // Espera un corto período antes de aplicar la transición y comenzar el deslizamiento automático
});

