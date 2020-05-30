
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

    /**
     * Allow digits only
     */
    $('.digits-only').inputFilter(function(value) {
        return /^\d*$/.test(value);
    });

    /**
     * Save order status
     */
    $('.order-status').change(function () {
        let order_id = $(this).attr('order-id');
        let order_status = $(this).val();
        $.post('/admin/order/update',
            {
                order_id: order_id,
                order_status: order_status
            }
        );
    });

    /**
     * Save user discount
     */
    $('.discount').change(function () {
        let user_id = $(this).attr('user-id');
        let user_discount = $(this).val();
        $.post('/admin/user/update',
            {
                user_id: user_id,
                user_discount: user_discount
            }
        );
    });

    // $('.product-record').hover(
    //     function () {
    //         $(this).find('.primary-actions').removeClass('invisible');
    //     },
    //     function () {
    //         $(this).find('.primary-actions').addClass('invisible');
    //     }
    // );
});