<html>
<head>
	<link href='css/edit.css' rel='stylesheet' type="text/css">
	<!-- Include the JS files -->
</head>
<body>
<?
	/*$q2 = "SELECT link FROM `$database`.`members` WHERE fb_id='$username'";
	$result_set2 = mysql_query($q2);	
	if (mysql_num_rows($result_set2) == 1) 
    {
        $found = mysql_fetch_array($result_set2);
        $artist_id=$found["link"];
    }*/
    $todayDate = date("m/d/Y");
?>

<section id="left" style="width:100%">
    <div class="gcontent">
        <div class="head" style="background:#000;">
            <h1>Tours</h1>
        </div>
        <div class="boxy" id="boxy" style="overflow-y:auto;">
            <form action="update.php" method="post" enctype="multipart/form-data">
                <table id="tourOptionsTable" >
                    <tr>
                        <td width="30%">Select Cities:</td>
                        <td style="height: 40px;">
                            <input type="checkbox" id="tourBangalore" name="tourBangalore" value="1" checked="checked">
                            <label for="tourBangalore">Bangalore</label>
                            <input type="checkbox" id="tourDelhi" name="tourDelhi" value="1">
                            <label for="tourDelhi">Delhi</label>
                            <input type="checkbox" id="tourGoa" name="tourGoa" value="1">
                            <label for="tourGoa">Goa</label>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Total Budget Required:<br><em style="margin-bottom: 0px">(including Travel and Accom.)</em></td>
                        <td>
                            <p>
                                <label for="tourBudget">20000</label>
                                <input type="text" id="tourBudget" name="tourBudget" value="20000">
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Number of Events:</td>
                        <td>
                            <p>
                                <label for="tourNumEvents">2</label>
                                <input type="text" id="tourNumEvents" name="tourNumEvents" value="2">
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Start Date:</td>
                        <td>
                            <p>
                                <label for="tourStartDate"><?print($todayDate);?></label>
                                <input type="text" id="tourStartDate" name="tourStartDate" value="<?print($todayDate);?>">
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">End Date:</td>
                        <td>
                            <p>
                                <label for="tourEndDate"><?print($todayDate);?></label>
                                <input type="text" id="tourEndDate" name="tourEndDate" value="<?print($todayDate);?>">
                            </p>
                        </td>
                    </tr>
                </table>
				
				
                <center>
                    <div class="centera" style=" width:500px; position:relative; margin-top:20px;">
                        <input type="hidden" name="tourSubmit" value="1"/>
                        <input type="submit" name="submit" value="Submit" style = "height: 45px; width: auto; padding: 5px 5px;"/>
                    </div>
                    <!--
                    <div class="formExtra" style="margin-left:60px; margin-right:60px; bottom: 0px;">
                        <p><strong>Note: </strong> Fields marked with <span class="requiredField">*</span> are required.</p>
                    </div>
                    -->
                </center>
            </form>
        </div> <!--boxy-->
	</div> <!--gcontent-->
</section>

<script type="text/javascript">
	$('form p label').inFieldLabels();
    $('#tourStartDate').datepicker();
    $('#tourEndDate').datepicker();
	$('#loading-indicator').hide();
</script>

</body>
</html>