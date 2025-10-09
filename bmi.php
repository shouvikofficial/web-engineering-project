<?php
require 'includes/db.php';
require 'includes/functions.php';
session_start();
$recommendation = null;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $height = floatval($_POST['height_cm'])/100;
  $weight = floatval($_POST['weight_kg']);
  if($height>0){
    $bmi = round($weight/($height*$height),2);
    if($bmi < 18.5) $rec = 'Underweight — increase healthy calories and strength training.';
    elseif($bmi < 25) $rec = 'Normal — maintain with balanced routine.';
    elseif($bmi < 30) $rec = 'Overweight — focus cardio & caloric deficit.';
    else $rec = 'Obese — consult your trainer & nutritionist.';
    $recommendation = ['bmi'=>$bmi,'text'=>$rec];
    // optional: save to progress if member logged in
    if(isset($_SESSION['member_id'])){
      $stmt = $pdo->prepare("INSERT INTO progress (member_id, record_date, weight, bmi, note) VALUES (?,?,?,?,?)");
      $stmt->execute([$_SESSION['member_id'], date('Y-m-d'), $weight, $bmi, $rec]);
    }
  }
}
include 'includes/header.php';
?>
<div class="container">
  <h2>BMI Calculator</h2>
  <form method="post" class="form-grid">
    <input name="height_cm" id="height_cm" placeholder="Height (cm)" required>
    <input name="weight_kg" id="weight_kg" placeholder="Weight (kg)" required>
    <button class="btn">Calculate</button>
  </form>
  <p id="bmi_preview"></p>
  <?php if($recommendation): ?>
    <div class="card"><h3>Your BMI: <?php echo esc($recommendation['bmi']); ?></h3><p><?php echo esc($recommendation['text']); ?></p></div>
  <?php endif; ?>
</div>
<?php include 'includes/footer.php'; ?>
