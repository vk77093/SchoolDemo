<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>
    <table id="customers">
        <tr>
          <td><h2>
        <?php $image_path = 'AdminAsset/images/logo/logo-1.jpg';  ?>
        
        <img src="{{asset($image_path)}}" width="200" height="100">
      
          </h2></td>
          <td><h2>Test School ERP</h2>
      <p>School Address</p>
      <p>Phone : 343434343434</p>
      <p>Email : support@easylerningbd.com</p>
      <p> <b> Monthly and Yearly Profit </b> </p>
      
          </td> 
        </tr>
        
         
      </table>
      <table id="customers">
        <tr>
          <td colspan="2" style="text-align: center;">
            <h4>Reporting Date: {{ date('d M Y', strtotime($sdate) ) }} - {{ date('d M Y', strtotime($edate) ) }}</h4>
      
          </td>
        </tr>
        <tr>
          <td width="50%"><h4>Purpose</h4></td>
          <td width="50%"><h4>Amount</h4></td>
           
        </tr>
        <tr>
          <td>Student Fee </td>
          <td> {{ $studentFee}}</td>
          
        </tr>
      
          <tr>
          <td>Employee Salary </td>
          <td> {{ $empSalary }} </td>
           
        </tr>
      
        <tr>
          <td>Other Cost </td>
          <td> {{ $otherCost }} </td>
           
        </tr>
        <tr>
          <td>Total Cost</td>
          <td> {{ $totalCost }} </td>
         
        </tr>
      
        <tr>
          <td>Profit </td>
          <td>{{ $profit }}</td>
         
        </tr>
          
         
      </table>
      <br> <br>
        <i style="font-size: 10px; float: right;">Print Data : {{ date("d M Y") }}</i>
      
      <hr style="border: dashed 2px; width: 95%; color: #000000; margin-bottom: 50px">
</body>
</html>