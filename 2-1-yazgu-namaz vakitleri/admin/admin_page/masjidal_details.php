<?php 
if(is_user_logged_in())
{
?>

<div class="tab">
  <button class="tablinks active" onclick="openCity(event, 'Details')"><?php echo esc_html( 'Masjid Settings');?></button>
 <button class="tablinks" onclick="openCity(event, 'label_text')">Label Text</button>
  <!-- <button class="tablinks" onclick="openCity(event, 'Cron')">Cron Scripts </button>
  <button class="tablinks" onclick="openCity(event, 'Endpoints')">Endpoints</button>-->
</div>
<?php 
$Save_label=sanitize_text_field($_POST['Save_label']);
$Save=sanitize_text_field($_POST['Save']);
 if($Save_label =='Save' || $Save =='Save'){ ?>
<div class="alert alert-success alert-dismissible" style="margin-top:18px;">
    <a href="#" class="close newclose" data-dismiss="alert" aria-label="close" title="close">×</a>
    
	<?php echo esc_html( 'Successful! save you data.');?>
</div>
<?php } ?>
<div id="Details" class="tabcontent">
  <div class="masjid_details">
<?php

   $masjid_id=sanitize_text_field($_POST['masjid_id']);
 $masjid_calendar_type=sanitize_text_field($_POST['masjid_calendar_type']);
 $masjid_calendar_layout=sanitize_text_field($_POST['masjid_calendar_layout']);
   $highlighted_color=sanitize_text_field($_POST['highlighted_color']);
    $jumuah3_time=sanitize_text_field($_POST['jumuah3_time']);
    $jumuah3time=sanitize_text_field($_POST['jumuah3time']);
    $khutbah_time1=sanitize_text_field($_POST['khutbah_time1']);
    $timeformat_24=sanitize_text_field($_POST['timeformat_24']);
    $iqamahChange=sanitize_text_field($_POST['iqamahChange']);
    $khutbah_time=sanitize_text_field($_POST['khutbah_time']);
    //$khutbah_label=sanitize_text_field($_POST['khutbah_label']);
   $highlighted_text_color=sanitize_text_field($_POST['highlighted_text_color']);
   $montly_pdf_url=sanitize_text_field($_POST['montly_pdf_url']);
   if(!empty($masjid_id) && !empty($masjid_calendar_type) && !empty($highlighted_color)){
   update_option('masjid_id',$masjid_id);
   if($masjid_calendar_type == 'Custom_url'){
	    update_option('montly_pdf_url',$montly_pdf_url);
   }
   update_option('masjid_calendar_type',$masjid_calendar_type);
   update_option('masjid_calendar_layout',$masjid_calendar_layout);
   update_option('highlighted_color',$highlighted_color);
   update_option('jumuah3_time',$jumuah3_time);
   update_option('jumuah3time',$jumuah3time);
   update_option('khutbah_time1',$khutbah_time1);
   update_option('timeformat_24',$timeformat_24);
   update_option('iqamahChange',$iqamahChange);
   update_option('khutbah_time',$khutbah_time);
   //update_option('khutbah_label',$khutbah_label);
   update_option('highlighted_text_color',$highlighted_text_color);
   ?>
    
   <?php
   }else{
	      ?>
  <!--  <div class="alert alert-danger  alert-dismissible" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Sorry!</strong> Please Enter Correct Value.
</div> -->
   <?php
   }
 $masjid_id=get_option('masjid_id');
   $masjid_calendar_type=get_option('masjid_calendar_type');
   $masjid_calendar_layout=get_option('masjid_calendar_layout');
  if(empty($masjid_calendar_type)){
	  $autocheckd='checked';
  }
  $highlighted_color=get_option('highlighted_color');
  $highlighted_text_color=get_option('highlighted_text_color');
  $montly_pdf_url=get_option('montly_pdf_url');
  $jumuah3_time=get_option('jumuah3_time');
  $jumuah3time=get_option('jumuah3time');
  $khutbah_time1=get_option('khutbah_time1');
  $timeformat_24=get_option('timeformat_24');
  $iqamahChange=get_option('iqamahChange');

  $khutbah_time=get_option('khutbah_time');
  //$khutbah_label=get_option('khutbah_label');
 if(empty($highlighted_color)){
	  $highlighted_color='#b3e5f3';
  }
  
if($masjid_calendar_type =='Custom_url'){
	$styel="display:block";
}else{
	$styel="display:none";
}

?>

<h3><?php echo esc_html( 'Masjid Details' );?></h3>

<form method="post">
<div class="rest_filed">
<label><?php echo esc_html( 'Masjid ID :' );?></label><input style="width: 16%;" type="text" maxlength="9" name="masjid_id" id="masjid_id" value="<?php echo esc_attr_e( $masjid_id ); ?>" required></div>
<div class="rest_filed">
<label style="width:24%;"><?php echo esc_html( 'Theme :' );?> </label>
<!-- <div class="type_cal"><input type="radio" name="masjid_calendar_layout" id="masjid_calendar_layout" <?php  if($masjid_calendar_layout == 'Default'){ echo 'checked'; } ?> value="Default"><span><?php echo esc_html( 'Default' );?></span></div>
<div class="type_cal"><input type="radio" name="masjid_calendar_layout" id="masjid_calendar_layout" <?php  if($masjid_calendar_layout == 'Layout1'){ echo 'checked'; } ?> value="Layout1"><span><?php echo esc_html( 'Layout 1' );?></span></div> -->
<select name="masjid_calendar_layout" id="masjid_calendar_layout" style="width: 16%;">
<option value="Default" <?php  if($masjid_calendar_layout == 'Default'){ echo 'selected'; } ?>><?php echo esc_html( 'Default' );?></option>
<option value="Layout1" <?php  if($masjid_calendar_layout == 'Layout1'){ echo 'selected'; } ?>><?php echo esc_html( 'Layout 1' );?></option>
<option value="Layout2" <?php  if($masjid_calendar_layout == 'Layout2'){ echo 'selected'; } ?>><?php echo esc_html( 'Layout 2' );?></option>
</select>
</div>

<div class="rest_filed">
<label style="width:100%;"><?php echo esc_html( 'Choose Monthly Calendar View :' );?> </label>
<div class="type_cal first_div"><input type="radio" name="masjid_calendar_type" id="masjid_calendar_type" <?php  if($masjid_calendar_type == 'none'){ echo 'checked'; } ?> value="none"><span><?php echo esc_html( 'None' );?></span></div>
<div class="type_cal first_div"><input type="radio" name="masjid_calendar_type" id="masjid_calendar_type" <?php  if($masjid_calendar_type == 'Custom_url'){ echo 'checked'; } ?> value="Custom_url"><span><?php echo esc_html( 'Custom' );?></span></div>
<div class="type_cal"><input type="radio" name="masjid_calendar_type" id="masjid_calendar_type" <?php  if($masjid_calendar_type == 'v1'){ echo 'checked'; } ?> value="v1" <?php echo esc_attr_e($autocheckd); ?>><img src="<?php echo  esc_url(plugin_dir_url(dirname(dirname(__FILE__)))) ?>/admin/img/CalendarWidget_1.jpg" alt="view1"></div>
<div class="type_cal"><input type="radio" name="masjid_calendar_type" id="masjid_calendar_type" <?php  if($masjid_calendar_type == 'v2'){ echo esc_attr_e('checked'); } ?> value="v2"><img src="<?php echo  esc_url(plugin_dir_url(dirname(dirname(__FILE__)))) ?>/admin/img/CalendarWidget_2.jpg" alt="view2"></div>
<div class="type_cal"><input type="radio" name="masjid_calendar_type" id="masjid_calendar_type" <?php  if($masjid_calendar_type == 'v3'){ echo esc_attr_e('checked'); } ?> value="v3"><img src="<?php echo  esc_url(plugin_dir_url(dirname(dirname(__FILE__)))) ?>/admin/img/CalendarWidget_3.jpg" alt="view3"></div>

</div>

<div style="<?php echo esc_attr($styel); ?>" class="rest_filed montly_pdf_filed">
<label for="montly_pdf_url"><?php echo esc_html( 'Enter Monthly URL :' );?></label>

  <input style="width: 60%;" id="montly_pdf_url" type="text" name="montly_pdf_url" value="<?php echo esc_url($montly_pdf_url);?>"></div>
  

  <div class="rest_filed">
  <label for="favcolor"><?php echo esc_html( "24-Hour Time Format :" );?></label>

  <input type="checkbox" id="timeformat_24" name="timeformat_24" <?php  if($timeformat_24 == 'yes'){ echo 'checked'; } ?> value="yes"/>
 
</div>
<div class="rest_filed">
	<label for="favcolor"><?php echo esc_html( 'Hide Iqamah Change :' );?></label>
	<input type="checkbox" id="iqamahChange" name="iqamahChange" <?php if($iqamahChange == 'yes'){ echo 'checked'; } ?> value="yes"/>
</div>
<div class="rest_filed">
	<label for="favcolor"><?php echo esc_html( "Khutbah Time (only if 1 Jumu'ah is offered) :" );?></label>

	<input type="time" id="khutbahtimeInput" onchange="onkhutbahChange()" name="khutbah_time" value="<?php echo esc_attr_e($khutbah_time); ?>"/>
	<input type="hidden" id="khutbah_time1"  name="khutbah_time1" value="<?php echo esc_attr_e($khutbah_time1);?>"/>
</div>

<!--div class="rest_filed">
	<label for="favcolor"><?php echo esc_html( 'Jumuah 3 Time :', 'masjidal' );?></label>

	<input type="time" onchange="onTimeChange()" id="timeInput" name="jumuah3time" value="<?php echo esc_attr_e($jumuah3time); ?>"/>
	<input type="hidden" id="jumuah3_time"  name="jumuah3_time" value="<?php echo esc_attr_e($jumuah3_time);?>"/>
</div-->

<div class="rest_filed">
<label for="favcolor"><?php echo esc_html( 'Select Your Highlighted Color :', 'masjidal' );?></label>
  <input  type="color" id="favcolor" name="highlighted_color" value="<?php echo esc_attr_e($highlighted_color);?>">   <strong><?php echo esc_html($highlighted_color);?></strong></div>
  <div class="rest_filed">
<label for="favcolor"><?php echo esc_html( 'Select Your Highlighted Text Color :', 'masjidal' );?></label>
  <input  type="color" id="favcolor" name="highlighted_text_color" value="<?php echo esc_url($highlighted_text_color);?>">   <strong><?php echo esc_html($highlighted_text_color);?></strong></div>
  <div class="rest_filed">
<input type="submit" value="<?php esc_attr_e( 'Save' );?>" name="Save" id="Save_info">    <strong class="info_s" style="margin-left: 10%; font-size: 15px;
">For more information, <a href="https://mymasjidal.com/knowledge-base/wordpress"><?php echo esc_html( 'Please click here' );?></a> </strong></div>
</form>


</div>

</div>

<div id="label_text" class="tabcontent" style="display:none">
<?php 

 $Save_label=sanitize_text_field($_POST['Save_label']);

if($Save_label =='Save'){

 $starts_lable=sanitize_text_field($_POST['starts_lable']);
 $top_heading=sanitize_text_field($_POST['top_heading']);
$iqamah_lable=sanitize_text_field($_POST['iqamah_lable']);
$sunrise_lable=sanitize_text_field($_POST['sunrise_lable']);
$fajr_lable=sanitize_text_field($_POST['fajr_lable']);
$dhuhr_lable=sanitize_text_field($_POST['dhuhr_lable']);
$asr_lable=sanitize_text_field($_POST['asr_lable']);
$maghrib_lable=sanitize_text_field($_POST['maghrib_lable']);
$isha_lable=sanitize_text_field($_POST['isha_lable']);
 $jumuah_header=sanitize_text_field($_POST['jumuah_header']);
 $jumuah1_lable=sanitize_text_field($_POST['jumuah1_lable']);
$jumuah2_lable=sanitize_text_field($_POST['jumuah2_lable']);
$jumuah3_lable=sanitize_text_field($_POST['jumuah3_lable']);
$montly_text=sanitize_text_field($_POST['montly_text']);
$khutbah_label=sanitize_text_field($_POST['khutbah_label']);


 update_option('starts_lable',$starts_lable);
 update_option('top_heading',$top_heading);
 update_option('iqamah_lable',$iqamah_lable);
 update_option('sunrise_lable',$sunrise_lable);
 update_option('fajr_lable',$fajr_lable);
 update_option('dhuhr_lable',$dhuhr_lable);
 update_option('asr_lable',$asr_lable);
 update_option('maghrib_lable',$maghrib_lable);
 update_option('isha_lable',$isha_lable);
 update_option('jumuah_header',$jumuah_header);
 update_option('jumuah1_lable',$jumuah1_lable);
 update_option('jumuah2_lable',$jumuah2_lable);
 update_option('jumuah3_lable',$jumuah3_lable);
 update_option('montly_text',$montly_text);
 update_option('khutbah_label',$khutbah_label);
}


  $starts_lable= get_option('starts_lable');
  $top_heading= get_option('top_heading');
   $iqamah_lable=get_option('iqamah_lable');
   $sunrise_lable=get_option('sunrise_lable');
  $fajr_lable=get_option('fajr_lable');
  $dhuhr_lable=get_option('dhuhr_lable');
  $asr_lable=get_option('asr_lable');
 $maghrib_lable= get_option('maghrib_lable');
  $isha_lable=get_option('isha_lable');
 $jumuah_header= get_option('jumuah_header');
 $jumuah1_lable= get_option('jumuah1_lable');
 $jumuah2_lable= get_option('jumuah2_lable');
  $jumuah3_lable=get_option('jumuah3_lable');
  $montly_text=get_option('montly_text');
  $khutbah_label=get_option('khutbah_label');
?>
	<div class="masjid_details">
	<h3><?php echo esc_html( 'Change Label Text' );?></h3>
		<form method="post">
		<div class="heading_filed"> 
      <div class="lable_filed"><label for="top_heading"><?php echo esc_html( 'Top Heading:' );?></label><input type="text" maxlength="20" name="top_heading" value="<?php echo esc_attr_e($top_heading); ?>"></div>
		<div class="lable_filed"><label for="starts_lable"><?php echo esc_html( 'Starts:' );?></label><input type="text" maxlength="20" name="starts_lable" value="<?php echo esc_attr_e($starts_lable); ?>"></div>
		 <div class="lable_filed"><label  for="iqamah_lable"><?php echo esc_html( 'Iqamah:' );?></label><input type="text" maxlength="20" name="iqamah_lable" value="<?php echo esc_attr_e($iqamah_lable); ?>"> </div>
		 <div class="lable_filed"><label  for="sunrise_lable"><?php echo esc_html( 'Sunrise:' );?></label><input type="text" maxlength="20" name="sunrise_lable" value="<?php echo esc_attr_e($sunrise_lable); ?>"> </div>
		 </div>
		<div class="heading_filed">  
		<div class="lable_filed"><label  for="fajr"><?php echo esc_html( 'Fajr:' );?></label><input type="text" maxlength="20" name="fajr_lable" value="<?php echo esc_attr_e($fajr_lable); ?>"> </div>
		 <div class="lable_filed"><label  for="dhuhr"><?php echo esc_html( 'Dhuhr:' );?></label><input type="text" maxlength="20" name="dhuhr_lable" value="<?php echo esc_attr_e($dhuhr_lable); ?>"> </div>
		 <div class="lable_filed"><label  for="asr"><?php echo esc_html( 'Asr:', 'masjidal' );?></label><input type="text" maxlength="20" name="asr_lable" value="<?php echo esc_attr_e($asr_lable); ?>"> </div>
		 <div class="lable_filed"><label  for="maghrib "><?php echo esc_html( 'Maghrib :', 'masjidal' );?></label><input maxlength="20" type="text" name="maghrib_lable" value="<?php echo esc_attr_e($maghrib_lable); ?>"> </div>
		 <div class="lable_filed"><label  for="Isha "><?php echo esc_html( 'Isha :', 'masjidal' );?></label><input type="text" maxlength="20" name="isha_lable" value="<?php echo esc_attr_e($isha_lable); ?>"> </div>
		</div>		
		<div class="heading_filed"> 
   
<div class="lable_filed"><label  for="khutbah_label "><?php echo esc_html( 'Khutbah  :' );?></label><input type="text" maxlength="20" name="khutbah_label" value="<?php echo esc_attr_e($khutbah_label); ?>"> </div>

<div class="lable_filed"><label  for="jumuah1 "><?php esc_attr_e( 'Jumuah Header  :' );?></label><input type="text" maxlength="20" name="jumuah_header" value="<?php echo esc_attr_e($jumuah_header); ?>"> </div>

		<div class="lable_filed"><label  for="jumuah1 "><?php esc_attr_e( 'Jumuah 1  :' );?></label><input type="text" maxlength="20" name="jumuah1_lable" value="<?php echo esc_attr_e($jumuah1_lable); ?>"> </div>
		 <div class="lable_filed"><label for="jumuah2 "><?php esc_attr_e( 'Jumuah 2  :' );?></label><input type="text" maxlength="20" name="jumuah2_lable" value="<?php echo esc_attr_e($jumuah2_lable); ?>"> </div>
		 <div class="lable_filed"><label for="jumuah3  "><?php esc_attr_e( 'Jumuah 3   :' );?></label><input type="text" maxlength="20" name="jumuah3_lable" value="<?php echo esc_attr_e($jumuah3_lable); ?>"> </div>
     <div class="lable_filed"><label for="montly_text  "><?php esc_attr_e( 'Monthly Url Text   :' );?></label><input type="text" maxlength="90" name="montly_text" value="<?php echo esc_url($montly_text); ?>"> </div>
	 </div>	
	 <div class="lable_filed">	<input type="submit" value="<?php esc_attr_e( 'Save' );?>" name="Save_label" id="Save_info"> </div>
		</form>
	</div>
</div>
<div id="Cron" class="tabcontent" style="display:none">

</div>
<div id="Endpoints" class="tabcontent" style="display:none">
 
</div>

<script>

function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
jQuery('input#masjid_calendar_type').click(function() {
	
   if(jQuery(this).is(':checked')) { 
 
     var val= jQuery(this).val();
	if(val == 'Custom_url'){
		jQuery(".rest_filed.montly_pdf_filed").show();
	}else{
		jQuery(".rest_filed.montly_pdf_filed").hide();
	}
   }
});

jQuery("a.newclose").click(function(){
	jQuery(".alert.alert-success.alert-dismissible").hide();
});



var inputEle = document.getElementById('timeInput');

function onTimeChange() {
  var timeSplit = inputEle.value.split(':'),
    hours,
    minutes,
    meridian;
	
  hours = timeSplit[0];
  minutes = timeSplit[1];
 // alert(hours);
  if (hours > 12) {
    meridian = 'PM';
    hours -= 12;
  } else if (hours < 12) {
    meridian = 'AM';
    if (hours == 0) {
      hours = 12;
    }
  } else {
    meridian = 'PM';
  }
if(hours ==null || minutes ==null || meridian ==null ){
    jQuery("#jumuah3_time").val("");
}else{
	
	jQuery("#jumuah3_time").val(hours + ':' + minutes + ' ' + meridian);
	
}
  
}

var inputEle1 = document.getElementById('khutbahtimeInput');

function onkhutbahChange() {
  var timeSplit = inputEle1.value.split(':'),
    hours,
    minutes,
    meridian;
  hours = timeSplit[0];
  minutes = timeSplit[1];
  if (hours > 12) {
    meridian = 'PM';
    hours -= 12;
  } else if (hours < 12) {
    meridian = 'AM';
    if (hours == 0) {
      hours = 12;
    }
  } else {
    meridian = 'PM';
  }
  //alert(hours + ':' + minutes + ' ' + meridian);
  if(hours ==null || minutes ==null || meridian ==null ){
	  jQuery("#khutbah_time1").val("");
  }else{
  jQuery("#khutbah_time1").val(hours + ':' + minutes + ' ' + meridian);
  }
}
</script>


<?php 
}
?>