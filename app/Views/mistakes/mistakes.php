<main class="mb-6">
    <div class="container">
        <div class="row d-flex">
            <div class="col-12 my-5">
                <div class="mb-5">

                    <div class="accordion" id="accordionSentence">

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSentence">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSentence" aria-expanded="false" aria-controls="collapseSentence">
                                <strong>How does the <i>Mistakes</i> section work?</strong>
                            </button>
                            </h2>
                            <div id="collapseSentence" class="accordion-collapse collapse" aria-labelledby="headingSentence" data-bs-parent="#accordionSentence">
                            <div class="accordion-body">
                            This is where the mistakes you have made in the game are stored. You can reset them at any time, making all words and sentences available again.
                            </div>
                            </div>
                        </div>

                    </div>
                </div>

            <?php
                if ($mistakes_user) {
            ?>

            <button type="button" id="reset-mistakes" data-bs-toggle="modal" data-bs-target="#resetModal" >
                Reset Mistakes
            </button>

            <table class="table table-responsive table-hover table-striped mt-5 text-center" style="width: 100%;">

                <thead>
                    <tr class="tr-head">
                        <th style="width: 35%;">English</th>
                        <th style="width: 35%;">Native</th>
                        <th style="width: 30%;">Description</th>
                    </tr>
                </thead>

                <tbody>
                        <?php
                            foreach ($mistakes_user as $mistakes) { 

                        ?>
                            <tr class="table-active">
                                <td><?php echo $mistakes['english']; ?></td>
                                <td><?php echo $mistakes['native']; ?></td>
                                <td>
                                    <?php 
                                        if(isset($mistakes['description']))
                                        {
                                            echo $mistakes['description']; 
                                        } else {
                                            echo '';
                                        }
                                    ?>
                                </td>
                            </tr>

                        <?php
                            }
                        ?>
                </tbody>
            </table>
            
            <div class="col-md-12 text-center text-lg-start media-mt-3">
                <?php 

                    /***************PAGINATION***************/
                    $get_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
                    if (isset($_GET['page'])) {
                        $get_url = str_replace('page=' . $_GET['page'], '', $get_url);
                    }

                    if ($total_pages != 1) {
                        echo pagination($get_url, $num_page, $initial_number, $number_condition_limit, $total_pages, 'mistakes');
                    }

                ?>
            </div>

            <?php
                }
            ?>
            </div>
        </div>

    </div>
</main>

<!--Reset Popup-->
<div class="modal" tabindex="-1" id="resetModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reset Mistakes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="p-4 p-md-5 border rounded-3 bg-light">
                Do you want reset your mistakes?
                <a class="btn btn-danger" href="<?php echo base_url(); ?>mistakes/reset-mistakes">Yes</a>

                <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--End Reset Popup-->
