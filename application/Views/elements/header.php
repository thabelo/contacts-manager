<?php
	if (!session_id()) {
		session_start();
	}
?>
<head>
	<meta charset="utf-8">
	<title>AGSWORLD</title>
	<meta name="description" content="AGSWORLD">
	<meta name="author" content="Thabel Mmbengeni">
	<link rel="stylesheet" href="../../../assets/css/style.css">
	<script language="javascript" src="../../../assets/js/libs/jquery-1.7.1.min.js"></script>
	<script language="javascript" src="../../../assets/js/main.js"></script>
	
</head>

<div class="header-banner"> </div>
<div class="main-header">
	<nav>
		<ul>
			<li> <a href="../Users/"> Home </a> </li>
			<li> <a href="../Contacts/"> Contacts </a> </li>
			<li> <a href="../Admin/"> Admin </a> </li>
		</ul>
	</nav>
</div>
<div class="search">
	<div class="search-input">
		<input type="text" id="searchData" placeholder="Search Contacts" class="wide80" />
		<div class="button orange wide20 search-button" id="searchButton" type="submit"> Search </div>
	</div>
	<div class="search-results wide50"> </div>
</div>
<div class="clear"> </div>

<?php
	if (isset($_SESSION['flash'])) {
		$data = $_SESSION['flash'];
		unset($_SESSION['flash']);
	?>
	<div class="flash-message <?php echo $data['color']; ?>">
		<?php 
		echo $data['message'];
		?>
	</div>
<?php } ?>
