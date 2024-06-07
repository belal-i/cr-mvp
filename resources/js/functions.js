function mountSplides(num) {
    for (i = 0; i < num; i++) {
        new Splide('#splide-' + i, {
            pagination: false,
            perPage: 1,
            cover: true,
            height: '200px',
            lazyLoad: 'nearby',
        }).mount();
    }
}
