/*
 * All actions of the administration interface.
 */

$(document).ready(function(){

    // Usergroups ///////////////////////////////////////////////////

    // Click on the 'Create a new usergroup' link.
    $('#administration_users_usergroup_create').bind( 'click', function (){

        // Reset elements
        $('#group_name').val( '' );
        $('#usergroup_id').val( '-1' );
        $('input:checkbox').removeAttr( 'checked' );

        // Call modal
        $('#create').modal();

    });

    // Click on the "Edit" button at the end of a usergroup line.
    $('.administration_users_usergroup_edit').bind( 'click', function(){

        var usergroup_id = $(this).attr('data-id');
        $.ajax({

            url: WEBSITE_ROOT + "administration/users/usergroups/load.json//" + usergroup_id

        }).done(function( data ){

            var element = $.parseJSON( data );

            $('#group_name').val( element.name );
            $('#usergroup_id').val( element.id );

            $('#create').modal();

        });

    });

    // Click on the "Delete" button at the end of a usergroup line
    $('.administration_users_usergroup_delete').bind( 'click', function(){



    });

});
