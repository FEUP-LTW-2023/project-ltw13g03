<?php
    require_once(__DIR__ . '/../templates/common.php');

    output_header();
?>

<section id="ticket">
    <h2>Ticket X</h2>
    <aside>
        <div id="author">

        </div>
        <time datetime="">Date:</time>
        <div id="department">
            Department:
        </div>
        <div id="agent">

        </div>
        <div id="status">Status: </div>
        <div id="tags">
            <span class="tag">Lorem</span>
            <span class="tag">Ipsum</span>
        </div>
    </aside>
    <article id="ticket_description">
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet dui vel nulla ultrices vulputate quis sed elit. Mauris venenatis iaculis mi, vitae auctor ipsum commodo eget. Mauris eu magna sed nibh pulvinar consequat at sit amet ante. Sed ac scelerisque felis, a suscipit felis. Nam placerat metus vel nisl aliquam egestas. In cursus tellus in pharetra tempor. Sed sit amet elit augue. Proin consequat eleifend mi in aliquet. Phasellus tincidunt felis ut sem viverra pretium. Nullam id justo ornare, vehicula tellus ac, venenatis purus. Pellentesque placerat tristique libero vitae consectetur. Integer luctus enim leo, eu iaculis augue lacinia vitae.

            Etiam et dui odio. Sed ultrices non mi sit amet egestas. Vivamus condimentum at elit quis luctus. Aenean posuere vestibulum risus, quis bibendum ex dignissim eget. Nullam ut tincidunt velit, in ultrices felis. Etiam luctus convallis enim. Suspendisse a hendrerit lacus, nec tempus orci. Aenean eget est porttitor, bibendum magna a, feugiat diam. Maecenas ornare ex vitae cursus imperdiet. Vivamus facilisis nulla id dignissim cursus. Cras ipsum dui, laoreet sed dapibus molestie, consectetur nec ex. Etiam auctor, est in porta gravida, leo diam euismod metus, id mattis felis risus quis metus.

            Ut eu auctor nulla. Fusce in porta quam. Sed consectetur egestas quam. Etiam sed rhoncus tortor, eu dignissim quam. Nullam imperdiet tempus aliquet. Proin molestie gravida elit ac pellentesque. Praesent volutpat dui non lacus malesuada luctus. In faucibus malesuada felis, quis scelerisque ex fermentum in. Pellentesque at neque in nunc auctor dapibus. Etiam ultricies, metus ac pulvinar dapibus, nulla arcu placerat elit, blandit porta mauris mauris vitae lorem. Nam ut ultrices elit. Fusce magna turpis, posuere sed ex lobortis, accumsan vehicula turpis. Nulla id erat eget tellus dictum laoreet. Etiam porta, nibh id malesuada tincidunt, tellus ipsum ullamcorper mauris, venenatis posuere est ante eget leo. Integer aliquam dui eget quam sollicitudin, sed commodo sem feugiat. Maecenas lacinia elementum eros, sit amet pulvinar eros congue id.

            Mauris sed lectus nec quam condimentum condimentum. Aenean sed nunc sed mauris porta dictum ut nec augue. Morbi nec ipsum fringilla, lacinia odio vitae, sagittis elit. Quisque id sapien quam. Aliquam lobortis dolor in pretium vehicula. Mauris posuere, lacus sit amet bibendum placerat, mauris enim dignissim ipsum, vitae porta lectus massa ut metus. Sed egestas semper est, ac porttitor nisl bibendum id. Integer volutpat, mauris sit amet auctor eleifend, lorem risus pulvinar urna, ut sollicitudin tellus mauris sit amet odio. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer id mattis leo. Curabitur pulvinar vulputate nisi, sed lacinia erat bibendum eget. Vivamus convallis elementum lorem vel porta. Proin nec nisl gravida, tempus ipsum quis, tempor velit. Praesent fermentum neque facilisis mollis vestibulum.

            Maecenas dui tellus, imperdiet eu molestie eu, mollis vitae mi. Nam imperdiet nisl eget turpis elementum, nec malesuada eros dictum. Pellentesque viverra tristique sollicitudin. Mauris eget augue magna. Phasellus ac ligula a ligula mollis volutpat vel a risus. Cras pretium dui vitae nibh aliquam, sit amet tempus mi vehicula. Maecenas et lorem in massa faucibus malesuada a ut metus. Phasellus volutpat ligula at ligula finibus, eget tincidunt libero eleifend. Donec non suscipit arcu. Aenean quis nulla nibh. Mauris varius risus nec imperdiet lobortis. Nunc tempor semper urna at efficitur. Nulla nec fermentum dolor. Curabitur sem enim, ultricies quis dolor facilisis, vehicula lacinia felis.
        </p>
    </article>
    <section id="comments">
        <article class="comment">
            <img src="https://picsum.photos/80/80" alt="comment profile picture">
            <span class="comment_username">Username</span>
            <time datetime="">date</time>
            <p>
                This is a comment
            </p>
        </article>
        <article class="comment">
            <img src="https://picsum.photos/80/80" alt="comment profile picture">
            <span class="comment_username">Username</span>
            <time datetime="">date</time>
            <p>
               This is a comment
            </p>
        </article>
        <form>
            <textarea placeholder="Leave a comment"></textarea>
            <button type="submit">Reply</button>
        </form>
    </section>
</section>


<?php
    output_footer();
?>