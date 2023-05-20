<?php

require_once(__DIR__ . '/../database/misc.php');
function output_FAQ($faq) { ?>
    <div class="question" data-faq-id=<?=$faq['faqId']?>>
        <div class="dropdown-button">
            <h3><?=$faq['question']?></h3>
            <span class="open">+</span>
        </div>
        <div class="dropdown-content">
            <p><?= $faq['answer']?></p>
        </div>
    </div>
<?php }
?>

<?php function output_FAQs() { ?>
    <section id="questions">
        <?php
        $faqs = getFAQs();
        foreach ($faqs as $faq) {
            output_FAQ($faq);
        } ?>
    </section>
<?php } ?>