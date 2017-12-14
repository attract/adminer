
$(function () {

   $('select[name="auth[server]"]').on('change', function () {
       var driver = $('option:selected', this).attr('data-driver');
       $("input[name='auth[driver]']").val(driver);
       $('#selected_driver').html(driver);
   });

   $(".connect_to_db").on('click', function (e) {
       e.preventDefault();
       var tr = $(this).closest('tr');
       $('[name="auth[server]"]').val($(this).val());
       tr.find('.port');
       tr.find('.driver');
       tr.find('.host');
       tr.find('.user');
       tr.find('.password');

       alert(asd);
   });
});