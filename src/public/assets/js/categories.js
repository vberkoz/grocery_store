

(() => {
    $.get(domain + 'categories/index', r => {
        r = JSON.parse(r);
        r.push(r.splice(0, 1)[0]);
        let navCategories = '';
        r.map(i => {
            if (i.visible) {
                navCategories += `<a class="dropdown-item" href="/public/category/${i.slug}.html">${i.title}</a>`;
            }
        });
        document.getElementById('category_dd').innerHTML = navCategories;
    });
})();
