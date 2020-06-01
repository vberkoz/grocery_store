
// Restricts input for the set of matched elements to the given inputFilter function.
(function($) {
    $.fn.inputFilter = function(inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
            if (inputFilter(this.value)) {
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
}(jQuery));

$(document).ready(function () {

    let bag = [];
    let discount = 0;
    let bagItemsPrice = 0;

    /**
     * Add product to bag
     */
    $(".add-to-bag-first").click(function (e) {
        let id = $(this).attr("data-id");
        $(this).get(0).classList.add("d-none");
        $(this).get(0).nextSibling.nextSibling.classList.remove("d-none");
        $(this).get(0).nextSibling.nextSibling.children[1].value = 1;
        $.post(`/bag/add-ajax/${id}`, {}, function (res) {
            $("#bag-count").html(res);
        });
        return false;
    });

    /**
     * Add product to bag
     */
    $(".add-to-bag-second").click(function (e) {
        let id = $(this).attr("data-id");
        $(this).get(0).parentElement.previousSibling.previousSibling.value++;
        $.post(`/bag/add-ajax/${id}`, {}, function (res) {
            $("#bag-count").html(res);
        });
        return false;
    });

    $(".bag-plus").click(function () {
        let id = parseInt($(this).attr("data-id"));
        $(this).get(0).parentElement.previousSibling.previousSibling.value++;

        let bagItemData;
        bag.forEach(function (i) {
            if (i.id === id) {
                i.quantity = i.quantity + 1;
                i.item_total = i.item_total + i.price;
                bagItemData = i;
            }
        });

        bagItemsPrice = 0;
        bag.forEach(function (i) {
            bagItemsPrice += i.item_total;
        });
        $('.bag-items-price').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemsPrice) + ' ₴');
        $('.bag-discount').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemsPrice * (discount * 0.01)) + ' ₴');
        $('.bag-total').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemsPrice - (bagItemsPrice * (discount * 0.01))) + ' ₴');
        // $('.bag-total').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemsPrice) + ' ₴');

        $(`tr[bag-item-id='${id}']`).find('.item-total').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemData.item_total) + ' ₴');

        $.post(`/bag/add-ajax/${id}`, {}, function (res) {
            $("#bag-count").html(res);
        });
        return false;
    });

    /**
     * Remove product from bag
     */
    $(".remove-from-bag").click(function (e) {
        let id = $(this).attr("data-id");
        $(this).get(0).parentElement.nextSibling.nextSibling.value--;
        if ($(this).get(0).parentElement.nextSibling.nextSibling.value < 1) {
            $(this).get(0).parentElement.parentElement.classList.add("d-none");
            $(this).get(0).parentElement.parentElement.previousSibling.previousSibling.classList.remove("d-none");
        }
        $.post(`/bag/remove-ajax/${id}`, {}, function (r) {
            $('#bag-count').html(r);
        });
        return false;
    });

    $(".bag-minus").click(function () {
        let id = parseInt($(this).attr("data-id"));
        $(this).get(0).parentElement.nextSibling.nextSibling.value--;
        if ($(this).get(0).parentElement.nextSibling.nextSibling.value < 1) {
            $(this).get(0).parentElement.parentElement.parentElement.parentElement.remove();
        }

        let bagItemData;
        bag.forEach(function (i) {
            if (i.id === id) {
                i.quantity = i.quantity - 1;
                i.item_total = i.item_total - i.price;
                bagItemData = i;
            }
        });

        bagItemsPrice = 0;
        bag.forEach(function (i) {
            bagItemsPrice += i.item_total;
        });
        $('.bag-items-price').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemsPrice) + ' ₴');
        $('.bag-discount').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemsPrice * (discount * 0.01)) + ' ₴');
        $('.bag-total').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemsPrice - (bagItemsPrice * (discount * 0.01))) + ' ₴');
        // $('.bag-total').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemsPrice) + ' ₴');

        $(`tr[bag-item-id='${id}']`).find('.item-total').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemData.item_total) + ' ₴');

        $.post(`/bag/remove-ajax/${id}`, {}, function (r) {
            $('#bag-count').html(r);
            if (r === '' || r === '0') window.location.href = "/bag";
        });
        return false;
    });

    /**
     * Allow digits only
     */
    $(".change-bag").inputFilter(function(value) {
        return /^\d*$/.test(value);
    });

    /**
     * Change products quantity
     */
    $(".change-bag").keyup(function () {
        let id = parseInt($(this).attr("data-id"));
        let quantity = $(this).get(0).value;
        if (quantity === '' || quantity === '0') {
            $(this).get(0).parentElement.classList.add("d-none");
            $(this).get(0).parentElement.previousSibling.previousSibling.classList.remove("d-none");
        }
        $.post(`/bag/change-ajax/${id}`, {quantity: quantity}, function (r) {
            $('#bag-count').html(r);
        });
    });

    $(".bag-change").keyup(function () {
        let id = parseInt($(this).attr("data-id"));
        let quantity = $(this).get(0).value;
        if (quantity === '' || quantity === '0') {
            quantity = 0;
            $(`tr[bag-item-id='${id}']`).remove();
        }

        let bagItemData;
        bag.forEach(function (i) {
            if (i.id === id) {
                i.quantity = parseInt(quantity);
                i.item_total = parseInt(quantity) * i.price;
                bagItemData = i;
            }
        });

        bagItemsPrice = 0;
        bag.forEach(function (i) {
            bagItemsPrice += i.item_total;
        });
        $('.bag-items-price').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemsPrice) + ' ₴');
        $('.bag-discount').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemsPrice * (discount * 0.01)) + ' ₴');
        $('.bag-total').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemsPrice - (bagItemsPrice * (discount * 0.01))) + ' ₴');
        // $('.bag-total').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemsPrice) + ' ₴');

        $(`tr[bag-item-id='${id}']`).find('.item-total').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemData.item_total) + ' ₴');

        $.post(`/bag/change-ajax/${id}`, {quantity: quantity}, function (r) {
            $('#bag-count').html(r);
            if (r === '' || r === '0') window.location.href = "/bag";
        });
    });

    $('.product-card').hover(
        function () {
            $(this).find('.add-to-bag-first').removeClass('invisible');
        },
        function () {
            $(this).find('.add-to-bag-first').addClass('invisible');
        }
    );

    $.get('/bag/index-ajax', {}, function (r) {
        r = JSON.parse(r);
        $("a[data-id]").each(function (i) {
            for (const p in r) {
                if (parseInt($(this).attr("data-id")) === parseInt(p)) {
                    if (r[p] > 0) {
                        $(this).get(0).classList.add("d-none");
                        let inputGroup = $(this).get(0).nextSibling.nextSibling;
                        inputGroup.classList.remove("d-none");
                        inputGroup.children[1].value = r[p];
                    }
                }
            }
        });
    });

    $.get('/bag/data', {}, function (r) {
        bag = JSON.parse(r);

        discount = bag.pop();

        bagItemsPrice = 0;
        bag.forEach(function (i) {
            bagItemsPrice += i.item_total;
        });
        $('.bag-items-price').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemsPrice) + ' ₴');
        $('.bag-discount').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemsPrice * (discount * 0.01)) + ' ₴');
        $('.bag-total').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemsPrice - (bagItemsPrice * (discount * 0.01))) + ' ₴');

        $('.bag-item').each(function () {
            let bagItemId = parseInt($(this).attr('bag-item-id'));
            let bagItemData;
            bag.forEach(function (i) {
                if (i.id === bagItemId) bagItemData = i;
            });
            $(this).find('.item-total').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemData.item_total) + ' ₴');
            $(this).find('.item-price').text(new Intl.NumberFormat('uk-UA', { style: 'decimal', minimumFractionDigits: 2 }).format(bagItemData.price) + ' ₴');
        });
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