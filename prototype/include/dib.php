<?
ob_start();

if (!isset($_SESSION)) {
session_start();
}

include('../connect.php');

if(isset($_SESSION['username_artist']))
{
	$username=$_SESSION['username_artist'];
$password=md5($_SESSION['password_artist']);

}
elseif(isset($_SESSION['username']))
{
	$username=$_SESSION['username'];
$password=md5($_SESSION['password']);

}
else
{
header("logout.php");
exit;
}


 ?>
<html>
<head>
	<link rel='stylesheet' href='css/edit.css'>
	<!-- Include the JS files -->

</head>
<body>
<?
	$q2 = "SELECT link FROM `$database`.`members` WHERE fb_id='$username'";
	$result_set2 = mysql_query($q2);	
	if (mysql_num_rows($result_set2) == 1) 
{
 		$found = mysql_fetch_array($result_set2);
		$artist_id=$found["link"];
} ?>

<section id="left" style="width:100%">
    <div class="gcontent">
        <div class="head" style="background:#000;">
            <h1>DIBS Status</h1>
        </div>
        <div class="boxy" id="boxy" style="overflow-y:auto;">
            <table width='100%' style='padding: 10px 10px; text-align:center;'>
                <tr bgcolor='#ffcc00' height='30px'>
                    <td width="25%"><h1>Name</h1></td>
                    <td width="25%"><h1>City</h1></td>
                    <td width="10%"><h1>Date</h1></td>
                    <td width="10%"><h1>Time</h1></td>
                    <td width="30%"><h1>Status</h1></td>
                </tr>
            </table>

            <?
            if(isset($_SESSION['username_artist']))
            {
            $SQLs = "SELECT * FROM `$database`.`transaction` WHERE artist_id=$artist_id ORDER BY id DESC";
            }
            elseif(isset($_SESSION['username']))
            {
            $SQLs = "SELECT * FROM `$database`.`transaction` WHERE promoter_id=$artist_id ORDER BY id DESC";
            }
            $results = mysql_query($SQLs);
            while ($a = mysql_fetch_assoc($results))
            {
                $gig_id=$a["gig_id"];
                $id=$a["id"];$gig=$a["gig_name"];$promoter=$a["promoter_id"];$promoter_name=$a["promoter_name"];
                $artist=$a["artist_id"];$artist_name=$a["artist_name"];
                $link=$a["gig_id"];$statuss=$a["status"];

                $SQLe = "SELECT * FROM `$database`.`shop` WHERE link=$link";
                $resulte = mysql_query($SQLe);
                while ($f = mysql_fetch_assoc($resulte))
                {
                    $city=$f["venue_city"];$state=$f["venue_state"];$time=$f["venue_time"];$date=$f["venue_date"];
                }
				$formattedDate = date('d-m-Y',strtotime($date));
            ?>					

                <span class="gigs" style="padding:10px;" >
                    <div class='gigsTableItemContainer'>
                    <?
                        print("
                        <table width=100% style='text-align:center;'>
                            <tr>
                                <td width=25%><a href='javascript:;' class='highlightRef' onClick=gig('$link');><h3>$gig</h3></a></td>
                                <td width=25%>$city</td>
                                <td width=10%>$formattedDate</td>
                                <td width=10%>$time</td>
                                <td width=30%>
                        ");

                                if($statuss==1)
                                {
                                    print("<a href='#' class='greenRef' style='color:#FFF;'>Accepted</a></td></tr><tr><td colspan=4></td><td><center>");
                                    $SQLe = "SELECT mobile FROM `$database`.`members` WHERE link=$promoter";
                                    $resulte = mysql_query($SQLe);
                                    while ($f = mysql_fetch_assoc($resulte))
                                    {
                                        print("<a href='javascript:;' onClick=showProfile('$promoter'); class='greenRef'>$promoter_name</a><br>Contact: $f[mobile]</center>");
                                    }
                                }
                                elseif($statuss==2)
                                {
                                    print("<a href='#' class='redRef' style='color:#FFF;'>Rejected</a>");
                                }
                                elseif($statuss==4)
                                {
                                    print("<a href='#' class='yellowRef' style='color:#FFF;'>Pending</a>");
                                }
                                print("</td>
                            </tr>
                        </table>");                   
                    ?>
                    </div>
                </span>
            <?
            }
            ?>
        </div> <!--boxy-->
	</div> <!--gcontent-->
</section>

<script type="text/javascript">
	$('#loading-indicator').hide();
</script>

</body>
</html>