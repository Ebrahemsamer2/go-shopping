let appendParam = (filters) => {
    let url = new URL(window.location.href);
    for(let key in filters) {
        url.searchParams.set(key, filters[key]);
    }
    window.location.replace(url.href);
};