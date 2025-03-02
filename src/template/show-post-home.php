<?php if(!empty($templateParams["posts"])): ?>
    <?php foreach ($templateParams["posts"] as $post): ?>
        <article class="bg-light border border-dark my-4 px-4 pt-3 pb-1 rounded">
            <header class="hidden-header">
                <h2>PostHome</h2>
            </header>
            <!-- Profile image -->
            <div class="row">
                <div class="col text-start" id="<?php echo $post['IDPost'] ?>">
                    <img src="./img/<?php echo $post['ImmagineProfilo'] ?>" alt="Profile image" class="rounded-circle" height="40" width="40">
                    <!-- Profile name -->
                    <a href="profile.php?username=<?php echo $post['Username_seguito'] ?>" class="username usernameStyle" id="<?php echo $post["Username_seguito"]; ?>">@<?php echo $post["Username_seguito"]; ?></a>
                    <!-- Post date -->
                    <p class="ms-1 mt-1 mb-0 smaller-font">
                        <?php 
                            $date = new DateTime($post["Data"]);
                            echo $date->format('d-m-Y');
                        ?>
                    </p>
                </div>
            </div>
            <!-- Post image -->
            <?php if(isset($post['Immagine'])): ?>
                <img src="./img/<?php echo $post['Immagine'] ?>" alt="Post image" class="img-fluid rounded max-size-image">
            <?php endif; ?>
            <!-- Post text -->
            <p class="mt-1 mb-0 fst-italic"><?php echo $post["Testo"]; ?></p>
            <!-- Hashtags -->
            <div class="row">
                <div class="col">
                    <?php if(isset($post['Hashtag1']) || isset($post['Hashtag2']) || isset($post['Hashtag3'])): ?>
                        <p class="smaller-font">
                            <?php if(isset($post['Hashtag1'])) echo $post['Hashtag1'] . ' '; ?>
                            <?php if(isset($post['Hashtag2'])) echo $post['Hashtag2'] . ' '; ?>
                            <?php if(isset($post['Hashtag3'])) echo $post['Hashtag3']; ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Buttons like and comments-->
            <div class="row mt-2">
                <div class="col d-flex justify-content-end align-items-center mb-2">
                    <button class="comment btn btn-success border-dark me-2" type="button" data-bs-toggle="modal" data-bs-target="#comments-banner" data-postid=<?php echo $post["IDPost"]; ?>>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat" viewBox="0 1 16 16">
                            <path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
                        </svg>
                    </button>
                    <button class="like btn btn-success border-dark me-2" type="button" data-postid=<?php echo $post["IDPost"]; ?>>
                        <?php
                            $isLiked = $dbh->getLikesByUserAndPostId($_SESSION["username"], $post["IDPost"]);
                            $likedClass = $isLiked ? 'liked' : '';
                        ?>
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="1 1 16 16">
                            <image xlink:href="./img/<?php echo $likedClass == 'liked' ? 'symbol_liked.png' : 'symbol.png'; ?>" height="17.5" width="17.5"/>
                        </svg>
                    </button>
                    <p class="likenumber mb-0" data-postid="<?php echo $post["IDPost"]; ?>" id="like-<?php echo $post["IDPost"]; ?>"></p>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
    <?php require_once("./components/comments-banner.php"); ?>
<?php else: ?>
    <p class="text-center mt-5">Non ci sono post.. inizia a seguire i tuoi amici per vederli!!</p>
<?php endif; ?>