
$(document).ready(function () {

    let bag = [];
    let likes = [];
    let bagItemsPrice = 0;
    let logged = 0;

    $.fn.inputFilter = function(inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
            let unit = $(this).attr("data-unit");
            unit = ' ' + unit;
            let volume = this.value;

            if (volume.includes(unit)) {
                volume = this.value.slice(0, -3);
            }

            if (this.selectionStart > this.value.length - 3) {
                this.setSelectionRange(this.value.length - 3, this.value.length - 3);
            }

            if (inputFilter(volume)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
        });
    };

    /**
     * Allow float only
     */
    $(".input-float, .bag-input-float").inputFilter(function(value) {
        return /^[0-9]{0,3}([\.][0-9]{0,1})??$/.test(value);
    });

    /**
     * Allow integer only
     */
    $(".input-int, .bag-input-int").inputFilter(function(value) {
        return /^[0-9]{0,2}?$/.test(value);
    });

    /**
     * Add product to bag
     */
    $("#products").on("click", ".add-to-bag-first", (e) => {
        let element = e.target.closest(".add-to-bag-first");
        let id = $(element).attr("data-id");
        let volume = 1;
        let unit = $(element).attr("data-unit");
        unit = ' ' + unit;
        $(element).get(0).classList.add("d-none");
        $(element).get(0).nextSibling.nextSibling.classList.remove("d-none");
        $(element).get(0).nextSibling.nextSibling.children[1].value = volume + unit;
        $.post('/bag/add', {
            id: id,
            volume: volume
        }, function (r) {
            $("#bag-count").html(r);
        });
        return false;
    });

    /**
     * Add product to bag
     */
    $("#products").on("click", ".add-to-bag-second", (e) => {
        let element = e.target.closest(".add-to-bag-second");
        let id = $(element).attr("data-id");
        let volumeMin = parseFloat($(element).attr("data-volume_min"));
        let volumePrev = $(element).get(0).parentElement.previousSibling.previousSibling.value;
        volumePrev = volumePrev.slice(0, -3);
        volumePrev = parseFloat(volumePrev);
        let volume = Math.round((volumePrev + volumeMin) * 10) / 10;
        let unit = $(element).attr("data-unit");
        unit = ' ' + unit;
        $(element).get(0).parentElement.previousSibling.previousSibling.value = volume + unit;
        $.post('/bag/add', {
            id: id,
            volume: volume
        }, function (r) {
            $("#bag-count").html(r);
        });
        return false;
    });

    $(".bag-plus").click(function () {
        let id = parseInt($(this).attr("data-id"));
        let volumeMin = parseFloat($(this).attr("data-volume_min"));
        let volumePrev = $(this).get(0).parentElement.previousSibling.previousSibling.value;
        volumePrev = volumePrev.slice(0, -3);
        volumePrev = parseFloat(volumePrev);
        let volume = Math.round((volumePrev + volumeMin) * 10) / 10;
        let unit = $(this).attr("data-unit");
        unit = ' ' + unit;
        $(this).get(0).parentElement.previousSibling.previousSibling.value = volume + unit;

        let bagItemData;
        let discount = 0;
        bag.forEach(function (i) {
            if (i.id === id) {
                i.quantity = volume;
                i.item_total = volume * i.price;
                bagItemData = i;
            }
            discount += i.quantity * i.discount;
        });

        bagItemsPrice = 0;
        bag.forEach(function (i) {
            bagItemsPrice += i.item_total;
        });
        $('.bag-items-price').text(
                new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 })
                    .format(bagItemsPrice) + ' ₴'
            );
        $('.bag-discount').text(
                new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 })
                    .format(discount) + ' ₴'
            );
        $('.bag-total').text(
                new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 })
                    .format(bagItemsPrice - discount) + ' ₴'
            );

        $(`tr[bag-item-id='${id}']`).find('.item-total').text(
                new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 })
                    .format(bagItemData.item_total) + ' ₴'
            );

        $.post('/bag/add', {
            id: id,
            volume: volume
        }, function (res) {
            $("#bag-count").html(res);
        });
        return false;
    });

    /**
     * Remove product from bag
     */
    $("#products").on("click", ".remove-from-bag", (e) => {
        let element = e.target.closest(".remove-from-bag");
        let id = $(element).attr("data-id");
        let volumeMin = parseFloat($(element).attr("data-volume_min"));
        let volumePrev = $(element).get(0).parentElement.nextSibling.nextSibling.value;
        volumePrev = volumePrev.slice(0, -3);
        volumePrev = parseFloat(volumePrev);
        let volume = Math.round((volumePrev - volumeMin) * 10) / 10;
        let unit = $(element).attr("data-unit");
        unit = ' ' + unit;

        $(element).get(0).parentElement.nextSibling.nextSibling.value = volume + unit;

        if (volume < volumeMin) {
            $(element).get(0).parentElement.parentElement.classList.add("d-none");
            $(element).get(0).parentElement.parentElement.previousSibling.previousSibling.classList.remove("d-none");
        }

        $.post('/bag/reduce', {
            id: id,
            volume: volume
        }, function (r) {
            $('#bag-count').html(r);
        });

        return false;
    });

    $(".bag-minus").click(function () {
        let id = parseInt($(this).attr("data-id"));
        let volumeMin = parseFloat($(this).attr("data-volume_min"));
        let volumePrev = $(this).get(0).parentElement.nextSibling.nextSibling.value;
        volumePrev = volumePrev.slice(0, -3);
        volumePrev = parseFloat(volumePrev);
        let volume = Math.round((volumePrev - volumeMin) * 10) / 10;
        let unit = $(this).attr("data-unit");
        unit = ' ' + unit;

        $(this).get(0).parentElement.nextSibling.nextSibling.value = volume + unit;

        if (volume < volumeMin) {
            $(this).get(0).parentElement.parentElement.parentElement.parentElement.remove();
        }

        let bagItemData;
        let discount = 0;
        bag.forEach(function (i) {
            if (i.id === id) {
                i.quantity = volume;
                i.item_total = volume * i.price;
                bagItemData = i;
            }
            discount += i.quantity * i.discount;
        });

        bagItemsPrice = 0;
        bag.forEach(function (i) {
            bagItemsPrice += i.item_total;
        });
        $('.bag-items-price').text(
            new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 })
                .format(bagItemsPrice) + ' ₴'
        );
        $('.bag-discount').text(
            new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 })
                .format(discount) + ' ₴'
        );
        $('.bag-total').text(
            new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 })
                .format(bagItemsPrice - discount) + ' ₴'
        );

        $(`tr[bag-item-id='${id}']`).find('.item-total').text(
            new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 })
                .format(bagItemData.item_total) + ' ₴'
        );

        $.post('/bag/reduce', {
            id: id,
            volume: volume
        }, function (r) {
            $('#bag-count').html(r);
            if (r === '' || r === '0') window.location.href = "/bag";
        });
        return false;
    });

    /**
     * Change products quantity
     */
    $("#products").on("change", ".input-int, .input-float", (e) => {
        let element = e.target.closest(".input-int, .input-float");
        let unit = $(element).attr("data-unit");
        unit = ' ' + unit;
        let volume = $(element).get(0).value;

        if (volume.includes(unit)) {
            volume = volume.slice(0, -3);
        }

        let id = parseInt($(element).attr("data-id"));
        let quantity = parseFloat(volume);
        $(element).get(0).value = quantity + unit;

        if (!quantity) {
            quantity = 0;
            $(element).get(0).parentElement.classList.add("d-none");
            $(element).get(0).parentElement.previousSibling.previousSibling.classList.remove("d-none");
        }

        $.post('/bag/change', {
            id: id,
            quantity: quantity
        }, function (r) {
            $('#bag-count').html(r);
        });
    });

    $(".bag-input-float, .bag-input-int").change(function () {
        let unit = $(this).attr("data-unit");
        unit = ' ' + unit;
        let volume = $(this).get(0).value;

        if (volume.includes(unit)) {
            volume = volume.slice(0, -3);
        }

        let id = parseInt($(this).attr("data-id"));
        let quantity = parseFloat(volume);
        $(this).get(0).value = quantity + unit;

        if (!quantity) {
            quantity = 0;
            $(`tr[bag-item-id='${id}']`).remove();
        }

        let bagItemData;
        let discount = 0;
        bag.forEach(function (i) {
            if (i.id === id) {
                i.quantity = parseInt(quantity);
                i.item_total = parseInt(quantity) * i.price;
                bagItemData = i;
            }
            discount += i.quantity * i.discount;
        });

        bagItemsPrice = 0;
        bag.forEach(function (i) {
            bagItemsPrice += i.item_total;
        });

        $('.bag-items-price').text(
            new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 })
                .format(bagItemsPrice) + ' ₴'
        );
        $('.bag-discount').text(
            new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 })
                .format(discount) + ' ₴'
        );
        $('.bag-total').text(
            new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 })
                .format(bagItemsPrice - discount) + ' ₴'
        );

        $(`tr[bag-item-id='${id}']`).find('.item-total').text(
            new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 })
                .format(bagItemData.item_total) + ' ₴'
        );

        $.post('/bag/change', {
            id: id,
            quantity: quantity
        }, function (r) {
            $('#bag-count').html(r);
            if (r === '' || r === '0') window.location.href = "/bag";
        });
    });

    $("#products").on("mouseenter", ".product-card", (e) => {
            $(e.target.closest(".product-card")).find('.add-to-bag-first').removeClass('invisible');
            $(e.target.closest(".product-card")).find('.like').removeClass('invisible');
        }
    );

    $("#products").on("mouseleave", ".product-card", (e) => {
            $(e.target.closest(".product-card")).find('.add-to-bag-first').addClass('invisible');
            if (!likes.includes($(e.target.closest(".product-card")).attr('data-id'))) $(e.target.closest(".product-card")).find('.like').addClass('invisible');
        }
    );

    $("#products").on("click", ".like", (e) => {
        if (logged) {
            let productId = $(e.target.closest(".like")).attr('data-id');
            if (likes.includes(productId)) {
                let index = likes.indexOf(productId);
                likes.splice(index, 1);
                $.post('/likes/remove', {id: productId});
            } else {
                likes.push(productId);
                $.post('/likes/add', {id: productId});
            }
        } else {
            window.location.href = "/signin";
        }
    });

    $.get('/bag/list', {}, function (r) {
        if (r) {
            r = JSON.parse(r);
            $("a[data-id]").each(function (i) {
                for (const p in r) {
                    if (parseInt($(this).attr("data-id")) === parseInt(p)) {
                        if (r[p] > 0) {
                            $(this).get(0).classList.add("d-none");
                            let inputGroup = $(this).get(0).nextSibling.nextSibling;
                            inputGroup.classList.remove("d-none");
                            let unit = $(this).attr("data-unit");
                            inputGroup.children[1].value = r[p] + ' ' + unit;
                        }
                    }
                }
            });
        }
    });

    $.get('/bag/data', {}, function (r) {
        if (r) {
            bag = JSON.parse(r);
            let discount = bag.pop();
            bagItemsPrice = 0;
            bag.forEach(function (i) {
                bagItemsPrice += i.item_total;
            });

            $('.bag-items-price').text(
                new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 })
                    .format(bagItemsPrice) + ' ₴'
            );
            $('.bag-discount').text(
                new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 })
                    .format(discount) + ' ₴'
            );
            $('.bag-total').text(
                new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 })
                    .format(bagItemsPrice - discount) + ' ₴'
            );

            $('.bag-item').each(function () {
                let element = $(this);
                let bagItemId = parseInt($(this).attr('bag-item-id'));
                let bagItemData;
                bag.forEach(function (i) {
                    if (i.id === bagItemId) {
                        bagItemData = i;
                        let inputField = element.find('.bag-change');
                        let unit = inputField.attr("data-unit");
                        element.find('.bag-change').get(0).value = i.quantity + ' ' + unit;
                    }
                });
                $(this).find('.item-total').text(
                    new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 })
                        .format(bagItemData.item_total) + ' ₴'
                );
                $(this).find('.item-price').text(
                    new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 })
                        .format(bagItemData.price) + ' ₴'
                );
            });
        }
    });

    $.get('/likes', {}, function (r) {
        if (JSON.parse(r)) {
            logged = 1;
            likes = JSON.parse(r);
            likes.forEach(function (i) {
                $('#products').children('.product-card').each(function () {
                    let elementId = $(this).attr("data-id");
                    if (elementId == i) $(this).find('.like').removeClass('invisible');
                });
            });
        }
    });

    $('#remind').click(function () {
        let email = $('#inputEmail').val();
        if (validateEmail(email)) {
            $('#inputEmail').removeClass('is-invalid');
            $('#invalidEmail').remove();
            $.post('/forgot', {email: email}, function (response) {
                $('#remindSuccess').removeClass('d-none');
            });
        } else {
            $('#inputEmail').addClass('is-invalid');
            $('#inputEmail').after('<div class="invalid-feedback">Невірний формат електронної пошти</div>');
        }
    });

    function validateEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
});

