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
    <td>
        <h2>School Management System</h2>
        <p>School Address</p>
        <p>Phone : 346548512</p>
        <p>Email: lalitaryan1993@gmail.com</p>
        <p><b>Monthly and Yearly Profit</b></p>

    </td>
  </tr>
</table>

@php

    $student_fee = App\Models\AccountStudentFee::whereBetween('date', [$start_date, $end_date])->sum('amount');

    $other_cost = App\Models\AccountOtherCost::whereBetween('date', [$sDate, $eDate])->sum('amount');

    $employee_salary = App\Models\AccountEmployeeSalary::whereBetween('date', [$start_date, $end_date])->sum('amount');

    $totalCost = $other_cost + $employee_salary;

    $profit = $student_fee - $totalCost;

@endphp


<table id="customers">
  <tr>
    <td colspan="2" style="text-align:center;">
        <h4>Reporting Date: {{date('d M Y', strtotime($sDate))}} - {{date('d M Y', strtotime($eDate))}}</h4>
    </td>

  </tr>
  <tr>
    <td width="50%"><h4>Purpose</h4></td>
    <td width="50%"><h4>Amount</h4></td>
    {{-- <td>{{ $details[0]->user->name }}</td> --}}
  </tr>
  <tr>
    <td>Student Fee</td>
    <td>{{ $student_fee }}₹</td>

  </tr>
  <tr>
    <td>Employee Salary</td>
    <td>{{ $employee_salary }}₹</td>

</tr>
<tr>
    <td>Other Cost</td>
    <td>{{ $other_cost }}₹</td>
</tr>
<tr>
    <td>Total Cost</td>
    <td>{{ $totalCost }}₹</td>
</tr>
<tr>
    <td>Profit</td>
    <td>{{ $profit }}₹</td>
</tr>



</table>
<br>
<i style="font-size:10px; float:right;">Print Date : {{ date('Y-m-d') }}</i>


<hr style="border: dashed 2px #000; margin-bottom: 50px;">


</body>
</html>
