<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Результат работы машины вывода CLIPS';
$this->params['breadcrumbs'][] = ['label' => 'Базы знаний', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="knowlegebase-clipsrun">

    <h1><?= Html::encode($this->title) ?></h1>
    <br \> 
</div>



<?php
    $fname = $model->shortname;
    $file_clp = $fname . ".clp";
    $file_run = $fname . ".run";
    $file_rez = $fname . ".rez";
   
    if (file_exists($file_rez)) {
        $context = file_get_contents($file_rez);
        if($context != "") echo "<div class='well'>$context</div>";
        else echo "<div class='well'>Нет данных</div>";
        sleep(2);
        
    }
    else echo "Error";

    //if (file_exists($file_rez)) array_map('unlink', glob($file_rez)); //отчистить папку 
    //if (file_exists($file_run)) array_map('unlink', glob($file_run)); //отчистить папку 
    //if (file_exists($file_clp)) array_map('unlink', glob($file_clp)); //отчистить папку 

?>
