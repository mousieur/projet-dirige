<?php
require 'partials/head.php';
require 'partials/navigation.php';
?>
<style>
    .pfp-red {
        color: red
    }

    .pfp-blue {
        color: blue
    }

    .pfp-green {
        color: green
    }

    .pfp-yellow {
        color: yellow
    }

    .pfp-orange {
        color: orange
    }

    .pfp-purple {
        color: purple
    }

    .pfp-pink {
        color: pink
    }

    .pfp-brown {
        color: brown
    }

    .pfp-black {
        color: black
    }

    .pfp-white {
        color: white
    }

    .pfp-gray {
        color: gray
    }

    .pfp-cyan {
        color: cyan
    }
</style>
<section class="bg-light py-5">
    <div class="container">
        <div class="card mx-auto shadow-lg" style="max-width: 70%;">
            <div class="card-header bg-success text-white text-center">
                <h2 class="mb-0">Player Details</h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center mb-3">
                    <div id="avatarPreview" class="fs-1 p-2 rounded">
                        <i class="fas fa-user text-black"></i>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <form action="/updateAvatar" method="post">
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            <input type="radio" class="btn-check" name="image" id="option1" autocomplete="off"
                                value="fa-user">
                            <label class="btn btn-secondary fs-2" for="option1"><i class="fas fa-user"></i></label>

                            <input type="radio" class="btn-check" name="image" id="option2" autocomplete="off"
                                value="fa-user-secret">
                            <label class="btn btn-secondary fs-2" for="option2"><i
                                    class="fas fa-user-secret"></i></label>

                            <input type="radio" class="btn-check" name="image" id="option3" autocomplete="off"
                                value="fa-user-tie">
                            <label class="btn btn-secondary fs-2" for="option3"><i class="fas fa-user-tie"></i></label>

                            <input type="radio" class="btn-check" name="image" id="option4" autocomplete="off"
                                value="fa-user-ninja">
                            <label class="btn btn-secondary fs-2" for="option4"><i
                                    class="fas fa-user-ninja"></i></label>

                            <input type="radio" class="btn-check" name="image" id="option5" autocomplete="off"
                                value="fa-user-graduate">
                            <label class="btn btn-secondary fs-2" for="option5"><i
                                    class="fas fa-user-graduate"></i></label>

                            <input type="radio" class="btn-check" name="image" id="option6" autocomplete="off"
                                value="fa-user-injured">
                            <label class="btn btn-secondary fs-2" for="option6"><i
                                    class="fas fa-user-injured"></i></label>

                            <input type="radio" class="btn-check" name="image" id="option7" autocomplete="off"
                                value="fa-user-astronaut">
                            <label class="btn btn-secondary fs-2" for="option7"><i
                                    class="fas fa-user-astronaut"></i></label>

                            <input type="radio" class="btn-check" name="image" id="option8" autocomplete="off"
                                value="fa-skull">
                            <label class="btn btn-secondary fs-2" for="option8"><i class="fas fa-skull"></i></label>

                            <input type="radio" class="btn-check" name="image" id="option10" autocomplete="off"
                                value="fa-fish">
                            <label class="btn btn-secondary fs-2" for="option10"><i class="fas fa-fish"></i></label>

                            <input type="radio" class="btn-check" name="image" id="option11" autocomplete="off"
                                value="fa-frog">
                            <label class="btn btn-secondary fs-2" for="option11"><i class="fas fa-frog"></i></label>

                            <input type="radio" class="btn-check" name="image" id="option12" autocomplete="off"
                                value="fa-hippo">
                            <label class="btn btn-secondary fs-2" for="option12"><i class="fas fa-hippo"></i></label>

                            <input type="radio" class="btn-check" name="image" id="option9" autocomplete="off"
                                value="fa-poo">
                            <label class="btn btn-secondary fs-2" for="option9"><i class="fas fa-poo"></i></label>
                        </div>
                        <div class="d-flex flex-wrap gap-3 justify-content-center mt-3">
                            <input type="radio" class="btn-check" name="couleur" id="option-red" value="pfp-red">
                            <label class="btn btn-secondary fs-2" for="option-red"> <i
                                    class="fas fa-circle pfp-red"></i></label>

                            <input type="radio" class="btn-check" name="couleur" id="option-blue" value="pfp-blue">
                            <label class="btn btn-secondary fs-2" for="option-blue"><i
                                    class="fas fa-circle pfp-blue"></i></label>

                            <input type="radio" class="btn-check" name="couleur" id="option-green" value="pfp-green">
                            <label class="btn btn-secondary fs-2" for="option-green"><i
                                    class="fas fa-circle pfp-green"></i></label>

                            <input type="radio" class="btn-check" name="couleur" id="option-yellow" value="pfp-yellow">
                            <label class="btn btn-secondary fs-2" for="option-yellow"><i
                                    class="fas fa-circle pfp-yellow"></i></label>

                            <input type="radio" class="btn-check" name="couleur" id="option-orange" value="pfp-orange">
                            <label class="btn btn-secondary fs-2" for="option-orange"><i
                                    class="fas fa-circle pfp-orange"></i></label>

                            <input type="radio" class="btn-check" name="couleur" id="option-purple" value="pfp-purple">
                            <label class="btn btn-secondary fs-2" for="option-purple"><i
                                    class="fas fa-circle pfp-purple"></i></label>

                            <input type="radio" class="btn-check" name="couleur" id="option-pink" value="pfp-pink">
                            <label class="btn btn-secondary fs-2" for="option-pink"><i
                                    class="fas fa-circle pfp-pink"></i></label>

                            <input type="radio" class="btn-check" name="couleur" id="option-brown" value="pfp-brown">
                            <label class="btn btn-secondary fs-2" for="option-brown"><i
                                    class="fas fa-circle pfp-brown"></i></label>

                            <input type="radio" class="btn-check" name="couleur" id="option-black" value="pfp-black">
                            <label class="btn btn-secondary fs-2" for="option-black"><i
                                    class="fas fa-circle pfp-black"></i></label>

                            <input type="radio" class="btn-check" name="couleur" id="option-white" value="pfp-white">
                            <label class="btn btn-secondary fs-2" for="option-white"><i
                                    class="fas fa-circle pfp-white"></i></label>

                            <input type="radio" class="btn-check" name="couleur" id="option-gray" value="pfp-gray">
                            <label class="btn btn-secondary fs-2" for="option-gray"><i
                                    class="fas fa-circle pfp-gray"></i></label>

                            <input type="radio" class="btn-check" name="couleur" id="option-cyan" value="pfp-cyan">
                            <label class="btn btn-secondary fs-2" for="option-cyan"><i
                                    class="fas fa-circle pfp-cyan"></i></label>

                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <input type="submit" class="btn btn-success" id="btn-avatar" value="Changer profil">
                        </div>
                    </form>
                </div>

                <div class="pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="fs-5 fw-bold">Alias:</div>
                        <span class="fs-5"><?= $player->alias ?></span>
                    </div>
                </div>
                <div class="pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="fs-5 fw-bold">Prenom:</div>
                        <span class="fs-5"><?= $player->prenom ?></span>
                    </div>
                </div>
                <div class="pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="fs-5 fw-bold">Nom:</div>
                        <span class="fs-5"><?= $player->nom ?></span>
                    </div>
                </div>
                <div class="pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="fs-5 fw-bold">Email:</div>
                        <span class="fs-5"><?= $player->email ?></span>
                    </div>
                </div>
                <div class="pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="fs-5 fw-bold">Solde:</div>
                        <div class="d-flex align-items-center ms-auto">
                            <span class="text-success me-3"><?= $_SESSION['messageRequest'] ?></span>
                            <form action="/requestCaps" class="d-inline me-3">
                                <button type="submit" class="btn btn-success" <?= $disable ? 'disabled' : '' ?>>Demander
                                    des caps</button>
                            </form>
                            <span class="fs-5"><?= $player->caps ?> caps</span>
                        </div>
                    </div>
                </div>
                <div class="pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="fs-5 fw-bold">Points de vie:</div>
                        <span class="fs-5"><?= $player->pointsDeVie ?>pv</span>
                    </div>
                </div>
                <div class="pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="fs-5 fw-bold">Dextérité:</div>
                        <span class="fs-5"><?= $player->dexterite ?></span>
                    </div>
                </div>
                <div class="pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="fs-5 fw-bold">Poids:</div>
                        <span class="fs-5"><?= $poidsInventaire ?> / <?= $player->poidsMax ?>lbs</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
