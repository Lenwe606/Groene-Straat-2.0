<?php include_once("/php/include.inc.php"); ?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Groene Straat</title>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/layout.css"
          media="screen"/>
</head>
<body>
<div id="wrapper">
    <div id="content">
        <?php
        if (!empty($_GET["id"])) {
            $detail = get_detail_article(($_GET["id"]));
            if(empty($detail[0]))
            {
            ?>
                <h1 class="error_not_found"><?php echo $error_not_found; ?></h1>
                <script lang="javascript">window.location = "./index.php?page=articles";</script>
            <?php
            }
            else
            {
            ?>
            
        <h1 class="overview_title"><?php echo $detail[0][1]; ?></h1>
        <section class="info">
            <h2 class="section_name"><?php echo $detail_general; ?></h2>

            <p class="item_name"><?php echo $detail_owner; ?></p>

            <p class="item_value"><?php echo $detail[0][4]; ?></p>

            <p class="item_name"><?php echo $detail_creation_date; ?></p>

            <p class="item_value"><?php echo $detail[0][3]; ?></p>

            <p class="item_name"><?php echo $detail_category; ?></p>

            <p class="item_value"><?php echo $detail[0][5]; ?></p>

            <p class="item_name"><?php echo $detail_description; ?></p>

            <p class="item_value"><?php echo $detail[0][2]; ?></p>

        </section>

        <section class="buttons">
            <?php if($project_owner) {?>
                <a href="./index.php?page=newarticle&id=<?php echo $_GET["id"]; ?>"><button value="<?php echo $detail_edit; ?>"><?php echo $detail_edit; ?></button></a>
                <a><button value="<?php echo $detail_delete; ?>"><?php echo $detail_delete; ?></button></a>
            <?php } else { ?>
                <a><button value="<?php echo $detail_register; ?>"><?php echo $detail_register; ?></button></a>
            <?php } ?>
        </section>

        <section class="images">
            <h2 class="section_name"><?php echo $detail_images; ?></h2>

            <?php echo fotos($detail[1]); ?>
        </section>

        <section class="comment_items">
            <ul><?php echo comments_limited($detail[3], $detail_max_shown_comments); ?></ul>

            <?php
            if (count($detail[3]) > $detail_max_shown_comments) {
                ?>
                <p class="more_items"><a href=""><?php echo $detail_more_comment; ?></a></p>
            <?php
            }
            ?>
        </section>

        <section class="comment_section">
            <form method="post">
                <p><?php echo $detail_place_comment; ?></p>
                <textarea></textarea>
                <input type="submit" value="<?php echo $detail_place_comment_button; ?>"/>
            </form>
        </section>
        <?php
        }
        }
        ?>
    </div>
</div>
</body>
</html>