<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Komentari pacijentica</title>
		<link href="styles/reviewindex.css" rel="stylesheet" type="text/css">
		<link href="styles/reviewstyle.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.js"></script>
	</head>


<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
	<div class="container-fluid">
		<a class="navbar-brand" href="#"><img src="img/logo.png"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
				<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="index.html">Početna stranica</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="radnovrijeme.html">Radno vrijeme</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="contactform.html">Imate pitanje?</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="review_pocetna.php">Komentari pacijentica</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="gallery.html">Foto galerija</a>
				</li>
				
			</ul>
		</div>
	</div>
</nav>

	
<div class="jumbotron bg-transparent">
<div class="container">
	<div class="content home">

		<h1 class="naslov">Komentari pacijentica</h1>
		<h4 class="subtitle">Ovdje možete vidjeti osvrte naših pacijentica te ostaviti svoj. <br>Molimo Vas da upišete točne podatke.</h4>

<br>

	<div class="reviews"></div>
		<script>
		const reviews_page_id = 1;
		fetch("reviews.php?page_id=" + reviews_page_id).then(response => response.text()).then(data => {
			document.querySelector(".reviews").innerHTML = data; //inner HTML vraća HTML sadržaj nekog elementa. znači ovdje smo cijeli HTML od reviewsa stavili da je tipa data 
			document.querySelector(".reviews .write_review_btn").onclick = event => {
				event.preventDefault(); //ovo se odnosi na dugme za upisivanje recenzije (stranica se nece ponovno ucitati kad kliknemo na njega)
				document.querySelector(".reviews .write_review").style.display = 'block';
				document.querySelector(".reviews .write_review input[name='name']").focus();
			};

			//POST request i fetching
			document.querySelector(".reviews .write_review form").onsubmit = event => {
				event.preventDefault();  
				fetch("reviews.php?page_id=" + reviews_page_id, {
					method: 'POST',
					body: new FormData(document.querySelector(".reviews .write_review form")) //body deklarira oblik responsea
					//FormData objekt -> pomaže slanju key-value parova pomoću AJAXA te za poslati formu bez da refreshamo stranicu
				}).then(response => response.text()).then(data => {
					document.querySelector(".reviews .write_review").innerHTML = data;
				});
			};
		});
		</script>

</div>
</div>
</div>


<!--- Footer -->
<footer>
	<div class="container-fluid padding">
		<div class="row text-center">
			<div class="col-md-4">
				
				<i class="fas fa-phone"></i>
				<h5>Kontakt</h5>
				<hr class="light">
				<p>Kontakt: 00385 23 250 167</p>
				<p>Ginekološka ordinacija dr. Ivica Vlatković</p>
				
			</div>
			<div class="col-md-4">
				
				<i class="far fa-clock"></i>
				<h5>Radno vrijeme</h5>
				<hr class="light">
				<p>Pon-pet: na smjene od 8h do 20h</p>
				<p><a target="_blank" href="radnovrijeme.html" style="underline">Ovdje</a> možete vidjeti detaljno radno vrijeme</p>
			</div>

			<div class="col-md-4">
			
				<i class="fas fa-map-marker-alt"></i>
				<h5>Lokacija</h5>
				<hr class="light">
				<p>Obala kralja Petra Krešimira IV 9, Zadar</p>
				<p><a href="../index.html#klikni">Ovdje</a> možete vidjeti lokaciju</p>
			</div>
		</div>
	</div>
</footer>
</body>
</html>