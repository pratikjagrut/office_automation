<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<td><label>Generation Date</label></td>
	<td>
	    <input type="string" name="generation_date" class="form-control" required="true" id="generation_date">
	</td>
<script type="text/javascript">
	var date1 = new Date()
		var date2 = 1515568302610;
		var difference = date1.getTime() - date2;

        var daysDifference = Math.floor(difference/1000/60/60/24)
        difference -= daysDifference*1000*60*60*24

       	var hoursDifference = Math.floor(difference/1000/60/60)
        difference -= hoursDifference*1000*60*60

        var minutesDifference = Math.floor(difference/1000/60)
        difference -= minutesDifference*1000*60

        var secondsDifference = Math.floor(difference/1000)

     	document.write('difference = ' + daysDifference + 'd ' + hoursDifference + 'h :' + minutesDifference + 'm :' + secondsDifference + 's')
</script>
</body>
</html>