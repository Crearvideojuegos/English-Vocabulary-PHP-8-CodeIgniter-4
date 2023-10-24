<main class="mb-6">
    <div class="container">
        <div class="row d-flex">
            <div class="col-12 my-5">

                <table class="table table-responsive table-hover table-striped mt-5 text-center" style="width: 100%;">

                    <thead>
                        <tr class="tr-head">
                            <th style="width: 25%;">English</th>
                            <th style="width: 25%;">Native</th>
                            <th style="width: 25%;">Description</th>
                            <th style="width: 25%;">Description</th>
                        </tr>
                    </thead>

                    <tbody>
                            <?php
                                foreach ($irregular as $g) { 
                            ?>
                                <tr class="table-active">
                                    <td><?php echo $g['infinitive']; ?></td>
                                    <td><?php echo $g['past_simple']; ?></td>
                                    <td><?php echo $g['past_participle']; ?></td>
                                    <td><?php echo $g['spanish']; ?></td>
                                </tr>
                            <?php
                                }
                            ?>
                    </tbody>

                </table>

            </div>
        </div>

    </div>
</main>