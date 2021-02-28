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
        <p><b>Employee Monthly Salary</b></p>

    </td>
  </tr>
</table>

@php

    $date = date('Y-m', strtotime($details[0]->date));

    if($date != ''){
        $where[] = ['date', 'like', $date.'%'];
    }
    $totalAttend = App\Models\EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $details[0]->employee_id)->get();
    $absentCount = count($totalAttend->where('attend_status' , 'Absent'));

    $salary = (float)$details[0]->user->salary;
    $salaryPerDay = (float)$salary/30;
    $totalSalaryMinus = (float)$absentCount*(float)$salaryPerDay;
    $totalSalary= (float)$salary - (float)$totalSalaryMinus;


@endphp


<table id="customers">
  <tr>
    <th width="10%">S.NO.</th>
    <th width="45%">Employee Details</th>
    <th width="45%">Employee Data</th>
  </tr>
  <tr>
    <td>1</td>
    <td>Employee Name</td>
    <td>{{ $details[0]->user->name }}</td>
  </tr>
  <tr>
    <td>2</td>
    <td>Basic Salary</td>
    <td>{{ $details[0]->user->salary }}</td>

  </tr>
  <tr>
    <td>3</td>
    <td>Total Absent For This Month</td>
    <td>{{ $absentCount }}</td>

  </tr>
  <tr>
    <td>4</td>
    <td>Month</td>
    <td>{{ date('M Y', strtotime($details[0]->date)) }}</td>
  </tr>
  <tr>
    <td>5</td>
    <td>Salary This Month </td>
    <td>{{ (float)number_format($totalSalary, 2, '.', '') }}</td>
  </tr>



</table>
<br>
<i style="font-size:10px; float:right;">Print Date : {{ date('Y-m-d') }}</i>


<hr style="border: dashed 2px #000; margin-bottom: 50px;">

<table id="customers">
    <tr>
      <th width="10%">S.NO.</th>
      <th width="45%">Employee Details</th>
      <th width="45%">Employee Data</th>
    </tr>
    <tr>
      <td>1</td>
      <td>Employee Name</td>
      <td>{{ $details[0]->user->name }}</td>
    </tr>
    <tr>
      <td>2</td>
      <td>Basic Salary</td>
      <td>{{ $details[0]->user->salary }}</td>

    </tr>
    <tr>
      <td>3</td>
      <td>Total Absent For This Month</td>
      <td>{{ $absentCount }}</td>

    </tr>
    <tr>
      <td>4</td>
      <td>Month</td>
      <td>{{ date('M Y', strtotime($details[0]->date)) }}</td>
    </tr>
    <tr>
      <td>5</td>
      <td>Salary This Month </td>
      <td>{{ (float)number_format($totalSalary, 2, '.', '') }}</td>
    </tr>



  </table>
  <br>
  <i style="font-size:10px; float:right;">Print Date : {{ date('Y-m-d') }}</i>

</body>
</html>
