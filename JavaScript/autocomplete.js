 createFormAutoComplete: (function(target, position){
        position = position || { my: "left top", at: "left bottom", collision: "none" };
        $(target).autocomplete({
            minLength: 2,
            delay: 500,
            'position': position,
            select: function(event, ui) {
                //console.debug('select', event, ui.item);
                $('input[name="localizacao[string]"]').val(ui.item.address);
                $('input[name="localizacao[rua]"]').val(ui.item.street);
                $('input[name="localizacao[bairro]"]').val(ui.item.neighborhood);
                $('input[name="localizacao[cidade]"]').val(ui.item.city);
                $('input[name="localizacao[estado]"]').val(ui.item.state);
                $('input[name="localizacao[pais]"]').val(ui.item.country);
                $('input[name="localizacao[cep]"]').val(ui.item.postal_code);
                $('input[name="localizacao[latitude]"]').val(ui.item.latitude);
                $('input[name="localizacao[longitude]"]').val(ui.item.longitude);
                $('input[name="localizacao[region]"]').val(ui.item.latitude);
                $('input[name="localizacao[district]"]').val(ui.item.longitude);
                $('input[name="localizacao[find_type]"]').val(ui.item.find_type);
                $("#btnBuscar, #btnBuscar1").removeAttr('disabled');
                return false;
            },
            // focus: function( event, ui ) { // $('input[name="localizacao[string]"]').val(ui.item.address); //console.debug('focus', event); return false; },
            source: function(request, response) {
                $.ajax({
                        url: window.location.origin + '/api/uh/location/search',
                        data: { 'location': request.term },
                        dataType: 'json',
                        method: 'POST',
                    })
                    .done(function(data) {
                        // console.debug(data.response);
                        response(data.response);
                    });
            }
        }).autocomplete("instance")._renderItem = function(ul, item) {
            // console.debug('_renderItem', arguments);
            var li = $("<li>");
            var innerHtml = '<a class="dropdown-item" href="#" role="option">' + item.address + '</a>'
            if (item.find_type === 'condominium') {
                var cHtml = '<strong>Cond.: ' + item.nomecondominio + '</strong><br /><small>';
                cHtml += item.street + '<br />';
                //cHtml += item.location_neighborhood + ' - ';
                cHtml += item.city + ' - ';
                cHtml += item.state + '</small>';
                innerHtml = '<a class="dropdown-item" href="#" role="option">' + cHtml + '</a>'
            }
            return $("<li>").append(innerHtml).appendTo(ul);
        };

        $(target).autocomplete("instance")._renderMenu = (function(ul, items) {
            //console.debug('_renderMenu', arguments);
            var that = this;
            ul.attr("class", "nav nav-pills nav-stacked bs-autocomplete-menu");
            $.each(items, function(index, item) {
                that._renderItemData(ul, item);
            });
        });

        return $(target);
    }),
    createAutoComplete: (function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-XSRF-TOKEN': Cookies.get('XSRF-TOKEN'),
                'X-Requested-With': 'XMLHttpRequest',
            }
        });
        bmp.custom.createFormAutoComplete('#txtAddress');
    }),
};
