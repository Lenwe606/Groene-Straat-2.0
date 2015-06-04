<?php
function buttons_artikels_overview()
{
	include("php/settings.php");
	include("php/name.inc.php");
	?>
    <div id="top">
    	<section>
    		<a href="../newarticle"><button class="new_item" id="new_article" name="new_article"><?php echo $new_article?></button></a>
    		<input placeholder="<?php echo $search_filter ?>" class="search_input"/>
    	</section>
    </div>
    <?php
}

function steden_artikels_overview()
{
	include("php/settings.php");
	include("php/name.inc.php");
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results("SELECT Id, Gemeente FROM tblsteden GROUP BY Gemeente ASC");
	?>
	<div id="bottom">
	<section id="filter">
	<p class="filter_info"><?php echo $city_filter ?></p>
                <select id="cboSteden">
                <?php
                for($i=0;$i<count($rows);$i++)
				{
			    ?>
                <option value="<?php echo $rows[$i]->Id; ?>"><?php echo $rows[$i]->Gemeente; ?></option>
                <?php
            	}
            	?>
                </select>
    <?php
    categorie_artikels_overview();
}

function categorie_artikels_overview()
{
	include("php/settings.php");
	include("php/name.inc.php");
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results("SELECT Id, Naam FROM tblcategorieen WHERE Soort = 3");
	?>
	<p class="filter_info"><?php echo $category_filter ?></p>
                <ul style="list-style-type: none;">
                <?php
				for($i = 0; $i < count($rows); $i++) {
        		?>
        		<li><a href=""><?php echo $rows[$i]->Naam; ?></a></li>
    			<?php
    			}
    			?>
                </ul>
                </section>
                <?php
}
add_shortcode("steden_artikels_overview","steden_artikels_overview");

function artikels_overview()
{
	include("php/settings.php");
	include("php/name.inc.php");
	$mydb = new wpdb('root','usbw','groenestraat','localhost:3307');
	$rows = $mydb->get_results("SELECT tblartikels.*, tblgebruikers.gebruikersnaam as User, tblcategorieen.naam as Categorie FROM tblartikels inner join tblgebruikers on tblartikels.AdminId = tblgebruikers.Id inner join tblcategorieen on tblartikels.CategorieId = tblcategorieen.Id WHERE tblArtikels.Zichtbaar = 1 ORDER BY tblartikels.Aanmaakdatum DESC");
	?>
	<section id="articles">
	<ul>
	<?php 
	$max = 0;
	if($max_shown_articles_per_page > count($rows))
	{
		$max = count($rows);
	}
	else
	{
		$max = $max_shown_articles_per_page;
	}

	for($i = 0;$i<$max;$i++)
	{
		?>
			<li class="offset">
            <a href="../articledetail/<?php echo $rows[$i]->Id; ?>">
                <p class="article_name"><?php echo $rows[$i]->Titel; ?></p>

                <p class="article_date"><?php echo $rows[$i]->Aanmaakdatum; ?></p>

                <p class="article_category"><?php echo $rows[$i]->Categorie; ?></p>

                <p class="article_linked_value"><?php echo $rows[$i]->Omschrijving; ?></p>
            </a>
        	</li>
		<?php
	}
	?>
	</ul>
	<?php
}
add_shortcode("artikels_overview","artikels_overview");
?>