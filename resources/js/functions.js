function mountSplides(num)
{
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

function crSplideGoToRoom(room)
{
    /*
     * TODO: In the backend, we can construct the "room boxes".
     * Now, in the frontend, we just need some way to determine the correct
     * "splide index" based on the room, then we can simply call the 'go'
     * method to jump to that slide.
     * */

    // TODO: Figure this out dynamically.
    var n = 5;
    splide.go(n)
}
