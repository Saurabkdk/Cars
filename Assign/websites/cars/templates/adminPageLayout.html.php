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
        <li><a href="/">Home</a></li>
        <li><a href="/Cars/inventory">Showroom</a></li>
        <li><a href="/about.html">About Us</a></li>
        <li><a href="/Contacts/addEdit">Contact us</a></li>
        <li><a href="/Cars/career">Claire's Career</a></li>
    </ul>

</nav>
<img src="../images/randombanner.php"/>

<main class="admin">

    <?php if (isset($_SESSION['adminLogin'])) {?>
    <section class="left">
        <ul>
            <li><a href="../AdminManufacturers/inventory">Manufacturers</a></li>
            <li><a href="../AdminCars/inventory">Cars</a></li>
            <li><a href="../AdminArchive/inventory">Archive</a></li>
            <li><a href="../Administrators/inventory">Administrators</a></li>
            <li><a href="../Stories/addEdit">Add News/Story</a></li>
            <li><a href="../Contacts/inventory">Enquiries</a></li>
            <li><a href="../Login/logoutAdmin">Logout</a></li>

        </ul>
    </section>
    <?php } ?>

    <?php echo $contentOfThePage; ?>

</main>


<footer>
    &copy; Claire's Cars 2018
</footer>
</body>
</html>

