function alpineInitStore(key) {
    document.addEventListener(
        'alpine:init',
        () => Alpine.store(key)
    );
}
