
$(function () {

   $('select[name="auth[server]"]').on('change', function () {
       var driver = $('option:selected', this).attr('data-driver');
       $("input[name='auth[driver]']").val(driver);
       $('#selected_driver').html(driver);
   });

   $(".connect_to_db").on('click', function (e) {
       e.preventDefault();
       var tr = $(this).closest('tr');
       $('[name="auth[server]"]').val(tr.find('.host').text()+":"+tr.find('.port').text());
       $('[name="auth[username]"]').val(tr.find('.user').text());
       $('[name="auth[password]"]').val(tr.find('.password').text());
       $("select[name='auth[driver]'] option[value='"+tr.find('.driver').text()+"']").prop('selected', true);

       // Sybmit form
       $('input[type=submit][value="Войти"]').click();
   });

    $('.add_connect').on('click', function (e) {
        e.preventDefault();
        var tr = $(this).closest('tr');

        $.post('/add_connect', {
            "host": tr.find('.host').text(),
            "port": tr.find('.port').text(),
            "user": tr.find('.user').text(),
            "password": tr.find('.password').text(),
            "driver": tr.find('.driver').text(),
        }, function () {

        }, 'json')
    });
});