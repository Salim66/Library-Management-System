;(function($){
    $(document).ready(function(){

        //add user modal
        $(document).on('submit', '#user_add_form', function(e){
            e.preventDefault();

            $.ajax({
                url: '/register',
                method: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data){
                    $('.success_message').append(`<p class="alert alert-success">${data}<button class="close" data-dismiss="alert">&times;</button></p>`);
                    $('#all_user_table_data').DataTable().ajax.reload();
                }
            });
        });

        //add book modal
        $(document).on('submit', '#book_add_form', function(e){
            e.preventDefault();

            $.ajax({
                url: '/add-book',
                method: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data){
                    $('.b_success_message').append(`<p class="alert alert-success">${data}<button class="close" data-dismiss="alert">&times;</button></p>`);
                    $('#all_book_table_data').DataTable().ajax.reload();
                }
            });
        });

        //all user data fetch by yajra datatable
        $('#all_user_table_data').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/all-user'
            },
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'action',
                    name: 'action'
                },

            ]
        });

        //all book data fetch by yajra datatable
        $('#all_book_table_data').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/all-book'
            },
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'action',
                    name: 'action'
                },

            ]
        });


        // user edit
        $(document).on('click', '.edit_user', function(e){
            e.preventDefault();
            let edit_id = $(this).attr('edit_id');

            $.ajax({
                url: '/edit-user/'+edit_id,
                method: 'GET',
                success: function (data) {
                    $('.user_name').val(data.name);
                    $('.user_email').val(data.email);
                    $('.user_id').val(data.id);

                    jQuery('#user_edit_modal').modal('show');
                 }
            });


        });


        // book edit
        $(document).on('click', '.edit_book', function(e){
            e.preventDefault();
            let edit_id = $(this).attr('edit_id');

            $.ajax({
                url: '/edit-book/'+edit_id,
                method: 'GET',
                success: function (data) {
                    $('.book_name').val(data.name);
                    $('.book_id').val(data.id);

                    jQuery('#book_edit_modal').modal('show');
                 }
            });


        });

        // user update
        $(document).on('submit', '#user_update_form', function(e){
            e.preventDefault();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'user-update',
                method: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data){
                    $('.success_message').append(`<p class="alert alert-success">${data}<button class="close" data-dismiss="alert">&times;</button></p>`);
                    $('#all_user_table_data').DataTable().ajax.reload();
                    jQuery('#user_edit_modal').modal('hide');
                }
            });
        });

        // book update
        $(document).on('submit', '#book_update_form', function(e){
            e.preventDefault();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'book-update',
                method: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data){
                    $('.b_success_message').append(`<p class="alert alert-success">${data}<button class="close" data-dismiss="alert">&times;</button></p>`);
                    $('#all_book_table_data').DataTable().ajax.reload();
                    jQuery('#book_edit_modal').modal('hide');
                }
            });
        });

        // User delete
        $(document).on('click', '.delete_user', function(e){
            e.preventDefault();
            let delete_id = $(this).attr('delete_id');

            let condi = confirm('Are your Sure?');

            if(condi){
                $.ajax({
                    url: 'user-delete/'+delete_id,
                    method: 'GET',
                    success: function(data){
                        $('.success_message').append(`<p class="alert alert-success">${data}<button class="close" data-dismiss="alert">&times;</button></p>`);
                        $('#all_user_table_data').DataTable().ajax.reload();
                    }
                });
            }


        });

        // Book delete
        $(document).on('click', '.delete_book', function(e){
            e.preventDefault();
            let delete_id = $(this).attr('delete_id');

            let condi = confirm('Are your Sure?');

            if(condi){
                $.ajax({
                    url: 'book-delete/'+delete_id,
                    method: 'GET',
                    success: function(data){
                        $('.b_success_message').append(`<p class="alert alert-success">${data}<button class="close" data-dismiss="alert">&times;</button></p>`);
                        $('#all_book_table_data').DataTable().ajax.reload();
                    }
                });
            }


        });




    });
})(jQuery);
