@if ($dataprint->user_id==Auth::user()->id)
<!DOCTYPE html>
<html>
<head>
<title>Print</title>
<style>
body {
  background-image: url('');
   visibility: visible;
}
</style>

</head>
<body onload="window.print()">
<table width="100%"  style="border-style: none none solid none;">
    <tr>
        <td width="7%" align="center"><img src="{{ asset('images/logo_unpad.png') }}" width="80"></td>
        <td width="86%"align="center">
            <font style="font-family: Arial;font-size:25pt;"><b>LABORATORIUM XXXXXXXXXXX</b></font><br>
            <font style="font-family: Arial;font-size:18pt;"><b>UNPAD</b></font><br>
            <font style="font-family: Arial;font-size:11pt;"><b>Jl.XXXXXXXXXXXXX Bandung XXXXXXXXXXX</b></font><br>
        </td>
        {{-- <td width="7%"align="center"><img src="{{ asset('image/pramukakanan.png') }}" width="60" height="60"></td> --}}
    </tr>
</table>
<center><h1>BOOKING SERVICE</h1></center>
<table>
    <tr>
        <td width="25%"><font size="5">Date Booking</font></td>
        <td width="75%"><font size="5">: {{ $dataprint->date_booking }}</td>
    </tr>
    <tr>
        <td><font size="5">Full Name</td>
        <td><font size="5">: {{ Auth::user()->name }}</td>
    </tr>
    <tr>
        <td><font size="5">Service</td>
        <td><font size="5">: {{ $dataprint->jenis }}</td>
    </tr>

</table>
<table width="100%">
    <tr align="center">
        <td>{!! QrCode::size(200)->generate(''. $dataprint->coderandom .''); !!}<br>{{ $dataprint->coderandom }}</td>
    </tr>
</table>

</body>
</html>


@else

@endif


