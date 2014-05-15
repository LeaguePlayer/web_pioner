

$(document).ready(function() {


    $('#Place_address').kladr({
        token: '53707468fca916a17f3e34e1',
        key: 'd0979b6bdc60bee4849ec26f7bb0a23d6ec9d70d',
        type: $.kladr.type.street,
        parentType: $.kladr.type.city,
        parentId: '7200000100000',
        withParents: true,
        labelFormat: function(obj, query) {
            var result = '';
            for(var i in obj.parents) {
                if ( obj.parents[i].type == 'Область' )
                    continue;
                result += obj.parents[i].typeShort + '. ' + obj.parents[i].name + ', ';
            }
            result += obj.typeShort + '. ' + obj.name;
            return result;
        },
        valueFormat: function(obj, query) {
            var result = '';
            for(var i in obj.parents) {
                if ( obj.parents[i].type == 'Область' )
                    continue;
                result += obj.parents[i].typeShort + '. ' + obj.parents[i].name + ', ';
            }
            result += obj.typeShort + '. ' + obj.name;
            return result;
        }
    });
});
