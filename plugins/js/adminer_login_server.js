
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

       $("select[name='auth[driver]'] option[value='"+tr.find('.driver')+"']").prop('selected', true);

       // $('input[type=submit][value="Войти"]').click();
   });
});