/**
 * Rebilly JS Token Handler
 * https://www.rebilly.com/api/jsdoc/
 */
(function () {
    "use strict";
    var fixWording = {
        '[pan]': {msg: 'Credit card number', target: '.pan'},
        '[cvv]': {msg: 'Credit card\'s CVV', target: '.cvv'},
        '[expMonth]:': {msg: 'Invalid expiry month: ', target: '.expMonth'},
        '[expYear]:': {msg: 'Invalid expiry year: ', target: '.expYear'}
    };
    var tokenCallback = function (response) {
        console.log(response);
        if (response.error) {
            //remove the loading
            $('#form-billing').removeClass('loading');
            var $errorSummary = $('.error-summary');
            var $list = $errorSummary.children('ul').empty();
            try {
                var data = JSON.parse(response.data);
                var i = 0, l = data.errors.length;
                for (; i < l; i++) {
                    var errorMsg = data.errors[i];
                    for(var word in fixWording) {
                        if (errorMsg.indexOf(word) > -1) {
                            errorMsg = errorMsg.replace(word, fixWording[word].msg);
                        }
                    }
                    $list.append($('<li/>').text(errorMsg));
                }
            } catch (e) {
                //JSON went wrong... damage control
                $list.append($('<li/>').text('Your credit card is invalid. Please check your number, CVV and expiry information.'));
            }
            $errorSummary.show();
        }
        else {
            $('#form-billing').append(
                $(document.createElement('input'))
                    .attr({name: 'rebillyToken', type: 'hidden'})
                    .val(response.data.token.id)
            ).get(0).submit();
        }
    };
    $('#form-billing').on('submit', function () {
        $(this).addClass('loading');
        Rebilly.createToken(this, tokenCallback);
        return false;
    });

})();
