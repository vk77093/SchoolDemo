<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Details</title>
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
        
        <img src="{{(!empty($details->profile_photo_path) ? url($details->profile_photo_path) : url('AdminAsset/UserProfileImage/no_image.jpg'))}}" width="200" height="100">
      
          </h2></td>
          <td><h2>Easy School ERP</h2>
      <p>School Address</p>
      <p>Phone : 343434343434</p>
      <p>Email : support@vijay </p>
      <p> <b> Employee Registration Page </b> </p>
          </td> 
        </tr>
        
         
      </table>
      <table id="customers">
        <tr>
          <th width="10%">Sl</th>
          <th width="45%">Employee Details</th>
          <th width="45%">Employee Data</th>
        </tr>
        <tr>
          <td>1</td>
          <td><b>Employee Name</b></td>
          <td>{{ $details->name }}</td>
        </tr>
        <tr>
          <td>2</td>
          <td><b>Employee ID No</b></td>
          <td>{{ $details->stu_IdNumber }}</td>
        </tr>
      
          
        <tr>
          <td>3</td>
          <td><b>Father's Name</b></td>
          <td>{{ $details->fname }}</td>
        </tr>
        <tr>
          <td>5</td>
          <td><b>Mother's Name</b></td>
          <td>{{ $details->mname }}</td>
        </tr>
        <tr>
          <td>6</td>
          <td><b>Mobile Number </b></td>
          <td>{{ $details->mobile }}</td>
        </tr>
        <tr>
          <td>7</td>
          <td><b>Address</b></td>
          <td>{{ $details->address }}</td>
        </tr>
        <tr>
          <td>8</td>
          <td><b>Gender</b></td>
          <td>{{ $details->gender }}</td>
        </tr>
      
          <tr>
          <td>9</td>
          <td><b>Religion</b></td>
          <td>{{ $details->religion }}</td>
        </tr>
      
      
          <tr>
          <td>10</td>
          <td><b>Date of Birth</b></td>
          <td>{{ date('d-m-Y', strtotime($details->dob))  }}</td>
        </tr>
          <tr>
          <td>11</td>
          <td><b> Employee Designaton  </b></td>
          <td>{{ $details->DesignationName->desg_name }}  </td>
        </tr>
          <tr>
          <td>12</td>
          <td><b>Join Date </b></td>
          <td>{{ date('d-m-Y', strtotime($details->join_date))  }}</td>
        </tr>
          <tr>
          <td>13</td>
          <td><b>Employee Slaray  </b></td>
          <td>{{ $details->salary }}</td>
        </tr>
          
         
      </table>
      <br> <br>
        <i style="font-size: 10px; float: right;">Print Data : {{ date("d M Y") }}</i>
</body>
</html>