# shopping-cart 

# Bootstrap-Admin-Theme-3

https://github.com/VinceG/Bootstrap-Admin-Theme-3

# mockapi.io

## products1.html

```js

var data = [];

    var url = 'https://5a2f94b9a871f00012678dc8.mockapi.io/products';
    
    // Fetch data from url

      $.ajax({
        url: url,
        method: 'GET'
      }).then(
        function(json_data) {

          console.log(json_data);
          
          for(var i in json_data)
          {
             data.push(json_data[i]);
          }
          console.log(data);
        
        });
```

## products2.html

```html

    <script type="text/template" id="trItem">
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>
          <button class="btn btn-default"><i class="glyphicon glyphicon-eye-open"></i> View</button>
          <button class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i> Update</button>
          <button class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
          <button class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</button>
        </td>
      </tr>
    </script>

```
## Fetch data from url

```js

var data = [];
var url = 'https://5a2f94b9a871f00012678dc8.mockapi.io/products';

    function makeTrItem(template, product){

        template.find('td').first().text(product["id"])
          .next().text(product["name"])
          .next().text(product["price"]);

        return template;
      }
   
    
// Fetch data from url

  $.ajax({
        url: url,
        method: 'GET'
        })
        .then(
          function(json_data) {

            for(var i in json_data)
            {
               data.push(json_data[i]);
            }
        
            for (var i=0; i<Object.keys(data).length; i++) {
              
              var $template = $($('#trItem').html());
             
              $(".table-items").append(makeTrItem($template, data[i]));
             
             }
        
  });

```
## Сзздаем строку таблицы

```js

function makeTrItem(template, product){

        template.find('td').first().text(product["id"]).next().text(product["name"]).next().text(product["price"]);

          template.find('td').last().find('.btn-default').click(function(){
            console.log('View product By Id ' + product["id"]);
          })

          template.find('td').last().find('.btn-primary').click(function(){
            console.log('Edit product By Id ' + product["id"]);
          })

          template.find('td').last().find('.btn-danger').click(function(){
            console.log('Delete product By Id ' + product["id"]);
          })

         return template;
      }
```
## Получаем элемент 

```js
  template.find('td').last().find('.btn-primary').click(function(){
    
    console.log('Edit product By Id ' + product["id"]);

    $.ajax({
      url: url+'/'+product["id"],
      method: 'GET'
      }).then(
            function(json_data) {
            
                console.log('View product By Id ' + json_data);   
              });
  });

```
## Шаблон формы

```html

<script type="text/template" id="formEdit">
  <div class="row">
    <div class="col-md-6">
      <div class="content-box-large">
        <div class="panel-heading">
          <div class="panel-title">Edit Item</div>
                       
          <div class="panel-options">
            <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
            <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
          </div>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" role="form">
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Product Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="Product Name">
              </div>
            </div>
            <div class="form-group">
              <label for="price" class="col-sm-2 control-label">Product Price</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="price" placeholder="Product Price">
              </div>
            </div>
            <div class="form-group">
              <label for="picture" class="col-sm-2 control-label">Product Picture</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="picture" placeholder="Product Picture">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Product Description</label>
              <div class="col-sm-10">
                <textarea class="form-control" placeholder="Product Description" rows="3" id="description"></textarea>
              </div>
            </div>
                                 
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Update Product</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</script>

```
## Строим форму

```js
          template.find('td').last().find('.btn-primary').click(function(){
            

            $.ajax({
              url: url+'/'+product["id"],
              method: 'GET'
            }).then(
              function(json_data) {
                                
                console.log('Edit product By Id ' + json_data['name']);   

               var formTemplate = $($('#formEdit').html());

               formTemplate.find('#name').val(json_data["name"]);
               formTemplate.find('#price').val(json_data["price"]);
               formTemplate.find('#picture').val(json_data["picture"]);
               formTemplate.find('#description').text(json_data["description"]);
               $("#main").empty();
               $("#main").append(formTemplate);


              });

```
## Удаление элемента

```js
          template.find('td').last().find('.btn-danger').click(function(){
            console.log('Delete product By Id ' + product["id"]);

            $.ajax({
              url: url+'/'+product["id"],
              method: 'DELETE'
            }).then(
              function(json_data) {
                console.log('Delete product By Id ' + json_data); 
                $("#tr" + product["id"]).remove();  
              });

          });

```
## Добавление элемента

```js

$('#add').click(function(){

            var formTemplate = $($('#formEdit').html());
               $("#main").empty();
               $("#main").append(formTemplate);
          });

```
## Добавление элемента

```js
          $('#add').click(function(){

            var formTemplate = $($('#formEdit').html());
               $("#main").empty();
               $("#main").append(formTemplate);
             
               $('#save').on('click', function(){

               $.ajax({
                   type: "POST",
                   url: url,
                   data: 
                    {
                        "price": $("#idForm").find("#price").val(),
                        "name":  $("#idForm").find("#name").val(),
                        "picture": $("#idForm").find("#picture").val(),
                        "description": $("#idForm").find("#descriptin").val()
                      },


               }).then(function(data){
                    console.log(data); // show response from the php script.

               });

             });

          });

```

## Редактирование элемента

```js
          template.find('td').last().find('.btn-primary').click(function(){

            $.ajax({
              url: url+'/'+product["id"],
              method: 'GET'
            }).then(
              function(json_data) {
               var formTemplate = $($('#formEdit').html());
               formTemplate.find('#name').val(json_data["name"]);
               formTemplate.find('#price').val(json_data["price"]);
               formTemplate.find('#picture').val(json_data["picture"]);
               formTemplate.find('textarea#description').val(json_data["description"]);

               formTemplate.find('.save').attr('id', 'update');
               
               $("#main").empty();
               $("#main").append(formTemplate);

               $('#update').on('click', function(){

                $.ajax({
                    url: url + '/'+ json_data["id"],
                    type: 'PUT',
                    withCredentials: true,
                    data: {
                        "id": json_data["id"],
                        "price": $("#idForm").find("#price").val(),
                        "name":  $("#idForm").find("#name").val(),
                        "picture": $("#idForm").find("#picture").val(),
                        "description": $("#idForm").find("textarea#description").val()
                    },
                    success: function(result) {
                        console.log('Updated product saccess'); 
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log('Error ', jqXHR, textStatus, errorThrown); 
                    }
                });
              });      
           });
          });

```