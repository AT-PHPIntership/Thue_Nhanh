var modCheckBox = $('.mod-checkbox');
var adminCheckBox = $('.admin-checkbox');

function banAccount(url) {
    $(document).on('click', ".btn-ban", function() {
        var userID = $(this).next().val();
        $('#ban-form').attr('action', url + '/' + userID);
    });
}

function setPermission(url) {
    $(document).on('click', ".btn-cogs", function() {
        var userID = $(this).next().val();
        $('#config-form').attr('action', url + '/' + userID);

        var nextElement = $(this).next().next();
        var role_1 = nextElement.val();
        var role_2 = nextElement.next().val();
        var roleMod = 'mod';
        var roleAdmin = 'admin';
        var roles = ['mod', 'admin'];

        if (roleMod == role_1 || roleMod == role_2) {
            check(modCheckBox);
        } else {
            uncheck(modCheckBox);
        }

        if (roleAdmin == role_1 || roleAdmin == role_2) {
            check(adminCheckBox)
        } else {
            uncheck(adminCheckBox)
        }
    });
}

function check(element) {
    element.prop('checked', 'checked');
}

function uncheck(element) {
    element.removeAttr('checked');
}
