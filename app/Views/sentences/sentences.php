<main class="mb-6">
    <div class="container">
        <div class="row">
            <div class="col-12 my-5">

                <div class="mb-5">

                    <div class="accordion" id="accordionSentence">

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSentence">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSentence" aria-expanded="false" aria-controls="collapseSentence">
                                <strong>How does the <i>Sentences</i> section work?</strong>
                            </button>
                            </h2>
                            <div id="collapseSentence" class="accordion-collapse collapse" aria-labelledby="headingSentence" data-bs-parent="#accordionSentence">
                            <div class="accordion-body">
                            You can save a sentence in English and its translation into your language. The maximum number of characters for each sentence is 200.
                            </div>
                            </div>
                        </div>

                    </div>

                    <div class="accordion" id="accordionVoice">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingVoice">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVoice" aria-expanded="false" aria-controls="collapseVoice">
                                <strong>About the <i>Voice</i></strong>
                            </button>
                            </h2>
                            <div id="collapseVoice" class="accordion-collapse collapse" aria-labelledby="headingVoice" data-bs-parent="#accordionVoice">
                            <div class="accordion-body">
                            The voice functionality built into this website depends on the browser you are using. 
                            For the same reason, if you change browser it is possible that the voice you have saved may not be the same.
                            Remember to choose an English voice for better pronunciation.
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    $actual_page = '0';
                    if (isset($_GET['page'])) {
                        $actual_page = $_GET['page'];
                    }

                    $attributes = ['class' => 'p-4 p-md-5 border rounded-3 bg-light', 'id' => 'sentence-form'];
                    echo form_open('sentences/save-sentence', $attributes, ['actual_page' => $actual_page]);
                ?>

                <div class="form-floating mb-3">
                    <?php
                    $data = [
                        'type'  => 'text',
                        'name'  => 'english_sentence',
                        'id'    => 'english_sentence',
                        'class' => 'form-control',
                        'minlength' => '2',
                        'maxlength' => '200',
                        'Placeholder' => 'English sentence',
                        'required' => true,
                    ];
                
                    echo form_input($data);
                    echo form_label('English sentence', 'english_sentence');
                
                    echo '<small></small>';

                    ?>
                </div>

                <div class="form-floating mb-3">
                    <?php
                    $data = [
                        'type'  => 'text',
                        'name'  => 'native_sentence',
                        'id'    => 'native_sentence',
                        'class' => 'form-control',
                        'minlength' => '2',
                        'maxlength' => '200',
                        'Placeholder' => 'Your sentence',
                        'required' => true,
                    ];
                
                    echo form_input($data);
                    echo form_label('Your sentence', 'native_sentence');
                
                    echo '<small></small>';

                    ?>
                </div>

                <?php

                    $data = [
                        'name'    => 'button',
                        'class'	  => 'w-100 btn btn-lg btn-success',
                        'value'   => 'Save',
                        'content'   => 'Save',
                        'type'    => 'submit',
                    ];

                    echo form_button($data);
        
                    echo form_close();
                ?>
            </div>
        </div>

        <?php 
            $attributes = ['id' => 'sentences-search-form', 'method' => 'GET'];
            echo form_open('sentences', $attributes);
        ?>
        <table class="table table-responsive table-hover table-striped text-center mb-5" style="width: 100%;">
            <tbody>
                <tr class="table-active">
                    <td style="width: 42%;">
                        <?php
                            $data = [
                                'type'  => 'text',
                                'name'  => 'search_english',
                                'id'    => 'search_english',
                                'class' => 'form-control',
                                'value' => $search_english,
                                'maxlength' => '130',
                                'Placeholder' => 'English',
                            ];
                        
                            echo form_input($data);
                        ?>
                    </td>
                    <td style="width: 42%;">
                        <?php
                            $data = [
                                'type'  => 'text',
                                'name'  => 'search_native',
                                'id'    => 'search_native',
                                'class' => 'form-control',
                                'value' => $search_native,
                                'maxlength' => '130',
                                'Placeholder' => 'Native',
                            ];
                        
                            echo form_input($data);
                        ?>
                    </td>

                    <td style="width: 16%;">
                        <?php
                            $data = [
                                'class'	  => 'w-100 btn btn-info lightColoured',
                                'id'        => 'search-word',
                                'content'   => 'Search',
                                'type'    => 'submit',
                            ];

                            echo form_button($data);
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
            
        <?php
            echo form_close();
        ?>

        <?php echo form_open('profile/save-voice'); ?>
            <input type="hidden" name="voice_page" value="sentence">
            <input type="hidden" name="voice_selected" id="voice_selected" value="<?php echo selected_voice(); ?>">

            <table class="table table-responsive table-hover table-striped text-center mb-5" style="width: 100%;">
                <tbody>
                    <tr class="table-active">
                        <td style="width: 70%;">
                            <select class="form-control" name="voiceList" id='voiceList'></select>
                        </td>
                        <td style="width: 30%;">
                            <?php
                                $data = [
                                    'class'	  => 'w-100 btn btn-secondary',
                                    'id'        => 'select-voice',
                                    'content'   => 'Save Voice',
                                    'type'    => 'submit',
                                ];

                                echo form_button($data);
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php echo form_close(); ?>

            <?php
                if ($sentences_user) {
            ?>

        <table class="table table-responsive table-hover table-striped text-center" style="width: 100%;">

            <thead>
                <tr class="tr-head">
                    <th style="width: 6%;"></th>
                    <th style="width: 39%;">English</th>
                    <th style="width: 39%;">Native</th>
                    <th style="width: 16%;">More Info</th>

                </tr>
            </thead>

            <tbody>
                    <?php
                        $number_color = 1;

                        $number_column = random_int(100, 999);
                        foreach ($sentences_user as $sentences) { 
                            $number_color++;

                            if($number_color&1) {
                                $css_td = 'table-primary';
                            } else {
                                $css_td = 'table-info';
                            }

                            $active_in_game = 'Yes';
                            if($sentences['active_in_game'] == 1)
                            {
                                $active_in_game = 'Failed';
                            } else if($sentences['active_in_game'] == 2) {
                                $active_in_game = 'Passed';
                            }

                            $phpdate = strtotime($sentences['created_at']);
                            $created_at = date('Y-m-d', $phpdate);

                            $id = get_hidden_id($sentences['id']);

                    ?>
                        <tr class="<?php echo $css_td; ?>" id="tr-one-<?php echo $number_column; ?>">
                            <td><button class="readword" data-wordread="<?php echo $sentences['english_sentence']; ?>"><i class="bi bi-volume-up-fill"></i></button></td>
                            <td id="english-<?php echo $number_column; ?>"><?php echo $sentences['english_sentence']; ?></td>
                            <td id="native-<?php echo $number_column; ?>"><?php echo $sentences['native_sentence']; ?></td>
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
                                <span><strong>Active in Game: </strong><span id="active-game-<?php echo $number_column; ?>"><?php echo $active_in_game; ?></span></span>
                                <span><strong>Fails: </strong><?php echo $sentences['number_failed']; ?></span>
                                <span><strong>Success: </strong><?php echo $sentences['number_success']; ?></span>
                                <span><strong>Created At: </strong><?php echo $created_at; ?></span>

                                <button class="btn btn-danger button-delete" type="button" data-bs-toggle="modal" 
                                data-bs-target="#deleteModal" 
                                data-info="<?php echo $id; ?>"
                                data-td="<?php echo $number_column; ?>"
                                >Delete</button>

                                <button class="btn btn-primary button-edit" type="button" data-bs-toggle="modal" data-bs-target="#editModal" 
                                data-info="<?php echo $id; ?>"
                                data-sentence="<?php echo $sentences['english_sentence']; ?>"
                                data-native="<?php echo $sentences['native_sentence']; ?>"
                                data-td="<?php echo $number_column; ?>"
                                >
                                Edit</button>

  
                            </td>
                        </tr>

                    <?php
                        $number_column++;
                        }
                    ?>
            </tbody>
            
        </table>
        
        <div class="col-md-12 text-center text-lg-start media-mt-3 mt-5">
            <?php 

                /***************PAGINATION***************/
                $get_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
                if (isset($_GET['page'])) {
                    $get_url = str_replace('page=' . $_GET['page'], '', $get_url);
                }

                if ($total_pages != 1) {
                    echo pagination($get_url, $num_page, $initial_number, $number_condition_limit, $total_pages, 'sentences');
                }

            ?>
        </div>


        <?php
            }
        ?>
    </div>
