
$(function () {

    // Filters
   $('select[name="filter_env"]').on('change', function () {
       var value = $(this).val();
       if(value){
           $('#connections tbody tr').each(function (index) {
               if($(this).find('.env').text() == value){
                   $(this).show();
               } else {
                   $(this).hide();
               }
           });
       } else {
            $('#connections tbody tr').show();
       }
   });

    // Connect for DB
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

    // CRUD for connections
    $('.add_connect').on('click', function (e) {
        e.preventDefault();
        var tr = $(this).closest('tr');

        $.post('/route.php?method=add_connect', {
            "name": tr.find('input[name=name]').val(),
            "host": tr.find('input[name=host]').val(),
            "env": tr.find('select[name=env]').val(),
            "port": tr.find('input[name=port]').val(),
            "user": tr.find('input[name=user]').val(),
            "password": tr.find('input[name=password]').val(),
            "driver": tr.find('select[name=driver]').val()
        }, function (data) {
            if(data=='1'){
                location.href = "";
            }
            else{
                alert('Already addeed');
            }
        }, 'json')
    });

    $('.remove_connect').on('click', function (e) {
        e.preventDefault();
        var tr = $(this).closest('tr');
        var name = tr.find('input[name=name]').val();

        if(confirm("Вы действительно хотите удалить подключение `"+name+"`?")) {
            $.post('/remove_connect/' + tr.find('input[name=name]').val(), function (data) {
                alert(data);
            }, 'json')
        }
    });
});