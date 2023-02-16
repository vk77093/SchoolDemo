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
        <img src="{{(!empty($allData['0']['UserName']['profile_photo_path']) ? url($allData['0']['UserName']['profile_photo_path']) :url('AdminAsset/UserProfileImage/no_image.jpg'))}}">

    </h2></td>
    <td><h2>Easy School ERP</h2>
<p>School Address</p>
<p>Phone : 343434343434</p>
<p>Email : support@easylerningbd.com</p>
<p> <b>Student Result Report </b> </p>

    </td> 
  </tr>
  
   
</table>
 <br> <br>
 <strong>Result of : </strong> {{ $allData['0']['ExamTypeName']['exam_name'] }} 
 <br> <br>
<table id="customers">
   
  <tr>    
    <td width="50%"> <h4>Year / Session : </h4> {{ $allData['0']['YearName']['year_name'] }} </td>
    <td width="50%"> <h4> Class :  </h4>{{ $allData['0']['UserName']['name'] }} </td>
  </tr>

  
   
   
</table>
<br> <br>
  <i style="font-size: 10px; float: right;">Print Data : {{ date("d M Y") }}</i>

<hr style="border: dashed 2px; width: 95%; color: #000000; margin-bottom: 50px">

 
 

</body>
</html>
