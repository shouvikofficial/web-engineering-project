<?php
session_start();
include 'backend/connection.php';

// Must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Must have plan ID
if (!isset($_GET['plan'])) {
    header("Location: pricing.php");
    exit();
}

$plan_id = intval($_GET['plan']);
$plan = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM pricing_plans WHERE id=$plan_id"));

if (!$plan) {
    echo "Invalid plan!";
    exit();
}

$features = explode(",", $plan['features']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<title>Confirm Purchase</title>

<style>
/* Wrapper */
.purchase-wrapper {
    max-width: 780px;
    margin: 120px auto;
    padding: 10px;
}

/* Main card */
.purchase-card {
    background: var(--white);
    padding: 35px;
    border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    display: flex;
    gap: 35px;
    flex-wrap: wrap;
    align-items: flex-start;   /* FIXED */
}

/* Left section */
.purchase-info {
    flex: 1;
    min-width: 240px;
}

.purchase-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 18px;
}

.plan-price {
    font-size: 2.2rem;
    font-weight: 800;
    color: var(--accent);
    margin-bottom: 8px;
}

.plan-duration {
    font-size: 0.95rem;
    color: var(--gray);
    margin-bottom: 20px;
}

/* Features */
.feature-list {
    list-style: none;
    padding: 0;
}

.feature-list li {
    padding: 9px 0;
    border-bottom: 1px solid #eee;
    display: flex;
    align-items: center;
    gap: 10px;
}

.feature-list li:last-child {
    border-bottom: none;
}

/* Right Summary */
.purchase-summary {
    width: 280px;
    padding: 20px 22px;
    border-radius: 12px;
    border: 1px solid var(--border);
    background: var(--light);
    align-self: flex-start;    /* FIXED */
}

.summary-title {
    font-size: 1.15rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    padding: 7px 0;
}

.total-price {
    font-size: 1.35rem;
    font-weight: 700;
    color: var(--accent);
}

/* Confirm Purchase Button */
.confirm-btn {
    margin-top: 18px;
    width: 100%;
    padding: 12px 0;
    background: var(--accent);
    color: #fff;
    font-size: 1rem;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.25s ease;
    text-align: center;
}

.confirm-btn:hover {
    background: #0052a3;
    transform: translateY(-2px);
}

/* Back Link */
.cancel-link a {
    display: inline-block;
    margin-top: 12px;
    font-size: 0.95rem;
    font-weight: 500;
    color: var(--accent);
    text-decoration: none;
    transition: 0.25s ease;
}

.cancel-link a:hover {
    padding-left: 4px;
    text-decoration: underline;
}

/* Responsive */
@media (max-width: 768px) {
    .purchase-wrapper { max-width: 95%; }
    .purchase-card { padding: 25px; }
}

@media (max-width: 480px) {
    .purchase-title { font-size: 1.5rem; }
    .plan-price { font-size: 1.8rem; }
    .purchase-card { padding: 20px; }
}
</style>

</head>
<body>

<div class="container purchase-wrapper">

    <div class="purchase-card">

        <!-- Left section -->
        <div class="purchase-info">
            <h2 class="purchase-title">Confirm Your Purchase</h2>

            <h3><?= $plan['plan_name'] ?></h3>
            <p class="plan-price">৳<?= number_format($plan['price']) ?></p>
            <p class="plan-duration">Valid for <?= $plan['duration_days'] ?> days</p>

            <h4 style="margin-bottom:10px;">Included Features</h4>
            <ul class="feature-list">
                <?php foreach ($features as $f): ?>
                    <?php $clean = trim($f); ?>
                    <?php if (str_ends_with($clean, ":no")): ?>
                        <li style="opacity: 0.5;">❌ <?= str_replace(":no", "", $clean) ?></li>
                    <?php else: ?>
                        <li>✅ <?= $clean ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Right summary -->
        <div class="purchase-summary">
            <p class="summary-title">Order Summary</p>

            <div class="summary-row">
                <span>Plan:</span>
                <strong><?= $plan['plan_name'] ?></strong>
            </div>

            <div class="summary-row">
                <span>Duration:</span>
                <strong><?= $plan['duration_days'] ?> days</strong>
            </div>

            <div class="summary-row">
                <span>Price:</span>
                <strong>৳<?= number_format($plan['price']) ?></strong>
            </div>

            <hr>

            <div class="summary-row">
                <span>Total:</span>
                <span class="total-price">৳<?= number_format($plan['price']) ?></span>
            </div>

            <!-- Confirm button -->
            <form action="backend/purchase_process.php" method="POST">
                <input type="hidden" name="plan_id" value="<?= $plan['id'] ?>">
                <button type="submit" class="confirm-btn">Confirm Purchase</button>
            </form>

            <!-- Back link -->
            <div class="cancel-link">
                <a href="index.php#pricing">← Back to Pricing</a>
            </div>
        </div>

    </div>

</div>

</body>
</html>
