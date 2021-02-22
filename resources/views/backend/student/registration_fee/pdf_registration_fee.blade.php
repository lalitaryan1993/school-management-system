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
            $image_path = '/upload/demo.png';
        @endphp
        <img src="{{ public_path().$image_path}}" alt="Demo" width="200" height="100" />

        </h2></td>
    <td><h2>Lalit School</h2></td>
    <td>
        <h2>School Management System</h2>
        <p>School Address</p>
        <p>Phone : 346548512</p>
        <p>Email: lalitaryan1993@gmail.com</p>
        <p><b>Student Registration Fee</b></p>

    </td>
  </tr>
</table>

@php
     $registrationFee = App\Models\FeeCategoryAmount::where('fee_category_id', 1)->where('class_id', $details->class_id)->first();

     $originalFee = $registrationFee->amount;
            $discount = $details['discount']['discount'];
            $discountTableFee = $discount/100*$originalFee;
            $finalFee = (float)$originalFee - (float)$discountTableFee;
@endphp


<table id="customers">
  <tr>
    <th width="10%">S.NO.</th>
    <th width="45%">Student Details</th>
    <th width="45%">Student Data</th>
  </tr>
  <tr>
    <td>1</td>
    <td>Student ID NO</td>
    <td>{{ $details->student->id_no }}</td>
  </tr>
  <tr>
    <td>2</td>
    <td>Student Roll</td>
    <td>{{ $details->roll }}</td>

  </tr>
  <tr>
    <td>3</td>
    <td>Student Name</td>
    <td>{{ $details->student->name }}</td>

  </tr>
  <tr>
    <td>4</td>
    <td>Session</td>
    <td>{{ $details->student_year->name }}</td>
  </tr>
  <tr>
    <td>5</td>
    <td>Class </td>
    <td>{{ $details->student_class->name }}</td>
  </tr>
  <tr>
    <td>6</td>
    <td>Mobile </td>
    <td>{{ $details->student->mobile }}</td>
  </tr>
  <tr>
    <td>7</td>
    <td>Registration Fee</td>
    <td>{{ $originalFee }}₹</td>
  </tr>
  <tr>
    <td>8</td>
    <td>Discount Fee</td>
    <td>{{ $discount }}%</td>
  </tr>
  <tr>
    <td>9</td>
    <td>Fee For This Student </td>
    <td>{{ $finalFee }}₹</td>
  </tr>


</table>
<br>
<i style="font-size:10px; float:right;">Print Date : {{ date('Y-m-d') }}</i>


<hr style="border: dashed 2px #000; margin-bottom: 50px;">

<table id="customers">
    <tr>
      <th width="10%">S.NO.</th>
      <th width="45%">Student Details</th>
      <th width="45%">Student Data</th>
    </tr>
    <tr>
      <td>1</td>
      <td>Student ID NO</td>
      <td>{{ $details->student->id_no }}</td>
    </tr>
    <tr>
      <td>2</td>
      <td>Student Roll</td>
      <td>{{ $details->roll }}</td>

    </tr>
    <tr>
      <td>3</td>
      <td>Student Name</td>
      <td>{{ $details->student->name }}</td>

    </tr>
    <tr>
      <td>4</td>
      <td>Session</td>
      <td>{{ $details->student_year->name }}</td>
    </tr>
    <tr>
      <td>5</td>
      <td>Class </td>
      <td>{{ $details->student_class->name }}</td>
    </tr>
    <tr>
      <td>6</td>
      <td>Mobile </td>
      <td>{{ $details->student->mobile }}</td>
    </tr>
    <tr>
      <td>7</td>
      <td>Registration Fee</td>
      <td>{{ $originalFee }}₹</td>
    </tr>
    <tr>
      <td>8</td>
      <td>Discount Fee</td>
      <td>{{ $discount }}%</td>
    </tr>
    <tr>
      <td>9</td>
      <td>Fee For This Student </td>
      <td>{{ $finalFee }}₹</td>
    </tr>


  </table>
  <br>
  <i style="font-size:10px; float:right;">Print Date : {{ date('Y-m-d') }}</i>

</body>
</html>
