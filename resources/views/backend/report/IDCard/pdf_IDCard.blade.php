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
        @php
            $image_path = '/upload/school-logo.jpg';
        @endphp
        <img src="{{ public_path().$image_path}}" alt="Demo" width="200" height="100" />

        </h2></td>
    <td><h2>Lalit School</h2></td>
    <td>
        <h2>School Management System</h2>
        <p>School Address</p>
        <p>Phone : 346548512</p>
        <p>Email: lalitaryan1993@gmail.com</p>
        <p><b>Student ID Card</b></p>

    </td>
  </tr>
</table>

<br>
<br>

<table id="customers">


    @foreach($allData as $value)
    <tr >
        <td>Image</td>
        <td>Easy School</td>
        <td>Student ID Card</td>
    </tr>
    <br>
    <tr>
        <td>Name : {{ $value->student->name }}</td>
        <td>Session : {{ $value->student_year->name }}</td>
        <td>Class : {{ $value->student_class->name }}</td>
    </tr>
    <tr>
        <td>Roll : {{ $value->roll }}</td>
        <td>ID No : {{ $value->student->id_no }}</td>
        <td>Mobile : {{ $value->student->mobile }}</td>
    </tr>
    @endforeach



</table>

<br>
<br>

<i style="font-size:10px; float:right;">Print Date : {{ date('Y-m-d') }}</i>


<hr style="border: dashed 2px #000; margin-bottom: 50px;">



</body>
</html>
