$('.opinionCheckbox').on('click', function () {
    $('.opinionCheckbox')
    $.ajax({
        url: `localhost:8000/isActive.php`,
    }).done();
});