</main>

<!--Delete Popup-->
<div class="modal" tabindex="-1" id="deleteModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Word</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="p-4 p-md-5 border rounded-3 bg-light">
                Do you want to delete this sentence?
                <button type="button" class="btn btn-danger" id="btn-modal-delete">Yes</button>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--End Delete Popup-->

<!--Edit Popup-->
<div class="modal" tabindex="-1" id="editModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Word</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="p-4 p-md-5 border rounded-3 bg-light">


                <div class="form-floating mb-3">
                    <?php
                    $data = [
                        'type'  => 'text',
                        'name'  => 'english_sentence_modal',
                        'id'    => 'english_sentence_modal',
                        'class' => 'form-control',
                        'minlength' => '2',
                        'maxlength' => '200',
                    ];
                
                    echo form_input($data);
                    echo form_label('English sentence', 'english_sentence_modal');
                
                    echo '<small id="popup_english_sentence"></small>';
                    ?>
                </div>

                <div class="form-floating mb-3">
                    <?php
                    $data = [
                        'type'  => 'text',
                        'name'  => 'native_sentence_modal',
                        'id'    => 'native_sentence_modal',
                        'class' => 'form-control',
                        'minlength' => '2',
                        'maxlength' => '200',
                    ];
                
                    echo form_input($data);
                    echo form_label('Your sentence', 'native_sentence_modal');
                
                    echo '<small id="popup_native_sentence"></small>';
                    ?>
                </div>


                <button type="button" class="w-100 btn btn-lg btn-success" id="btn-modal-edit">Save</button>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--End Edit Popup-->
