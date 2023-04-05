<?php
function output_question() { ?>
    <div class="question">
        <div class="faq-header">
            <h3> O gaspar é fixe?</h3>
            <span class="open">+</span>
        </div>
        <div class="faq-answer">
            <p>O Gaspar é mesmo fixe! Ele é uma pessoa muito divertida e sempre pronto para animar qualquer
                situação. Além disso, ele é super inteligente e sempre tem ideias incríveis.</p>
        </div>
    </div>
<?php }
?>

<?php function output_questions() { ?>
    <section id="questions">
        <?php for ($i = 1; $i <= 3; $i++) {
            output_question();
        } ?>
    </section>
<?php } ?>