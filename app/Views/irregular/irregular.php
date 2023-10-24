<div class="container mt-10d5 mb-5">
    <div class="row">

        <div class="mb-5">

            <div class="accordion" id="accordionWord">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingWord">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWord" aria-expanded="false" aria-controls="collapseWord">
                        <strong>How does the <i>Irregular</i> section work?</strong>
                    </button>
                    </h2>
                    <div id="collapseWord" class="accordion-collapse collapse" aria-labelledby="headingWord" data-bs-parent="#accordionWord">
                    <div class="accordion-body">
                    <p>This section works in a similar way to the games section. You are given an English verb and have to guess its irregular forms and their translation. 
                        But this section does not keep mistakes and correct guesses.
                    </p>
                    <p>
                        At the bottom of this page you will find a link to a table with the forms and the translation.
                    </p>
                    <p>
                        Currently it only works for those whose mother tongue is Spanish.
                    </p>
                    </div>
                    </div>
                </div>
            </div>

        </div>

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

foreach ($irregular as $g) {
    $infinitive = $g['infinitive'];
    $simple = $g['past_simple'];
    $participle = $g['past_participle'];
    $spanish = $g['spanish'];
}

?>

<div id="success-button" class="d-none"></div>
<div id="error-button" class="d-none"></div>
<div id="button-response" class="d-none"></div>


<div class="mb-6">
    <div class="container text-center">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 my-5">
                <div class="card">
                    <div class="card-body">

                    <button class="readword mb-3" data-wordread="<?php echo $infinitive; ?>"><i class="bi bi-volume-up-fill" style="
                        padding: 20px;
                        font-size: 30px;
                    "></i></button>

                        <div>
                            <p class="game-texts"><?php echo $infinitive; ?></p>
                        </div>

                        <div id="div-response" class="blur-words-game">
                            <p class="game-texts"><?php echo $simple; ?></p>
                            <p class="game-texts"><?php echo $participle; ?></p>
                            <p class="game-texts"><?php echo $spanish; ?></p>
                        </div>

                        <div class="text-center">


                            <button type="button" class="btn btn-success btn-lg btn-block w-100 my-3" id="show-button">Show</button>


                            <button type="button" class="btn btn-primary btn-lg btn-block w-100 my-3" id="show-button" onClick="window.location.reload();">Next</button>

                        </div>


                    </div>
                </div>
            </div>

            <div>
                <a class="btn btn-primary" href="<?php echo base_url(); ?>irregular/table">Table</a>
            </div>

        </div>
    </div>
</div>
