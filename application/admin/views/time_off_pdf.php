<!DOCTYPE html>

<html lang="en">

<head>

<div  style="padding-top:5px;margin:5px;"><img src="<?=base_url('assets/images/pr_logo.png')?>" border="0" width="25%"></div>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?=base_url('assets')?>/css/icons.css" rel="stylesheet" type="text/css" />

<style type="text/css"></style>

</head>

<body style="margin-top: 0px;margin-left: 0px; background: #d5d5d5;font-family: 'Verdana','Helvetica', Arial, sans-serif;font-size: 18px;">

<table style="width:1000px;background: #fff;padding: 0 60px 60px 60px;" >

	<tr>

	<td>
	
	
	<div align="" style="font-size:18px;padding-left:35px;padding-right:35px">
		<b>Name : <?=$record[0]['name']?></b><p></p>   </br>
	</div>
	<div align="" style="font-size:18px;padding-left:35px;padding-right:35px">
		<b>Today's Date : <?=$record[0]['today_date']?></b><p></p>   </br>
	</div>
	<div align="" style="font-size:18px;padding-left:35px;padding-right:35px">
		<b>From Date : <?=$record[0]['from_date']?></b><p></p>   </br>
	</div>
	<div align="" style="font-size:18px;padding-left:35px;padding-right:35px">
		<b>To Date : <?=$record[0]['to_date']?></b><p></p>   </br>
	</div>
	<div align="" style="font-size:18px;padding-left:35px;padding-right:35px">
		<b>Reason : <?=$record[0]['reason']?></b><p></p>   </br>
	</div>
	
	
	<div align="" style="font-size:18px;padding-left:35px;padding-right:35px">
			<b>Employee signature_________________________Date____________</b><p></p>  </br>
		</div>
	
	<div align="" style="font-size:18px;padding-left:35px;padding-right:35px">
			<b>Manager signature_________________________Date____________</b><p></p>  </br>
		</div>
	
	
	</td>

   </tr>
	</td>

   </tr>

</table>

</body>

</html>