<?php

$host="localhost";
$dbUsername="id13530449_ordinacijavt";
$dbPassword="UwwW3_Os92D7ZoV{";
$dbName="id13530449_ordinacija";

try {
    $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbName . ';charset=utf8', $dbUsername, $dbPassword);
} catch (PDOException $exception) {
    // ako je došlo do greške, skripta se stopira
    exit('Failed to connect to database!');
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array('y' => 'year', 'm' => 'month', 'w' => 'week', 'd' => 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second');
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


if (isset($_GET['page_id'])) {

    if (isset($_POST['ime'], $_POST['prezime'], $_POST['email'], $_POST['rating'], $_POST['content'])) {
        // Insert a new review (user submitted form)
        $stmt = $pdo->prepare('INSERT INTO ocjene (page_id, ime, prezime, email, content, rating, submit_date) VALUES (?,?,?,?,?,?,NOW())');
        $stmt->execute([$_GET['page_id'], $_POST['ime'], $_POST['prezime'], $_POST['email'], $_POST['content'], $_POST['rating']]);
        exit('Uspješno ste poslali osvrt. Ponovno učitajte stranicu kako biste ga vidjeli.');
    }
    // Get all reviews by the Page ID ordered by the submit date
    $stmt = $pdo->prepare('SELECT * FROM ocjene WHERE page_id = ? ORDER BY submit_date DESC');
    $stmt->execute([$_GET['page_id']]);
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Get the overall rating and total amount of reviews
    $stmt = $pdo->prepare('SELECT AVG(rating) AS overall_rating, COUNT(*) AS total_reviews FROM ocjene WHERE page_id = ?');
    $stmt->execute([$_GET['page_id']]);
    $reviews_info = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    exit('Please provide the page ID.');
}
?>

<div class="container">
<div class="col-md-6">
<div class="overall_rating">
    <span class="num"><?=number_format($reviews_info['overall_rating'], 1)?></span>
    <span class="stars"><?=str_repeat('&#9733;', round($reviews_info['overall_rating']))?></span>
    <span class="total"><?=$reviews_info['total_reviews']?> reviews</span>
</div>
    <a href="#" class="write_review_btn">Napiši osvrt</a>
    <br>
    <div class="write_review">
        <form>
            <input name="ime" type="text" placeholder="Ime (prikazat će se na stranici)" required>
            <input name="prezime" type="text" placeholder="Prezime (neće se prikazati na stranici)" required>
            <input name="email" type="email" placeholder="Email (neće se prikazati na stranici)" required>
            <input name="rating" type="number" min="1" max="5" placeholder="Ocjena (1-5)" required>
            <textarea name="content" placeholder="Komentar..." required></textarea>
            <button type="submit">Pošalji</button>
        </form>
            <br><br><br>
    </div>
</div>
</div>
<?php foreach ($reviews as $review): ?>
<div class="review">
    <h3 class="name"><?=htmlspecialchars($review['ime'], ENT_QUOTES)?></h3>
    <div>
        <span class="rating"><?=str_repeat('&#9733;', $review['rating'])?></span>
        <span class="date"><?=time_elapsed_string($review['submit_date'])?></span>
    </div>
    <p class="content"><?=htmlspecialchars($review['content'], ENT_QUOTES)?></p>
</div>
<?php endforeach ?>