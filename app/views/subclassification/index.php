<section class="hero is-fullheight-with-navbar">
    <div class="hero-body">
        <div class="container">
            <nav class="panel is-primary mt-4">
                <!-- Title -->
                <div class="panel-heading">
                    <span class="icon-text">
                        <span class="icon mr-4">
                            <i class="fa-solid fa-list-check"></i>
                        </span>
                        <span class="has-text-weight-normal">
                            Subclassification
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
                            <i class="fa-solid fa-list-check"></i>
                        </span>
                        <span>Subclassification</span>
                    </span>
                    <a class="button is-primary is-outlined" href="<?= Flight::get('flight.base_url') ?>/subclassification/store">
                        <div class="icon-text">
                            <span class="icon">
                                <i class="fa-solid fa-plus"></i>
                            </span>
                            <span>Add</span>
                        </div>
                    </a>
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
                <div class="list-subclassification">
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
        </div>
    </div>
</section>
