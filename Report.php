
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
 <style>
body {
    margin: 0;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 10%;
    background-color: #f1f1f1;
    position: fixed;
    height: 100%;
    overflow: auto;
}

li a {
    display: block;
    color: #000;
    padding: 8px 16px;
    text-decoration: none;
}

li a.active {
    background-color: #4CAF50;
    color: white;
}

li a:hover:not(.active) {
    background-color: #555;
    color: white;
}
</style>
</head>
<body>

<ul>
  <!-- <li><a class="active" href="#home">หน้าแรก</a></li> -->
  <li><a class="active"  href="#news">ค้นหาสินค้า</a></li>

</ul>

<div style="margin-left:10%;padding:1px 16px;height:1000px;">
  <h2>SEARCH PRODUCT</h2>
<html>
<head>
	<script
  		src="https://code.jquery.com/jquery-3.2.1.min.js"
  		integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  		crossorigin="anonymous">
	</script>

	<style>
table, th, td {

    border: 1px solid gray;
    /*border-radius: 4px;*/
}

button {
    background-color:green; /* Green */
    border: none;
    color: white;
    padding: 8px  10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 4px 2px;
    cursor: pointer;
}
input[type=text] {
    width: 30%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 1px solid gray;
    /*border-radius: 4px;*/
}
</style>
</head>
<body>

	  Search by Product Name <br>
	  <input type="text" name="txtCountry" value="" id = "Product">
		<button class="button" name="Submit" value="Submit" id="Submit">Click</button>


	<div class ="" id = "result">

	</div>
  <div class = "" id = "result2">

  </div>
  <div class = "" id = "result3">

  </div>
  <div class = "" id = "result4">

  </div>

<br>
<table>
	<script type = "text/javascript">
		var URL = "http://977377searchproducts.azurewebsites.net/api/v1/Search/Products/ProductName/";
    var URL2 = "http://saleorderdetail.azurewebsites.net/OrderDetail/Search/ProductID/"


		$("#Submit").click(function(){
			URL += $("#Product").val();
			$.getJSON(URL,function(data){
				$("#result").append("<tr>");
				$("#result").append("<th>"+"ProductsID"+"</th>");
				$("#result").append("<th>"+"SalesOrderID"+"</th>");
				$("#result").append("<th>"+"OrderQty"+"</th>");
				$("#result").append("<th>"+"Price"+"</th>");
				$("#result").append("<th>"+"Total"+"</th>");
				$("#result").append("<th>"+"Customer Name"+"</th>");
				$("#result").append("</tr>");
				$.each(data,function(index,item){
          var row = "<td>"+item.ProductID+"</td>"
          URL2+=item.ProductID
          $.getJSON(URL2,function(data2){
            console.log(data2);
            $.each(data2,function(index2,item2){
              var row2 = "<td>"+item2.SalesOrderID+"</td>"+"<td>"+item2.OrderQty+"</td>"+"<td>"+item2.UnitPrice+"</td>"+"<td>"+(item2.OrderQty*item2.UnitPrice)+"</td>"
              var URL3 = "http://977377saleorderheader.azurewebsites.net/api/v1/salesOrderHeader/SalesOrderID/"
              URL3 +=item2.SalesOrderID;
              $.getJSON(URL3,function(data3){
                console.log(data3);
                $.each(data3,function(index3,item3){
                  var row3 = "<td" +item3.CustomerID+"</td>"
                  var URL4 = "http://customerservices.azurewebsites.net/Customers/Search/CustomerID/"
                  URL4 += item3.CustomerID
                  $.getJSON(URL4,function(data4){
                    console.log(data4);
                    $.each(data4,function(index4,item4){
                      var row4 = "<td>"+item4.FirstName+"</td>"
											$("#result").append("<tr>"+row+row2+row3+row4+"</tr>");
                    });
                  });
                });
              });
            });
          });
        });
			});
		});
	</script>
</table>
</body>
</html>


</div>

</body>
</html>
