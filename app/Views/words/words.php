<main class="mb-6">
    <div class="container">
        <div class="row">
            <div class="col-12 my-5">
                <div class="mb-5">

                    <div class="accordion" id="accordionWord">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingWord">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWord" aria-expanded="false" aria-controls="collapseWord">
                                <strong>How does the <i>Words</i> section work?</strong>
                            </button>
                            </h2>
                            <div id="collapseWord" class="accordion-collapse collapse" aria-labelledby="headingWord" data-bs-parent="#accordionWord">
                            <div class="accordion-body">
                            In this section, you can save a word and its translation into your native language. Optionally, you can write a short description. 
                            You can edit words at any time. If you edit a word, it will automatically become active again in the game.
                            Words in English can have a maximum of 30 characters, in your language 70 and in description the maximum is 130.
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

                    $attributes = ['class' => 'p-4 p-md-5 border rounded-3 bg-light', 'id' => 'word-form'];
                    echo form_open('words/save-word', $attributes, ['actual_page' => $actual_page]);
                ?>

                <div class="form-floating mb-3">
                    <?php
                    $data = [
                        'type'  => 'text',
                        'name'  => 'english_word',
                        'id'    => 'english_word',
                        'class' => 'form-control',
                        'minlength' => '1',
                        'maxlength' => '30',
                        'Placeholder' => 'English word',
                        'required' => true,
                    ];
                
                    echo form_input($data);
                    echo form_label('English word', 'english_word');
                
                    echo '<small></small>';

                    ?>
                </div>

                <div class="form-floating mb-3">
                    <?php
                    $data = [
                        'type'  => 'text',
                        'name'  => 'native_word',
                        'id'    => 'native_word',
                        'class' => 'form-control',
                        'minlength' => '1',
                        'maxlength' => '70',
                        'Placeholder' => 'Your word',
                        'required' => true,
                    ];
                
                    echo form_input($data);
                    echo form_label('Your word', 'native_word');
                
                    echo '<small></small>';

                    ?>
                </div>

                <div class="form-floating mb-3">
                    <?php
                    $data = [
                        'type'  => 'text',
                        'name'  => 'description',
                        'id'    => 'description',
                        'class' => 'form-control',
                        'maxlength' => '130',
                        'Placeholder' => 'Description',
                    ];
                
                    echo form_input($data);
                    echo form_label('Description', 'description');
                
                    echo '<small></small>';

                    ?>
                </div>

                <?php

                    $data = [
                        'name'    => 'button',
                        'class'	  => 'w-100 btn btn-lg btn-success',
                        'id'        => 'save-new-word',
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
            $attributes = ['id' => 'word-search-form', 'method' => 'GET'];
            echo form_open('words', $attributes);
        ?>
        <table class="table table-responsive table-hover table-striped text-center mb-5" style="width: 100%;">
            <tbody>
                <tr class="table-active">
                    <td style="width: 35%;">
                        <?php
                            $data = [
                                'type'  => 'text',
                                'name'  => 'search_word',
                                'id'    => 'search_word',
                                'class' => 'form-control',
                                'value' => $search_word,
                                'maxlength' => '130',
                                'Placeholder' => 'English',
                            ];
                        
                            echo form_input($data);
                        ?>
                    </td>
                    <td style="width: 35%;">
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
                    <td style="width: 20%;">
                        <?php
                            $data = [
                                'type'  => 'text',
                                'name'  => 'search_description',
                                'id'    => 'search_description',
                                'class' => 'form-control',
                                'value' => $search_description,
                                'maxlength' => '130',
                                'Placeholder' => 'Description',
                            ];
                        
                            echo form_input($data);
                        ?>
                    </td>
                    <td style="width: 10%;">
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
            <input type="hidden" name="voice_page" value="word">
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
            if ($words_user) {
        ?>


        <div style="overflow-x:auto;">
            <table class="table table-responsive table-hover table-striped text-center" style="width: 100%;">
                <thead>
                    <tr class="tr-head">
                        <th style="width: 6%;"></th>
                        <th style="width: 32%;">English</th>
                        <th style="width: 32%;">Native</th>
                        <th style="width: 20%;">Description</th>
                        <th style="width: 10%;">More Info</th>

                    </tr>
                </thead>

                <tbody>
                        <?php

                            $number_color = 1;

                            $number_column = random_int(100, 999);
                            foreach ($words_user as $words) { 
                                $number_color++;

                                if($number_color&1) {
                                    $css_td = 'table-primary';
                                } else {
                                    $css_td = 'table-info';
                                }

                                $active_in_game = 'Yes';
                                if($words['active_in_game'] == 1)
                                {
                                    $active_in_game = 'Failed';
                                } else if($words['active_in_game'] == 2) {
                                    $active_in_game = 'Passed';
                                }

                                $phpdate = strtotime($words['created_at']);
                                $created_at = date('Y-m-d', $phpdate);

                                $id = get_hidden_id($words['id']);

                        ?>
                            <tr class="<?php echo $css_td; ?>" id="tr-one-<?php echo $number_column; ?>">
                                <td><button class="readword" data-wordread="<?php echo $words['english_word']; ?>"><i class="bi bi-volume-up-fill"></i></button></td>
                                <td id="english-<?php echo $number_column; ?>"><?php echo $words['english_word']; ?></td>
                                <td id="native-<?php echo $number_column; ?>"><?php echo $words['native_word']; ?></td>
                                <td id="description-<?php echo $number_column; ?>"><?php echo $words['description']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-secondary button-show"
                                    data-td="<?php echo $number_column; ?>"
                                    data-state="close">
                                    <i class="bi bi-plus-square"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr class="d-none" id="tr-two-<?php echo $number_column; ?>">
                                <td colspan="5">

                                    <span><strong>Active in Game: </strong><span id="active-game-<?php echo $number_column; ?>"><?php echo $active_in_game; ?></span></span>
                                    <span><strong>Fails: </strong><?php echo $words['number_failed']; ?></span>
                                    <span><strong>Success: </strong><?php echo $words['number_success']; ?></span>
                                    <span><strong>Created At: </strong><?php echo $created_at; ?></span>

                                    <button class="btn btn-danger button-delete" type="button" data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal" 
                                    data-info="<?php echo $id; ?>"
                                    data-td="<?php echo $number_column; ?>"
                                    >Delete</button>

                                    <button class="btn btn-primary button-edit" type="button" data-bs-toggle="modal" data-bs-target="#editModal" 
                                    data-info="<?php echo $id; ?>"
                                    data-word="<?php echo $words['english_word']; ?>"
                                    data-native="<?php echo $words['native_word']; ?>"
                                    data-description="<?php echo $words['description']; ?>"
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
        </div>

        <div class="col-md-12 text-center text-lg-start media-mt-3 mt-5">
            <?php 

                /***************PAGINATION***************/
                $get_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

                if (isset($_GET['page'])) {
                    $get_url = str_replace('page=' . $_GET['page'], '', $get_url);
                }

                if ($total_pages != 1) {
                    echo pagination($get_url, $num_page, $initial_number, $number_condition_limit, $total_pages, 'words');
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
                Do you want to delete this word?
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
                        'name'  => 'english_word_modal',
                        'id'    => 'english_word_modal',
                        'class' => 'form-control',
                        'minlength' => '1',
                        'maxlength' => '30',
                        'required' => true,
                    ];
                
                    echo form_input($data);
                    echo form_label('English word', 'english_word_modal');
                
                    echo '<small id="popup_english_word"></small>';
                    ?>
                </div>

                <div class="form-floating mb-3">
                    <?php
                    $data = [
                        'type'  => 'text',
                        'name'  => 'native_word_modal',
                        'id'    => 'native_word_modal',
                        'class' => 'form-control',
                        'minlength' => '1',
                        'maxlength' => '90',
                        'required' => true,

                    ];
                
                    echo form_input($data);
                    echo form_label('Your word', 'native_word_modal');
                
                    echo '<small id="popup_native_word"></small>';
                    ?>
                </div>

                <div class="form-floating mb-3">
                    <?php
                    $data = [
                        'type'  => 'text',
                        'name'  => 'description_modal',
                        'id'    => 'description_modal',
                        'class' => 'form-control',
                        'maxlength' => '130',
                    ];
                
                    echo form_input($data);
                    echo form_label('Description', 'description_modal');
                
                    echo '<small id="popup_description_word"></small>';
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
