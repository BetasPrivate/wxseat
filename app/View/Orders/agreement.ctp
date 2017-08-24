<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="initial-scale=1.0,user-scalable=no,width=device-width,height=device-height" />
		<meta name="format-detection" content="telephone=no" />
		<link rel="stylesheet" href="css/common.css" type="text/css"/>
		<title>协议和承诺书</title>
		<style>
			body {
				background-color: #FFFFFF;
			}
			.mobile {
				background-color: #FFFFFF;
				padding:10px;
				font-size: 14px;
				line-height: 26px;
				box-sizing: border-box;
			}
			.mobile h2 {
				text-align: center;
				font-size: 28px;
				line-height: 50px;
			}
			.mobile h3 {
				text-indent:70%;
			}
			.mobile p {
				text-indent: 28px;
			}
			.mobile dl dd {
				width:50%;
				text-indent: 24px;
				float:left;
			}
			.mobile dl {
				margin-bottom: 30px;
			}
			@media only screen and (min-width: 750px) {
				.mobile {
					background-color: #FFFFFF;
					padding:20px;
					font-size: 14px;
					line-height: 26px;
					box-sizing: border-box;
				}
			}
		</style>
	</head>
	<body>
		<section class="mobile">
			<?php echo $protocol['Protocol']['text'];?>
		</section>
	</body>
</html>
