
<div class="container mt-10d5 mb-5">
    <div class="accordion" id="accordionGame">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingGame">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGame" aria-expanded="false" aria-controls="collapseGame">
                <strong>How does the <i>Game</i> section work?</strong>
            </button>
            </h2>
            <div id="collapseGame" class="accordion-collapse collapse" aria-labelledby="headingGame" data-bs-parent="#accordionGame">
            <div class="accordion-body">
            <strong>Welcome to the Game!</strong>
                <p>Here you will be presented with words and sentences that you have saved at random.
                If you get the word right it will disappear from the words that appear, and if you miss it, it will remain but will not appear in the game for 5 minutes.</p>

                <p>Hits and misses are saved for each word and phrase.</p>

                <p>Once you get all the words right or all the wrong words have appeared in less than five minutes, the appearing words will be reset.</p>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">

        <?php echo form_open('profile/save-voice'); ?>
            <input type="hidden" name="voice_page" value="game">
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

    </div>
</div>

<?php 

if(!empty($game)) {
    if($type_game == 'sentence') {
        foreach ($game as $g) {
            $id = get_hidden_id($g['id']);
            $english = $g['english_sentence'];
            $native = $g['native_sentence'];
            $description = '';
        }
    
    } else if($type_game == 'word') {
        foreach ($game as $g) {
            $id = get_hidden_id($g['id']);
            $english = $g['english_word'];
            $native = $g['native_word'];
            $description = $g['description'];
        }
    }
?>

<div class="mb-6">
    <div class="container text-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 my-5">
                <div class="card">
                    <div class="card-body">

                    <button class="readword mb-3" data-wordread="<?php echo $english; ?>"><i class="bi bi-volume-up-fill" style="
                        padding: 20px;
                        font-size: 30px;
                    "></i></button>

                        <div>
                            <p class="game-texts"><?php echo $english; ?></p>
                        </div>

                        <div id="div-response" class="blur-words-game">
                            <p class="game-texts"><?php echo $native; ?></p>
                            <p><?php echo $description; ?></p>
                        </div>

                        <div class="text-center">

                            <button type="button" class="btn btn-primary btn-lg btn-block w-100 my-3" id="show-button">Show</button>

                            <div id="button-response">

                                <?php
                                    $hidden = array(
                                        'type_game' => $type_game,
                                        'game' => $id
                                    );

                                    echo form_open('game/success-game', '', $hidden);
                                ?>
                                    <button type="submit" class="btn btn-success btn-lg btn-block w-100 my-3" id="success-button">I know!</button>
                                <?php
                                    echo form_close();
                                ?>

                                <?php
                                    $hidden = array(
                                        'type_game' => $type_game,
                                        'game' => $id
                                    );

                                    echo form_open('game/error-game', '', $hidden);
                                ?>
                                    <button type="submit" class="btn btn-danger btn-lg btn-block w-100 my-3" id="error-button">Error</button>
                                <?php
                                    echo form_close();
                                ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

} else {

    if($user_can_game) {
        echo '
        <script>
            window.location.reload();
        </script>
        ';
    }

?>

<?php
}
