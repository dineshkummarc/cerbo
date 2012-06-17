/*
 * All actions of the administration interface.
 */

$(document).ready(function(){

    // Usergroups ///////////////////////////////////////////////////

    // Click on the 'Create a new usergroup' link.
    $('#administration_users_usergroup_create').bind( 'click', function (){

        $('h3.create').css( 'display', 'block' );
        $('h3.edit').css( 'display', 'none' );

        // Reset elements
        $('#group_name').val( '' );
        $('#usergroup_id').val( '-1' );
        $('input:checkbox').removeAttr( 'checked' );

        // Call modal
        $('#create').modal();

    });

    // Click on the "Edit" button at the end of a usergroup line.
    $('.administration_users_usergroup_edit').bind( 'click', function(){

        $('h3.create').css( 'display', 'none' );
        $('h3.edit').css( 'display', 'block' );

        var usergroup_id = $(this).attr('data-id');
        $.ajax({

            url: WEBSITE_ROOT + "administration/users/usergroups/load.json//" + usergroup_id

        }).done(function( data ){

            var element = $.parseJSON( data );

            $('#group_name').val( element.name );
            $('#usergroup_id').val( element.id );
            $('input:checkbox').removeAttr( 'checked' );

            // Init policies

            $.each( element.policies, function( index, list ){
                $.each( list, function( id, value ){
                    check_name = index + '::' + value;
                    $('input[value="' + check_name + '"]').attr( 'checked', true );
                });
            });

            $('#create').modal();

        });

    });

    // Click on the "Delete" button at the end of a usergroup line
    $('.administration_users_usergroup_delete').bind( 'click', function(){

        // TODO Remove from DS with AJAX and remove it from DOM if success.

        $('tr[data-id="' + $(this).attr('data-id') + '"]').remove();

    });

});