$(".product-index-search").keyup(function () {
    $.post('/search', {
        search_term: $(this).val(),
        user_id: $(this).attr("data-user-id")
    }, function (r) {
        $('.pager').remove();
        let products = '';
        JSON.parse(r).map(i => {
            let price = parseFloat(i.price)
            let currency = parseFloat(i.currency) || 0
            let percent = parseFloat(i.percent) || 0
            let discount = currency + (price / 100 * percent)

            products += `
            <div class="col-6 col-md-3 pl-1 pr-1 pb-2 product-card" data-id="${i.id}">
                <div class="card h-100">
                    <button class="btn btn-outline-primary border-0 btn-sm position-absolute float-right m-2 invisible like"
                            style="right: 0;z-index: 1;" data-id="${i.id}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 456" height="1.3em" fill="currentColor" class="align-middle pb-1">
                            <path d="m471.382812 44.578125c-26.503906-28.746094-62.871093-44.578125-102.410156-44.578125-29.554687 0-56.621094 9.34375-80.449218 27.769531-12.023438 9.300781-22.917969 20.679688-32.523438 33.960938-9.601562-13.277344-20.5-24.660157-32.527344-33.960938-23.824218-18.425781-50.890625-27.769531-80.445312-27.769531-39.539063 0-75.910156 15.832031-102.414063 44.578125-26.1875 28.410156-40.613281 67.222656-40.613281 109.292969 0 43.300781 16.136719 82.9375 50.78125 124.742187 30.992188 37.394531 75.535156 75.355469 127.117188 119.3125 17.613281 15.011719 37.578124 32.027344 58.308593 50.152344 5.476563 4.796875 12.503907 7.4375 19.792969 7.4375 7.285156 0 14.316406-2.640625 19.785156-7.429687 20.730469-18.128907 40.707032-35.152344 58.328125-50.171876 51.574219-43.949218 96.117188-81.90625 127.109375-119.304687 34.644532-41.800781 50.777344-81.4375 50.777344-124.742187 0-42.066407-14.425781-80.878907-40.617188-109.289063zm0 0"/>
                        </svg>
                    </button>
                    <div class="px-4 pt-4">
                        <img class="card-img-top" src="/template/images/${i.image}" alt="${i.title}">
                    </div>

                    <div class="card-body d-flex flex-column justify-content-between p-3">
                        <a href="#" class="add-to-bag-first btn btn-outline-primary btn-sm invisible" data-id="${i.id}" data-unit="${i.unit}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="1.3em" fill="currentColor" class="align-middle pb-1">
                                <path d="M447.988,139.696c-0.156-2.084-1.9-3.696-3.988-3.696h-72v-20C372,52.036,319.96,0,256,0S140,52.036,140,116v20H68    c-2.088,0-3.832,1.612-3.988,3.696l-28,368c-0.084,1.108,0.296,2.204,1.056,3.02C37.824,511.536,38.888,512,40,512h432    c1.112,0,2.176-0.464,2.932-1.28c0.756-0.816,1.14-1.912,1.056-3.02L447.988,139.696z M172,116c0-46.316,37.68-84,84-84    s84,37.684,84,84v20H172V116z M156,248c-22.06,0-40-17.944-40-40c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16    s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636C196,230.056,178.06,248,156,248z M356,248c-22.06,0-40-17.944-40-40    c0-15.964,8-30.348,24-36.66V208c0,8.824,7.18,16,16,16s16-7.176,16-16v-36.636c16,6.312,24,20.804,24,36.636    C396,230.056,378.06,248,356,248z"/>
                            </svg>
                        </a>

                        <div class="input-group input-group-sm d-none">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-outline-primary remove-from-bag" data-id="${i.id}" data-volume_min="${i.volume_min}" data-unit="${i.unit}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 459 459" height="0.6em" fill="currentColor" class="align-middle">
                                        <path d="M459.313,229.648c0,22.201-17.992,40.199-40.205,40.199H40.181c-11.094,0-21.14-4.498-28.416-11.774   C4.495,250.808,0,240.76,0,229.66c-0.006-22.204,17.992-40.199,40.202-40.193h378.936   C441.333,189.472,459.308,207.456,459.313,229.648z"/>
                                    </svg>
                                </button>
                            </div>

                            <input type="text" class="form-control text-center ${i.unit == 'шт' ? 'input-int' : 'input-float'}" data-id="${i.id}" data-unit="${i.unit}">

                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-primary add-to-bag-second" data-id="${i.id}" data-volume_min="${i.volume_min}" data-unit="${i.unit}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 448" height="0.8em" fill="currentColor" class="align-middle">
                                        <path d="m408 184h-136c-4.417969 0-8-3.582031-8-8v-136c0-22.089844-17.910156-40-40-40s-40 17.910156-40 40v136c0 4.417969-3.582031 8-8 8h-136c-22.089844 0-40 17.910156-40 40s17.910156 40 40 40h136c4.417969 0 8 3.582031 8 8v136c0 22.089844 17.910156 40 40 40s40-17.910156 40-40v-136c0-4.417969 3.582031-8 8-8h136c22.089844 0 40-17.910156 40-40s-17.910156-40-40-40zm0 0"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <p class="card-text pt-2" style="min-height: 48px;">${i.title}</p>

                        <div class="d-flex justify-content-between align-items-end">${i.volume} ${i.unit}
                            <div>
                                <div>
                                    <strike>
                                        ${(i.currency + (i.price / 100 * i.percent)) > 0 ? new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(price) + ' ₴' : ''}
                                    </strike>
                                </div>
                                <div>
                                    <strong>
                                        ${new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(price - discount) + ' ₴'}
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `
        })
        $('#products').html(products);
    })
});

/**
 * Slider
 */
let products = $('#featured_items').find('.product-card');
$('#featured_items').remove();

let slideIndex = 0;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function showSlides(n) {
    if (n > products.length - 1) slideIndex = 0;

    if (n < 0) {slideIndex = products.length - 1}

    let indices = [];
    for (let i = 0; i < products.length; i ++) indices.push(i);

    let visibleIndices = [];
    let currentElement = slideIndex;
    for (let i = 0; i < 4; i ++) {
        if (currentElement > products.length - 1) currentElement = 0;
        visibleIndices.push(indices[currentElement]);
        currentElement ++;
    }

    let visibleProducts = [];
    visibleIndices.map((item) => {
        visibleProducts.push(products[item]);
    });

    $('#slider').html(visibleProducts);
}