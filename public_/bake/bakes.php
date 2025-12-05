<?php
session_start();
require_once 'dbconnect.php';

try {
    // Optional category filter: ?category=cakes, cookies, pastries, bread
    $category = isset($_GET['category']) ? $_GET['category'] : null;

    // Map category slug -> bakeTypeID in DB
    $categoryMap = [
        'cakes'    => 1,
        'cookies'  => 2,
        'pastries' => 3,
        'bread'    => 4
    ];

    // Pretty names for the heading
    $categoryNames = [
        'cakes'    => 'Cakes',
        'cookies'  => 'Cookies',
        'pastries' => 'Pastries',
        'bread'    => 'Bread'
    ];

    $sql = "
        SELECT
            bakes.bakeID,
            bakes.bakeName,
            bakes.description,
            bakes.price,
            bakes.bakeTypeID,
            bakes.imageFileName
        FROM bakes
        WHERE 1 = 1
    ";

    if ($category && isset($categoryMap[$category])) {
        $sql .= " AND bakes.bakeTypeID = :bakeTypeID";
    }

    $query = $db->prepare($sql);

    if ($category && isset($categoryMap[$category])) {
        $query->bindValue(':bakeTypeID', $categoryMap[$category], PDO::PARAM_INT);
    }

    $query->execute();
    $bakes = $query->fetchAll(PDO::FETCH_ASSOC);

    // Page heading
    $heading = 'All bakes';
    if ($category && isset($categoryNames[$category])) {
        $heading = $categoryNames[$category];
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
<?php include '../components/header.php'; ?>


<main>
    <!-- Heading + intro -->
    <section class="section">
        <h2><?= htmlspecialchars($heading, ENT_QUOTES, 'UTF-8') ?></h2>
        <p class="section-intro">
            <?php if ($heading === 'All bakes'): ?>
                Browse all cakes, cookies, pastries and breads.
            <?php else: ?>
                Showing only <?= htmlspecialchars($heading, ENT_QUOTES, 'UTF-8') ?>.
            <?php endif; ?>
        </p>
    </section>

    <!-- Text-only category tiles, like on home -->
    <section class="section section-alt">
        <h3>Browse by category</h3>

        <div class="card-grid categories-grid">
            <a href="bakes.php?category=cakes" class="card category-card">
                <h4>Cakes</h4>
                <p>Celebration cakes, layer cakes, and loaf cakes for every event.</p>
            </a>

            <a href="bakes.php?category=cookies" class="card category-card">
                <h4>Cookies</h4>
                <p>Soft, chewy, or crunchy cookies baked fresh daily.</p>
            </a>

            <a href="bakes.php?category=pastries" class="card category-card">
                <h4>Pastries</h4>
                <p>Buttery croissants, danishes, and puff pastry delights.</p>
            </a>

            <a href="bakes.php?category=bread" class="card category-card">
                <h4>Bread</h4>
                <p>Fresh loaves, rolls, and specialty breads.</p>
            </a>
        </div>
    </section>

    <!-- Products grid -->
    <section class="section">
        <div class="card-grid">
            <?php if (empty($bakes)): ?>
                <p>No bakes found for this category.</p>
            <?php else: ?>
                <?php foreach ($bakes as $row): ?>
                    <article class="card product-card">
                        <?php if (!empty($row['imageFileName'])): ?>
                            <!-- product images: public_/bake/img/uploads/{imageFileName from DB} -->
                            <img
                                src="img/uploads/<?= htmlspecialchars($row['imageFileName'], ENT_QUOTES, 'UTF-8') ?>"
                                alt="<?= htmlspecialchars($row['bakeName'], ENT_QUOTES, 'UTF-8') ?>"
                                class="product-image"
                                style="height:140px;width:100%;object-fit:cover;border-radius:0.7rem;"
                            >
                        <?php else: ?>
                            <div class="product-image placeholder-image">Bake</div>
                        <?php endif; ?>

                        <h4><?= htmlspecialchars($row['bakeName'], ENT_QUOTES, 'UTF-8') ?></h4>

                        <?php if (!empty($row['description'])): ?>
                            <p><?= htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') ?></p>
                        <?php endif; ?>

                        <p class="price">£<?= number_format($row['price'], 2) ?></p>

                        <form action="../basket_add.php" method="post" class="add-to-basket-form">
                            <input type="hidden" name="bakeID" value="<?= (int)$row['bakeID'] ?>">
                            <label>
                                Qty:
                                <input type="number" name="qty" value="1" min="1" class="qty-input">
                            </label>
                            <button type="submit" class="btn small">Add to basket</button>
                        </form>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</main>



<?php include '../components/footer.php'; ?>
<?php include '../components/script.html'; ?>
</body>
</html>
