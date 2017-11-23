
function toggle_panel(panel, background_layer) {

     if (panel.hasClass('speed-in')) {
         panel.removeClass('speed-in');
         background_layer.removeClass('is-visible');
     } else {
            panel.addClass('speed-in');
            background_layer.addClass('is-visible');
            }
}

function makeItem($template, product, picture='cats'){

    $template.find('.item').attr('productId', product["id"]);

    $template.find('.productName').text(product.name).attr('productName', product["name"]);

    $template.find('img').attr('src', "http://lorempixel.com/300/200/"+picture+"/" + (product.id + 1));

    $template.find('.productPrice').text('$' + product["price"]).attr('productPrice', product["price"]);

    $template.find('.productDescription').text(product["description"]);
    return $template;
    }
