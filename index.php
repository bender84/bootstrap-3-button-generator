<?php
function changeColor($hex, $amount) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}

	$rNew = ($r + $amount) >=0 ? ($r + $amount) : 0;
	$gNew = ($g + $amount) >=0 ? ($g + $amount) : 0;
	$bNew = ($b + $amount) >=0 ? ($b + $amount) : 0;

	$hexNew = "";
	$hexNew .= str_pad(dechex($rNew), 2, "0", STR_PAD_LEFT);
	$hexNew .= str_pad(dechex($gNew), 2, "0", STR_PAD_LEFT);
	$hexNew .= str_pad(dechex($bNew), 2, "0", STR_PAD_LEFT);

	return $hexNew;
}


$bootstrap='.btn-%CLASS% {
	background-color: #%COLOR_ORIG%;
	border-color: #%COLOR_ORIG_BRD%;
	color:#%TEXT_COLOR%;
}
.btn-%CLASS%:hover,
.btn-%CLASS%:focus,
.btn-%CLASS%:active,
.btn-%CLASS%.active {
	background-color: #%COLOR%;
	border-color: #%COLOR_BRD%;
	color:#%TEXT_COLOR%;
}
.btn-%CLASS%.disabled:hover,
.btn-%CLASS%.disabled:focus,
.btn-%CLASS%.disabled:active,
.btn-%CLASS%.disabled.active,
.btn-%CLASS%[disabled]:hover,
.btn-%CLASS%[disabled]:focus,
.btn-%CLASS%[disabled]:active,
.btn-%CLASS%[disabled].active,
fieldset[disabled] .btn-%CLASS%:hover,
fieldset[disabled] .btn-%CLASS%:focus,
fieldset[disabled] .btn-%CLASS%:active,
fieldset[disabled] .btn-%CLASS%.active {
	background-color: #%COLOR_ORIG%;
	border-color: #%COLOR_ORIG_BRD%;
	color:#%TEXT_COLOR%;
}';


$CLASS = isset($_POST['CLASS']) ? $_POST['CLASS'] : "custom";
$COLOR_ORIG = isset($_POST['COLOR_ORIG']) ? $_POST['COLOR_ORIG'] : "888888";
$TEXT = isset($_POST['TEXT']) ? $_POST['TEXT'] : "Button";
$TEXT_COLOR = isset($_POST['TEXT_COLOR']) ? $_POST['TEXT_COLOR'] : "FFFFFF";

$COLOR_ORIG_BRD = changeColor($COLOR_ORIG, -13);
$COLOR = changeColor($COLOR_ORIG, -16);
$COLOR_BRD = changeColor($COLOR_ORIG, -40);

$bootstrap = str_replace("%CLASS%", $CLASS, $bootstrap);
$bootstrap = str_replace("%COLOR_ORIG%", $COLOR_ORIG, $bootstrap);
$bootstrap = str_replace("%COLOR_ORIG_BRD%", $COLOR_ORIG_BRD, $bootstrap);
$bootstrap = str_replace("%COLOR%", $COLOR, $bootstrap);
$bootstrap = str_replace("%COLOR_BRD%", $COLOR_BRD, $bootstrap);
$bootstrap = str_replace("%TEXT_COLOR%", $TEXT_COLOR, $bootstrap);


?><!DOCTYPE html>
<html lang="cs">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Bootstrap 3 Button Generator</title>
		<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
<?php
	// Google Analytics tracking on my site
	if(preg_match("/rotten77/", $_SERVER['SERVER_NAME'])) include dirname(__FILE__) . "/../ga.html";
?>
<style>
textarea {
	font-family: monospace;
}
.color-picker-wrap {
	width: 40px;
}
</style>
		<?php echo "<style>\n".$bootstrap."\n</style>"; ?>
	</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Bootstrap 3 Button Generator</h1>
			<hr />
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<form role="form" class="form-horizontal" action="./" method="post">
				<div class="form-group">
					<label for="COLOR_ORIG" class="col-lg-2 control-label">Color</label>
					
					<div class="col-lg-6">
						<div class="input-group">
							<span class="input-group-addon">#</span>
							<input type="text" class="form-control" name="COLOR_ORIG" id="COLOR_ORIG" value="<?php echo $COLOR_ORIG; ?>" placeholder="888888">
								
							<span class="input-group-btn color-picker-wrap">
								<input type="color" data-target="COLOR_ORIG" class="color-picker form-control" />
							</span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="TEXT_COLOR" class="col-lg-2 control-label">Text color</label>
					
					<div class="col-lg-6">
						<div class="input-group">
							<span class="input-group-addon">#</span>
							<input type="text" class="form-control" name="TEXT_COLOR" id="TEXT_COLOR" value="<?php echo $TEXT_COLOR; ?>" placeholder="ffffff">

							<span class="input-group-btn color-picker-wrap">
								<input type="color" data-target="TEXT_COLOR" class="color-picker form-control" />
							</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label for="CLASS" class="col-lg-2 control-label">Class</label>
					
					<div class="col-lg-8">
						<div class="input-group">
							<span class="input-group-addon">btn-</span>
							<input type="text" class="form-control" name="CLASS" id="CLASS" value="<?php echo $CLASS; ?>" placeholder="-custom">
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="TEXT" class="col-lg-2 control-label">Text</label>
					
					<div class="col-lg-8">
							<input type="text" class="form-control" name="TEXT" id="TEXT" value="<?php echo $TEXT; ?>" placeholder="Button">
					</div>
				</div>

				<div class="form-group">
					<div class="col-lg-8 col-lg-offset-2">
						<button type="submit" class="btn btn-info">Submit</button>
					</div>
				</div>
				
				
			</form>
		</div>
		<div class="col-md-6">
	
			<p>
				<a href="#" class="btn btn-<?php echo $CLASS; ?> btn-lg"><?php echo $TEXT; ?></a>

				<a href="#" class="btn btn-<?php echo $CLASS; ?>"><?php echo $TEXT; ?></a>

				<a href="#" class="btn btn-<?php echo $CLASS; ?> btn-sm"><?php echo $TEXT; ?></a>

				<a href="#" class="btn btn-<?php echo $CLASS; ?> btn-xs"><?php echo $TEXT; ?></a>
			</p>
			
			<p class="form">
				<textarea cols="20" rows="30" class="form-control"><?php echo $bootstrap; ?></textarea>
			</p>
		</div>
	</div>
</div>
<script src="./bootstrap/js/jquery.js"></script>
<script src="./bootstrap/js/bootstrap.min.js"></script>
<script>
$(function(){
	// Check if browser has support of input[type="color"]
	var i = document.createElement("input");
	i.setAttribute("type", "color");
	if(i.type == "text") $('.color-picker-wrap').hide();

	$('#COLOR_ORIG, #TEXT_COLOR').each(function(){
		$('input[data-target="'+$(this).attr("id")+'"]').val("#" + $(this).val());
	});

	$('.color-picker').change(function(){
		console.log($(this).val());
		$('#'+$(this).data("target")).val($(this).val().replace("#", ""));
	});
});
</script>
</body>
</html>

