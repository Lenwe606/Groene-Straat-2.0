<?php include_once("php/include.inc.php"); ?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Groene Straat</title>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/layout.css"
          media="screen"/>
    <!--TODO Meta tags-->
</head>
<body>
<div id="wrapper">
    <div id="content">
        <form id="new" method="post">
            <h1><?php echo $new_article; ?></h1>
            <section id="label">
                <p><label for="title"><?php echo $article_title; ?></label></p>

                <p><label for="category"><?php echo $article_category; ?></label></p>

                <p><label for="linked_project"><?php echo $article_linked; ?></label></p>

                <p class="textarea"><label for="description"><?php echo $article_text; ?></label></p>
            </section>
            <section id="field">
                <p><input type="text" placeholder="<?php echo $article_title; ?>" id="title" name="title" required/></p>
                <select id="cboCategory" name="category" class="cbo">
                    <?php echo article_category_options(get_article_category()); ?>
                </select>
                <select id="cboProjects" name="linked_project" class="cbo">
                    <?php echo article_options(get_projects()); ?>
                </select>
                <textarea placeholder="<?php echo $article_text; ?>" id="description" name="description" required></textarea>

            </section>
            <div id="formButton">
                <p>
                    <button value="<?php echo $reset; ?>"><?php echo $reset; ?></button>
                </p>
                <p><input type="reset" type="submit" value="<?php echo $save; ?>"/></p>
            </div>
        </form>
    </div>
</div>
</body>
</html>