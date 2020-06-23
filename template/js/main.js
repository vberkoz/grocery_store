
$(document).ready(function () {

    let bag = [];
    let likes = [];
    let bagItemsPrice = 0;
    let logged = 0;

    $.fn.inputFilter = function(inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
            let unit = $(this).attr("data-unit");
            if (unit === 'г') unit = 'шт';
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
    $(".add-to-bag-first").click(function (e) {
        let id = $(this).attr("data-id");
        let volume = 1;
        let unit = $(this).attr("data-unit");
        if (unit === 'г') unit = 'шт';
        unit = ' ' + unit;
        $(this).get(0).classList.add("d-none");
        $(this).get(0).nextSibling.nextSibling.classList.remove("d-none");
        $(this).get(0).nextSibling.nextSibling.children[1].value = volume + unit;
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
    $(".add-to-bag-second").click(function (e) {
        let id = $(this).attr("data-id");
        let volumeMin = parseFloat($(this).attr("data-volume_min"));
        let volumePrev = $(this).get(0).parentElement.previousSibling.previousSibling.value;
        volumePrev = volumePrev.slice(0, -3);
        volumePrev = parseFloat(volumePrev);
        let volume = Math.round((volumePrev + volumeMin) * 10) / 10;
        let unit = $(this).attr("data-unit");
        if (unit === 'г') unit = 'шт';
        unit = ' ' + unit;
        $(this).get(0).parentElement.previousSibling.previousSibling.value = volume + unit;
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
        if (unit === 'г') unit = 'шт';
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
    $(".remove-from-bag").click(function (e) {
        let id = $(this).attr("data-id");
        let volumeMin = parseFloat($(this).attr("data-volume_min"));
        let volumePrev = $(this).get(0).parentElement.nextSibling.nextSibling.value;
        volumePrev = volumePrev.slice(0, -3);
        volumePrev = parseFloat(volumePrev);
        let volume = Math.round((volumePrev - volumeMin) * 10) / 10;
        let unit = $(this).attr("data-unit");
        if (unit === 'г') unit = 'шт';
        unit = ' ' + unit;

        $(this).get(0).parentElement.nextSibling.nextSibling.value = volume + unit;

        if (volume < volumeMin) {
            $(this).get(0).parentElement.parentElement.classList.add("d-none");
            $(this).get(0).parentElement.parentElement.previousSibling.previousSibling.classList.remove("d-none");
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
        if (unit === 'г') unit = 'шт';
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
    $(".input-int, .input-float").change(function () {
        let unit = $(this).attr("data-unit");
        if (unit === 'г') unit = 'шт';
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
            $(this).get(0).parentElement.classList.add("d-none");
            $(this).get(0).parentElement.previousSibling.previousSibling.classList.remove("d-none");
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
        if (unit === 'г') unit = 'шт';
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

    $('.product-card').hover(
        function () {
            $(this).find('.add-to-bag-first').removeClass('invisible');
            $(this).find('.like').removeClass('invisible');
        },
        function () {
            $(this).find('.add-to-bag-first').addClass('invisible');
            if (!likes.includes($(this).attr('data-id'))) $(this).find('.like').addClass('invisible');
        }
    );

    $('.like').click(function () {
        if (logged) {
            let productId = $(this).attr('data-id');
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
                            let unit = 'кг';
                            if ($(this).attr("data-unit") === 'г') unit = 'шт';
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
                        let unit = 'кг';
                        let inputField = element.find('.bag-change');
                        if (inputField.attr("data-unit") === 'г') unit = 'шт';
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