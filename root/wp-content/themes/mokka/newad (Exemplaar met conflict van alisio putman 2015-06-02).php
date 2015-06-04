<?php include_once("php/include.inc.php"); ?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Groene Straat</title>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/layout.css" media="screen" />
    <!--TODO Meta tags-->
</head>
<body>
<div id="wrapper">
    <div id="content">
        <form id="new" method="post">
            <h1><?php echo $new_ad; ?></h1>
            <section id="label">
                <p><label for="title"><?php echo $ad_title; ?></label></p>
                <p><label for="type"><?php echo $ad_type; ?></label></p>
                <p><label for="category"><?php echo $ad_category; ?></label></p>
                <p class="textarea"><label for="description"><?php echo $ad_description; ?></label></p>
                <p><label for="linked_project"><?php echo $ad_linked; ?></label></p>
                <p><label for="img1"><?php echo $img; ?></label></p>
                <p><label for="img2"><?php echo $img; ?></label></p>
                <p><label for="img3"><?php echo $img; ?></label></p>
                <p><label for="img4"><?php echo $img; ?></label></p>
                <p><label for="img5"><?php echo $img; ?></label></p>
            </section>
            <section id="field">
                <p><input type="text" placeholder="<?php echo $ad_title; ?>" id="title" name="title" required/></p>
                <section>
                    <p><input type="radio" name="filter" value="<?php echo $filter_offered; ?>" checked><?php echo $filter_offered; ?></p>
                    <p><input type="radio" name="filter" value="<?php echo $filter_wanted; ?>"><?php echo $filter_wanted; ?></p>
                </section>
                <select id="cboCategory" name="category" class="cbo">
                    <?php echo ad_category_options(get_ad_category()); ?>
                </select>

                <textarea placeholder="<?php echo $ad_description; ?>" id="description" name="description" required></textarea>
                <select id="cboProjects" name="linked_project" class="cbo">
                    <?php echo ad_options(get_projects()); ?>
                </select>

                <div class="img">
                    <p>
                        <input type="text" placeholder="<?php echo $img; ?>" id="img1" name="img1"/>
                        <button value="<?php echo $button_img; ?>"><?php echo $button_img; ?></button>
                    </p>
                </div>

                <div class="img">
                    <p>
                        <input type="text" placeholder="<?php echo $img; ?>" id="img2" name="img2"/>
                        <button value="<?php echo $button_img; ?>"><?php echo $button_img; ?></button>
                    </p>
                </div>

                <div class="img">
                    <p>
                        <input type="text" placeholder="<?php echo $img; ?>" id="img3" name="img3"/>
                        <button value="<?php echo $button_img; ?>"><?php echo $button_img; ?></button>
                    </p>
                </div>

                <div class="img">
                    <p>
                        <input type="text" placeholder="<?php echo $img; ?>" id="img4" name="img4"/>
                        <button value="<?php echo $button_img; ?>"><?php echo $button_img; ?></button>
                    </p>
                </div>

                <div class="img">
                    <p>
                        <input type="text" placeholder="<?php echo $img; ?>" id="img5" name="img5"/>
                        <button value="<?php echo $button_img; ?>"><?php echo $button_img; ?></button>
                    </p>
                </div>
            </section>
            <div id="formButton">
                <p><button type="reset" value="<?php echo $reset; ?>"><?php echo $reset; ?></button></p>
                <p><input type="submit" value="<?php echo $save; ?>"/></p>
            </div>
        </form>
    </div>
</div>
</body>
</html>