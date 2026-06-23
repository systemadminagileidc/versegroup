import Splide from '@splidejs/splide';

/**
 * Create slide shows
 * @type {Splide}
 */
let splides = new Splide( '.splide', {
    type    : 'fade',
    autoplay: false,
    rewind: true,
    speed: 2000,
    interval: 6000,
    intersection: {
        inView: {
            autoplay: false,
        },
    }
});

/**
 * Autoplay on arrow change
 */
splides.on('arrows:updated',() => {
    if (splides.options.autoplay) {
        const { Autoplay } = splides.Components;
        Autoplay.play();
    }
});

/**
 * Export Sliders
 * @param Sliders
 */
export default Sliders => {
    splides.mount();
}
