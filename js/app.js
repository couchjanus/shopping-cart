
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

      $template.find('.singleMember').attr('productId', product["id"]);


      $template.find('.product-name').text(product.name.replace(/ /g, '\u00a0')).attr('productName', product["name"]);

      $template.find('img').attr('src', "images/" + product.picture);

      $template.find('.product-price').text('$' + product["price"]).attr('productPrice', product["price"]);

      return $template;
    }
