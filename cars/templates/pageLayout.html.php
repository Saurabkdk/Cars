<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/styles.css"/>
    <title>Claires's Cars - <?php echo $titleOfThePage; ?></title>
</head>
<body>
<header>
    <section>
        <aside>
            <h3>Opening Hours:</h3>
            <p>Mon-Fri: 09:00-17:30</p>
            <p>Sat: 09:00-17:00</p>
            <p>Sundays: Closed</p>
        </aside>
        <img src="/images/logo.png"/>

    </section>
</header>
<nav>
    <ul>
        <li><a href="/Stories/inventory">Home</a></li>
        <li><a href="/Cars/inventory">Showroom</a></li>
        <li><a href="/about.html">About Us</a></li>
        <li><a href="/contact.php">Contact us</a></li>
        <li><a href="/Cars/career">Claire's Career</a></li>
    </ul>

</nav>
<img src="../images/randombanner.php"/>

    <?php echo $contentOfThePage; ?>



<footer>
    &copy; Claire's Cars 2018
</footer>
</body>
</html>

