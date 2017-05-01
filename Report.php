<html>
<head>
	<script
  		src="https://code.jquery.com/jquery-3.2.1.min.js"
  		integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  		crossorigin="anonymous">
	</script>

	<style>
table, th, td {
    border: 1px solid pink;
}

button {
    background-color:rgba(255, 0, 0, 0.2); /* Green */
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
    border: 2px solid pink;
    border-radius: 4px;
}
</style>
</head>
<body>


	  <h2>Search Customer</h2>
	  Search by Country Code
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
