<section class="hero is-fullheight-with-navbar">
    <div class="hero-body">
        <div class="container">
            <nav class="panel is-primary mt-4">
                <!-- Title -->
                <div class="panel-heading">
                    <span class="icon-text">
                        <span class="icon mr-4">
                            <i class="fa-solid fa-coins"></i>
                        </span>
                        <span class="has-text-weight-normal">
                            Dashboard
                        </span>
                    </span>
                </div>
                <!-- End title -->
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
                            <i class="fa-solid fa-coins"></i>
                        </span>
                        <span>Dashboard</span>
                    </span>
                    <div>
                        <div class="buttons has-addons">
                            <a class="button is-primary is-outlined" href="<?= Flight::get('flight.base_url') ?>/dashboard/store?type=income">
                                <div class="icon-text">
                                    <span class="icon">
                                        <i class="fa-solid fa-arrow-trend-up"></i>
                                    </span>
                                    <span>Add income</span>
                                </div>
                            </a>
                            <a class="button is-info is-outlined" href="<?= Flight::get('flight.base_url') ?>/dashboard/store?type=outcome">
                                <div class="icon-text">
                                    <span class="icon">
                                        <i class="fa-solid fa-arrow-trend-down"></i>
                                    </span>
                                    <span>Add outcome</span>
                                </div>
                            </a>
                            <a class="button is-danger is-outlined" id="aDelete" href="<?= Flight::get('flight.base_url') ?>/operation/store">
                                <div class="icon-text">
                                    <span class="icon">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </span>
                                    <span>Delete</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- End Breadcrumb-->
                <!-- Search -->
                <div class="panel-block is-hidden">
                    <p class="control has-icons-left">
                        <input class="input" type="text" placeholder="Search">
                        <span class="icon is-left">
                            <i class="fas fa-search" aria-hidden="true"></i>
                        </span>
                    </p>
                </div>
                <!-- End Search -->
                <div class="list-dashboard">
                </div>
                <!-- Pagination -->
                <div class="panel-block is-flex-direction-row is-justify-content-center">
                    <nav class="pagination is-rounded" role="navigation" aria-label="pagination">
                        <ul class="pagination-list">
                        </ul>
                    </nav>
                </div>
                <!-- End Pagination -->
            </nav>
            <div class="notification is-warning mt-5">
                <p><strong>Button delete</strong>:Delete last operation</p>
            </div>
        </div>
    </div>
</section>