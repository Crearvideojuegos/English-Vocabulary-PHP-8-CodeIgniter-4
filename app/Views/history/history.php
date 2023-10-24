<main class="mb-6">
    <div class="container">
        <div class="row d-flex">
            <div class="col-12 my-5">

                <div class="mb-5">
                    <div class="accordion" id="accordionHistory">

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingHistory">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHistory" aria-expanded="false" aria-controls="collapseHistory">
                                <strong>How does the <i>History</i> section work?</strong>

                            </button>
                            </h2>
                            <div id="collapseHistory" class="accordion-collapse collapse" aria-labelledby="headingHistory" data-bs-parent="#accordionHistory">
                            <div class="accordion-body">
                                The history shows all the failures you have had in the game. This section will not be deleted or reset.
                            </div>
                            </div>
                        </div>

                    </div>
                </div>

            <table class="table table-responsive table-hover table-striped text-center" style="width: 100%;">
                <thead>
                    <tr class="tr-head">
                        <th style="width: 35%;">English</th>
                        <th style="width: 35%;">Native</th>
                        <th style="width: 20%;">Description</th>
                        <th style="width: 15%;">More Info</th>

                    </tr>
                </thead>

                <tbody>
                            
                    <?php
                        if ($history_user) {
                            $number_color = 1;

                            $number_column = random_int(100, 999);

                            foreach ($history_user as $history) { 
                                $number_color++;

                                if($number_color&1) {
                                    $css_td = 'table-primary';
                                } else {
                                    $css_td = 'table-info';
                                }    

                                if(!is_null($history['id_word'])) {
                                    $english = $history['english_word'];
                                    $native = $history['native_word'];
                                    $description = $history['description'];
                                    $fails = $history['word_failed'];
                                    $success = $history['word_success'];
                                    $state_active_in_game = $history['word_success'];
                                    $created_at = $history['created_at'];
                                } else {
                                    $english = $history['english_sentence'];
                                    $native = $history['native_sentence'];
                                    $description = '';
                                    $fails = $history['sentence_failed'];
                                    $success = $history['sentence_success'];
                                    $state_active_in_game = $history['sentence_game'];
                                    $created_at = $history['created_at'];
                                }

                                $active_in_game = 'Yes';
                                if($state_active_in_game == 1)
                                {
                                    $active_in_game = 'Failed';
                                } else if($state_active_in_game == 2) {
                                    $active_in_game = 'Passed';
                                }

                        ?>


                            <tr class="<?php echo $css_td; ?>">
                                <td><?php echo $english; ?></td>
                                <td><?php echo $native; ?></td>
                                <td><?php echo $description; ?></td>
                                <td>
                                    <button type="button" class="btn btn-secondary button-show"
                                    data-td="<?php echo $number_column; ?>"
                                    data-state="close">
                                    <i class="bi bi-plus-square"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr class="d-none" id="tr-two-<?php echo $number_column; ?>">
                                <td colspan="4">
                                    <span><strong>Active in Game: </strong><?php echo $active_in_game; ?></span>
                                    <span><strong>Fails: </strong><?php echo $fails; ?></span>
                                    <span><strong>Success: </strong><?php echo $success; ?></span>
                                    <span><strong>Created At: </strong><?php echo $created_at; ?></span>

                                </td>
                            </tr>


                        <?php
                            $number_column++;
                            }
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
                        echo pagination($get_url, $num_page, $initial_number, $number_condition_limit, $total_pages, 'history');
                    }

                ?>
            </div>
        </div>
    </div>

    </div>
</main>