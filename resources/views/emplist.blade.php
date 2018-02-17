<html>
	<head>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.5/lodash.core.js"></script>
	</head>
	<body>
		<h1> Employee List</h1>
		<input type="hidden" id="baseurl" value="{{ $URL = Request::url()}}">
		<select id="seletStatus" name="seletStatus" onchange="getemp()">
			<option value="All">Select Status</option>
			<option value="active">Active</option>
			<option value="inactive">InActive</option>
		</select><br/><br>
		<table id="emptable" border="2px;">
			<tr>
				<th>Sr No</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Department</th>
				<th>Contact No</th>
				<th>Status</th>
			</tr>
		</table>
	</body>
</html>
<script>
		var BASEURL = $('#baseurl').val();
		$( document ).ready(function() {
    		$.ajax({
    			type:"GET",
    			dataType :"json",
    			contentType:"application/json; charset=utf-8",
    			url:BASEURL+'/api/employee/empWithDep',
    			success:function(response){
    				//alert(response.data);
    				var i=1;
    				_.forEach(response.data, function(value) {
    					var trr = '<tr><td>'+i+'</td><td>'+value.first_name+'</td><td>'+value.last_name+'</td><td>'+value.email+'</td><td>'+value.department_name.dep_name+'</td><td>'+value.contact_number+'</td><td>'+value.status+'</td></tr>';
						 $( "#emptable" ).append( $( trr ) );
						 i++;
						});
    			}
    		})
		});

		function getemp(){
			$status = $('#seletStatus').val();
			$.ajax({
    			type:"GET",
    			dataType :"json",
    			contentType:"application/json; charset=utf-8",
    			url:BASEURL+'/api/employee/empOnStatus/'+$status,
    			success:function(response){
    				//alert(response.data);
    				$("#emptable").find("tr:gt(0)").remove();
    				var i=1;
    				_.forEach(response.data, function(value) {
    					var trr = '<tr><td>'+i+'</td><td>'+value.first_name+'</td><td>'+value.last_name+'</td><td>'+value.email+'</td><td>'+value.department_name.dep_name+'</td><td>'+value.contact_number+'</td><td>'+value.status+'</td></tr>';
						$( "#emptable" ).append( $( trr ) );
						i++;
					});
    			}
			})
		}
    		
</script>