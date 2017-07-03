/**
 * Created by vadim on 7/3/17.
 */

$(function () {
    $('input[name=local-mysql]').on('click', function () {
        $("select[name='auth[server]'] option[value='172.17.0.1:3306']").prop('selected', true);
        $('select[name="auth[server]"]').change();
    });

    $('input[name=local-pgsql]').on('click', function () {
        $("select[name='auth[server]'] option[value='172.17.0.1:5432']").prop('selected', true);
        $('select[name="auth[server]"]').change();
    });

   $('select[name="auth[server]"]').on('change', function () {
       var driver = $('option:selected', this).attr('data-driver');
       $("input[name='auth[driver]']").val(driver);
       $('#selected_driver').html(driver);
   });
   $('select[name="auth[server]"]').change();
});