require 'partials/footer.php';
?>
<script>
    const avatarPreview = document.getElementById('avatarPreview');
    let selectedIcon = 'fa-user';
    let selectedColorClass = 'pfp-gray';

    function updatePreview() {
        const iconElement = avatarPreview.querySelector('i');
        iconElement.className = `fas ${selectedIcon}`;

        const colorMap = {
            'pfp-red': '#e74c3c',
            'pfp-blue': '#3498db',
            'pfp-green': '#2ecc71',
            'pfp-yellow': '#f1c40f',
            'pfp-orange': '#e67e22',
            'pfp-purple': '#9b59b6',
            'pfp-pink': '#fd79a8',
            'pfp-brown': '#8e6e53',
            'pfp-black': '#2c3e50',
            'pfp-white': '#ecf0f1',
            'pfp-gray': '#7f8c8d',
            'pfp-cyan': '#1abc9c'
        };

        avatarPreview.style.color = colorMap[selectedColorClass] || '#ccc';
    }

    document.querySelectorAll('input[name="image"]').forEach(input => {
        input.addEventListener('change', () => {
            selectedIcon = input.value;
            updatePreview();
        });
    });

    document.querySelectorAll('input[name="couleur"]').forEach(input => {
        input.addEventListener('change', () => {
            selectedColorClass = input.value;
            updatePreview();
        });
    });
</script>