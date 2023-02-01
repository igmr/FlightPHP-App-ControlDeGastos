
<?php

$showSelectSubclassification  = false;
$subclassifications = [];
$subclassification = 2;
$description = '';
$amount = '';
$edit = false;
if($id > 0)
{
    $edit      = true;
    $dashboard = $data['row'];
    $subclassification = $dashboard->subclassification_id;
    $description = $dashboard->description;
}
if ($income == 0)
{
    $showSelectSubclassification  = true;
    $subclassifications = json_decode($data['subclassifications'],true);
}


?>

<section class="hero  is-fullheight-with-navbar">
    <div class="hero-body">
        <form class="container" id="store">
            <input type="hidden" name="id" id="id" value="<?= $id ?>">
            <input type="hidden" name="action" id="action" value="<?= $income == 1 ? 'income' : 'outcome'?>">
            <nav class="panel <?= $id < 0 ? 'is-primary' : 'is-info' ?>">
                <p class="panel-heading">
                    <?= $title ?>
                </p>
                <!-- Breadcrumb -->
                <div class="panel-block
                    is-flex-direction-row is-justify-content-space-between">
                    <span class="icon-text">
                        <span class="icon">
                            <i class="fa-solid fa-dollar-sign"></i>
                        </span>
                        <span>Home</span>
                        <span class="icon">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="icon">
                            <i class="fa-solid fa-list-check"></i>
                        </span>
                        <span><?= $income ? 'Income' : 'Outcome' ?></span>
                        <span class="icon">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                        <?php if($id < 0){ ?>
                            <span class="icon">
                                <i class="fa-solid fa-plus"></i>
                            </span>
                            <span>Add</span>
                        <?php }else { ?>
                            <span class="icon">
                                <i class="fa-solid fa-pen-nib"></i>
                            </span>
                            <span>Edit</span>
                        <?php } ?>
                    </span>
                </div>
                <!-- End Breadcrumb-->
                <?php if($showSelectSubclassification){ ?>
                    <div class="panel-block control is-flex-direction-column is-align-items-start">
                        <div class="select" style="width:100%" id="select">
                            <select style="width:100%" id="subclassification" name="subclassification">
                                <?php
                                foreach($subclassifications as $item){
                                    if($item['id'] != 1)
                                    {
                                        $selected = $subclassification == $item['id'] ?'selected': '';
                                        echo '<option value="'. $item['id'] .'" '.$selected.'>'.$item['name'].'</option>';
                                    }
                                }
                                /**/
                                ?>
                            </select>
                        </div>
                        <p class="help is-hidden is-success " id="info-subclassification">The field is valid</p>
                    </div>
                <?php  } ?>
                <?php if($edit == false){ ?>
                    <div class="panel-block control is-flex-direction-column is-align-items-start">
                        <input value="<?= $amount ?>" class="input is-small" type="text" name="amount" id="amount" placeholder="Amount">
                        <p class="help is-success is-hidden" id="info-amount">The field is valid</p>
                    </div>
                <?php } ?>
                <div class="panel-block control is-flex-direction-column is-align-items-start">
                    <textarea  class="textarea is-small" name="description" id="description" placeholder="Description"><?= $description ?></textarea>
                    <p class="help is-hidden is-success " id="info-description">The field is valid</p>
                </div>
                <div class="panel-block is-justify-content-center">
                    <div class="buttons">
                        <button type="submit" class="button is-success is-outlined ">
                            Save
                        </button>
                        <a href="<?= Flight::get('flight.base_url') ?>/"  class="button is-danger is-outlined ">
                            Cancel
                        </a>
                    </div>
                </div>
            </nav>
        </form>
    </div>
</section>

