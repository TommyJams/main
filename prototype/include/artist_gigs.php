<?php
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
else
{
header("logout.php");
exit;
}

$todayTime = strtotime(date("Y-m-d"));
 ?>

 <html>
<head>
    <link rel='stylesheet' href='css/edit.css'>

	<!-- Include the JS files -->

	<!--
	<style>
	.paging { padding:10px 0px 0px 0px; text-align:center; font-size:13px;}
	.paging.display{text-align:right;}
	.paging a, .paging span {padding:2px 8px 2px 8px;}
	.paging span {font-weight:bold; color:#000; font-size:13px; }
	.paging a {color:#000; text-decoration:none; border:1px solid #dddddd;}
	.paging a:hover { text-decoration:none; background-color:#6C6C6C; color:#fff; border-color:#000;}
	.paging span.prn { font-size:13px; font-weight:normal; color:#aaa; }
	.paging a.prn { border:2px solid #dddddd;}
	.paging a.prn:hover { border-color:#000;}
	.paging p#total_count{color:#aaa; font-size:12px; padding-top:8px; padding-left:18px;}
	.paging p#total_display{color:#aaa; font-size:12px; padding-top:10px;}
	</style>
	-->

</head>

<body>
    <? 
	if(!isset($_SESSION["searchGigs"])){$_SESSION["searchGigs"]=NULL;} /*Need to set $searchGigs to NULL in this case so as to get a query LIKE '%%' when searching for all gigs*/
	$searchGigs=$_SESSION["searchGigs"];
	if(!isset($_SESSION["page"])){$_SESSION["page"]=1;}
    ?> 

<div id="searchbox">
    <form method="post" action="artist.php?gigs=search" style = "display:block; height: 100%; width:100%; padding: 0px 0px;">
        <input type="text" name="search" value="<?print($searchGigs);?>"   style="height:45%; width:80%; top:0; border:0px; margin-bottom: 5px;">
        <input type="submit" value="Search"  style="width: 15%; height:45%; border: 0px; margin-left:1%; margin-bottom: 5px;"> 
        <select name="city" style = "height: 40%; width: 19%">
        <option value='all'>Any City</option>
        <? 
			$scity=$_POST["city"];$scity=$_POST["city"];$scity=$_POST["city"];
			$que = "SELECT DISTINCT venue_city FROM `$database`.`shop` WHERE (`gig` LIKE '%$searchGigs%' OR `desc` LIKE '%$searchGigs%'  OR `venue_city` LIKE '%$searchGigs%'  OR `promoter_name` LIKE '%$searchGigs%') AND status!=2";
			$sea=mysql_query($que);
            while($a = mysql_fetch_assoc($sea))
			{
				$city=$a["venue_city"];
				if(isset($_SESSION["scity"]) & $_SESSION["scity"]!="all" & $city==$_SESSION["scity"])
					print("<option value='$city' selected='selected'>$city</option>");
				else
					print("<option value='$city'>$city</option>");
			}
		?>
        </select>
        <select name="date" style = "height: 40%; width: 19%">
        <option value='all'>Any Date</option>
        <?
			$que = "SELECT DISTINCT venue_date FROM `$database`.`shop` WHERE (`gig` LIKE '%$searchGigs%' OR `desc` LIKE '%$searchGigs%'  OR `venue_city` LIKE '%$searchGigs%'  OR `promoter_name` LIKE '%$searchGigs%') AND status!=2";
			$sea=mysql_query($que);
            while($a = mysql_fetch_assoc($sea))
			{
				$date=$a["venue_date"];
				$formattedDate = date('d-m-Y',strtotime($date));
				if(isset($_SESSION["sdate"]) & $_SESSION["sdate"]!="all" & $date==$_SESSION["sdate"])
				{
					print("<option value='$date' selected='selected'>$formattedDate</option>");
				}
				else
				{
					print("<option value='$date'>$formattedDate</option>");
				}
			}
		?>
        </select>
        <select name="cat" style = "height: 40%; width: 19%">
        <option value='all'>Any Genre</option>
        <? 
			$que = "SELECT DISTINCT category FROM `$database`.`shop` WHERE (`gig` LIKE '%$searchGigs%' OR `desc` LIKE '%$searchGigs%'  OR `venue_city` LIKE '%$searchGigs%'  OR `promoter_name` LIKE '%$searchGigs%') AND status!=2";
			$sea=mysql_query($que);
            while($a = mysql_fetch_assoc($sea))
			{
				$cat=$a["category"];
				if(!strpos($cat,"/"))
				{
					if(isset($_SESSION["scat"]) & $_SESSION["scat"]!="all" & $cat==$_SESSION["scat"])
						print("<option value='$cat' selected='selected'>$cat</option>");
					else
						print("<option value='$cat'>$cat</option>");
				}
			}
		?>
        </select>
        <select name="budget_min" style = "height: 40%; width: 20%">
        <option value='all'>Any Budget</option>
        <? 
			$que = "SELECT DISTINCT budget_min FROM `$database`.`shop` WHERE (`gig` LIKE '%$searchGigs%' OR `desc` LIKE '%$searchGigs%'  OR `venue_city` LIKE '%$searchGigs%'  OR `promoter_name` LIKE '%$searchGigs%') AND status!=2 ORDER BY budget_min DESC";
			$sea=mysql_query($que);
            while($a = mysql_fetch_assoc($sea))
			{	
				$min=$a["budget_min"];
				if($min>=0)
				{
					if(isset($_SESSION["sbudget"]) & $_SESSION["sbudget"]!="all" & $_SESSION["sbudget"]==$min)
						print("<option value='$min' selected='selected'>$min</option>");
					else
						print("<option value='$min'>$min</option>");
				}
			}
		?>
        </select>
		<!--
        <select name="budget_max" style = "height: 40%; width: 15%;">
        <option value='all'>Max Budget</option>
        <?/* $que = "SELECT DISTINCT budget_max FROM `$database`.`shop` WHERE (`gig` LIKE '%$searchGigs%' OR `desc` LIKE '%$searchGigs%'  OR `venue_city` LIKE '%$searchGigs%'  OR `desc` LIKE '%$searchGigs%') AND status!=2 ORDER BY budget_max DESC";
        $sea=mysql_query($que);
            while($a = mysql_fetch_assoc($sea))
        {	$max=$a["budget_max"];
        print("<option value='$max'>$max</option>");
        }*/ ?>
        </select>
		-->
    </form>
</div> <!--searchbox-->
<!--<div id="box" style="display:block;">

<div id="content" class="clearfix">-->
<section id="left" style = "width:100%; height:80%;">
    <div class="gcontent" >
            <div class="boxy" id="boxy" style="height: 100%;">
                <div class='gigsTableItemContainer' style="height: 100%;">
					<table style="max-height:8%; width:100%; padding:10px 10px 0px 10px; text-align:center;">
                        <tr bgcolor="#ffcc00" height="30px">
                            <td width="25%"><h1>Name</h1></td>
                            <td width="20%"><h1>Host</h1></td>
							<td width="20%"><h1>City</h1></td>
                            <td width="10%"><h1>Date</h1></td>
                            <td width="10%"><h1>Time</h1></td>
                            <td width="15%"><h1>Status</h1></td>
                        </tr>
					</table>
					<div style="height:78%; width:100%; overflow-y:auto;">
                    <table width="100%" style="padding: 10px 10px; text-align: center;">
                        <?

							$query = "SELECT COUNT(*) as num FROM `$database`.`shop` WHERE (`gig` LIKE '%$searchGigs%' OR `desc` LIKE '%$searchGigs%'  OR `venue_city` LIKE '%$searchGigs%'  OR `promoter_name` LIKE '%$searchGigs%') AND status!=2";
							$que   = "SELECT               * FROM `$database`.`shop` WHERE (`gig` LIKE '%$searchGigs%' OR `desc` LIKE '%$searchGigs%'  OR `venue_city` LIKE '%$searchGigs%'  OR `promoter_name` LIKE '%$searchGigs%') AND status!=2";
							if(isset($_SESSION["scity"]) & $_SESSION["scity"]!="all"){$searchCity = $_SESSION["scity"]; $query.=" AND `venue_city` = '$searchCity'";  $que.=" AND `venue_city` = '$searchCity'";}
							if(isset($_SESSION["sdate"]) & $_SESSION["sdate"]!="all"){$searchDate = $_SESSION["sdate"]; $query.=" AND `venue_date` = '$searchDate'";  $que.=" AND `venue_date` = '$searchDate'";}
							if(isset($_SESSION["scat"] ) & $_SESSION["scat"] !="all"){$searchCat  = $_SESSION["scat"];  $query.=" AND `category` LIKE '%$searchCat%'"; $que.=" AND `category` LIKE '%$searchCat%'";}
							if(isset($_SESSION["sbudget"]) & $_SESSION["sbudget"]!="all"){$searchBudget = $_SESSION["sbudget"]; $query.=" AND `budget_min` >= '$searchBudget'"; $que.=" AND `budget_min` >= '$searchBudget'";}
							$que.= " ORDER BY venue_date DESC";

							$total_pages = mysql_fetch_array(mysql_query($query));
                            $total_pages = $total_pages['num']/6;
                            $total_pages=ceil($total_pages);
                            
                            $v=0;
							$sea=mysql_query($que);
                            while($a = mysql_fetch_assoc($sea))
                            {
                                $v=$v+1;
                                $id=$a["id"];$gig=$a["gig"];$cat=$a["category"];
                                $city=$a["venue_city"];$state=$a["venue_state"];$country=$a["venue_country"];$pincode=$a["venue_pin"];
                                $date=$a["venue_date"];$time=$a["venue_time"];$period=$a["period"];$link=$a["link"];
                                $budget_min=$a["budget_min"];$budget_max=$a["budget_max"];$image=$a["image"];$status=$a["status"];
                                $dated = strtotime($date);$promoter_name=$a["promoter_name"];$pid=$a["promoter"];
                                $linker=$link*15999;
								$formattedDate = date('d-m-Y',$dated);

                                if($v<=($_SESSION["page"]*6) && $v>($_SESSION["page"]*6)-6)
                                {
                        ?>
                                    <tr height='20' bgcolor='#000'>
                                        <?
                                        print("
                                            <td width=25%><a href='javascript:;' onClick=gig('$link'); class='highlightRef' ><h3>$gig</h3></a></td>
											<td width=20%>");
												if(isset($_SESSION["username_artist"]))
												{
													print("<a href='javascript:;' onClick=showProfile('$pid'); class='highlightRef'><h3>$promoter_name</h3></a>");
												}
												else
												{
													print("<h3>$promoter_name</h3>");
												}
										print("
											</td>
                                            <td width=20%>$city</td>
                                            <td width=10%>$formattedDate</td>
                                            <td width=10%>$time</td>
                                            <td width=15%>");
                                            $yes=0;
                                            $q4 = "SELECT * FROM `$database`.`transaction` WHERE gig_id=$link AND status=1";
                                            $result_set4 = mysql_query($q4);	
                                            if (mysql_num_rows($result_set4) == 1) 
                                            {
                                                $found = mysql_fetch_array($result_set4);
                                                $yes=1;                
                                                print("<a class='dibStatusRef' href='#'style='color:#666;'>Booked</a>");
                                            }
                                            elseif(isset($_SESSION["username_artist"]))
                                            { 
                                                $q2 = "SELECT link FROM `$database`.`members` WHERE fb_id='$_SESSION[username_artist]'";
                                                $result_set2 = mysql_query($q2);	
                                                if (mysql_num_rows($result_set2) == 1) 
                                                {
                                                        $found = mysql_fetch_array($result_set2);
                                                        $artist_id=$found["link"];
                                                }

                                                $q4 = "SELECT * FROM `$database`.`transaction` WHERE gig_id=$link AND artist_id=$artist_id";
                                                $result_set4 = mysql_query($q4);	
                                                if (mysql_num_rows($result_set4) == 1) 
                                                {
                                                    $found = mysql_fetch_array($result_set4);
                                                    $statuss=$found["status"];
                                                    
                                                    if($statuss==2){print("<a href='#' class='dibStatusRef redRef' style='color:#FFF;'>Rejected</a>");}
                                                    elseif($statuss==4){print("<a href='#' class='dibStatusRef' style='color:#666;'>Pending</a>");}
                                                }
												elseif($todayTime > $dated)
												{
													print("<a class='dibStatusRef' href='#'style='color:#666;'>Closed</a>");
												}
                                                else
                                                {
                                                    if($yes!=1) { 
                                                    ?>
                                                    <form  action="dib_action.php"  method="post">
                                                        <input type="hidden" name="gig" value="<? print($link);?>">
                                                        <input id="dibStatusButton" name="dib" type="submit" value="DIB" style="height:80%; width:auto;" onClick="return confirmSubmit()">
                                                    </form>
                                                    <?
                                                    }
                                                }

                                            }
                                            print("</td>");
                                        ?>
                                    </tr>
                                <?
                                }
                            }
                    print("</table></div>");
					?>
					<div id ="pgNoContainer" style="position:absolute; bottom: 0px; padding-left:10px; margin-bottom:5px; height: 45px; max-height:12%;">
					<?
                    if($total_pages>20){$total_pages=20;}
                    for($i=1;$i<=$total_pages;$i++){
						if($_SESSION["page"] == $i)
							print("<a href='artist.php?gigs=search&page=$i' style='background: #ffcc00; height: 15px; padding: 10px; float:left;' >$i</a>");
						else
							print("<a href='artist.php?gigs=search&page=$i' class='highlightRef' style='height: 15px; padding: 10px; float:left;' >$i</a>");
					}
                    ?>
					</div>
                </div> <!--gigsTableItemContainer-->
			</div> <!--boxy-->
    </div><!--gcontent-->
</section>

<script type="text/javascript">
	$('#loading-indicator').hide();
</script>

<script LANGUAGE="JavaScript">
function confirmSubmit()
{
    var agree=confirm("Are you sure you wish to call dibs for this gig? The host will receive the dibs and choose an artist. Please note, these dibs are not cancellable.");
    if (agree)
        return true ;
    else
        return false ;
}
</script>
	
</body>
</html>