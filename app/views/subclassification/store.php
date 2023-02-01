
<?php
if(is_array($data['classifications']))
{
    $classifications = $data['classifications'];
}
else
{
    $classifications = json_decode($data['classifications'],true);
}
if($id < 3)
{
    $name           = '';
    $description    = '';
    $classification = 2;
}
else
{
    $data          = json_decode($data['subclassification'],true);
    $name           = $data['name'] ?: '';
    $description    = $data['description'] ?: '';
    $classification = $data['classification_id'] ?: 2;
}
?>
<section class="hero  is-fullheight-with-navbar">
    <div class="hero-body">
        <form class="container" id="store">
            <input type="hidden" name="id" id="id" value="<?= $id ?>">
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
                        <span>Subclassification</span>
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

                <div class="panel-block control is-flex-direction-column is-align-items-start">
                    <div class="select" style="width:100%" id="select">
                        <select style="width:100%" id="classification" name="classification">
                            <?php
                                foreach($classifications as $item){
                                    $selected = $classification == $item['id'] ?'selected': '';
                                    echo '<option value="'. $item['id'] .'" '.$selected.'>'.$item['name'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <p class="help is-hidden is-success " id="info-classification">The field is valid</p>
                </div>
                <div class="panel-block control is-flex-direction-column is-align-items-start">
                    <input value="<?= $name ?>" class="input is-small" type="text" name="name" id="name" placeholder="Name">
                    <p class="help is-success is-hidden" id="info-name">The field is valid</p>
                </div>
                <div class="panel-block control is-flex-direction-column is-align-items-start">
                    <textarea  class="textarea is-small" name="description" id="description" placeholder="Description"><?= $description ?></textarea>
                    <p class="help is-hidden is-success " id="info-description">The field is valid</p>
                </div>
                <div class="panel-block is-justify-content-center">
                    <div class="buttons">
                        <button type="submit" class="button is-success is-outlined ">
                            Save
                        </button>
                        <a href="<?= Flight::get('flight.base_url') ?>/subclassification"  class="button is-danger is-outlined ">
                            Cancel
                        </a>
                    </div>
                </div>
            </nav>
        </form>
    </div>
</section>




