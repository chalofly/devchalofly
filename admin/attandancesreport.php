<?php

if($_REQUEST['attandancedays']==''){
    $attandancedays=1;
} else {
    $attandancedays=$_REQUEST['attandancedays'];
}

?>

<style>
.table td,
.table th {
    vertical-align: top;
}

.statusbox{
    margin-right: 5px;
    padding: 10px;
    text-align: center;
    background-color: #000000;
    font-size: 13px;
    color: #fff;
    border-radius: 4px;
    text-transform:uppercase;
}

.notes{
    font-size: 12px;
    background-color: #FFFFCC;
    border: 1px solid #FFCC33;
    padding: 0px 5px;
    color: #ff6a00;
    font-weight: 600;
    float: left;
    margin-top: 2px;
    border-radius: 2px;
}
</style>

<div class="wrapper">
<div class="container-fluid">
<div class="main-content">
<div class="page-content">

<div class="newboxheading">

<div class="newhead">

<?php if($attandancedays==1){ ?> Today's Attendance<?php } ?>
<?php if($attandancedays==2){ ?> Last 7 Days Attendance<?php } ?>
<?php if($attandancedays==3){ ?> This Month Attendance<?php } ?>
<?php if($attandancedays==4){ ?> Last Month Attendance<?php } ?>

Report

<div class="newoptionmenu">

<form action="" method="get">

<table border="0" cellpadding="0" cellspacing="0">
<tr>

<td>
<select name="attandancedays" class="form-control" style="width:220px;">

<option value="1" <?php if($attandancedays==1){ ?>selected<?php } ?>>
Today's Attendance
</option>

<option value="2" <?php if($attandancedays==2){ ?>selected<?php } ?>>
Last 7 Days Attendance
</option>

<option value="3" <?php if($attandancedays==3){ ?>selected<?php } ?>>
This Month Attendance
</option>

<option value="4" <?php if($attandancedays==4){ ?>selected<?php } ?>>
Last Month Attendance
</option>

</select>
</td>

<?php if($LoginUserDetails['userType']==0){ ?>

<td style="padding-left:5px;">

<select name="searchusers" class="form-control" style="width:180px;">

<option value="">All Users</option>

<?php

$rs22=GetPageRecord(
    '*',
    'sys_userMaster',
    'userType=1 order by firstName asc'
);

while($restuser=mysqli_fetch_array($rs22)){

?>

<option value="<?php echo $restuser['id']; ?>"
<?php if($restuser['id']==$_REQUEST['searchusers']){ ?>
selected
<?php } ?>>

<?php echo stripslashes(ucwords($restuser['firstName'].' '.$restuser['lastName'])); ?>

</option>

<?php } ?>

</select>

</td>

<?php } ?>

<td style="padding-left:5px;">
<button type="submit"
class="btn btn-secondary btn-lg waves-effect waves-light"
style="padding: 6px 10px;">

<i class="fa fa-search"></i> Search

</button>
</td>

<td style="padding-left:5px;">
<a href="display.html?ga=attandancesreport">
<button type="button"
class="btn btn-secondary btn-lg waves-effect waves-light"
style="padding: 6px 10px;">

Reset

</button>
</a>
</td>

</tr>
</table>

<input name="page" type="hidden" value="<?php echo $_REQUEST['page']; ?>" />
<input name="ga" type="hidden" value="<?php echo $_REQUEST['ga']; ?>" />

</form>

</div>
</div>
</div>

<div class="col-md-12 col-xl-12" style="padding-top:34px;">

<div class="card" style="min-height:500px;">

<div class="card-body" style="padding:0px;">


<?php

/*
|--------------------------------------------------------------------------
| DATE RANGE
|--------------------------------------------------------------------------
*/

if($attandancedays==1){

    $dates = array(date('Y-m-d'));

} elseif($attandancedays==2){

    $dates = array();

    $begin = new DateTime(date('Y-m-d',strtotime('-7 days')));
    $end   = new DateTime(date('Y-m-d',strtotime('-1 day')));

    for($i=$begin; $i<=$end; $i->modify('+1 day')){
        $dates[] = $i->format("Y-m-d");
    }

} elseif($attandancedays==3){

    $dates = array();

    $begin = new DateTime(date('Y-m-01'));
    $end   = new DateTime(date('Y-m-d'));

    for($i=$begin; $i<=$end; $i->modify('+1 day')){
        $dates[] = $i->format("Y-m-d");
    }

} elseif($attandancedays==4){

    $dates = array();

    $begin = new DateTime(date('Y-m-01',strtotime('-1 month')));
    $end   = new DateTime(date('Y-m-t',strtotime('-1 month')));

    for($i=$begin; $i<=$end; $i->modify('+1 day')){
        $dates[] = $i->format("Y-m-d");
    }
}


/*
|--------------------------------------------------------------------------
| USER FILTER
|--------------------------------------------------------------------------
*/

$whereto='';

if($_REQUEST['searchusers']!=''){
    $whereto=' and id="'.$_REQUEST['searchusers'].'" ';
}

$where=' where userType=1 '.$whereto.' order by firstName asc';
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 
$targetpage='display.html?ga='.$_REQUEST['ga'].'&keyword='.$_REQUEST['keyword'].'&searchcity'.$_REQUEST['searchcity'].'&statusid='.$_REQUEST['statusid'].'&'; 
$rs=GetRecordList('*','sys_userMaster','   '.$where.'  ','200',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];

/*
|--------------------------------------------------------------------------
| LOOP DATES
|--------------------------------------------------------------------------
*/

foreach($dates as $date){

?>

<table border="1" bordercolor="#CCCCCC" class="table table-hover mb-0">

<thead>

<tr>
<th colspan="7" align="left" bgcolor="#F5F5F5">

<?php echo date('l, j F Y',strtotime($date)); ?>

</th>
</tr>

<tr>
<th width="2%"><div align="center">Sr.</div></th>
<th width="20%">Name</th>
<th width="12%"><div align="center">First Login</div></th>
<th width="12%"><div align="center">Sessions</div></th>
<th width="12%"><div align="center">Last Update</div></th>
<th width="12%"><div align="center">Status</div></th>
<th width="12%"><div align="center">Working Hours</div></th>
</tr>

</thead>

<tbody>

<?php

$totalno=1;

mysqli_data_seek($rs[0],0);

while($res=mysqli_fetch_array($rs[0])){

$attendance = getAttendanceData($res['id'],$date);

?>

<tr>

<td align="center">
<?php echo $totalno; ?>
</td>

<td>
<strong>
<?php echo ucwords($res['firstName'].' '.$res['lastName']); ?>
</strong>
</td>

<td align="center">

<?php

if($attendance['firstLogin']!=''){
    echo date('h:i A',strtotime($attendance['firstLogin']));
} else {
    echo '-';
}

?>

</td>

<td align="center">
<?php echo $attendance['sessions']; ?>
</td>

<td align="center">

<?php

if($attendance['lastUpdate']=='Online'){

    echo '<span style="color:green;font-weight:bold;">Online</span>';

} elseif($attendance['lastUpdate']!=''){

    echo date('h:i A',strtotime($attendance['lastUpdate']));

} else {

    echo '-';
}

?>

</td>

<td align="center">

<?php if($attendance['status']=='Present'){ ?>

<span class="badge badge-success">
Present
</span>

<?php } else { ?>

<span class="badge badge-danger">
Absent
</span>

<?php } ?>

</td>

<td align="center">
<?php echo $attendance['hours']; ?>
</td>

</tr>

<?php

$totalno++;

}

?>

</tbody>
</table>

<br>

<?php } ?>

</div>
</div>
</div>
</div>
</div>
</div>
</div>


<script>

$(function(){

    $("#startDate").datepicker({
        dateFormat:'dd-mm-yy'
    });

    $("#endDate").datepicker({
        dateFormat:'dd-mm-yy'
    });

});

</script>


<script>

function changeAssignTo(id){

    var assignTo = $('#assignTo'+id).val();

    $('#actoinfrm').attr(
        'src',
        'actionpage.php?action=changeassignstatus&queryid='
        +id+
        '&assignTo='
        +assignTo
    );
}

</script>