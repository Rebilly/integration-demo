$(document).ready(function () {

    //Checkboxes
    $('.ui.checkbox').checkbox();

    //Popup
    $('.cvv').popup({
        on : 'click'
    });

    //Dropdown
    $('.ui.dropdown').dropdown();

    //Forms
    $('.withOther .ui.checkbox').on('click', function (){
        $(this).closest('.withOther').find('.why').toggleClass('disabled', !$(this).hasClass('other'));
    });



});
