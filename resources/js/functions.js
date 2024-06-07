function mountSplides(num) {
    for (i = 0; i < num; i++) {
        new Splide('#splide-' + i, {
            pagination: false,
        }).mount();
    }
}
